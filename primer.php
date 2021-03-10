<?php


    $username = "root";
    $password = "password";
    $servername = "127.0.0.1";
    $db_name = "users_db";


    try {
        $connection = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


