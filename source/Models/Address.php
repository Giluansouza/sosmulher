<?php

namespace DevBoot\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = "addresses";
    public $timestamp = false;

	protected $fillable = [
        'users_id',
        'city_id',
        'occurrences_id',
        'district',
        'public_place',
        'latitude',
        'longitude'
	];
}
