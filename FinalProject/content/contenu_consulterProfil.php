<?php
$user = User::getUtilisateur($_SESSION['login']);
$now = date(DATE_ATOM, time());
$now = new DateTime($now);
$now = $now->format('Y-m-d H:i:s');



require_once("scripts/utilsBD.php");
if(isset($_POST['search'])){
   $searchtmp = htmlspecialchars($_POST['search']);
   $search = '%' . $searchtmp . '%';
$dbh = Database::connect();
$query = "SELECT * FROM Users WHERE nom LIKE ? ORDER BY promotion";
$sth = $dbh->prepare($query);
$sth->setFetchMode(PDO::FETCH_CLASS, 'User');
$sth->execute(array($search));
$result = $sth->fetchAll(PDO::FETCH_CLASS, 'User');
}

echo "<script> var profids=new Array();</script>";
$profids = array();
foreach ($result as $profil) {
 $profids[]=$profil->login;
            
            echo<<<END
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10  toppad" >

    
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">$profil->login</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/ProfilPic/$profil->login/$profil->ProfilPic" class="pic img-circle" width="220"> </div>
                
                <div class="col-md-offset-1 col-lg-offset-1 col-md-8 col-lg-8 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nom</td>
                        <td>$profil->nom</td>
                      </tr>
                      <tr>
                        <td>Prénom</td>
                        <td>$profil->prenom</td>
                      </tr>
                      <tr>
                        <td>Adresse Mail</td>
                        <td><a href="mailto:$profil->email">$profil->email</a></td></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Promotion</td>
                        <td>$profil->promotion</td>
                      </tr>
                        <tr>
                        <td>Téléphone</td>
                        <td>$profil->tel</td>
                      </tr>  
                    </tbody>
                  </table>
END;
            

echo<<<FIN
            <center><a id="trajetfuturclick$profil->login" class="btn btn-trajet1">Ses trajets à venir</a></center>
            
            <br>
            
            <div id="trajetfutur1$profil->login" class = "col-sm-6 col-md-6 box1 text-accueil">
                <h2><center>Trajet où il est passager</center></h2>
FIN;
                
                require_once ("scripts/trajet.php");
                echo "<script> var trajetids=new Array();</script>";
                $a = getTrajetWhereIamPassager($profil->login);
                $trajetids = array();
                foreach ($a as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now < $expire) {
                        $trajetids[] = printTrajetWhereIamPassagerPROFIL($tra);
                    }
                }
                ?>
            </div>
            
<?php
            echo "<div id=\"trajetfutur2$profil->login\" class = \"col-sm-6 col-md-6 box2 text-accueil\">";
                    ?>
                <h2><center>Trajet où il est conducteur</center></h2>
                <?php
                require_once ("scripts/trajet.php");

                $b = getTrajetWhereIamConducteur($profil->login);

                foreach ($b as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now < $expire) {
                        $trajetids[] = printTrajetWhereIamConducteurPROFIL($tra);
                    }
                }
                ?>

            </div>
            
            
<?php
           echo "<div><center><a id=\"trajetpasseclick$profil->login\" class=\"btn btn-trajet2 btn-default\">Ses trajets passés</a></center>";
?>
            <br>
<?php            
            echo "<div id=\"trajetpasse1$profil->login\" class = \"col-sm-6 col-md-6 box1 text-accueil\">";
?>                    
                <h2><center>Trajet où il était passager</center></h2>

                <?php
                require_once ("scripts/trajet.php");
                echo "<script> var trajetids=new Array();</script>";
                $a = getTrajetWhereIamPassager($_SESSION['login']);

                foreach ($a as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now > $expire) {
                        $trajetids[] = printTrajetWhereIamPassagerPROFIL($tra);
                    }
                }
                ?>
            </div>
<?php
           echo " <div id=\"trajetpasse2$profil->login\" class = \"col-sm-6 col-md-6 box2 text-accueil\">";
 ?>                   
                <h2><center>Trajet où il était conducteur</center></h2>
                <?php
                require_once ("scripts/trajet.php");

                $b = getTrajetWhereIamConducteur($_SESSION['login']);

                foreach ($b as $tra) {
                    $expire = new DateTime($tra->date . $tra->horaire);
                    $expire = $expire->format('Y-m-d H:i:s');

                    if ($now > $expire) {
                        $trajetids[] = printTrajetWhereIamConducteurPROFIL($tra);
                    }
                }
                echo "<script> trajetids=trajetids.concat(" . json_encode($trajetids) . "); </script> ";
                
                ?>

            </div>
            </div>
        </div>
    </div>
</div>
            </div>            

<?php
}
echo "<script> profids=profids.concat(" . json_encode($profids) . "); </script> ";
?>

<script language='javascript'>
    
  $(document).ready(function() {
    
    //alert(trajetids);
    for (var key in trajetids) {
        toggletrip(trajetids[key]);
    }
    console.log(trajetids);
});
$(document).ready(function() {
    
    //alert(trajetids);
    for (var key in profids) {
        togglefut(profids[key]);
        togglepasse(profids[key]);
        
    }
    console.log(profids);
});
</script>



