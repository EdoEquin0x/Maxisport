<?php 

//Le script d'authentification utilisé sur tout le site.


require_once 'Dependance/databaseauth.php';
if (isset($_POST["loginsubmit"])) {
    if($_POST['loginemail'] != "" || $_POST['loginpassword'] != ""){
        $name = $_POST["loginemail"];
        $pswd = $_POST["loginpassword"];
        

        $adminrequest = $auth->prepare("SELECT * FROM admin WHERE adminName = '$name'");              //
        $franchiserequest = $auth->prepare("SELECT * FROM franchise WHERE franchiseLogin = '$name'"); // Ici on prépare les 3 requêtes qui vont permettre de vérifier
        $establishrequest = $auth->prepare("SELECT * FROM establish WHERE establishLogin = '$name'"); // le login et le mdp, ainsi que d'autres infos

        $adminrequest->execute();      //
        $franchiserequest->execute();  // Ici on exécutes toutes les requêtes
        $establishrequest->execute();  // 

        $resultadmin = $adminrequest->fetch();         //
        $resultfranchise = $franchiserequest->fetch(); // Ici on récupère les infos de toutes les requêtes
        $resultestablish = $establishrequest->fetch(); //
        



        if ($resultadmin == false) { // L'utilisateur n'est pas admin
            if ($resultfranchise == false) { // L'utilisateur n'est pas une franchise
                if ($resultestablish == false) { // L'utilisateur n'est pas un établissement, il n'existe donc pas dans la BDD
                    header("location: http://localhost/MaxiSport/login.php?notexisting=true&login=$name");
                }
                else { // L'utilisateur est un établissement
                    if ($resultestablish['establishEnabled'] == true) { // L'utilisateur existe et est un établissement, on vérifie si il est activé
                        if (password_verify($pswd, $resultestablish['establishPswd']) == true) { //Le MDP est le bon
                            if ($resultestablish['changedPswd'] == false) { // Le MDP utilisé est celui à usage unique fourni lors de l'inscription
                                header("location: http://localhost/MaxiSport/login/newpassword.php");
                            }
                            else { // Le MDP utilisé est celui qui as été redéfini
                                session_start();
                                $_SESSION["Level"] = 'Establish';                                   //Je stocke le niveau d'authentification ainsi que d'autres infos utiles
                                $_SESSION["Email"] = $name;                                         // sur d'autres pages, comme l'id, qui est utilisé pour afficher la
                                $_SESSION["franchiseid"] = $resultestablish['franchiseid'];         // bonne page en "read-only"
                                $_SESSION["Id"] = $resultestablish['establishId'];
                                header("location: http://localhost/MaxiSport/index.php");
                            }
                        } 
                        else { //Le MDP ne match pas
                            header("location: http://localhost/MaxiSport/login.php?error=true&login=$name");
                        }
                    }
                    else { // L'utilisateur est bloqué
                        header("location: http://localhost/MaxiSport/login.php?locked=true&login=$name");

                    }
                    
                }
            }
            else { // L'utilisateur est une franchise
                if ($resultfranchise['franchiseEnabled'] == true) { // L'utilisateur existe et est une franchise, on vérifie si elle est activé
                    if (password_verify($pswd, $resultfranchise['franchisePswd']) == true) { //Le MDP est le bon
                        if ($resultfranchise['changedPswd'] == false) { // Le MDP utilisé est celui à usage unique fourni lors de l'inscription
                            header("location: http://localhost/MaxiSport/login/newpassword.php");
                        }
                        else { // Le MDP utilisé est celui qui as été redéfini
                            session_start();
                            $_SESSION["Level"] = 'Franchise';                          //Je stocke le niveau d'authentification ainsi que d'autres infos utiles
                            $_SESSION["Email"] = $name;                                // sur d'autres pages, comme l'id, qui est utilisé pour afficher la
                            $_SESSION["Id"] = $resultfranchise['franchiseId'];         // bonne page en "read-only"
                            header("location: http://localhost/MaxiSport/index.php");
                        }
                    } 
                    else { //Le MDP ne match pas
                        header("location: http://localhost/MaxiSport/login.php?error=true&login=$name");
                    } 
                }
                else { // L'utilisateur est bloqué
                    header("location: http://localhost/MaxiSport/login.php?locked=true&login=$name");
                }
            }
        } 
        else { // L'utilisateur est Admin, on passe à la vérif du MDP
            if (password_verify($pswd, $resultadmin['adminPswd']) == true) { //Le MDP est le bon
                session_start();
                $_SESSION["Level"] = 'Admin';
                header("location: http://localhost/MaxiSport/index.php");
            } 
            else { //Le MDP ne match pas
                header("location: http://localhost/MaxiSport/login.php?error=true&login=$name");
            } 
        }
































    }
}
else if (isset($_GET["adminsubmit"])) {
    $registerlogin = $_GET["adminlogin"];
    $registerpassword = $_GET["adminpassword"];
    $registerpasswordconfirm = $_GET["adminpasswordconfirm"];
    $url = $_SERVER['REQUEST_URI'];
    $url2 = parse_url($url, PHP_URL_QUERY);
    if ($registerpassword === $registerpasswordconfirm) {

        $registeradmin = "INSERT INTO admin VALUES (?, ?, true)";
        $adminregister = $auth->prepare($registeradmin);
        $adminregister->execute(array($registerlogin,password_hash($registerpassword, PASSWORD_BCRYPT)));
        header("location: http://localhost/MaxiSport/index.php");

















    }
    else {
        header("location: http://localhost/MaxiSport/login/presentation.php?passwordmismatch=true&$url2&createadmin=#");
    }

}

