<?php

function ConnectionPDO(string $dsn = "", string $user = "", string $password = ""): ?PDO
{
    $dsn = "mysql:host=127.0.0.1;dbname=ecom";
    $user = "root";
    $password = "root";
    try {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo "Une erreur est survenue : $e";
    }
    return null;
}
