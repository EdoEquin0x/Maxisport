
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<link href="pannel/css/hub.css" rel="stylesheet" type="text/css" />

<?php

//Page faisant office de hub à l'administrateur, lui permettant de naviguer entre la page de listage des franchises, et celle de listage des établissements


if ($_SESSION["level"] = 'Admin') { ?>

    <main>

        <div class="hubbody">
            <div class="Hubblock">
                <br/>
                <h1>Pannel Administrateur</h1>
                <br/>
                <div class="buttonblock">
                    <p id="icon" class="material-symbols-outlined">apartment</p>
                    <a href="franchiselisting.php" class="button">Gestionnaire de franchise</a>
                <div>
                <br/>

                <div class="buttonblock">
                    <p id="icon" class="material-symbols-outlined">domain</p>
                    <a href="establishlisting.php" class="button">Gestionnaire d'établissements</a>
                <div>

                <br/>
            </div>
            <br/>
        </div>
        <br/>
    </main>
    <br/>

<?php
}
else {session_start(); session_unset(); session_destroy(); header ('location: http://localhost/MaxiSport/index.php');}