else if (isset($_GET["changepasswordsubmit"])) {
    $login = $_GET["login"];
    $password = $_GET["password"];
    $newpassword = $_GET["newpassword"];
    $url = $_SERVER['REQUEST_URI'];
    $url2 = parse_url($url, PHP_URL_QUERY);
    

    $newpassword = password_hash($newpassword, PASSWORD_BCRYPT);

    $franchiserequest = $auth->prepare("SELECT * FROM franchise WHERE franchiseLogin = '$login'"); // Ici on prépare les 2 requêtes qui vont permettre de vérifier
    $establishrequest = $auth->prepare("SELECT * FROM establish WHERE establishLogin = '$login'"); // le login et le mdp, ainsi que d'autres infos

    $franchiserequest->execute();  // Ici on exécutes toutes les requêtes
    $establishrequest->execute();  // 

 
    $resultfranchise = $franchiserequest->fetch(); // Ici on récupère les infos de toutes les requêtes
    $resultestablish = $establishrequest->fetch(); //
    


    if ($resultfranchise == false) { // L'utilisateur n'est pas une franchise
        if ($resultestablish == false) { // L'utilisateur n'est pas un établissement, il n'existe donc pas dans la BDD
            header("location: http://localhost/MaxiSport/login/newpassword.php?changepswd=true&passwordmismatch=true&login=$login");
        }
        else { // L'utilisateur est un établissement
            if (password_verify($password, $resultestablish['establishPswd']) == true) { //Le MDP est le bon
                $request = "UPDATE establish SET establishPswd=?, changedPswd=? WHERE establishLogin=?";
                $auth->prepare($request)->execute([$newpassword, true, $login]);
                header("location: http://localhost/MaxiSport/login.php");
            }
            else { // Le mot de passe est érroné
                header("location: http://localhost/MaxiSport/login/newpassword.php?changepswd=true&passwordmismatch=true&login=$login");
            }   
        }   
    }
    else { // L'utilisateur est une franchise
        if (password_verify($password, $resultfranchise['franchisePswd']) == true) { //Le MDP est le bon
            $request = "UPDATE franchise SET franchisePswd=?, changedPswd=? WHERE franchiseLogin=?";
            $auth->prepare($request)->execute([$newpassword, true, $login]);
            header("location: http://localhost/MaxiSport/login.php");
        }
        else { // Le mot de passe est érroné
            header("location: http://localhost/MaxiSport/login/newpassword.php?changepswd=true&passwordmismatch=true&login=$login");
        }       
    }















}
else {
    header("location: http://localhost/MaxiSport/index.php");
}