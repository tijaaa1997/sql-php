<?php


$servername = "127.0.0.1";
$username = "milos";
$password = "milos";
$dbname = "users_db";

    

try {
    $connection = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<html>
<head></head>
<body>

<h1>LALALA</h1>
</body>

</html>