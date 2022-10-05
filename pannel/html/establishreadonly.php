<?php 


require_once 'Dependance/databaseauth.php';

// Page "read-only" affichant un établissement et ses informations mais de façon à ce qu'elles ne soient pas modifiables. 
// C'est la page que verras un établissement lorsqu'il se connectera à son pannel


if (isset($_SESSION["Level"])) {
    if ($_SESSION["Level"] = 'Establish') { 

        $establishid = $_SESSION["Id"];

        $query = $auth->query("SELECT * FROM establish WHERE establishId = '$establishid'");
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
                               
                                <div class="pannelpicture">    
                                    <img class="franchiseimg" width="384" height="384" src="<?php echo "$establish->imgurl"; ?>" alt="Error Loading Img"></img>
                                </div>
                                <div class="franchisename">
                                    <h1>Mon établissement</h1>
                                </div>
                                <br/>
                                <br/>
                                <br/>
                                
                            </div>
                           
                            <div class="pannelinfoblock">
                                
                                <form class="franchise-edit-form" action="pannel/script/validforminfos.php" method="get">
                                    <br/>
                                    
                                    <?php
                                    
                                    if ($establish->establishEnabled == "0") { 
                                        echo '<h3 class="infotextcontainer">Informations</h3>';

                                        echo '<div class="permissioncontainer">';
                                        echo '<h4>Est activé ?</h4>';
                                        echo '<label class="switch">';
                                        echo  '<input id="establishEnabled" name="establishEnabled" type="checkbox" disabled>';
                                        echo  '<span></span>';
                                        echo '</label>';
                                        echo '</div>';
                                    }

                                    if ($establish->establishEnabled == "1") {
                                        echo '<h3 class="infotextcontainer">Informations</h3>';

                                        echo '<div class="permissioncontainer">';
                                        echo '<h4>Est activé ?</h4>';
                                        echo '<label class="switch">';
                                        echo  '<input id="establishEnabled" name="establishEnabled" type="checkbox" checked disabled>';
                                        echo  '<span></span>';
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                    
                                    ?>
                                   
                                    
                                    <div class="FormBlock">
                                            <p class="material-symbols-outlined pannelicon">badge</p>
                                            <input type="text" name="establishName" placeholder="<?php echo $establish->establishName ?>" value="" disabled>
                                            <p class="placeholder">Nom de l'établissement</p>                            
                                            </div>
    
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">alternate_email</p>
                                                <input type="text" name="establishLogin" placeholder="<?php echo $establish->establishLogin ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$" value="" title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)." disabled> 
                                                <p class="placeholder">Adresse Email / Login</p>                            
                                            </div>
    
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">public</p>
                                                <input type="text" name="establishWebsite" placeholder="<?php echo $establish->establishWebsite ?>" value="" disabled>
                                                <p class="placeholder">Site web de l'établissement</p>   
                                            </div>
                                            
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">call</p>
                                                <input type="tel" name="establishphone" placeholder="<?php echo $establish->establishphone ?>" value="" disabled>
                                                <p class="placeholder">Numéro de l'établissement</p>   
                                            </div>

                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">smartphone</p>
                                                <input type="tel" name="ownerphone" placeholder="<?php echo $establish->ownerphone ?>" value="" disabled >
                                                <p class="placeholder">Numéro du propriétaire de l'établissement</p>   
                                            </div>


                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">mail</p>
                                                <input type="text" name="address" placeholder="<?php echo $establish->address ?>" value="" disabled>
                                                <p class="placeholder">Adresse de l'établissement</p>   
                                            </div>
    
                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">apartment</p>
                                                <input type="text" name="city" placeholder="<?php echo $establish->city ?>" value="" disabled>
                                                <p class="placeholder">Ville</p>   
                                            </div>

                                            <div class="FormBlock">
                                                <p class="material-symbols-outlined pannelicon">dialpad</p>
                                                <input type="text" name="zipcode" placeholder="<?php echo $establish->zipcode ?>" value="" disabled>
                                                <p class="placeholder">Code postal</p>   
                                            </div>






                                            
                                            <input type="text" name="establishId" class="franchiseid" placeholder="" value="<?php echo $establish->establishId?>">
                                            <input type="text" name="franchiseid" class="franchiseid" placeholder="" value="<?php echo $establish->franchiseid?>">
                                    <br>
                                    
                                </form>
                            
                            </div>
                            
                        </div>
                        
                    </div> 
                        <div class="slideranimationbarmiddle">
                            <p>-</p>
                        </div>
                          
                        





                                </main>























                        

                               
                      




                <link href="pannel/css/pannelcheckestablish.css" rel="stylesheet" type="text/css" />




        <?php
        
    }
}

else {session_unset(); session_destroy(); header ('location: http://localhost/MaxiSport/index.php');}


