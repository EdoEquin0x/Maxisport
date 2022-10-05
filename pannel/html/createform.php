<?php

// Page de création, elle reçoit une requete en GET appelée "createwhat" et selon la nature de cette requête cette page
// affiche sois un formulaire de création de franchise, sois d'établissement, les deux ne partageant pas les mêmes paramètres.


require_once '../../Dependance/databaseauth.php';
include '../../htmlbase/base.html';
include '../../htmlbase/header.php';
$parameters = array("franchiseEnabled", "permNewsletter", "permDrink", "permProm", "permAutorenewal", "permWebintegration");
$parameterslabels = array("Est activé ?", "Newsletter automatique ?", "Boissons ?", "Services marketing ?", "Renouvellement automatique ?", "Intégration web ?");
    
if (isset($_SESSION["Level"])) {
    if ($_SESSION["Level"] = 'Admin') { 
        // La requête est une requête de création de franchise
        if($_GET['createwhat'] == "franchise") {
        ?>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
            <main>
                <div class="pannelcheckfranchisebody">
                    <div class="pannelcheckfranchiseblock">
                        <div class="pannelcheckfranchise">                           
                            <div class="pannelinfoblock">
                                <form class="franchise-edit-form" action="../script/validforminfos.php" method="get">
                                    <br/>
                                    <h2>Création d'une franchise</h2>
                                    <div class="slideranimationbarmiddle">
                                        <p>-</p>
                                    </div>
                                    <div class="informationwrapper">
                                        
                                        <h3>Informations</h3>

                                        <div class="FormBlock">
                                        <p class="material-symbols-outlined createicon">badge</p>
                                        <input type="text" name="franchiseName" placeholder="Nom de la franchise" value="" required>
                                        <p class="placeholder">Nom de la franchise</p>                            
                                        </div>


                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined createicon">alternate_email</p>
                                            <input type="text" name="franchiseLogin" placeholder="Adresse Email / Login" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$" value="" title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)."> 
                                            <p class="placeholder">Adresse Email / Login</p>                            
                                        </div>


                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined createicon">public</p>
                                            <input type="text" name="franchiseWebsite" placeholder="Adresse du site Web" value="" required>
                                            <p class="placeholder">Site web de la franchise</p>   
                                        </div>

                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined createicon">call</p>
                                            <input type="tel" name="franchisecomphone" placeholder="Numéro du service commercial" value="" required>
                                            <p class="placeholder">Numéro du service commercial</p>   
                                        </div>

                                        
                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined createicon">support_agent</p>
                                            <input type="tel" name="franchisetechphone" placeholder="Numéro du service technique" value="" required>
                                            <p class="placeholder">Numéro du service technique</p>   
                                        </div>


                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined createicon">image</p>
                                            <input type="text" name="imgurl" placeholder="Url vers le logo de la franchise" value="" required>
                                            <p class="placeholder">Url vers le logo de la franchise</p>   
                                        </div>

                                    </div>
                                    <div class="slideranimationbarmiddle">
                                        <p>-</p>
                                    </div>
                                    
                                    <div class="permissionwrapper">
                                        <h3>Permissions</h3>
                                        <div class="parameterbox">
                                            <p>Est activé ?</p>
                                            <label class="switch">    
                                                <input name="franchiseEnabled" type="checkbox"> 
                                                <span></span> 
                                            </label>
                                        </div>
                                        <div class="parameterbox">
                                            <p>Newsletter automatique ?</p>
                                            <label class="switch">    
                                                <input name="permNewsletter" type="checkbox"> 
                                                <span></span> 
                                            </label>
                                        </div>
                                        <div class="parameterbox">
                                            <p>Boissons ?</p>
                                            <label class="switch">    
                                                <input name="permDrink" type="checkbox"> 
                                                <span></span> 
                                            </label>
                                        </div>
                                        <div class="parameterbox">
                                            <p>Services marketing ?</p>
                                            <label class="switch">    
                                                <input name="permProm" type="checkbox"> 
                                                <span></span> 
                                            </label>
                                        </div>
                                        <div class="parameterbox">
                                            <p>Renouvellement automatique ?</p>
                                            <label class="switch">    
                                                <input name="permAutorenewal" type="checkbox"> 
                                                <span></span> 
                                            </label>
                                        </div>    
                                        <div class="parameterbox">
                                            <p>Intégration web ?</p>
                                            <label class="switch">    
                                                <input name="permWebintegration" type="checkbox"> 
                                                <span></span> 
                                            </label>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div class="slideranimationbarmiddle">
                                        <p>-</p>
                                    </div>

                                    <button type="submit" name="franchisecreationsubmit">Créer la franchise</button>
                                </form>
                            
                            </div>
                            
                                   
                            
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <?php
        
        }
        // La requête est une requête de création d'établissement

        if($_GET['createwhat'] == "establish") {
            ?>
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
                <main>
                    <div class="pannelcheckfranchisebody">
                        <div class="pannelcheckfranchiseblock">
                            <div class="pannelcheckfranchise">                           
                                <div class="pannelinfoblock">
                                    <form class="franchise-edit-form" action="../script/validforminfos.php" method="get">
                                        <br/>
                                        <h2>Création d'établissement</h2>
                                        <div class="slideranimationbarmiddle">
                                            <p>-</p>
                                        </div>
                                        <div class="informationwrapper">
                                            
                                            <h3>Informations</h3>
    
                                            <div class="FormBlock">
                                            <p class="material-symbols-outlined createicon">badge</p>
                                            <input type="text" name="establishName" placeholder="Nom de l'établissement" value="" required>
                                            <p class="placeholder">Nom de l'établissement</p>                            
                                            </div>
    
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">alternate_email</p>
                                                <input type="text" name="establishLogin" placeholder="Adresse Email / Login" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$" value="" title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)."> 
                                                <p class="placeholder">Adresse Email / Login</p>                            
                                            </div>
    
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">public</p>
                                                <input type="text" name="establishWebsite" placeholder="Site web de l'établissement" value="" required>
                                                <p class="placeholder">Site web de l'établissement</p>   
                                            </div>
                                            
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">call</p>
                                                <input type="tel" name="establishphone" placeholder="Numéro de l'établissement" value="" required>
                                                <p class="placeholder">Numéro de l'établissement</p>   
                                            </div>

                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">smartphone</p>
                                                <input type="tel" name="ownerphone" placeholder="Numéro du propriétaire de l'établissement" value="" required>
                                                <p class="placeholder">Numéro du propriétaire de l'établissement</p>   
                                            </div>


                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">mail</p>
                                                <input type="text" name="address" placeholder="Adresse de l'établissement" value="" required>
                                                <p class="placeholder">Adresse de l'établissement</p>   
                                            </div>
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">apartment</p>
                                                <input type="text" name="city" placeholder="Ville ou est situé l'établissement" value="" required>
                                                <p class="placeholder">Ville</p>   
                                            </div>

                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">dialpad</p>
                                                <input type="text" name="zipcode" placeholder="Code postal de la ville" value="" required>
                                                <p class="placeholder">Code postal</p>   
                                            </div>





    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">image</p>
                                                <input type="text" name="imgurl" placeholder="Url vers le logo de l'établissement" value="" required>
                                                <p class="placeholder">Url vers le logo de l'établissement</p>   
                                            </div>










                                            <?php 
                                            $query = $auth->query('SELECT * FROM franchise');
                                            $franchises = $query->fetchAll(PDO::FETCH_OBJ); ?>
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined createicon">domain</p>
                                                <select placeholder="Franchise affiliée" name="franchiseId" id="franchiseselect" required title="Veuillez sélectionner la franchise à laquelle appartient cet établissement">


                                                <?php foreach ($franchises as $franchise) { ?>
                                                    
                                                    <option name="franchiseId" value="<?php echo $franchise->franchiseName; ?>"><?php echo $franchise->franchiseName; ?></option>




                                                <?php } ?>
                                                
                                                
                                                </select>
                                                
                                                
                                                
                                                
                                                <?php 
                                                
                                                
                                                ?>
                                                <p class="placeholder">Franchise possèdant cet établissement</p>  
                                            </div>
    
                                        </div>
                                        <div class="slideranimationbarmiddle">
                                            <p>-</p>
                                        </div>
                                        
                                    
                                        <button type="submit" name="establishcreationsubmit">Créer l'établissement</button>
                                    </form>
                                
                                </div>
                                
                                       
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <?php
            
            }
        include '../../htmlbase/footer.html';
    }
    else {session_start(); session_unset(); session_destroy(); header ('location: https://php-maxisport.herokuapp.com/index.php');}

}
 



?>





<link href="../../accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
<link href="../../offers/css/offers.css" rel="stylesheet" type="text/css" />
    
<link href="../../accueil/css/canvas.css" rel="stylesheet" type="text/css" />
    
<link href="../../accueil/css/keyframe.css" rel="stylesheet" type="text/css" />
    
<link href="../../pannel/css/createform.css" rel="stylesheet" type="text/css" />

    
<script src="../../accueil/javascript/layermenu.js"></script>
    
<script src="../../accueil/javascript/navbarselector.js"></script>
    
<script src="../../accueil/javascript/canvas.js"></script>


