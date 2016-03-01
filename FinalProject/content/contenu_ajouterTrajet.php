<?php
if ((!array_key_exists('loggedIn', $_SESSION) || $_SESSION['loggedIn'] == false)) {
    echo '<script language="Javascript">
alert ("Vous devez être logué pour y accéder!" )
</script>';
    exit();
}
?>
<div class="jumbotron text-form">
    <h1>Ajouter un trajet</h1>
    <p>Il n'y a qu'à compléter le formulaire ci-dessous</p>        
</div>

<?php
require_once('scripts/trajet.php');
require_once('scripts/user.php');


if ((!array_key_exists('loggedIn', $_SESSION) || $_SESSION['loggedIn'] == false)) {
    echo '<script language="Javascript">
alert ("Vous devez être logué pour y accéder!" )
</script>';
    exit();
}
if (isset($_POST['nature'])) {
    if ($_POST['nature'] == '1') {
        echo " <script>document.location.href=\"index.php?page=ajouterTrajetConducteur\";</SCRIPT>";
    }
    if ($_POST['nature'] == '2') {
        echo " <script>document.location.href=\"index.php?page=ajouterTrajetPassager\";</SCRIPT>";
    }
}

echo<<<FIN

    <form class="form-horizontal text-form" role="form" method='POST' action='index.php?page=ajouterTrajet'>
        <div class="form-group">
            <label for="input_nature" class="col-sm-5 col-md-5 col-lg-5 control-label">Je suis</label>
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ui-group-buttons">
                            <button type="submit" name="nature" value='1' class="btn btn-lg btn-trajet1">Conducteur</button>
                            <div class="or or-lg"></div>
                            <button type="submit" name="nature" value='2' class="btn btn-trajet2 btn-lg">Passager</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    
FIN;
?>
    