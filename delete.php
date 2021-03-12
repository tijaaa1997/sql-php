<?php
    include "db.php";

    $id = $_GET['id'];

    //napisati query sql
    $sql = "DELETE FROM users WHERE id=:izabranKorisnik";

    $statement = $connection->prepare($sql);

    $statement->bindParam(":izabranKorisnik", $id);

    //izvrsiti ga
    $statement->execute();


    if ($statement->rowCount() > 0) {
        echo ("Uspesno obrisan korisnik!");
    } else {
        echo ("Greska");
    }