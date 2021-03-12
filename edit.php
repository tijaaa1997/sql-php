<?php

    include "db/db.php";
    $id = $_GET['id'];

    echo($id);


?>

<html>
    <body>
    <!-- forma kojom se unosi novi korisnik, na submit se salje POST request -->
        <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <label>Ime: </label><input type="text" name="ime" /><br/>
            <label>Prezime: </label><input type="text" name="prezime" /><br/>
            <label>Email: </label><input type="text" name="email" /><br/>
            <input type="submit" value="Edit" />
        </form>
    </body>
</html>



<?php

    if (isSet($_POST["ime"]) && isSet($_POST["prezime"]) && isSet($_POST["email"])) {
        //pokupi vrednosti koje je korisnik uneo

        $novoIme = $_POST["ime"];
        $novoPrezime = $_POST["prezime"];
        $noviEmail = $_POST["email"];

        //napisi sql upit

        $sql = "UPDATE users 
                SET first_name=:novoIme, last_name=:novoPrezime, email=:noviEmail 
                WHERE id=:id";

        //izvrsi ga

        $statement = $connection->prepare($sql);

        $data = [
            "novoIme" => $novoIme,
            "novoPrezime" => $novoPrezime,
            "noviEmail" => $noviEmail,
            "id" => $id
        ];

        $statement->execute($data);

        //ispisi poruku da li je uspelo
        
        $brojRedova = $statement->rowCount();

        if ($brojRedova > 0) {
            echo ("Uspesno izmenjeno ".$brojRedova. " korisnika");
        } else {
            echo ("Greska pri izmeni!");
        }
    }