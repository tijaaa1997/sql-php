<?php
 
    //sve sto je potrebno da bi se ostvarila konekcija ka bazi
    $username = "root";
    $password = "password";
    $servername = "127.0.0.1";
    $db_name = "users_db";


    try {
        //pokusavamo da uspostavimo konekciju sa bazom
        $connection = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);

        //definisemo da ako se desi greska baci eror
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        //ispisujemo eror ukoliko se desi
        echo $e->getMessage();
    }
?>