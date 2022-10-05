<?php

  //Page listant les offres, j'y intègre le script d'authentification, le header, le footer le contenu
  //J'y intègre aussi le CSS utilisé sur cette page

  require_once 'Dependance/databaseauth.php';
  include 'htmlbase/base.html';
  include 'htmlbase/header.php';
  include 'offers/html/offers.html';
  include 'htmlbase/footer.html';
?>
<link href="accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
<link href="offers/css/offers.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/canvas.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

<script src="accueil/javascript/layermenu.js"></script>

<script src="accueil/javascript/navbarselector.js"></script>

<script src="accueil/javascript/canvas.js"></script>
