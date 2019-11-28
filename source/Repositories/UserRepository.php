<?php

namespace DevBoot\Repositories;

use DevBoot\Interfaces\UserRepoInterface;
use DevBoot\Repositories\AbstractDefaultRepository;
use DevBoot\Core\Session;
use DevBoot\Core\View;
use DevBoot\Support\Email;
use DevBoot\Support\Message;

use DevBoot\Commands\UserCmd;
use DevBoot\Models\User;

/**
 * Class Auth
 * @package DevBoot\AuthRepository
 */
class UserRepository extends AbstractDefaultRepository implements UserRepoInterface
{

    protected $modelClass = User::class;
    protected $model;
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
        $this->model = new User;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(string $name, string $cpf, string $email, string $password)
    {

        try {

            $newUser = $this->model;

            $newUser->name = $name;
            $newUser->cpf = $cpf;
            $newUser->email = $email;
            $newUser->password = passwd($password);
            if (!$newUser->save()) {
                $this->message->error("Não foi possível finalizar o cadastro");
                return;
            }
        } catch (\PDOException $e) {
            $this->message->error("Não foi possível finalizar o cadastro");
            return false;
        }

        $this->message->success("Cadastro realizado com sucesso.");
        return $newUser;
    }

    public function update(array $data): bool
    {
        $update = User::find($data['id']);
        $update->first_name = $data['first_name'];
        $update->last_name = $data['last_name'];
        $update->email = $data['email'];
        $update->level = $data['level'];
        $update->office_registry = $data['office_registry'];
        $update->office = $data['office'];
        $update->office_unity_id = $data['office_unity_id'];
        $update->status = $data['status'];
        $update->reserved = $data['reserved'];
        if ($update->save()) {
            $this->message->success("Editado com sucesso.")->flash();
            return true;
        }
        return false;
    }

    public function delete(int $data): bool
    {
        $delete = User::find($data);
        if (!$delete->delete()) {
            $this->message->error("Não foi possível remover a ocorrência.")->flash();
            return false;
        }
        return true;
    }

    public function findByCpfOrEmail(array $data)
    {
        $query = parent::newQuery();
        $query->where("cpf", "=", $data['cpf'])
            ->orWhere("email", "=", $data['email']);

        if (!empty($this->doQuery($query, [], 0, false)->toArray())) {
            return $this->doQuery($query, [], 0, false);
        }
        return false;
    }

    public function getUsers(array $filter, int $take, bool $paginate, bool $all = true): object
    {
        $query = parent::newQuery();

        if (!$all) {
            $query->where('status', '!=', 'ON');
        }

        $query->where('level', '!=', 10)
            ->where('level', '!=', 5)
            ->orderBy('first_name', 'ASC')
            ->orderBy('last_name', 'ASC');
        return $this->doQuery($query, $filter, $take, $paginate);
    }

    public function getAllUsers(array $filter = [], int $take = 10, bool $paginate = false): object
    {
        $query = parent::newQuery();
        $query->orderBy('name', 'ASC')
            ->orderBy('level', 'ASC');
        return $this->doQuery($query, $filter, $take, $paginate);
    }
    // public function getUsers()

    /**
     * @param string $email
     * @param string $password
     * @param bool $save
     * @return bool
     */
    public function login(string $email, string $password, bool $save = false, string $level = '1'): bool
    {
        if (!is_email($email)) {
            $this->message->warning("O e-mail informado não é válido");
            return false;
        }

        if ($save) {
            setcookie("authEmail", $email, time() + 604800, "/");
        } else {
            setcookie("authEmail", null, time() - 3600, "/");
        }

        if (!is_passwd($password)) {
            $this->message->warning("A senha informada não é válida");
            return false;
        }

        $user = User::where('email', '=', $email)->get();

        if ($user->isEmpty()) {
            $this->message->error("O e-mail informado não está cadastrado");
            return false;
        }

        if ($user[0]->status == "OFF") {
            $this->message->warning("Sua conta não está ativada, verifique o email enviado!");
            return false;
        }

        if ($user[0]->status == "BLOCK") {
            $this->message->error("Usuário bloqueado!");
            return false;
        }


        if (!passwd_verify($password, $user[0]->password)) {
            $this->message->error("A senha informada não confere");
            return false;
        }

        if (passwd_rehash($user[0]->password)) {
            $user->password = $password;
            $user->save();
        }

        //LOGIN
        (new Session())->set("authUser", $user[0]->id);
        // $this->message->success("Login efetuado com sucesso")->flash();
        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function forget(string $email): bool
    {
        $user = User::where("email", $email)->first();

        if (!$user) {
            $this->message->warning("O e-mail informado não está cadastrado.");
            return false;
        }

        $user->forget = md5(uniqid(rand(), true));
        $user->save();

        $view = new View(__DIR__ . "/../../shared/views/email");
        $message = $view->render("forget", [
            "name" => $user->name,
            "forget_link" => url("/recuperar/{$user->email}|{$user->forget}")
        ]);

        (new Email())->bootstrap(
            "Recupere sua senha no " . CONF_SITE_NAME,
            $message,
            $user->email,
            "{$user->name}"
        )->send();

        return true;
    }

    /**
     * @param string $email
     * @param string $code
     * @param string $password
     * @param string $passwordRe
     * @return bool
     */
    public function reset(string $email, string $code, string $password, string $passwordRe): bool
    {
        $user = People::where("email", "=", $email)->first();

        if (!$user) {
            $this->message->warning("A conta para recuperação não foi encontrada.");
            return false;
        }

        if ($user->forget != $code) {
            $this->message->error("Desculpe, mas o código de verificação não é válido.");
            return false;
        }

        if (!is_passwd($password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->info("Sua senha deve ter entre {$min} e {$max} caracteres.");
            return false;
        }

        if ($password != $passwordRe) {
            $this->message->warning("Você informou duas senhas diferentes.");
            return false;
        }

        $user->password = passwd($password);
        $user->forget = null;
        $user->save();
        return true;
    }
}
