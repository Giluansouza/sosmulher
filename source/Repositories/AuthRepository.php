<?php

namespace DevBoot\Repositories;

use DevBoot\Repositories\AbstractDefaultRepository;
use DevBoot\Core\Session;
use DevBoot\Core\View;
use DevBoot\Boot\Helpers;
use DevBoot\Support\Email;
use DevBoot\Support\Message;
use DevBoot\Models\User;

/**
 * Class Auth
 * @package DevBoot\AuthRepository
 */
class AuthRepository extends AbstractDefaultRepository
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * @return null|User
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return User::find($session->authUser);
    }

    /**
     * log-out
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
        $session->unset("weblogin");
        session_destroy();
    }

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
