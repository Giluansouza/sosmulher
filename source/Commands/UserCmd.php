<?php

namespace DevBoot\Commands;

use DevBoot\Support\Commands\Command;
use DevBoot\Repositories\UserRepository;
use DevBoot\Models\User;
use DevBoot\Support\Message;
use DevBoot\Support\Validations\Users\UserValidation;

class UserCmd extends Command
{

    protected $data;
    private $message;

    public function __construct(array $data)
    {
        $this->message = new Message();
        $this->data = $data;
    }

    public function getName()
    {
        return $this->name;
    }

    public function handle()
    {
        if (!$this->validation()) {
            return;
        }

        $query = new UserRepository();
        $this->message = $query->message();
        return $query->create(
            $this->data['cpf'],
            $this->data['email'],
            $this->data['password']
        );
    }

    public function message()
    {
        return $this->message;
    }

    protected function validation(): bool
    {

        if ($this->data['cpf'] == "" || $this->data['email'] == "" || $this->data['password'] == "") {
            $this->message->error("Todos os campos são de preenchimento obrigatório");
            return false;
        }

        if (!is_cpf($this->data['cpf'])) {
            $this->message->error("CPF inválido");
            return false;
        }

        if (!is_email($this->data['email'])) {
            $this->message->error("E-mail inválido");
            return false;
        }

        if ($this->data['password'] != $this->data['conf_password']) {
            $this->message->warning("As senhas não conferem");
            return false;
        }

        if ((new UserRepository())->findByCpfOrEmail($this->data)) {
            $this->message->error("CPF ou E-mail já cadastrado");
            return false;
        }

        return true;
    }
}
