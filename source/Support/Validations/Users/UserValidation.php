<?php

namespace DevBoot\Support\Validations\Users;

use DevBoot\Support\Validations\Validation;
use Illuminate\Validation\Rule;

/**
 *
 */
class UserValidation extends Validation
{

    /**
     * @var $data
     */
    protected $data;

    function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'email' => [
                'required',
                Rule::unique('users', 'email'),
                'email'
            ],
            'cpf' => [
                'required',
                Rule::unique('users', 'cpf'),
                'cpf'
            ],
            'password' => 'required|min:4'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'cpf.cpf' => 'CPF não é válido'
        ];
    }
}
