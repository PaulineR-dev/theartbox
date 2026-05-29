<?php

function connexion() {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=artbox;charset=utf8',
        'root',
        ''
    );

    return $mysqlClient;
}