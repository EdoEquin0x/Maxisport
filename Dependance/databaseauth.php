

<?php

//PHP pour se connecter à la base de donnée

$db="uh8hmkbxnun65c7p";
$dbhost="au77784bkjx6ipju.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$dbport=3306;
$dbuser="i7v6t4j8h5wmdz4r";
$dbpasswd="ezcxruodepso3vpi";

$auth = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);


if (!$auth) {
    die("Erreur: Connexion à la base de donnée échouée");
    
}
else {
}
