<?php

function logIn() {
    if (array_key_exists('login', $_POST) && array_key_exists('mdp', $_POST)) {
        $user = User::getUtilisateur($_POST['login']);
        if (!$user == NULL && $user->testerMDP($_POST['mdp'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['login'] = $user->login;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            
            return true;
        }
    } else {
        
        return false;
    }
}

function logOut() {
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['login']);
    unset($_SESSION['nom']);
    unset($_SESSION['prenom']);
}

?>