<?php

namespace DevBoot\Support\Commands;

use DevBoot\Support\Validations\ValidationException;

abstract class Command
{
    /**
     * @var array
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->validate();
    }

    protected function validate()
    {
        $method = 'validation';

        if (!method_exists($this, $method)) {
            return true;
        }

        try {
            $class = $this->$method();
            (new $class($this->data))->validate();
        } catch (ValidationException $validationException) {
            throw new CommandException(
                $validationException->getMessages(),
                "Validation exception",
                ValidationException::class
            );
        }
    }

     /**
     * Handle the command.
     *
     * @return mixed
     */
    abstract public function handle();
}
