<?php
 
   include "db/db.php";

    

?>


<html>
    <body>
    <!-- forma kojom se unosi novi korisnik, na submit se salje POST request -->
        <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <label>Ime: </label><input type="text" name="ime" /><br/>
            <label>Prezime: </label><input type="text" name="prezime" /><br/>
            <label>Email: </label><input type="text" name="email" /><br/>
            <input type="submit" value="Dodaj novog" />
        </form>
    </body>


</html>


<?php
    //prikupljamo podatke 
    $unesenoIme = $_POST['ime'];
    $unesenoPrezime = $_POST['prezime'];
    $unesenEmail = $_POST['email'];

    //proveravamo da li je korisnik uneo sva polja, ako je neko ostavio praznim nece se dodati novi user
    if ($unesenoIme != "" && $unesenoPrezime != "" && $unesenEmail != "") {
        //pisemo sql upit kao obican string
        $sql = "insert into users  (first_name, last_name, email) values (:ime, :prezime, :email);";

        //pripremamo upit
        $statement = $connection->prepare($sql);

        $informacije = [
            "ime" => $unesenoIme,
            "prezime" => $unesenoPrezime,
            "email" => $unesenEmail
        ];

        //Drugi nacin, onda nije potrebno praviti objekat $informacije vec rucno bindovati svaki parametar, onda na 68 liniji ne bismo prosledjivali taj objekat $informacije
        // $statement->bindParam(":ime", $unesenoIme);
        // $statement->bindParam(":prezime", $unesenoPrezime);
        // $statement->bindParam(":email", $unesenEmail);

        //izvrsavamo sql upit
        $statement->execute($informacije);
    }

?>