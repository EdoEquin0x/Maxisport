<?php

require_once 'Dependance/databaseauth.php';

// Page listant toutes les franchises qui existent dans la base de donnée, grâce à une barre de recherche on peux trouver grâce au nom ou a l'email une franchises précise
// Le fonctionnement de la barre de recherche est très simple: Une requête GET qui contiens la recherche de l'utilisateur, cette requête est récupérée et
// comparée dans la base de donnée avec le nom ou l'email de chaque franchises, ensuite il recharge la page et n'affiche que ceux ayant rempli positivement
// la condition

if ($_SESSION["level"] = 'Admin') {
        
        $query = $auth->query('SELECT * FROM franchise ORDER BY franchiseEnabled DESC');
        $objs = $query->fetchAll(PDO::FETCH_OBJ);
        
?>
        <main>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
            
            <div class="pannelbodyblock">    
                <div class="pannelblock">
                    <br/>
                    
                    <br/>
                    <h1>Gestionnaire de franchises</h1>

                    <div class="upperblock">
                        <a class="cancelcontainer" href="https://php-maxisport.herokuapp.com/pannel.php"><<</a>
                        <a class="createbutton" href="https://php-maxisport.herokuapp.com/pannel/html/createform.php?createwhat=franchise">Créer une franchise</a>
                        <form class="searchbarblock" action="#" method="get">
                            <input class="searchbar" type="text" name="searchbar" title="Search" id="searchbar" placeholder="Rechercher...">
                            <button type="submit"><p id="searchicon" class="material-symbols-outlined">search</p></button>
                            <p class="placeholder">Effectuer une recherche</p>  
                        </form>
                    </div>
                    <div class="slideranimationbarmiddle">
                        <p>-</p>
                    </div>
                    <?php
                    
                    if ($objs == null) {
                        echo '<h2 class="Hey">Attention !</h2>';
                        echo '<br/>';
                        echo '<p class="Notexisting"> Il n\'existe aucune franchise dans la base de donnée, peut être devriez-vous en ajouter une ? </p>';
                    }
                    
                    ?>
                    <div class="middleblock">
                    <?php
                    
                    foreach($objs as $obj): 
                        if ($obj->franchiseEnabled == "1") {$statut="active";}
                        if ($obj->franchiseEnabled == "0") {$statut="disabled";}
                        ?>
                            
                            <div class="franchiseblock <?php echo $statut;?>">
                                <h5 class="franchisename <?php echo $statut;?>"><?php echo "$obj->franchiseName"; ?></h5>
                                <img class="franchiseimg" width="192" height="192" src="<?php echo $obj->imgurl?>" alt="Error Loading Img"></img>
                                <div class="infos <?php echo $statut;?>">
                                    <p class="material-symbols-outlined infoicon">alternate_email<a class="franchiseemail" href="mailto: <?php echo "$obj->franchiseLogin"; ?>"> <?php echo "$obj->franchiseLogin"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">public<a class="franchisewebsite" href="<?php echo "$obj->franchiseWebsite"; ?>"> <?php echo "$obj->franchiseWebsite"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">call<a class="franchisecomphone" href="tel: <?php echo "$obj->franchisecomphone"; ?>"> <?php echo "$obj->franchisecomphone"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">support_agent<a class="franchisetechphone"href="tel: <?php echo "$obj->franchisetechphone"; ?>"> <?php echo "$obj->franchisetechphone"; ?></a></p>

                                </div>
                                <br/>
                                <div class="buttonblock">
                                    <a class="material-symbols-outlined infoicon franchiseparam" href="pannel/html/editfranchise.php?franchise=<?php echo "$obj->franchiseId";?>">edit</a>
                                    <div class=franchisedelete>
                                        <form class="franchise-delete-form" action="pannel/script/validforminfos.php" method="get">
                                            <input type="text" name="franchiseId" class="franchiseid" placeholder="" value="<?php echo "$obj->franchiseId";?>">
                                            <input type="text" name="franchiseName" class="franchisenameinfo" placeholder="" value="<?php echo "$obj->franchiseName";?>">
                                            <button type="submit" name="franchisedelete" class="material-symbols-outlined deleteicon">delete</button>
                                        </form>
                                    </div>
                                </div>
                                <br/>

                            </div>
                            
                              <br/>
                        
                        
                                  
                           
                 
                    <?php endforeach ?>
                    


<?php       
    


    // Si une recherche est effectuée, il vérifie le GET, contenant cette recherche
    if (isset($_GET['searchbar'])) {
        $searchindex = $_GET['searchbar'];
        $searchindex = "%$searchindex%";
        if(strlen(trim($_GET['searchbar']))<=0){
            unset($_GET['searchbar']);
        }
    
        
        else {
            ?>
            
            <script>
                window.onload = (event) => {
                    var disabled = 1;
                    const franchiseblocks = Array.from(document.getElementsByClassName('franchiseblock'));
                    if (disabled == 1) {
                        franchiseblocks.forEach(franchiseblock => {
                            franchiseblock.remove();
                            document.getElementById("searchbar").setAttribute('value','<?php echo $_GET['searchbar']; ?>');
                            disabled++
                        });
                    }
                }
                
            </script>
            <?php
            $query = $auth->query("SELECT * FROM franchise WHERE franchiseName LIKE '$searchindex' or franchiseLogin LIKE '$searchindex' ORDER BY franchiseEnabled DESC");
            $searchresults = $query->fetchAll(PDO::FETCH_OBJ);
            if ($searchresults == null) {
                echo '<p class="Nofound"> Aucun résultat </p>';
            }
            foreach($searchresults as $searchresult): 
                if ($searchresult->franchiseEnabled == "1") {$statut="active";}
                if ($searchresult->franchiseEnabled == "0") {$statut="disabled";}
                ?>
                    
                    <div class="franchiseblocksearched <?php echo $statut;?>">
                        <h5 class="franchisename <?php echo $statut;?>"><?php echo "$searchresult->franchiseName"; ?></h5>
                        <img class="franchiseimg" width="192" height="192" src="<?php echo $searchresult->imgurl?>" alt="Error Loading Img"></img>
                        <div class="infos <?php echo $statut;?>">
                            <p class="material-symbols-outlined infoicon">alternate_email<a class="franchiseemail" href="mailto: <?php echo "$searchresult->franchiseLogin"; ?>"> <?php echo "$searchresult->franchiseLogin"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">public<a class="franchisewebsite" href="<?php echo "$searchresult->franchiseWebsite"; ?>"> <?php echo "$searchresult->franchiseWebsite"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">call<a class="franchisecomphone" href="tel: <?php echo "$searchresult->franchisecomphone"; ?>"> <?php echo "$searchresult->franchisecomphone"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">support_agent<a class="franchisetechphone"href="tel: <?php echo "$searchresult->franchisetechphone"; ?>"> <?php echo "$searchresult->franchisetechphone"; ?></a></p>

                        </div>
                        <br/>
                        <div class="buttonblock">
                            <a class="material-symbols-outlined infoicon franchiseparam" href="pannel/html/editfranchise.php?franchise=<?php echo "$searchresult->franchiseId";?>">edit</a>
                            <div class=franchisedelete>
                                <form class="franchise-delete-form" action="pannel/script/validforminfos.php" method="get">
                                    <input type="text" name="franchiseId" class="franchiseid" placeholder="" value="<?php echo "$searchresult->franchiseId";?>">
                                    <input type="text" name="franchiseName" class="franchisenameinfo" placeholder="" value="<?php echo "$searchresult->franchiseName";?>">
                                    <button type="submit" name="franchisedelete" class="material-symbols-outlined deleteicon">delete</button>
                                </form>
                            </div>
                        </div>
                        <br/>

                    </div>
                    
                      <br/>
                
                
                          
                   
         
            <?php endforeach ?>
            
            
<?php

        }
    }

    
?>
                    </div>
                    <div class="separator">-</div> 
                </div> 
            </div> 
            <link href="pannel/css/panneladmin.css" rel="stylesheet" type="text/css" />
</main>

<?php 

}
else {session_start(); session_unset(); session_destroy(); header ('location: https://php-maxisport.herokuapp.com/index.php');}
    ?>
