<?php


function printLoginForm($askedPage) {
    echo<<<END
    
  
    <form action="index.php?todo=login&page=$askedPage" class="navbar-form navbar-left" role="form" style='text-align:center' method="POST">
        <div class="form-group text-login" >
            <input type='text' name='login' placeholder='Login' class="form-control">
            <input type='password' name='mdp' placeholder='Mot de Passe' class="form-control">
            <div class="checkbox">
  </div>
            <input type='submit' value='Connexion' class="btn btn-serieux1">
            <a  href='index.php?page=register'><input type='button' value='Inscription' class="btn btn-serieux2"></a> </div>
    </form>
        
            

END;
}

function printLogoutForm($askedPage) {
    echo<<<END
        <div class='navbar navbar-left decalage'>
            <a href='index.php?todo=logout&page=$askedPage'><input type='submit' value='Déconnexion' class="btn btn-danger btn-serieux1"></a>
            
        </div>
END;
}

?>