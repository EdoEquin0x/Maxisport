
<?php
    
    require_once 'Dependance/databaseauth.php';

    if (isset($_SESSION["Level"])) {
        if ($_SESSION["Level"] = 'Franchise') { 
        

            $url = $_SESSION["Id"];
                

                    
        // Page "read-only" affichant une franchise et ses informations mais de façon à ce qu'elles ne soient pas modifiables. 
        // C'est la page que verras une franchise lorsqu'il se connectera à son pannel

        //Les établissements de la franchise sont également vérifiés et listés, toujours en "read-only", ce qui signifie que j'ai retiré
        // les boutons permettant leur modification

          
        
            $query = $auth->query('SELECT * FROM franchise WHERE franchiseId = '.$url.'');
            $objs = $query->fetchAll(PDO::FETCH_OBJ);
            
            foreach($objs as $obj):
                $franchise = $obj?> 
            <?php endforeach  ?>
            <?php 
                $parameters = array("franchiseEnabled", "permNewsletter", "permDrink", "permProm", "permAutorenewal", "permWebintegration");
                $parameterslabels = array("Est activé ?", "Newsletter automatique ?", "Boissons ?", "Services marketing ?", "Renouvellement automatique ?", "Intégration web ?")
    
     
?>



            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

            <main>
                <div class="pannelcheckfranchisebody">
                    <div class="pannelcheckfranchiseblock">
                        <div class="pannelcheckfranchise">
                            <div class="pannelmainblock">
                                
                                <div class="pannelpicture">
                                    <img class="franchiseimg" width="384" height="384" src="<?php echo "$franchise->imgurl"; ?>" alt="Error Loading Img"></img>
                                </div>
                                <div class="franchisename">
                                    <h1>Ma franchise</h1>
                                </div>
                            </div>
                           
                            <div class="pannelinfoblock">
                                
                                <form class="franchise-edit-form" action="../script/validforminfos.php" method="get">
                                <br/>
                                    <h2>Modification de franchise</h2>
                                    <div class="slideranimationbarmiddle">
                                        <p>-</p>
                                    </div>
                                    <div class="informationwrapper">
                                        
                                        <h3>Informations</h3>

                                        <div class="FormBlock">
                                        <p class="material-symbols-outlined infoicon">badge</p>
                                        <input type="text" name="franchiseName" placeholder="<?php echo "$franchise->franchiseName"; ?>" value="" disabled>
                                        <p class="placeholder">Nom de la franchise</p>                            
                                        </div>


                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined infoicon">alternate_email</p>
                                            <input type="text" name="franchiseLogin" placeholder="<?php echo "$franchise->franchiseLogin"; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$" value="" title="L'adresse email doit contenir une arobase (@) et se terminer par un nom de domaine (.fr, .com etc)." disabled> 
                                            <p class="placeholder">Adresse Email / Login</p>                            
                                        </div>

                                       

                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined infoicon">public</p>
                                            <input type="text" name="franchiseWebsite" placeholder="<?php echo "$franchise->franchiseWebsite"; ?>" value="" disabled>
                                            <p class="placeholder">Site web de la franchise</p>   
                                        </div>

                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined infoicon">call</p>
                                            <input type="tel" name="franchisecomphone" placeholder="<?php echo "$franchise->franchisecomphone"; ?>" value="" disabled>
                                            <p class="placeholder">Numéro du service commercial</p>   
                                        </div>

                                        
                                        <div class="FormBlock">
                                            <p class="material-symbols-outlined infoicon">support_agent</p>
                                            <input type="tel" name="franchisetechphone" placeholder="<?php echo "$franchise->franchisetechphone"; ?>" value="" disabled>
                                            <p class="placeholder">Numéro du service technique</p>   
                                        </div>


                                   

                                    </div>
                                    <br/>
                                    
                                    <div class="permissionwrapper">
                                        <h3>Permissions</h3>
                                        <?php
                                            foreach(array_combine($parameters , $parameterslabels) as $parameter => $parameterlabel):
                                                if ($franchise->$parameter == "1") { ?>
                                                    <div class="parameterbox">
                                                        <p><?php echo $parameterlabel?></p>
                                                        <label class="switch">    
                                                            <input id="<?php echo $parameter; ?>" name="<?php echo $parameter; ?>" type="checkbox" checked disabled> 
                                                            <span></span> 
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                                if ($franchise->$parameter == "0") { ?>
                                                    <div class="parameterbox">
                                                        <p><?php echo $parameterlabel?></p>
                                                        <label class="switch">    
                                                            <input id="<?php echo $parameter; ?>" name="<?php echo $parameter; ?>" type="checkbox" disabled> 
                                                            <span></span> 
                                                        </label>
                                                    </div>


                                                <?php } ?>
                                                <br/>
                                            <?php endforeach  ?>
                                            <input style="display: none;" type="text" name="franchiseid" placeholder="" value="<?php echo $franchise->franchiseId; ?>">

                                        </div>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        
                                    </form>
                                
                            </div>

                        </div>
                        <br/>
                    </div>            
                        <div class="slideranimationbarmiddle">
                            <p>-</p>
                        </div>
                        

                       <div class="pannelcheckestablishlist">
                       
                        
                        <?php


                        $query2 = $auth->query('SELECT * FROM establish WHERE franchiseid = '.$url.'');
                        $establishlist = $query2->fetchAll(PDO::FETCH_OBJ);
                        if ($establishlist == null) {
                            echo '<br/>';
                            echo '<p class="Nofound"> Aucun établissement </p>';
                            echo '<div class="textcontainer">';
                            echo '</div>';
                            ?>
                            <style>
                            .pannelinfoblock {
                                grid-area: pannelinfoblock;
                                background-color: rgba(214, 214, 214, 0.178);
                                box-shadow: rgba(226, 252, 190, 0.4) 5px 5px, rgba(226, 252, 190, 0.3) 10px 10px, rgba(226, 252, 190, 0.2) 15px 15px, rgba(226, 252, 190, 0.1) 20px 20px, rgba(226, 252, 190, 0.05) 25px 25px;    
                                
                                display: flex;
                                justify-content: center;
                                
                            }
                            
                            </style>    
                        <?php }
                        else {
                            echo '<br/>';
                            echo '<p class="Listingtext"> Etablissements rattachés à votre franchise </p>';
                            echo '<div class="textcontainer">';
                            echo '</div>';
                            ?>
                            <style>
                            .pannelinfoblock {
                                grid-area: pannelinfoblock;
                                background-color: rgba(214, 214, 214, 0.178);
                                box-shadow: rgba(226, 252, 190, 0.4) 5px 5px, rgba(226, 252, 190, 0.3) 10px 10px, rgba(226, 252, 190, 0.2) 15px 15px, rgba(226, 252, 190, 0.1) 20px 20px, rgba(226, 252, 190, 0.05) 25px 25px;    
                                margin-left: 17.5%;
                                display: flex;
                                justify-content: center;
                                
                            }
                            





                            </style>    
                        
                        <?php } ?>
                        

                        <div class="establishlistblock">
                        
                        <?php
                        foreach($establishlist as $establish): 
                            if ($establish->establishEnabled === "1") {$statut="active";}
                            if ($establish->establishEnabled === "0") {$statut="disabled";}
                            ?>
                                
                                <div class="establishblock <?php echo $statut;?>">
                                    <h5 class="establishname <?php echo $statut;?>"><?php echo "$establish->establishName"; ?></h5>
                                    <img class="establishimg" width="192" height="192" src="<?php echo $establish->imgurl?>" alt="Error Loading Img"></img>
                                    <div class="infos <?php echo $statut;?>">
                                        <p class="material-symbols-outlined infoicon">alternate_email<a class="establishemail" href="mailto: <?php echo "$establish->establishLogin"; ?>"> <?php echo "$establish->establishLogin"; ?></a></p>
                                        <p class="material-symbols-outlined infoicon">public<a class="establishwebsite" href="<?php echo "$establish->establishWebsite"; ?>"> <?php echo "$establish->establishWebsite"; ?></a></p>
                                        <p class="material-symbols-outlined infoicon">call<a class="establishphone" href="tel: <?php echo "$establish->establishphone"; ?>"> <?php echo "$establish->establishphone"; ?></a></p>
                                        <p class="material-symbols-outlined infoicon">smartphone<a class="establishownerphone"href="tel: <?php echo "$establish->ownerphone"; ?>"> <?php echo "$establish->ownerphone"; ?></a></p>
                                        <p class="material-symbols-outlined infoicon">mail<a class="establishaddress" href="#"> <?php echo "$establish->address"; ?></a></p>
                                        <p class="material-symbols-outlined infoicon">apartment<a class="establishcity" href="#"> <?php echo "$establish->city"; ?></a></p>
                                        <p class="material-symbols-outlined infoicon">dialpad<a class="establishzip" href="#"> <?php echo "$establish->zipcode"; ?></a></p>
                                        <br/>
                                        
                                        <br/>
                                    </div>
                                    
                                    
            
                                </div>
                                
                                  <br/>
                            
                            
                                      
                               
                     
                        <?php endforeach ?>


                        
                        


                   










                        </div>
                        <div class="separator">-</div> 
                        </div>
                        

                </div> 
            </div> 












































        </main>

































        
        
        <?php        
        }
        else {session_start(); session_unset(); session_destroy(); header ('location: https://php-maxisport.herokuapp.com/index.php');}

    }

    else {session_unset(); session_destroy(); header ('location: https://php-maxisport.herokuapp.com/index.php');}

  
?>
<link href="accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
<link href="offers/css/offers.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/canvas.css" rel="stylesheet" type="text/css" />

<link href="accueil/css/keyframe.css" rel="stylesheet" type="text/css" />

<link href="pannel/css/pannelcheckfranchise.css" rel="stylesheet" type="text/css" />


<script src="accueil/javascript/layermenu.js"></script>

<script src="accueil/javascript/navbarselector.js"></script>

<script src="accueil/javascript/canvas.js"></script>

