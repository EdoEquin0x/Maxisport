

<?php

    // Petit script PHP pour déconnecter l'utilisateur, avec destruction de la variable session


    session_start();


    session_unset();
    session_destroy();
    header("location: http://localhost/MaxiSport/index.php");
