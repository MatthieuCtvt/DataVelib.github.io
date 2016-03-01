<?php
if ((!array_key_exists('loggedIn', $_SESSION) || $_SESSION['loggedIn'] == false)) {
    echo '<script language="Javascript">
alert ("Vous devez être logué pour y accéder!" )
</script>';
    exit();
    }
?>
<div class="jumbotron text-form">
    <h1>Ajouter mon trajet en tant que Passager</h1>
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
$user = User::getUtilisateur($_SESSION['login']);
 
$trajet = "";
if (array_key_exists('trajet', $_POST)) {
    $trajet = $_POST['trajet'];
}

$date="";
if (array_key_exists('date', $_POST)) {
    
    $date = $_POST['date'];
    
   
}

$horaire="";
if (array_key_exists('horaire', $_POST)) {
    $horaire = $_POST['horaire'];
}

$nbplaces = "";
if (array_key_exists('nbplaces', $_POST)) {
    $nbplaces = $_POST['nbplaces'];
}

$depart = "";
if (array_key_exists('depart', $_POST)) {
    $depart = $_POST['depart'];
}

$arrivee = "";
if (array_key_exists('arrivee', $_POST)) {
    $arrivee = $_POST['arrivee'];
}

$commentaire="";
if (array_key_exists('commentaire', $_POST)) {
    $commentaire = $_POST['commentaire'];
}
$ok = FALSE;
if (isset($_POST['trajet']) && !$_POST['trajet']=="" && isset($_POST['horaire']) && !$_POST['horaire']=="" && !$_POST['horaire']==""  ) {
    $ok=Trajet::insererTrajet($_POST['trajet'], "", $_SESSION['login'],"","","",  $_POST['date'],$_POST['horaire'],NULL, '', '', $_POST['commentaire']);
}
if($ok){
    echo '<script language="Javascript">alert ("Trajet ajouté");</script>';
   
    
                                        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
}

echo<<<FIN

<form class="form-horizontal text-form" role="form" method='POST' action='index.php?page=ajouterTrajetPassager'>
    
    <div class="form-group">
        <label for="input_trajet" class="col-sm-4 control-label">Trajet <em>*</em></label>
        <div class="col-sm-4">
            <select name="trajet" class="form-control" placeholder="Choississez le trajet voulu" required="">
                <option value="X -> Massy">X -> Massy</option>
                <option value="Massy -> X">Massy -> X</option>
                <option value="X -> Lozere">X -> Lozere</option>
                <option value="Lozere -> X">Lozere -> X</option>
                <option value="X -> Paris">X -> Paris</option>
                <option value="Paris -> X">Paris -> X</option>
                <option value="X -> Orly">X -> Orly</option>
                <option value="Orly -> X">Orly -> X</option>
                <option value="X -> CDG">X -> CDG</option>
                <option value="CDG -> X">CDG -> X</option>
                
            </select>
        </div>
    </div>

    
    <div class="form-group">
        <label for="input_date" class="col-sm-4 control-label">Date du trajet <em>*</em></label>
        <div class="col-sm-4">
            <input type="text" name="date" class="form-control" id="input_date" placeholder="AAAA-MM-JJ" required="">
        </div>
    </div>

    <div class="form-group">
        <label for="input_horaire" class="col-sm-4 control-label">Horaire du trajet <em>*</em></label>
        <div class="col-sm-4">
            <input type="time" data-placement="bottom" data-original-title="Attention ! Indiquez l'horaire selon le format HH:MM" data-toggle="tooltip" name="horaire" class="form-control" id="input_horaire" placeholder="00:00" required="">
        </div>
    </div>
         
    <div class="form-group">
        <label for="input_commentaire" class="col-sm-4 control-label">Commentaire</label>
        <div class="col-sm-4">
            <input type="text" name="commentaire" class="form-control" id="input_commentaire" placeholder="Mettez par exemple le trajet envisagé" value='$depart'>
        </div>
    </div>
        
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-4 col-md-offset-5 col-md-4 col-lg-offset-5 col-lg-5">
            <button type="submit" class="btn btn-serieux1">Ajouter le trajet</button>
        </div>
    </div>
</form>
FIN;



?>