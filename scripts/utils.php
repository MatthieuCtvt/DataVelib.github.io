<?php

$page_list = array(
    array(
        "name" => "accueil",
        "title" => "Accueil de notre site",
        "menuTitle" => "Accueil",
    ),
    array(
        "name" => "compte",
        "title" => "Mon profil",
        "menuTitle" => "Mon Profil",
    ),
    array(
        "name" => "info",
        "title" => "Fonctionnement du covoiturage",
        "menuTitle" => "Règles de fonctionnement",
    ),
    array(
        "name" => "covoiturage",
        "title" => "covoiturage",
        "menuTitle" => "Covoiturage",
    ),
    array(
        "name" => "X-Massy",
        "title" => "X-Massy",
    ),
    array(
        "name" => "consulterProfil",
        "title" => "ConsulterProfil",
    ),
    array(
        "name" => "contact",
        "title" => "Qui contacter?",
    ),
    array(
        "name" => "register",
        "title" => "Page d'inscription",
    ),
    array(
        "name" => "compte",
        "title" => "Mon compte",
    ),
    array(
        "name" => "ajouterTrajet",
        "title" => "Ajouter un trajet",
    ),
    array(
        "name" => "ajouterTrajetConducteur",
        "title" => "Ajouter un trajet",
    ), 
    array(
        "name" => "ajouterTrajetPassager",
        "title" => "Ajouter un trajet",
    ),
    array(
        "name" => "admin",
        "title" => "Admin",
        "admin" => "admin",
    ),
    array(
        "name" => "ajouterTrajetConducteur2",
        "title" => "Ajouter un trajet",
    ),
    array(
        "name" => "compte2",
        "title" => "Mon compte",
    ),
);

function checkPage($page) {
    global $page_list;
    foreach ($page_list as $tab) {
        if ($tab['name'] == $page) {
            return true;
        }
    }
    return false;
}

function getPageTitle($page) {
    global $page_list;
    foreach ($page_list as $tab) {
        if ($tab['name'] == $page) {
            return $tab['title'];
        }
    }
    return "page interdite ou introuvable";
}

function generateMenu3($page) {
    global $page_list;
    echo<<<FIN
<div class="container">
        <ul class="nav nav-justified navbar-fixed-top navbar">
FIN;



    foreach ($page_list as $tab) {
        if (array_key_exists('menuTitle', $tab)) {


            if ($tab['name'] == $page) {
                $extra = "class='active'";
            } else {
                $extra = "";
            }
            echo "<li $extra><a href='index.php?page={$tab['name']}'>{$tab['menuTitle']}</a></li>";
        }
    }
    if (array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn'] == true) {
        if($_SESSION['login'] == "emeric" || $_SESSION['login'] == "simon" || $_SESSION['login'] == "olivier") {
    
        foreach ($page_list as $tab) {
            if (array_key_exists('admin', $tab)) {


                if ($tab['name'] == $page) {
                    $extra = "class='active'";
                } else {
                    $extra = "";
                }
                echo "<li $extra><a href='index.php?page={$tab['name']}'>{$tab['admin']}</a></li>";
            }
        }
    }
    }
    if (array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn'] == true) {
        printLogoutForm($page);
    } else {
        printLoginForm($page);
    }
    echo<<<FIN
       <form method="post" action="index.php?page=consulterProfil" class="navbar-form navbar-right" role="search">
         <div class="form-group text-login">
            <input type="text" data-placement="bottom" data-original-title="Recherche par Nom de famille" data-toggle="tooltip" name="search" id="search" class="form-control" placeholder="Rechercher un profil">
         </div>
         <button type="submit" class="btn btn-serieux1">Go !</button>
      </form>
FIN;

    echo<<<FIN
        </ul>
      </div>
FIN;
}

function generateHTMLHeader($page) {
    echo<<<FIN
<!DOCTYPE html>
<html>
    <head>
        <title>$page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style_Emeric.css" rel="stylesheet">
        <link href="css/style_Simon.css" rel="stylesheet">
        <link href="css/justified-nav.css" rel="stylesheet">
            <link href="css/jquery-ui.css" rel="stylesheet">
            
        
        <link href="css/datepicker.css" rel="stylesheet">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
       
        <script type="text/javascript" src="js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script type="text/javascript" src="js/code.js"></script>
        <style>
         body{background:url(img/VW.png) no-repeat center fixed;
         -webkit-background-size: over; /* Chrome et Safari
         -moz-background-size: cover; /* Mozilla
         -o-background-size: cover; /* Opera
            backdround-size : cover /* standardisé
            
         </style>
            
     </head>
    <body>
FIN;
}

function generateHTMLFooter() {
    echo<<<FIN
</body>
</html>
FIN;
}

?>
