<?php 

require_once '../../Dependance/databaseauth.php';
include '../../htmlbase/base.html';
include '../../htmlbase/header.php';

//Page de validation que j'utilise sur absolument tout le site.
// J'ai utilisé un if/else statement et selon le type de requête il effectuera différentes actions

// Je me suis permis d'utiliser le GET pour contenir des infos sensible dans la mesure ou de toute façon
// une vérification de session a lieu et que seul l'administrateur possède l'accès à ces pages

//Pour la partie validation, j'ai utilisé une autre requête GET, qui est appliquée lorsque l'utilisateur appuis sur "Valider"
//la page va se recharger, avec comme instruction de valider la précédente requête, procédant ainsi. 
//si l'instruction "Valider" n'est pas renseignée, il affiche simplement le formulaire de validation en guise de fallback

$url = $_SERVER['REQUEST_URI'];
$url2 = parse_url($url, PHP_URL_QUERY);




if ($_SESSION["Level"] = 'Admin') {

    //La requête est une requête de modification d'une franchise, je récupère donc toutes les infos et je procède
    if (isset($_GET['franchisesubmit'])) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === "confirm") {
                $franchiseName = $_GET['franchiseName'];
                $franchisePswd = $_GET['franchisePswd'];
                $franchisePswd = password_hash($franchisePswd, PASSWORD_BCRYPT);
                $franchiseLogin = $_GET['franchiseLogin'];
                $franchiseWebsite = $_GET['franchiseWebsite'];
                $franchisecomphone = $_GET['franchisecomphone'];
                $franchisetechphone = $_GET['franchisetechphone'];
                $imgurl = $_GET['imgurl'];
                $franchiseid = $_GET['franchiseid'];
                $parameters = array("franchiseEnabled", "permNewsletter", "permDrink", "permProm", "permAutorenewal", "permWebintegration");
                foreach ($parameters as $parameter) {
                    if ($_GET[''.$parameter.''] == "on") {
                        $_GET[''.$parameter.''] = 1;

                    }
                    if ($_GET[''.$parameter.''] == NULL) {
                        $_GET[''.$parameter.''] = 0;
                        
                    }
                }

                $franchiseEnabled = $_GET['franchiseEnabled'];
                $permNewsletter = $_GET['permNewsletter'];
                $permDrink = $_GET['permDrink'];
                $permProm = $_GET['permProm'];
                $permAutorenewal = $_GET['permAutorenewal'];
                $permWebintegration = $_GET['permWebintegration'];
                $franchiseid = $_GET['franchiseid'];


                $changes = array("franchiseName", "franchisePswd", "franchiseLogin", "franchiseWebsite", "franchisecomphone", "franchisetechphone",  "imgurl");
                $values = array($franchiseName, $franchisePswd, $franchiseLogin, $franchiseWebsite, $franchisecomphone, $franchisetechphone,  $imgurl);

                $request2 = "UPDATE franchise SET franchiseEnabled=?, permNewsletter=?, permDrink=?, permProm=?, permAutorenewal=?, permWebintegration=? WHERE franchiseid=?";
                $auth->prepare($request2)->execute([$franchiseEnabled, $permNewsletter, $permDrink, $permProm, $permAutorenewal, $permWebintegration, $franchiseid]);
                        
                foreach(array_combine($changes , $values) as $change => $value):
                    if ($value == NULL) {
                        
                    }
                    else {
             
                        $request = "UPDATE franchise SET ".$change."=? WHERE franchiseid=?";
                        $auth->prepare($request)->execute([$value, $franchiseid]);
                
                    }
                endforeach;
                header ('location: http://localhost/MaxiSport/franchiselisting.php');

             

                // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
                // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
                $to = "nicolasbourgoisbrg@gmail.com";
                $subject = 'Modification de votre franchise';

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
                $headers[] = "MIME-Version: 1.0" . "rn";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

                // On défini le contenu du mail
                $message = '
                <body style="background-color: #333; border-radius: 10px; justify-content: center;">
                    <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
                    <h3 style="text-align: center; font-size: 3em; color:gray;">Informations</h3>
                    <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
                        <p>Bonjour! Des modifications ont été apportées sur les informations de votre franchise.</p>
                        <p>Si vous pensez qu\'il s\'agis d\'une erreur, veuillez contacter notre service technique.</p>
                    </div>
                    <br />
                </body>
                ';

                // On envoie le mail 
                mail($to, $subject, $message, implode("\r\n", $headers));




                




            }
            else if ($_GET['action'] === "cancel") {
                $franchiseid = $_GET['franchiseid'];
                header ('location: http://localhost/MaxiSport/franchiselisting.php');
            }
        }
        else { ?>
        <main>
            <div class="confirmationformcontainer">
                <div class="confirmationform">
                    <br/>
                    <h3 class="confirmtiontitle">Confirmation</h3>
                    <br/>
                    <p>Veuillez confirmer que vous souhaitez sauvegarder ces modifications</p>
                    <br/>
                    
                    <div class="formcontainer">
                        <a href="?action=cancel&<?php echo $url2;?>" class="cancelbutton">Annuler</a>
                        <a href="?action=confirm&<?php echo $url2;?>" class="confirmbutton">Confirmer</a>
                        
                    </div>
                </div>
            </div>
        </main>
            
            
            
    <?php 
        
        }
    }

    
  
    ?>
    <?php
    //La requête est une requête de modification d'un établissement, je récupère donc toutes les infos et je procède
    if (isset($_GET['etablishsubmit'])) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === "confirm") {
                $establishName = $_GET['establishName'];
                $establishLogin = $_GET['establishLogin'];
                $establishPswd = password_hash($_GET['establishPswd'], PASSWORD_BCRYPT);
                $establishWebsite = $_GET['establishWebsite'];
                $establishphone = $_GET['establishphone'];

                $ownerphone = $_GET['ownerphone'];
                $address = $_GET['address'];
                $city = $_GET['city'];
                $zipcode = $_GET['zipcode'];
                

                $imgurl = $_GET['imgurl'];
                $establishId = $_GET['establishId'];
                $franchiseid = $_GET['franchiseid'];

                if ($_GET['establishEnabled'] == "on") {$establishEnabled = true;}
                if ($_GET['establishEnabled'] == NULL) {$establishEnabled = false;}
                
                $changes = array("establishName", "establishLogin", "establishPswd", "establishWebsite", "establishphone", "imgurl", "establishEnabled", "address", "ownerphone", "city", "zipcode");
                $values = array($establishName, $establishLogin, $establishPswd, $establishWebsite, $establishphone, $imgurl, $establishEnabled, $address, $ownerphone, $city, $zipcode);

                foreach(array_combine($changes , $values) as $change => $value):
                    if ($value == NULL) {
                        
                    }
                    else {
                        $request = "UPDATE establish SET ".$change."=? WHERE establishId=?";
                        $auth->prepare($request)->execute([$value, $establishId]);
                    }
                endforeach;
                header ('location: http://localhost/MaxiSport/establishlisting.php');

             
                // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
                // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
                $to = "nicolasbourgoisbrg@gmail.com";
                $subject = 'Modification de votre établissement';

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
                $headers[] = "MIME-Version: 1.0" . "rn";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

                // On défini le contenu du mail
                $message = '
                <body style="background-color: #333; border-radius: 10px; justify-content: center;">
                    <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
                    <h3 style="text-align: center; font-size: 3em; color:gray;">Informations</h3>
                    <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
                        <p>Bonjour! Des modifications ont été apportées sur les informations de votre établissement.</p>
                        <p>Si vous pensez qu\'il s\'agis d\'une erreur, veuillez contacter notre service technique.</p>
                    </div>
                    <br />
                </body>
                ';

                // On envoie le mail 
                mail($to, $subject, $message, implode("\r\n", $headers));

                //Ici on pourrai ajouter un deuxième mail pour prévenir la franchise à qui appartient l'établissement en utilisant le franchiseId et le name, informations qui
                // sont déjà récupérées plus haut

            }
            else if ($_GET['action'] === "cancel") {
                $franchiseid = $_GET['franchiseid'];
                header ('location: http://localhost/MaxiSport/establishlisting.php');
            }
        }
        else { ?>
         <main>
            <div class="confirmationformcontainer">
                <div class="confirmationform">
                    <br/>
                    <h3 class="confirmtiontitle">Confirmation</h3>
                    <br/>
                    <p>Veuillez confirmer que vous souhaitez sauvegarder ces modifications</p>
                    <br/>
                    
                    <div class="formcontainer">
                        <a href="?action=cancel&<?php echo $url2;?>" class="cancelbutton">Annuler</a>
                        <a href="?action=confirm&<?php echo $url2;?>" class="confirmbutton">Confirmer</a>
                        
                    </div>
                </div>
            </div>
        </main>  
            
            
            
    <?php 
        
        }
    }

    
  
    ?>
    <?php
    //La requête est une requête de suppresion d'un établissement, je récupère donc les infos dont j'ai besoin, notamment l'ID et je procède
    if (isset($_GET['establishdelete'])) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === "confirm") {
                $establishName = $_GET['establishName'];
                $establishId = $_GET['establishId'];
                $franchiseid = $_GET['franchiseid'];

              
                
                



            
                $request = "DELETE FROM establish WHERE establishId=? AND establishName=?";
                $auth->prepare($request)->execute([$establishId, $establishName]);
                header ('location: http://localhost/MaxiSport/establishlisting.php');

                // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
                // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
                $to = "nicolasbourgoisbrg@gmail.com";
                $subject = 'Suppression de votre établissement';

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
                $headers[] = "MIME-Version: 1.0" . "rn";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

                // On défini le contenu du mail
                $message = '
                <body style="background-color: #333; border-radius: 10px; justify-content: center;">
                    <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
                    <h3 style="text-align: center; font-size: 3em; color:gray;">Aurevoir</h3>
                    <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
                        <p>Bonjour votre établissement à été supprimée de nos bases de données.</p>
                        <p>Si vous pensez qu\'il s\'agis d\'une erreur, veuillez contacter notre service technique.</p>
                    </div>
                    <br />
                </body>
                ';

                // On envoie le mail 
                mail($to, $subject, $message, implode("\r\n", $headers));





            }
            else if ($_GET['action'] === "cancel") {
                $franchiseid = $_GET['franchiseid'];
                header ('location: http://localhost/MaxiSport/establishlisting.php');
            }
        }
        else { 
                $establishName = $_GET['establishName'];
                $establishId = $_GET['establishId'];
                $franchiseid = $_GET['franchiseid'];
?>
         <main>
            <div class="confirmationformcontainer">
                <div class="confirmationform">
                    <br/>
                    <h3 class="confirmtiontitle">Confirmation</h3>
                    <br/>
                    <p>Veuillez confirmer la suppression de l'établissement: <span class="establishnamespan"><?php echo "$establishName"?></span></p>
                    <br/>
                    
                    <div class="formcontainer">
                        <a href="?action=cancel&<?php echo $url2;?>" class="cancelbutton">Annuler</a>
                        <a href="?action=confirm&<?php echo $url2;?>" class="confirmbutton">Confirmer</a>
                        
                    </div>
                </div>
            </div>
        </main>
            
            
            
    <?php 
        
        }
    }
    //La requête est une requête de suppression d'une franchise, je récupère donc les infos dont j'ai besoin, ainsi que les infos des établissement rattachés à cette
    // franchise pour les supprimers eux-aussi
    if (isset($_GET['franchisedelete'])) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === "confirm") {
                $franchiseId = $_GET['franchiseId'];
                $franchiseName = $_GET['franchiseName'];

              
                
                



            
                $request = "DELETE FROM franchise WHERE franchiseId=? AND franchiseName=?";
                $request2 = "DELETE FROM establish WHERE franchiseId=?";
                $auth->prepare($request)->execute([$franchiseId, $franchiseName]);
                $auth->prepare($request2)->execute([$franchiseId]);
                header("location: http://localhost/MaxiSport/franchiselisting.php"); //Rediriger vers le pannel des établissements

        

                // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
                // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
                $to = "nicolasbourgoisbrg@gmail.com";
                $subject = 'Suppression de votre franchise';

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
                $headers[] = "MIME-Version: 1.0" . "rn";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

                // On défini le contenu du mail
                $message = '
                <body style="background-color: #333; border-radius: 10px; justify-content: center;">
                    <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
                    <h3 style="text-align: center; font-size: 3em; color:gray;">Aurevoir</h3>
                    <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
                        <p>Bonjour votre franchise à été supprimée de nos bases de données.</p>
                        <p>Si vous pensez qu\'il s\'agis d\'une erreur, veuillez contacter notre service technique.</p>
                    </div>
                    <br />
                </body>
                ';

                // On envoie le mail 
                mail($to, $subject, $message, implode("\r\n", $headers));



            }
            else if ($_GET['action'] === "cancel") {
                $franchiseid = $_GET['franchiseid'];
                header("location: http://localhost/MaxiSport/franchiselisting.php"); //Rediriger vers le pannel des établissements
            }
        }
        else { 
            $franchiseId = $_GET['franchiseId'];
            $franchiseName = $_GET['franchiseName'];



            $establistrequest = $auth->prepare("SELECT establishName FROM establish WHERE franchiseid = $franchiseId");
            $establistrequest->execute();
            $establistresults = $establistrequest->fetch();
            



?>
        <main>
            <div class="confirmationformcontainer">
                <div class="confirmationform">
                    <br/>
                    <h3 class="confirmtiontitle">Confirmation</h3>
                    <br/>
                    <p>Veuillez confirmer la suppression de la franchise: <span class="establishnamespan"><?php echo "$franchiseName"?></span></p>
                    <br/>
                    
                    <?php 
                    if ($establistresults != NULL) {
                        ?>
                        <p>Notez que les établissements rattachés à cette franchise seront eux aussi supprimés !</p>
                        <p>Serons supprimés:</p>
                        <?php
                        foreach ($establistresults as $establistresult) {
                            echo '<p>-<span class="establishnamespan">'.$establistresult.'</span></p>';
                        }
                    }
                    ?>
                    <br/>
                    
                    <div class="formcontainer">
                        <a href="?action=cancel&<?php echo $url2;?>" class="cancelbutton">Annuler</a>
                        <a href="?action=confirm&<?php echo $url2;?>" class="confirmbutton">Confirmer</a>
                        
                    </div>
                </div>
            </div>
        </main>
            
            
            
    <?php 
        
        }
    }















    // la requête est une requête de création de franchise, je récupère donc les infos fournies et je procède
    if (isset($_GET['franchisecreationsubmit'])) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === "confirm") {
                header ('location: http://localhost/MaxiSport/franchiselisting.php'); //Rediriger vers le pannel des franchises

                $parameters = array("franchiseEnabled", "permNewsletter", "permDrink", "permProm", "permAutorenewal", "permWebintegration");
                foreach ($parameters as $parameter) {
                    if ($_GET[''.$parameter.''] == "on") {$_GET[''.$parameter.''] = true;}
                    if ($_GET[''.$parameter.''] == NULL) {$_GET[''.$parameter.''] = false;}
                
                }
                
        

                $franchiseName = $_GET['franchiseName'];
                $franchiseLogin = $_GET['franchiseLogin'];
                $franchiseWebsite = $_GET['franchiseWebsite'];
                $franchisecomphone = $_GET['franchisecomphone'];
                $franchisetechphone = $_GET['franchisetechphone'];
                $imgurl = $_GET['imgurl'];

                $franchiseEnabled = $_GET['franchiseEnabled'];
                $permNewsletter = $_GET['permNewsletter'];
                $permDrink = $_GET['permDrink'];
                $permProm = $_GET['permProm'];
                $permAutorenewal = $_GET['permAutorenewal'];
                $permWebintegration = $_GET['permWebintegration'];

                $n=12;
                $randomString = "";
                $keychain = "123456789abcdefgh*/-+ijklmnopqrstuvwxyzABC*/-+DEFGHIJKL*/-+MNOPQRSTUVWXYZ";

                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($keychain) - 1);
                    $randomString .= $keychain[$index];
                }
                
                $franchisePswd = password_hash($randomString, PASSWORD_BCRYPT);
                $registerfranchise = "INSERT INTO franchise (franchiseName, franchiseLogin, franchisePswd, franchiseWebsite, franchisecomphone, franchisetechphone, imgurl, franchiseEnabled, permNewsletter, permDrink, permProm, permAutorenewal, permWebintegration) VALUES ('$franchiseName', '$franchiseLogin', '$franchisePswd', '$franchiseWebsite', '$franchisecomphone', '$franchisetechphone', '$imgurl', '$franchiseEnabled', '$permNewsletter', '$permDrink', '$permProm', '$permAutorenewal', '$permWebintegration')";
                $franchisereg = $auth->prepare($registerfranchise);
                $franchisereg->execute();



                // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
                // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
                $to = "nicolasbourgoisbrg@gmail.com";
                $subject = 'Bienvenue chez Maxisport!';

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
                $headers[] = "MIME-Version: 1.0" . "rn";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

                // On défini le contenu du mail
                $message = '
                <body style="background-color: #333; border-radius: 10px; justify-content: center;">
                    <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
                    <h3 style="text-align: center; font-size: 3em; color:gray;">Bienvenue chez vous!</h3>
                    <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
                        <p>Bonjour! Votre franchise viens d\'être ajouté à notre groupe !</p>
                        <p>Vous avez désormais accès à votre pannel, qui vous permettra de consulter les informations que nous avons sur
                        vous ainsi que la liste des établissement qui vous sont rattachés.</p>
                        <p>Pour vous connecter, rentrez simplement votre addresse email et le mot de passe fournis ci dessous dans notre
                        formulaire de connexion.</p>
                        <p>Suite à votre connexion, il vous sera demandé de changer votre mot de passe, vous pourrez alors le définir sur ce
                        que vous voulez.</p>
                        <p> >>
                        <p style="color: rgb(157, 235, 63); font-size: 2.5em;">'.$randomString.'</p>
                        </p>
                    </div>
                    <br />
                </body>
                ';

                // On envoie le mail 
                mail($to, $subject, $message, implode("\r\n", $headers));

            




            }
                else if ($_GET['action'] === "cancel") {
                    
                    header ('location: http://localhost/MaxiSport/pannel/html/createform.php?createwhat=franchise');
                }
        }
        else { 
            $franchiseName = $_GET['franchiseName'];?>
        <main>
            <div class="confirmationformcontainer">
                <div class="confirmationform">
                    <br/>
                    <h3 class="confirmtiontitle">Confirmation</h3>
                    <br/>
                    <p>Veuillez confirmer que vous souhaitez créer la franchise: <span class="franchisenamecreate"><?php echo "$franchiseName"?></p>
                    <br/>
                    
                    <div class="formcontainer">
                        <a href="?action=cancel&<?php echo $url2;?>" class="cancelbutton">Annuler</a>
                        <a href="?action=confirm&<?php echo $url2;?>" class="confirmbutton">Confirmer</a>
                        
                    </div>
                </div>
            </div>
        </main>
            
            
            
            
    <?php 
        
        }
    }


    // la requête est une requête de création d'établissement, je récupère donc les infos fournies et je procède
    if (isset($_GET['establishcreationsubmit'])) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === "confirm") {
     

                $establishName = $_GET['establishName'];
                $establishLogin = $_GET['establishLogin'];
                $establishWebsite = $_GET['establishWebsite'];
                $establishphone = $_GET['establishphone'];
                $ownerphone = $_GET['ownerphone'];
                $address = $_GET['address'];
                $city = $_GET['city'];
                $zipcode = $_GET['zipcode'];
                $franchiseId = $_GET['franchiseId'];
                $imgurl = $_GET['imgurl'];

    

                $franchiseidrequest = $auth->prepare("SELECT franchiseId FROM franchise WHERE franchiseName = '$franchiseId'");
                $franchiseidrequest->execute();
                $whatfranchiseid = $franchiseidrequest->fetch();
                $whatfranchiseid1 = $whatfranchiseid['franchiseId'];

                $franchisenamerequest = $auth->prepare("SELECT franchiseName FROM franchise WHERE franchiseId = $whatfranchiseid1");
                $franchisenamerequest->execute();
                $whatfranchisename = $franchisenamerequest->fetch();
                $whatfranchisename1 = $whatfranchisename['franchiseName'];
            

                $n=12;
                $randomString = "";
                $keychain = "123456789abcdefgh*/-+ijklmnopqrstuvwxyzABC*/-+DEFGHIJKL*/-+MNOPQRSTUVWXYZ";

                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($keychain) - 1);
                    $randomString .= $keychain[$index];
                }
                $establishPswd = password_hash($randomString, PASSWORD_BCRYPT);

                $registerestablish = "INSERT INTO establish (establishEnabled, establishName, establishLogin, establishWebsite, establishphone, ownerphone, address, franchiseId, imgurl, establishPswd, city, zipcode) VALUES ('true', '$establishName', '$establishLogin', '$establishWebsite', '$establishphone', '$ownerphone', '$address', '$whatfranchiseid1', '$imgurl', '$establishPswd', '$city', '$zipcode')";
                $establishreg = $auth->prepare($registerestablish);
                $establishreg->execute();
                header("location: http://localhost/MaxiSport/pannel.php"); //Rediriger vers le pannel des établissements




                }
                else if ($_GET['action'] === "cancel") {
                    
                    header ('location: http://localhost/MaxiSport/pannel/html/createform.php?createwhat=establish');
                }


                // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
                // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
                $to = "nicolasbourgoisbrg@gmail.com";
                $subject = 'Bienvenue chez Maxisport!';

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
                $headers[] = "MIME-Version: 1.0" . "rn";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

                // On défini le contenu du mail
                $message = '
                <body style="background-color: #333; border-radius: 10px; justify-content: center;">
                    <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
                    <h3 style="text-align: center; font-size: 3em; color:gray;">Bienvenue chez vous!</h3>
                    <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
                        <p>Bonjour! Votre établissement viens d\'être ajouté à notre groupe !</p>
                        <p>Vous avez désormais accès à votre pannel, qui vous permettra de consulter les informations que nous avons sur
                        vous.</p>
                        <p>Pour vous connecter, rentrez simplement votre addresse email et le mot de passe fournis ci dessous dans notre
                        formulaire de connexion.</p>
                        <p>Suite à votre connexion, il vous sera demandé de changer votre mot de passe, vous pourrez alors le définir sur ce
                        que vous voulez.</p>
                        <p> >>
                        <p style="color: rgb(157, 235, 63); font-size: 2.5em;">'.$randomString.'</p>
                        </p>
                    </div>
                    <br />
                </body>
                ';

                // On envoie le mail 
                mail($to, $subject, $message, implode("\r\n", $headers));









            }
        else { 
            $establishName = $_GET['establishName'];
            $franchiseId = $_GET['franchiseId'];

            $franchiseidrequest = $auth->prepare("SELECT franchiseId FROM franchise WHERE franchiseName = '$franchiseId'");
            $franchiseidrequest->execute();
            $whatfranchiseid = $franchiseidrequest->fetch();
            $whatfranchiseid1 = $whatfranchiseid['franchiseId'];

            $franchisenamerequest = $auth->prepare("SELECT franchiseName FROM franchise WHERE franchiseId = $whatfranchiseid1");
            $franchisenamerequest->execute();
            $whatfranchisename = $franchisenamerequest->fetch();
            $whatfranchisename1 = $whatfranchisename['franchiseName'];
           
            
            
            
            
            ?>
            <main>
            <div class="confirmationformcontainer">
                <div class="confirmationform">
                    <br/>
                    <h3 class="confirmtiontitle">Confirmation</h3>
                    <br/>
                    <p>Veuillez confirmer que vous souhaitez créer l'établissement: <span class="franchisenamecreate"><?php echo "$establishName"?></p>
                    <br/>
                    <p>Il sera rattaché à la franchise: <span class="franchisenamecreate"><?php echo $whatfranchisename1; ?></p>
                    <br/>
                    
                    <div class="formcontainer">
                        <a href="?action=cancel&<?php echo $url2;?>" class="cancelbutton">Annuler</a>
                        <a href="?action=confirm&<?php echo $url2;?>" class="confirmbutton">Confirmer</a>
                        
                    </div>
                </div>
            </div>
        </main>

            
            
    <?php
    
            
            

            

                








        
        }
    }
   

    include '../../htmlbase/footer.html';
  
    ?>















































































    <link href="../../accueil/css/header+pagelayout.css" rel="stylesheet" type="text/css" />
    <link href="../../offers/css/offers.css" rel="stylesheet" type="text/css" />
    
    <link href="../../accueil/css/canvas.css" rel="stylesheet" type="text/css" />
    
    <link href="../../accueil/css/keyframe.css" rel="stylesheet" type="text/css" />
    
    <link href="../../pannel/css/pannelvalidform.css" rel="stylesheet" type="text/css" />
    
    
    <script src="../../accueil/javascript/layermenu.js"></script>
    
    <script src="../../accueil/javascript/navbarselector.js"></script>
    
    <script src="../../accueil/javascript/canvas.js"></script>













<?php
}
else {session_start(); session_unset(); session_destroy(); header ('location: http://localhost/MaxiSport/index.php');}
