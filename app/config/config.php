<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'port' => 5432,
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'manarah',
            'charset' => 'utf8'
        ],

        'application' => [
	        'controllersDir' => "app/controllers/",
	        'modelsDir'      => "app/models/",
	        'libraryDir'      => "app/library/",
	        'baseUri'        => "/",
        ],
    ]
);
