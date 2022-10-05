<body>


<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Formulaire de connexion pour admin, frachises et établissement -->

    <div class="bodyloginblock">
        <div class="loginblock">
            <div class="logintext">
                <h1>Connexion</h1>
            </div>
            <form class="login-form" action="https://php-maxisport.herokuapp.com/authentification.php" method="post">
                <?php
                if (isset($_GET['error'])) {
                            
                    echo "<p class=\"warningmessage\">*Erreur: L'identifiant ou le mot de passe ne correspond pas.</p>";

                }
                if (isset($_GET['locked'])) {
                            
                    echo "<p class=\"warningmessage\">*Le compte est actuellement désactivé, veuillez contacter Maxisport ou votre franchise parent.</p>";

                }
                if (isset($_GET['notexisting'])) {
                            
                    echo "<p class=\"warningmessage\">*L'utilisateur n'existe pas</p>";

                }
                ?>
                <br/>
                <br/>
                
                
                <div class="FormBlock">
                    <p class="material-symbols-outlined loginpage">person</p>
                    <input value="<?php if (isset($_GET['login'])) { echo $_GET['login'];}?>" type="text" name="loginemail" placeholder="Adresse Email" required title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)." pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$">
                    <p class="placeholder">Adresse Email / Login</p>
                </div>
                <br/>
                <div class="FormBlock">
                    <p id="lock" class="material-symbols-outlined loginpage">lock_person</p>
                    <input type="password" id="password" name="loginpassword" placeholder="Mot de passe" required>
                    <p class="placeholder">Mot de passe</p>
                    <br/>
                    <p id="showpassword" class="material-symbols-outlined" onclick="revealpswd()">visibility_off</p>

                </div>


                <br/>
                <div class="FormBlock">
                    <button type="submit" name="loginsubmit">Connexion</button>
                </div>
                <script>
                    function revealpswd() {
                        var x = document.getElementById("password");
                        var y = document.getElementById("showpassword");
                        if (y.innerText === "visibility_off") {
                            x.type = "text";
                            y.innerText = "visibility";
                        } else {
                            x.type = "password";
                            y.innerText = "visibility_off";
                        }

                 

                        }

                  



                </script>
    
    
            </form>
        </div>

        </div>
    </div>









</body>