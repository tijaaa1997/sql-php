<?php
    //TO DO: sve iz ovog fajla probaj da iskucas u index.php 


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


    //pisemo sql upit kao obican string
    $sql = "SELECT * FROM users;";

    //pripremamo upit
    $statement = $connection->prepare($sql);

    //izvrsavamo sql upit
    $statement->execute();

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $users = $statement->fetchAll();

    //ovo pre je radi lepseg ispisa
    echo '<pre>';
    //ispisujemo sve korisnike koji su u promenljivboj users
    var_dump($users);
    echo '</pre>';