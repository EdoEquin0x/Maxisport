<?php

// Page listant tout les établissements qui existent dans la base de donnée, grâce à une barre de recherche on peux trouver grâce au nom ou a l'email un établissement précis
// Le fonctionnement de la barre de recherche est très simple: Une requête GET qui contiens la recherche de l'utilisateur, cette requête est récupérée et
// comparée dans la base de donnée avec le nom ou l'email de chaque établissement, ensuite il recharge la page et n'affiche que ceux ayant rempli positivement
// la condition

require_once 'Dependance/databaseauth.php';

if ($_SESSION["Level"] = 'Admin') { 
        
        $query = $auth->query('SELECT * FROM establish ORDER BY establishEnabled DESC');
        $objs = $query->fetchAll(PDO::FETCH_OBJ);
        
?>
        <main>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
            
            <div class="pannelbodyblock">    
                <div class="pannelblock">
                    <br/>
                    <br/>
                    <h1>Gestionnaire d'établissement</h1>
                    <div class="upperblock">
                        <a class="cancelcontainer" href="https://php-maxisport.herokuapp.com/pannel.php"><<</a>
                        <a class="createbutton" href="https://php-maxisport.herokuapp.com/pannel/html/createform.php?createwhat=establish">Créer un établissement</a>
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
                        echo '<p class="Notexisting"> Il n\'existe aucun établissement dans la base de donnée, peut être devriez-vous en ajouter ? </p>';
                        echo '<br/>';
                    }
                    
                    ?>
                    <div class="middleblock">
                    <?php
                    
                    foreach($objs as $obj): 
                        if ($obj->establishEnabled === "1") {$statut="active";}
                        if ($obj->establishEnabled === "0") {$statut="disabled";}
                        ?>
                            
                            <div class="establishblock <?php echo $statut;?>">
                                <h5 class="establishname <?php echo $statut;?>"><?php echo "$obj->establishName"; ?></h5>
                                <img class="establishimg" width="192" height="192" src="<?php echo $obj->imgurl?>" alt="Error Loading Img"></img>
                                <div class="infos <?php echo $statut;?>">
                                    <p class="material-symbols-outlined infoicon">alternate_email<a class="establishemail" href="mailto: <?php echo "$obj->establishLogin"; ?>"> <?php echo "$obj->establishLogin"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">public<a class="establishwebsite" href="<?php echo "$obj->establishWebsite"; ?>"> <?php echo "$obj->establishWebsite"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">call<a class="establishphone" href="tel: <?php echo "$obj->establishphone"; ?>"> <?php echo "$obj->establishphone"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">smartphone<a class="establishownerphone"href="tel: <?php echo "$obj->ownerphone"; ?>"> <?php echo "$obj->ownerphone"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">mail<a class="establishaddress" href="#"> <?php echo "$obj->address"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">apartment<a class="establishcity" href="#"> <?php echo "$obj->city"; ?></a></p>
                                    <p class="material-symbols-outlined infoicon">dialpad<a class="establishzip" href="#"> <?php echo "$obj->zipcode"; ?></a></p>
                                    <br/>

                                    <div class="buttonblock">
                                        <a class="material-symbols-outlined infoicon franchiseparam" href="pannel/html/editestablish.php?establish=<?php echo "$obj->establishId";?>">edit</a>
                                        <div class=franchisedelete>
                                            <form class="franchise-delete-form" action="pannel/script/validforminfos.php" method="get">
                                                <input type="text" name="establishId" class="franchiseid" placeholder="" value="<?php echo "$obj->establishId";?>">
                                                <input type="text" name="franchiseid" class="franchiseid" placeholder="" value="<?php echo "$obj->franchiseid";?>">

                                                <input type="text" name="establishName" class="franchisenameinfo" placeholder="" value="<?php echo "$obj->establishName";?>">
                                                <button type="submit" name="establishdelete" class="material-symbols-outlined deleteicon">delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                
                                
        
                            </div>
                            
                              <br/>
                        
                        
                                  
                           
                 
                        <?php endforeach ?>
                    


<?php       
    


    // Vérification de si oui ou non la barre de recherche à été utilisé, grâce à GET
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
                    const franchiseblocks = Array.from(document.getElementsByClassName('establishblock'));
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
            $query = $auth->query("SELECT * FROM establish WHERE establishName LIKE '$searchindex' or establishLogin LIKE '$searchindex' ORDER BY establishEnabled DESC");
            $searchresults = $query->fetchAll(PDO::FETCH_OBJ);
            if ($searchresults == null) {
                echo '<p class="Nofound"> Aucun résultat </p>';
            }
            foreach($searchresults as $searchresult): 
                if ($searchresult->establishEnabled === "1") {$statut="active";}
                if ($searchresult->establishEnabled === "0") {$statut="disabled";}
                ?>
                    
                    <div class="establishblocksearched <?php echo $statut;?>">
                        <h5 class="establishname <?php echo $statut;?>"><?php echo "$searchresult->establishName"; ?></h5>
                        <img class="establishimg" width="192" height="192" src="<?php echo $searchresult->imgurl?>" alt="Error Loading Img"></img>
                        <div class="infos <?php echo $statut;?>">
                            <p class="material-symbols-outlined infoicon">alternate_email<a class="establishemail" href="mailto: <?php echo "$searchresult->establishLogin"; ?>"> <?php echo "$searchresult->establishLogin"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">public<a class="establishwebsite" href="<?php echo "$searchresult->establishWebsite"; ?>"> <?php echo "$searchresult->establishWebsite"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">call<a class="establishphone" href="tel: <?php echo "$searchresult->establishphone"; ?>"> <?php echo "$searchresult->establishphone"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">smartphone<a class="establishownerphone"href="tel: <?php echo "$searchresult->ownerphone"; ?>"> <?php echo "$searchresult->ownerphone"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">mail<a class="establishaddress" href="#"> <?php echo "$searchresult->address"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">apartment<a class="establishcity" href="#"> <?php echo "$searchresult->city"; ?></a></p>
                            <p class="material-symbols-outlined infoicon">dialpad<a class="establishzip" href="#"> <?php echo "$searchresult->zipcode"; ?></a></p>
                            <br/>
                            <div class="buttonblock">
                                <a class="material-symbols-outlined infoicon franchiseparam" href="pannel/html/editestablish.php?establish=<?php echo "$searchresult->establishId";?>">edit</a>
                                <div class=franchisedelete>
                                    <form class="franchise-delete-form" action="pannel/script/validforminfos.php" method="get">
                                        <input type="text" name="establishId" class="franchiseid" placeholder="" value="<?php echo "$searchresult->establishId";?>">
                                        <input type="text" name="franchiseid" class="franchiseid" placeholder="" value="<?php echo "$searchresult->franchiseid";?>">

                                        <input type="text" name="establishName" class="franchisenameinfo" placeholder="" value="<?php echo "$searchresult->establishName";?>">
                                        <button type="submit" name="establishdelete" class="material-symbols-outlined deleteicon">delete</button>
                                    </form>
                                </div>
                            </div>
                            <br/>
                        </div>
                        
                        

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
            <link href="pannel/css/panneladminestablish.css" rel="stylesheet" type="text/css" />
        </main>

<?php 

}
else {session_start(); session_unset(); session_destroy(); header ('location: https://php-maxisport.herokuapp.com/index.php');}
    ?>