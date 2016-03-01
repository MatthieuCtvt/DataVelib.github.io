<?php
if ((!array_key_exists('loggedIn', $_SESSION) || $_SESSION['loggedIn'] == false)) {
    echo '<script language="Javascript">
alert ("Vous devez être logué pour y accéder!" )
</script>';
echo"<form name=\"formulaireBidon1\" method=\"post\" action=\"index.php?page=accueil\"><input type=\"hidden\"></form>";
echo "<script>document.formulaireBidon1.submit();</script>";
exit();
}
$user = User::getUtilisateur($_SESSION['login']);
$now = date(DATE_ATOM, time());
$now = new DateTime($now);
$now = $now->format('Y-m-d H:i:s');


?>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad" >

            <?php
            echo<<<END
    
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">$user->login</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/ProfilPic/$user->login/$user->ProfilPic" class="pic img-circle" width="220"> </div>
                
                <div class="col-md-offset-1 col-lg-offset-1 col-md-8 col-lg-8 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nom</td>
                        <td>$user->nom</td>
                      </tr>
                      <tr>
                        <td>Prénom</td>
                        <td>$user->prenom</td>
                      </tr>
                      <tr>
                        <td>Adresse Mail</td>
                        <td><a href="mailto:$user->email">$user->email</a></td></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Promotion</td>
                        <td>$user->promotion</td>
                      </tr>
                        <tr>
                        <td>Téléphone</td>
                        <td>$user->tel</td>
                      </tr>  
                    </tbody>
                  </table>
END;
            ?>
            <div><center><a id="trajetfuturclick" class="btn btn-profil1">Mes trajets à venir</a></center>
            
            <br>
            
            <div id="trajetfutur1" class = "col-sm-6 col-md-6 box1 text-accueil">
                <h2><center>Trajet où je suis passager</center></h2>

                <?php
                require_once ("scripts/trajet.php");
                echo "<script> var trajetids=new Array();</script>";
                $a = getTrajetWhereIamPassager($_SESSION['login']);
                $trajetids = array();
                foreach ($a as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now < $expire) {
                        $trajetids[] = printTrajetWhereIamPassager($tra);
                    }
                }
                ?>
            </div>
            

            <div id="trajetfutur2" class = "col-sm-6 col-md-6 box2 text-accueil">
                <h2><center>Trajet où je suis conducteur</center></h2>
                <?php
                require_once ("scripts/trajet.php");

                $b = getTrajetWhereIamConducteur($_SESSION['login']);

                foreach ($b as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now < $expire) {
                        $trajetids[] = printTrajetWhereIamConducteur($tra);
                    }
                }
                ?>

            </div>
            </div>
            
            
            

            <div><center><a id="trajetpasseclick" class="btn btn-profil2 btn-default">Mes trajets passés</a></center>

            <br>
            
            <div id="trajetpasse1" class = "col-sm-6 col-md-6 box1 text-accueil">
                <h2><center>Trajet où j'étais passager</center></h2>

                <?php
                require_once ("scripts/trajet.php");
                echo "<script> var trajetids=new Array();</script>";
                $a = getTrajetWhereIamPassager($_SESSION['login']);

                foreach ($a as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now > $expire) {
                        $trajetids[] = printTrajetWhereIamPassager($tra);
                    }
                }
                ?>
            </div>

            <div id="trajetpasse2" class = "col-sm-6 col-md-6 box2 text-accueil">
                <h2><center>Trajet où j'étais conducteur</center></h2>
                <?php
                require_once ("scripts/trajet.php");

                $b = getTrajetWhereIamConducteur($_SESSION['login']);

                foreach ($b as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now > $expire) {
                        $trajetids[] = printTrajetWhereIamConducteur($tra);
                    }
                }
                echo "<script> trajetids=trajetids.concat(" . json_encode($trajetids) . "); </script> ";
                ?>

            </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['suppressionCompte'])){
    print_r("pouet");
    $user = User::getUtilisateur($_SESSION['login']);
    unlink("img/ProfilPic/$user->login/$user->ProfilPic");
    rmdir("img/ProfilPic/$user->login");
    //suppression des trajets où je suis conducteur
    $dbh1 = Database::connect();
    $query1 ="UPDATE Trajet SET conducteur= ? WHERE conducteur=?"; 
    $sth1 = $dbh1->prepare($query1);
    $sth1->execute(array("",$user->login));
    //suppressiondes trajets où je suis passager1
    $dbh2 = Database::connect();
    $query2 ="UPDATE Trajet SET passager1=? WHERE passager1=?"; 
    $sth2 = $dbh2->prepare($query2);
    $sth2->execute(array("",$user->login));
    //suppressiondes trajets où je suis passager2
    $dbh3 = Database::connect();
    $query3 ="UPDATE Trajet SET passager2=? WHERE passager2=?"; 
    $sth3 = $dbh3->prepare($query3);
    $sth3->execute(array("",$user->login));
    //suppressiondes trajets où je suis passager3
    $dbh4 = Database::connect();
    $query4 ="UPDATE Trajet SET passager3=? WHERE passager3=?"; 
    $sth4 = $dbh4->prepare($query4);
    $sth4->execute(array("",$user->login));
    //suppressiondes trajets où je suis passager4
    $dbh5 = Database::connect();
    $query5 ="UPDATE Trajet SET passager4=? WHERE passager4=?"; 
    $sth5 = $dbh5->prepare($query5);
    $sth5->execute(array("",$user->login));
    logOut();
    $dbh = Database::connect();
    $query ="DELETE FROM Users WHERE login=?"; 
    $sth = $dbh->prepare($query);
    $sth->execute(array($user->login));
    $ok=($sth->rowCount() > 0);
    echo '<script language="Javascript">
alert ("Votre compte a été supprimé")
</script>';
    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=accueil\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    
}
echo<<<END

