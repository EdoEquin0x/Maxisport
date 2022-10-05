<?php


// Script PHP relié à la page de contact pour 
// récupérer les informations du formilaire et envoyer le mail 
// Je me suis documenté sur la documentation officielle de PHP et j'utilise 
// ce principe sur chaque envoie de mail

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $societyname = $_POST['societyname'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $subject = $_POST['subject'];
    $messagecontent = $_POST['message'];
    
    // On défini le receveur et l'objet du mail, pour mes test j'ai inséré mon email, vous pouvez prendre le soin de mettre la votre si vous
    // souhaitez tester cette fonctionnalité, dans un environement de production on aurait pu y récupérer et y mettre l'email du concerné
    $to = "nicolasbourgoisbrg@gmail.com";


    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini (récupéré sur la docu officielle de PHP)
    $headers[] = "MIME-Version: 1.0" . "rn";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "rn";

    // On défini le contenu du mail
    $message = '
    <body style="background-color: #333; border-radius: 10px; justify-content: center;">
        <h2 style="text-align: center; font-size: 5em; color:rgb(157, 235, 63); font-weight: 900;">Maxisport</h2>
        <h3 style="text-align: center; font-size: 3em; color:gray;">Formulaire de contact</h3>
        <div style="margin-left: 10%; text-align: center; font-size: 2em; max-width: 80%; color:white; border: 2px solid rgba(218, 218, 218, 0.781); border-radius: 15px; margin-bottom: 10%;">
            <p>De: '.$name.'</p>
            <p>Pour: '.$societyname.'</p>
            <p>Numéro: '.$tel.'</p>
            <p>Mail: '.$mail.'</p>
            <br/>

            <p>Message:</p>
            <br/>
            <p>'.$messagecontent.'</p>
            </div>
            <br />
        </body>
    ';

    // On envoie le mail 
    mail($to, $subject, $message, implode("\r\n", $headers));







    header("Location: http://localhost/MaxiSport/index.php");
}