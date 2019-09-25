<?php

namespace DevBoot\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
	    'name',
        'email',
        'password',
        'forget',
        'cpf',
        'rg',
        'date_birth'
	];

    public function Occurrences()
    {
        return $this->hasMany(Occurrence::class, 'users_id');
    }
}