<div class="panel-footer">
    <a data-original-title="Envoyer un mail" href="mailto:$user->email" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
    <span class="pull-right">
        <form action="" method="post" class="sajouter" id="" action="index.php?page=compte">
            <button data-original-title="Supprimer mon compte" data-toggle="tooltip" type="submit" name="suppressionCompte"  value ="" id=""class="btn btn-sm btn-serieux1"><i class="glyphicon glyphicon-remove"></i></button>
        </form>
   </span>
</div>
END;
?>

</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Modifier mes informations</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class=" col-md-9 col-lg-9 "> 

                            <center><a id="changermdpclick" class=" col-sm-offset-4 btn btn-profil1">Mettre à jour mon mot de passe</a></center>
                            <?php
                            require_once("scripts/user.php");
                            if (isset($_POST["vp"]) && $_POST["vp"] != "" &&
                                    isset($_POST["up"]) && $_POST["up"] != "" &&
                                    isset($_POST["up2"]) && $_POST["up2"] != "" && $_POST["up"] == $_POST["up2"]) {
                                $user = User::getUtilisateur($_SESSION['login']);
                                if (!$user == NULL) {
                                    if ($user->testerMDP($_POST['vp'])) {
                                        $user->updateMDP($_POST['up']);
                                        echo '<script language="Javascript">alert ("Mot de passe mis à jour");</script>';
                                        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
                                    }
                                }
                            }
                            ?>
                            <form class="form-horizontal" id="changermdp" role="form" method='POST' action='index.php?page=compte'>
                                <br>
                                <div class="form-group">
                                    <label for="input_vp" class="col-sm-5 control-label">Mot de passe actuel</label>
                                    <div class="col-sm-7">
                                        <input type="password" name="vp" class="form-control" id="input_vp" placeholder="Mot de passe actuel">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input_up" class="col-sm-5 control-label">Nouveau mot de passe</label>
                                    <div class="col-sm-7">
                                        <input type="password" name="up" class="form-control" id="input_up" placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input_up2" class="col-sm-5 control-label">Nouveau mot de passe (confirmation)</label>
                                    <div class="col-sm-7">
                                        <input type="password" name="up2" class="form-control" id="input_up2" placeholder="Mot de passe (confirmation)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-6">
                                        <button type="submit" class="btn btn-default btn-profil2">Mettre à jour !</button>
                                    </div>
                                </div>
                            </form>
                            
                            <br>

                            <center><a id="changerinfoclick" class="btn btn-profil1 col-sm-offset-4">Mettre à jour mes informations</a></center>
                            <?php
                            require_once("scripts/user.php");

                            if (isset($_POST["a"]) && $_POST["a"] != "" &&
                                    isset($_POST["b"]) && $_POST["b"] != "" &&
                                    isset($_POST["c"]) && $_POST["c"] != "" &&
                                    isset($_POST["d"]) && $_POST["d"] != "" &&
                                    isset($_POST["e"]) && $_POST["e"] != "") {

                                $user = User::getUtilisateur($_SESSION['login']);
                                if (!$user == NULL) {

                                    $user->updateUser($_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['e']);

                                    echo '<script language="Javascript">alert ("Informations mises à jour");</script>';
                                    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
                                }
                            }



                            echo<<<FIN
        
            <form class="form-horizontal" id="changerinfo" role="form" method='POST' action='index.php?page=compte'>
                <br>
                    <div class="form-group">
                    <label for="input_a" class="col-sm-4 control-label">Nom</label>
                    <div class="col-sm-8">
                        <input  name="a" class="form-control" id="input_a" value="$user->nom">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_b" class="col-sm-4 control-label">Prénom</label>
                    <div class="col-sm-8">
                        <input  name="b" class="form-control" id="input_b" value="$user->prenom">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_c" class="col-sm-4 control-label">Adresse mail</label>
                    <div class="col-sm-8">
                        <input name="c" class="form-control" id="input_c" value="$user->email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_d" class="col-sm-4 control-label">Promotion</label>
                    <div class="col-sm-8">
                        <input name="d" class="form-control" id="input_d" value="$user->promotion">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_e" class="col-sm-4 control-label">Numéro de téléphone</label>
                    <div class="col-sm-8">
                        <input name="e" class="form-control" id="input_e" value="$user->tel">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
                        <button type="submit" class="btn btn-default btn-profil2">Mettre à jour !</button>
                    </div>
                </div>
            </form>
        
