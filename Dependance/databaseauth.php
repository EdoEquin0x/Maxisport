


<?php

//PHP pour se connecter à la base de donnée

$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$auth = new PDO('mysql:host='.$hostname.';port='.$dbport.';dbname='.$database.'', $username, $password);


if (!$auth) {
    die("Erreur: Connexion à la base de donnée échouée");
    
}
else {
}