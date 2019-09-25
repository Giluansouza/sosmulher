<?php

namespace DevBoot\Commands;

use DevBoot\Support\Commands\Command;
use DevBoot\Repositories\AddressRepository;
use DevBoot\Models\Address;
use DevBoot\Support\Message;
use DevBoot\Support\Validations\Users\UserValidation;

class AddressCmd extends Command
{

    protected $data;
    private $message;

    public function __construct(array $data)
    {
        $this->message = new Message();
        $this->data = $data;
    }

    public function handle()
    {
        if (!$this->validation()) {
            return;
        }

        $query = new AddressRepository();
        $this->message = $query->message();
        return $query->create(
            ($this->data['users_id']?:NULL),
            ($this->data['city_id']??2623),
            $this->data['occurrences_id'],
            ($this->data['cep']??""),
            $this->data['public_place'],
            $this->data['complement'],
            $this->data['district'],
            $this->data['coordinates']
        );
    }

    public function message()
    {
        return $this->message;
    }

    protected function validation(): bool
    {

        // if ($this->data['cpf'] == "" || $this->data['email'] == "" || $this->data['password'] == "") {
        //     $this->message->error("Todos os campos são de preenchimento obrigatório");
        //     return false;
        // }

        // if (!is_cpf($this->data['cpf'])) {
        //     $this->message->error("CPF inválido");
        //     return false;
        // }

        // if (!is_email($this->data['email'])) {
        //     $this->message->error("E-mail inválido");
        //     return false;
        // }

        // if ($this->data['password'] != $this->data['conf_password']) {
        //     $this->message->warning("As senhas não conferem");
        //     return false;
        // }

        return true;
    }
}