FIN;
                            ?>




                        
                        <br>

                        <center><a id="changerProfilPicclick" class="col-sm-offset-4 btn btn-profil1">Changer ma photo de profil</a></center>
                        <?php
                        require_once("scripts/user.php");
                        $probleme = FALSE;

                        if (isset($_FILES['ProfilPic'])) {
                            if ($_FILES['ProfilPic']['error'] > 0) {
                                $probleme = TRUE;
                                echo '<script language="Javascript">alert ("Probleme upload");</script>';
                            }
                            $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
                            $extension_upload = strtolower(substr(strrchr($_FILES['ProfilPic']['name'], '.'), 1));
                            if (!in_array($extension_upload, $extensions_valides)) {
                                $probleme = TRUE;
                                echo '<script language="Javascript">alert ("Mauvais format pour la photo");</script>';
                            }

                            if (!$probleme) {
                                $user = User::getUtilisateur($_SESSION['login']);
   
                                unlink("img/ProfilPic/$user->login/$user->ProfilPic");

                                $destination = "img/ProfilPic/$user->login/{$_FILES['ProfilPic']['name']}";
                                $resultat = move_uploaded_file($_FILES['ProfilPic']['tmp_name'], $destination);
                                $user->updateProfilPic($_FILES['ProfilPic']['name']);
                                if ($resultat)
                                    echo '<script language="Javascript">alert ("Téléchargement réussi");</script>';
                                    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
                            }
                        }
                        ?>

                        <br>
                        
                        <form class="form-horizontal" id="changerProfilPic" role="form" method='POST' action='index.php?page=compte' enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="input_ProfilPic" class="col-sm-6 control-label">Choisir la nouvelle photo de profil : </label>
                                <div class="col-sm-4">
                                    <input type="file" name="ProfilPic"  id="input_ProfilPic">

                                </div>
                            </div>
                            <div class="col-sm-offset-6 col-sm-6">
                                <button type="submit" class="btn btn-default btn-profil2">Mettre à jour !</button>
                            </div>

                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script language='javascript'>
    
  $(document).ready(function() {
    
    //alert(trajetids);
    for (var key in trajetids) {
        toggletrip(trajetids[key]);
    }
    console.log(trajetids);
});
</script>



