<?php

    // HTML de la page qui s'ouvre lorsque l'utilisateur est une franchise ou un établissement et qu'il se connecte pour la première fois, menant donc au changement 
    // de mot de passe obligatoire

 
    if (isset($_GET['changepswd'])) {
        ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="../accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
        <link href="../accueil/css/canvas.css" rel="stylesheet" type="text/css" />
        <link href="../accueil/css/mainpage.css" rel="stylesheet" type="text/css" />
        <link href="../accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

        <script src="../accueil/javascript/layermenu.js"></script>
        <script src="../accueil/javascript/navbarselector.js"></script>
        <script src="../accueil/javascript/canvas.js"></script>


        <body>
            <canvas id="nokey" width="800" height="800"></canvas>
            <div class="bodyloginblock">
                <div class="loginblock">
                    <div class="logintext">
                        <h1>Changement de mot de passe</h1>
                    </div>
                    <form class="login-form" action="https://php-maxisport.herokuapp.com/authentification.php" method="get">
                        <br>
                        <?php 
                            if (isset($_GET['passwordmismatch'])) {
                                
                                echo '<p class="warningmessage">*Erreur: Le mot de passe est incorrect ou l\'utilisateur n\'existe pas</p>';

                            }
                            
                        ?>
                        <div class="FormBlock">
                            <p class="material-symbols-outlined">person</p>
                            <input type="text" value="<?php if (isset($_GET['login'])) { echo $_GET['login'];}?>" title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)." name="login" placeholder="Adresse Email / Login" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$">
                            <p class="placeholder">Adresse Email / Login</p>
                        </div>
                        <div class="FormBlock">
                            <p class="material-symbols-outlined">lock_person</p>
                            <input type="text" value="<?php if (isset($_GET['password'])) { echo $_GET['password'];}?>" title="Le mot de passe doit comporter au minimum 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial." name="password" placeholder="Mot de passe fournis" required>
                            <p class="placeholder">Mot de passe fournis</p>
                            
                        </div>
                        <div class="FormBlock">
                            <p class="material-symbols-outlined">lock_reset</p>
                            <input type="text" value="" title="Le mot de passe doit comporter au minimum 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial." name="newpassword" placeholder="Nouveau mot de passe" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                            <p class="placeholder">Nouveau mot de passe</p>
                            <p class="text">*Doit comporter au moins 8 caractères, une minuscule, une majuscule,</p>
                            <p class="text">un chiffre et un caractère spécial.</p>
                            

                        </div>
                        <br>
                        <button type="submit" name="changepasswordsubmit">Créer</button>
                    </form>
                </div>
                </div>
            </div>
        </body>
        <link href="css/firstpageform.css" rel="stylesheet" type="text/css" />
        <script src="accueil/javascript/canvas.js"></script>
    <?php
        }
        else { ?>
            <link href="../accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
            <link href="../accueil/css/canvas.css" rel="stylesheet" type="text/css" />
            <link href="../accueil/css/mainpage.css" rel="stylesheet" type="text/css" />
            <link href="../accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

            <script src="../accueil/javascript/layermenu.js"></script>
            <script src="../accueil/javascript/navbarselector.js"></script>
            <script src="../accueil/javascript/canvas.js"></script>


            <body>
            <canvas id="nokey" width="800" height="800"></canvas>
            <div class="wrapper">
                <div class="Background">
                    <h1 class="mainmessage">Bonjour !</h1>
                    <h2 class="text">Bienvenue sur le site de MaxiSport. Cette connexion étant la première, il est nécessaire que vous mettiez à jour votre mot de passe.</h2>
                    <form class="admincreation" action="#" method="get">
                        <button name="changepswd" class="buttoncreate">></button>
                    </form>
                    
                </div>
            </div>
            <link href="css/firstpage.css" rel="stylesheet" type="text/css" />
            <script src="accueil/javascript/canvas.js"></script>
            </body>
            <?php
        }


