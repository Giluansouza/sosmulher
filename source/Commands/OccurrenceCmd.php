<?php

namespace DevBoot\Commands;

use DevBoot\Support\Commands\Command;
use DevBoot\Repositories\OccurrenceRepository;
use DevBoot\Models\User;
use DevBoot\Support\Message;
use DevBoot\Support\Validations\Users\UserValidation;

class OccurrenceCmd extends Command
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

        $query = new OccurrenceRepository();
        $this->message = $query->message();
        return $query->create(
            $this->data['users_id']?:NULL,
            $this->data['type']??0,
            $this->data['real_time']??"",
            $this->data['plaintiff']??"",
            $this->data['precautionary_measure']??"",
            $this->data['name_victim']??"",
            $this->data['name_accused']??"",
            $this->data['note']??"",
            $this->data['ip_plaintiff'],
            $this->data['plaintiff_coordinates']
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
