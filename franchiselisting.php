<?php

    // Page de listage des franchises, ici j'y intègre le script d'authentification, le header, le footer et le contenu
    // J'y importe également le CSS concerné pour cette page


    require_once 'Dependance/databaseauth.php';
    include 'htmlbase/base.html';
    include 'htmlbase/header.php';
    if (isset($_SESSION["Level"])) {
      if ($_SESSION["Level"] === 'Admin') {include 'pannel/html/franchiselisting.php';}
    }
    else {session_start(); session_unset(); session_destroy(); header ('location: http://localhost/MaxiSport/index.php');}

    include 'htmlbase/footer.html';
  
?>
<link href="accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />

<link href="pannel/css/hub.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/canvas.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

<script src="accueil/javascript/layermenu.js"></script>

<script src="accueil/javascript/navbarselector.js"></script>

<script src="accueil/javascript/canvas.js"></script>

