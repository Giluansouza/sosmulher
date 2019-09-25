<?php

namespace DevBoot\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * DevBoot | Class City
 * @author Giluan Souza <contato@giluansouza.com.br>
 * @package DevBoot\Models
 */
class City extends Model
{

    protected $table = "cities";
    public $timestamp = false;
    protected $fillable = [
        'name',
        'uf_initials'
    ];

    public function Address() {
        return $this->hasMany(Address::class, 'id');
    }
}
