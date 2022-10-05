<!-- HTML du header, il contiens les deux navbar, l'une est cachée quand l'autre ne l'est pas -->

<?php 
  $result = $auth->query('SELECT COUNT(*) AS num_rows FROM admin');
  $numRows = $result->fetchColumn();


  if ($numRows == 0) {
    header('location: login/presentation.php');
  }
  else {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  
?>

<canvas id="nokey" width="200" height="200">
</canvas>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<header>

    <!-- Menu de navigation classique -->

    <nav class="navbar">
      <a href="http://localhost/MaxiSport/index.php" class="logo">MaxiSport</a>
      
      <div class="navmenu">
        <ul>
          <li id="home"><a href="http://localhost/MaxiSport/index.php">Accueil</a></li>
          <li id="offers"><a href="http://localhost/MaxiSport/offers.php">Offres</a></li>
          <li id="infos"><a href="http://localhost/MaxiSport/infos.php">Contact</a></li>
          <?php 

          // Si l'utilisateur est connecté, le header se vois modifié
          if (isset($_SESSION["Level"])) {
            echo '<li id="pannel"><a href="http://localhost/MaxiSport/pannel.php">Pannel</a></li>';
            echo '<li id="logout"><a href="http://localhost/MaxiSport/login/Logout.php">Deconnexion</a></li>';
          } else {
            echo '<li id="login"><a href="http://localhost/MaxiSport/login.php">Connexion</a></li>';
          }


          ?>
          
        </ul>
      </div>
    </nav>


    <!-- Menu de navigation pour mobile et tablettes -->
    <nav class="mobilenavbar">
      
      <div class="navmenu">
        <ul>

          <div class="navcontainer">
          <li id="home"><a class="material-symbols-outlined navicon" href="http://localhost/MaxiSport/index.php">home</a></li>
          
          <li id="offers"><a class="material-symbols-outlined navicon" href="http://localhost/MaxiSport/offers.php">shopping_bag</a></li>
          <li id="infos"><a class="material-symbols-outlined navicon" href="http://localhost/MaxiSport/infos.php">mail</a></li>
          <?php 
          
          // Si l'utilisateur est connecté, le header se vois modifié
          if (isset($_SESSION["Level"])) {

            echo '<li id="pannel"><a class="material-symbols-outlined navicon" href="http://localhost/MaxiSport/pannel.php">settings</a></li>';
            echo '<li id="logout"><a class="material-symbols-outlined navicon" href="http://localhost/MaxiSport/login/Logout.php">logout</a></li>';
          } else {
            echo '<li id="login"><a class="material-symbols-outlined navicon" href="http://localhost/MaxiSport/login.php">login</a></li>';
          }


          ?>
          
        </ul>
      </div>
    </nav>






   
      <div class="slideranimationbar">
        <p>-</p>
      </div>
    
     

</header> 
<?php }?>