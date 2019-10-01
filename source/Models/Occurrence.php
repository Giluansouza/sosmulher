<?php

namespace DevBoot\Models;

use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{

    protected $table = 'occurrences';
	protected $fillable = [
        'users_id',
        'type',
        'real_time',
        'plaintiff',
        'precautionary_measure',
        'name_victim',
        'name_accused',
        'note',
        'ip_plaintiff',
        'plaintiff_coordinates',
        'status'
	];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function Address()
    {
        return $this->hasOne(Address::class, "occurrences_id");
    }
}
