<?php 

// Page d'édition des établissement, je récupère via un jeu d'URL et de PDO et conversion en objet toutes les informations de l'établissement concerné.
// Le jeu d'url est très simple, cette page n'est normalement accessible que via le pannel qui liste les établissement, j'ai donc intégré dans
// l'url l'id de l'établissement que l'on veux modifier, ensuite via pdo j'utilise cet id pour récupérer absolument
// toutes les infos relatives à cet établissement

// J'ai également intégré dans les input et en placeholder les informations actuelles de l'établissement, cela permet une meilleure lisibilité.

require_once '../../Dependance/databaseauth.php';
include '../../htmlbase/base.html';
include '../../htmlbase/header.php';

if (isset($_SESSION["Level"])) {
    if ($_SESSION["Level"] = 'Admin') { 
        
        $url = $_GET['establish'];

        $query = $auth->query('SELECT * FROM establish WHERE establishId = '.$url.'');
        $objs = $query->fetchAll(PDO::FETCH_OBJ);
        
        
        foreach($objs as $obj):
            $establish = $obj?> 
        <?php endforeach  ?>


        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <main>
                <div class="pannelcheckfranchisebody">
                    <div class="pannelcheckfranchiseblock">
                        <div class="pannelcheckfranchise">
                            <div class="pannelmainblock">
                                <br/>
                                    <a class="backbutton" href="http://localhost/MaxiSport/establishlisting.php"><<</a>
                                <br/>
                                <div class="pannelpicture">    
                                    <img class="franchiseimg" width="384" height="384" src="<?php echo "$establish->imgurl"; ?>" alt="Error Loading Img"></img>
                                </div>
                                <div class="franchisename">
                                    <h1><?php echo $establish->establishName ?></h1>
                                </div>
                                
                            </div>
                           
                            <div class="pannelinfoblock">
                                
                                <form class="franchise-edit-form" action="../script/validforminfos.php" method="get">
                                    <br/>
                                    
                                    <?php
                                    // Vérifie si oui ou non l'établissement est activé actuellement et adapte la checkbox en conséquence
                                    if ($establish->establishEnabled == "0") { 
                                        echo '<h3 class="infotextcontainer">Informations</h3>';

                                        echo '<div class="permissioncontainer">';
                                        echo '<h4>Est activé ?</h4>';
                                        echo '<label class="switch">';
                                        echo  '<input id="establishEnabled" name="establishEnabled" type="checkbox">';
                                        echo  '<span></span>';
                                        echo '</label>';
                                        echo '</div>';
                                    }

                                    if ($establish->establishEnabled == "1") {
                                        echo '<h3 class="infotextcontainer">Informations</h3>';

                                        echo '<div class="permissioncontainer">';
                                        echo '<h4>Est activé ?</h4>';
                                        echo '<label class="switch">';
                                        echo  '<input id="establishEnabled" name="establishEnabled" type="checkbox" checked>';
                                        echo  '<span></span>';
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                    
                                    ?>
                                   
                                    
                                    <div class="FormBlock">
                                            <p class="material-symbols-outlined pannelicon">badge</p>
                                            <input type="text" name="establishName" placeholder="<?php echo $establish->establishName ?>" value="">
                                            <p class="placeholder">Nom de l'établissement</p>                            
                                            </div>
    
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">alternate_email</p>
                                                <input type="text" name="establishLogin" placeholder="<?php echo $establish->establishLogin ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$" value="" title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)."> 
                                                <p class="placeholder">Adresse Email / Login</p>                            
                                            </div>

                                            <div class="FormBlock">
                                            <p class="material-symbols-outlined pannelicon">lock_person</p>
                                            <input type="password" id="password" name="establishPswd" placeholder="Changer le mot de passe" title="Le mot de passe doit comporter au minimum 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial." pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" value=""> 
                                            <p class="placeholder">Mot de passe</p>                            
                                            <p id="showpassword" class="material-symbols-outlined pannelicon" onclick="revealpswd()">visibility_off</p>

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
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">public</p>
                                                <input type="text" name="establishWebsite" placeholder="<?php echo $establish->establishWebsite ?>" value="">
                                                <p class="placeholder">Site web de l'établissement</p>   
                                            </div>
                                            
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">call</p>
                                                <input type="tel" name="establishphone" placeholder="<?php echo $establish->establishphone ?>" value="">
                                                <p class="placeholder">Numéro de l'établissement</p>   
                                            </div>

                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">smartphone</p>
                                                <input type="tel" name="ownerphone" placeholder="<?php echo $establish->ownerphone ?>" value="">
                                                <p class="placeholder">Numéro du propriétaire de l'établissement</p>   
                                            </div>


                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">mail</p>
                                                <input type="text" name="address" placeholder="<?php echo $establish->address ?>" value="">
                                                <p class="placeholder">Adresse de l'établissement</p>   
                                            </div>
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">apartment</p>
                                                <input type="text" name="city" placeholder="<?php echo $establish->city ?>" value="">
                                                <p class="placeholder">Ville</p>   
                                            </div>

                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">dialpad</p>
                                                <input type="text" name="zipcode" placeholder="<?php echo $establish->zipcode ?>" value="">
                                                <p class="placeholder">Code postal</p>   
                                            </div>





    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">image</p>
                                                <input type="text" name="imgurl" placeholder="Url vers le logo de l'établissement" value="">
                                                <p class="placeholder">Url vers le logo de l'établissement</p>   
                                            </div>








                                            
                                            
                                            <input type="text" name="establishId" class="franchiseid" placeholder="" value="<?php echo $establish->establishId?>">
                                            <input type="text" name="franchiseid" class="franchiseid" placeholder="" value="<?php echo $establish->franchiseid?>">
                                    <br>
                                    
                                    <button class="submitbutton" type="submit" name="etablishsubmit">Modifier</button>
                                </form>
                            
                            </div>
                            
                        </div>
                        
                    </div> 
                        <div class="slideranimationbarmiddle">
                            <p>-</p>
                        </div>
                          
                        
                </main>




























                        

                               
                      





                <link href="../../accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
                <link href="../../offers/css/offers.css" rel="stylesheet" type="text/css" />

                <link href="../../accueil/css/canvas.css" rel="stylesheet" type="text/css" />

                <link href="../../accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

                <link href="../../pannel/css/pannelcheckestablish.css" rel="stylesheet" type="text/css" />


                <script src="../../accueil/javascript/layermenu.js"></script>

                <script src="../../accueil/javascript/navbarselector.js"></script>

                <script src="../../accueil/javascript/canvas.js"></script>




        <?php
        
    }
    else {session_start(); session_unset(); session_destroy(); header ('location: http://localhost/MaxiSport/index.php');}

}

else {session_start(); session_unset(); session_destroy(); header ('location: http://localhost/MaxiSport/index.php');}

include '../../htmlbase/footer.html';

