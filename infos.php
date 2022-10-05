<?php

  //Page d'info, j'y intègre le script d'authentification, le header, le footer et le contenu
  // J'y importe également le CSS concerné pour cette page


  require_once 'Dependance/databaseauth.php';
  include 'htmlbase/base.html';
  include 'htmlbase/header.php';
  include 'infos/html/contactform.html';
  include 'htmlbase/footer.html';
?>
<link href="accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
<link href="infos/css/contactform.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/canvas.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

<script src="accueil/javascript/layermenu.js"></script>

<script src="accueil/javascript/navbarselector.js"></script>

<script src="accueil/javascript/canvas.js"></script>
