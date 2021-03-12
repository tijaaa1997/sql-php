<?php

include "db/db.php";

$id = $_GET['id'];

$sql = "DELETE FROM  users WHERE id=:izabraniKorisnik";

$statement = $connection->prepare($sql);
$statement->bindParam(":izabraniKorisnik",$id);

$statement->execute();

if($statement->rowCount() > 0){
    echo ("Uspesno obrisan korisnik");
}else{
    echo("Greska");
}
