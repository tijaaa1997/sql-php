<?php
    include "db.php";
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
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
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
                <td>Godine</td>
                <td>Email</td>
                <td>Obrisi</td>

            </tr>
            <?php
                foreach($users as $user) {
            ?>   
                <tr>
                    <td><?php echo($user['ime']) ?></td>
                    <td><?php echo($user['godine']) ?></td>
                    <td><?php echo($user['email']) ?></td>
                    <td> <a href="delete.php?id=<?php echo($user['id'])?>">
                    <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php 
                }
            ?>
       </table>
  
    </body>
</html>
