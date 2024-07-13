<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {
    public function __construct() {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'postgresql',
            'host'      => '127.0.0.1',
            'database'  => 'api_pacientes',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
