<?php

session_start();
require_once('scripts/utils.php');
require_once('scripts/user.php');
require_once('scripts/printForms.php');
require_once('scripts/logInOut.php');


$askedPage = 'accueil';
if (array_key_exists('page', $_GET)) {
    $askedPage = $_GET['page'];
}
$autorized = checkPage($askedPage);
$pageTitle = getPageTitle($askedPage);

if (array_key_exists('todo', $_GET) && $_GET['todo'] == 'login') {
    logIn();
    if($_SESSION['loggedIn']){
    
    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }
    else{
        echo '<script language="Javascript">alert ("Login inexistant ou mot de passe faux!");</script>';
    }
}

if (array_key_exists('todo', $_GET) && $_GET['todo'] == 'logout') {
    logOut();
    
}


generateHTMLHeader($pageTitle);

echo "<div style='margin-top: 50px'></div>";


//Zone de débuggage
//echo "<div class='debug'>";
//echo $askedPage;
//echo "<br>";
//var_dump($_SESSION);
//echo getPageTitle($askedPage);
//echo User::getUtilisateur("Olivier");
//User::insererUtilisateur('prof', 'secret', 'Prof', 'prenom');
//echo "</div>";

generateMenu3($askedPage);
echo "<br>";

if ($autorized) {
    require("content/contenu_$askedPage.php");
} else {
    echo<<<END
    <div class="jumbotron">
    <h1>Page interdite ou inexistante!</h1>
    </div>
END;
}
generateHTMLFooter();
?>
