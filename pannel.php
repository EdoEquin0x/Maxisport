<?php

  //Page principale du pannel, j'y intègre le script d'authentification, le header, le footer et le contenu
  //J'y intègre aussi le CSS utilisé sur cette page


  //Ici il y a une vérification du niveau d'authentification, et selon ce dernier l'utilisateur sera redirigé sur le pannel
  //Dédié à son niveau d'authentification. Ce processus est sécurisé par la vérification systématique sur chaque page admin
  // de ce fameux niveau, si l'utilisateur tente via URL d'accéder à une page qui ne lui est pas destinée, sa session est détruite
  // et il est redirigé sur la page d'acceuil.





    require_once 'Dependance/databaseauth.php';
    include 'htmlbase/base.html';
    include 'htmlbase/header.php';
    if (isset($_SESSION["Level"])) {
      if ($_SESSION["Level"] === 'Admin') {include 'pannel/html/pannelhub.php';}
      if ($_SESSION["Level"] === 'Franchise') {include 'pannel/html/franchisereadonly.php';}
      if ($_SESSION["Level"] === 'Establish') {include 'pannel/html/establishreadonly.php';}

    }
    else {session_start(); session_unset(); session_destroy(); header ('location: https://php-maxisport.herokuapp.com/index.php');}

    include 'htmlbase/footer.html';
  
?>
<link href="accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />


<link href="accueil/css/canvas.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

<script src="accueil/javascript/layermenu.js"></script>

<script src="accueil/javascript/navbarselector.js"></script>

<script src="accueil/javascript/canvas.js"></script>

