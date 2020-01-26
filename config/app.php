<?php
require_once 'db_cfg.php';

/*
const app = [
    'DB' => [
        'driver'   => 'pdo_mysql',
        'host'     => DB_HOST,
        'dbname'   => DB_NAME,
        'user'     => DB_USER,
        'password' => DB_PASSWORD
    ]
];
*/
const app = [
    'DB' => [
        'dsn' => 'sqlite:../db.sqlite',
    ],
];