<?php

namespace DevBoot\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * DevBoot | Class Connect [ Singleton Pattern ]
 * @author Giluan Souza <contato@giluansouza.com.br>
 * @package DevBoot\Core
 */
class Connect
{

    public function __construct()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => getenv('DB_CONNECTION'),
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ]);

        return $capsule->bootEloquent();
    }

}
