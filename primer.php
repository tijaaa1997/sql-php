<?php
    //TO DO: sve iz ovog fajla probaj da iskucas u index.php 


    //sve sto je potrebno da bi se ostvarila konekcija ka bazi
    $username = "milos";
    $password = "milos";
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


    //uzimamo ime koje je korisnik uneo
    $unesenoIme = $_GET['ime'];

    //ako je korisnik uneo prazno ili nije jos nista uneo dobavljamo sve korisnike
    if ($unesenoIme == '') {
        $query = "SELECT * from users;";
    } else {
        //inace filtriramo korisnike po imenu
        $query = "SELECT * FROM users WHERE first_name = :ime";
    }
    

    //pripremamo sql upit
    $statement = $connection->prepare($query);

    //vrsimo bindovanje parametra u upitu (ako postoje)
    $statement->bindParam(":ime", $unesenoIme);

    //izvrsavamo upit
    $statement->execute();


    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $users = $statement->fetchAll();

?>


<html>
    <head></head>
    <style>
        table, th, td {
             border: 1px solid black;
            }
    </style>
    <body>
    <!-- forma za pretragu korisnika po imenu, salje GET request -->
        <form method="GET" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <input type="text" name="ime"/>
            <input type="submit" value="Pretrazi"/>
        </form>
<!-- 
Prikazujemo korisnike u tabeli, svaki user je jedan red u tabeli (jedan tr), svako obelezje je jedna kolona (jedan td) -->
       <table style="width: 400px;">
            <tr>
            <!-- Ovo su nazivi kolona -->
                <td>Ime</td>
                <td>Prezime</td>
                <td>Email</td>
            </tr>
            <?php
                foreach($users as $user) {
            ?>   
                <tr>
                    <td><?php echo($user['first_name']) ?></td>
                    <td><?php echo($user['last_name']) ?></td>
                    <td><?php echo($user['email']) ?></td>
                </tr>
            <?php 
                }
            ?>
       </table>
  
    </body>
</html>
