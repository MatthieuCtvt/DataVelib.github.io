<?php
require_once("scripts/utilsBD.php");
require ("scripts/trajet.php");


$dbh = Database::connect();
$query = "SELECT * FROM Users ORDER BY nom";
$sth = $dbh->prepare($query);
$sth->setFetchMode(PDO::FETCH_CLASS, 'User');
$sth->execute(array());
//$result = array();
$result = $sth->fetchAll(PDO::FETCH_CLASS, 'User');


echo<<<FIN
<div>
<center><h1>Les Utilisateurs du site</h1></center>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Login</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Mail</th>
           <th>Téléphone</th>
          <th>Date de naissance</th>
          <th>Promotion</th>
          <th>supprimer profil</th>
          
        </tr>
      </thead>
<tbody>
FIN;
foreach($result as $prof){
    //suppression compte : 
    if(isset($_POST['suppressionCompte'.$prof->login])){
   
    unlink("img/ProfilPic/$prof->login/$prof->ProfilPic");
    rmdir("img/ProfilPic/$prof->login");
    
    $query ="DELETE FROM Users WHERE login=?"; 
    $sth = $dbh->prepare($query);
    $sth->execute(array($prof->login));
    $ok=($sth->rowCount() > 0);
    echo '<script language="Javascript">alert ("Ce compte a été supprimé");</script>';
   
    
                                        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    
    
}

    echo<<<FIN
        <tr>
          <td>$prof->login</td>
          <td>$prof->nom</td>
          <td>$prof->prenom</td>
          <td>$prof->email</td>
            <td>$prof->tel</td>
            <td>$prof->naissance</td>
            <td>$prof->promotion</td>
            <td><form action="" method="post" class="" id="" action="index.php?page=admin">
            <button data-original-title="Supprimer ce compte" data-toggle="tooltip" type="submit" name="suppressionCompte$prof->login"  value ="$prof" id=""class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
        </form></td>
            
            
        </tr>
        
 
FIN;
}
echo "</table>";
echo "</div>";



$query1 = "SELECT * FROM Trajet ORDER BY date,horaire";
$sth1 = $dbh->prepare($query1);
$sth1->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
$sth1->execute(array());
//$result = array();
$result1 = $sth1->fetchAll(PDO::FETCH_CLASS, 'Trajet');


echo<<<FIN
<div>

<center><h1>Les trajets existants</h1></center>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Trajet</th>
          <th>Date</th>
          <th>Horaire</th>
          <th>Conducteur</th>
          <th>Passager1</th>
          <th>Passager2</th>
          <th>Passager3</th>
          <th>Passager4</th>
          <th>supprimer le trajet</th>
          
        </tr>
      </thead>
<tbody>
FIN;
foreach($result1 as $traj){
    //suppression compte : 
    if (isset($_POST['suppressionTrajet' . $traj->id])) {


        $query = "DELETE FROM Trajet WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($traj->id));
        $ok = ($sth->rowCount() > 0);
        echo '<script language="Javascript">
alert ("Ce trajet a été supprimé")
</script>';
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }
    if (isset($_POST['suppressionConducteur' . $traj->id])) {
        $query = "UPDATE Trajet SET conducteur=? WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array("",$traj->id));
        $ok = ($sth->rowCount() > 0);
        echo '<script language="Javascript">
alert ("Le conducteur a été supprimé")
</script>';
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }
    if (isset($_POST['suppressionPa1' . $traj->id])) {
        $query = "UPDATE Trajet SET passager1=? WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array("",$traj->id));
        $ok = ($sth->rowCount() > 0);
        echo '<script language="Javascript">
alert ("Le passager a été supprimé")
</script>';
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }
    if (isset($_POST['suppressionPa2' . $traj->id])) {
        $query = "UPDATE Trajet SET passager2=? WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array("",$traj->id));
        $ok = ($sth->rowCount() > 0);
        echo '<script language="Javascript">
alert ("Le passager a été supprimé")
</script>';
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }
    if (isset($_POST['suppressionPa3' . $traj->id])) {
        $query = "UPDATE Trajet SET passager3=? WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array("",$traj->id));
        $ok = ($sth->rowCount() > 0);
        echo '<script language="Javascript">
alert ("Le passager a été supprimé")
</script>';
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }
    if (isset($_POST['suppressionPa4' . $traj->id])) {
        $query = "UPDATE Trajet SET passager4=? WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array("",$traj->id));
        $ok = ($sth->rowCount() > 0);
        echo '<script language="Javascript">
alert ("Le passager a été supprimé")
</script>';
        echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=admin\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    }

    echo<<<FIN
        <tr>
          <td>$traj->trajet</td>
          <td>$traj->date</td>
          <td>$traj->horaire</td>
FIN;
          echo"<td>$traj->conducteur";
          if($traj->conducteur!=""){
              echo "<form action=\"index.php?page=admin\" method=\"post\" ><button data-original-title=\"Supprimer le conducteur\" data-toggle=\"tooltip\" type=\"submit\" name=\"suppressionConducteur$traj->id\"  value =\"$traj\" class=\"btn btn-sm btn-danger\"><i class=\"glyphicon glyphicon-remove\"></i></button></form></td>";
          }
          echo "</td>";
          
           echo"<td>$traj->passager1";
          if($traj->passager1!=""){
              echo "<form action=\"index.php?page=admin\" method=\"post\" ><button data-original-title=\"Supprimer le passager\" data-toggle=\"tooltip\" type=\"submit\" name=\"suppressionPa1$traj->id\"  value =\"$traj\" class=\"btn btn-sm btn-danger\"><i class=\"glyphicon glyphicon-remove\"></i></button></form></td>";
          }
          echo "</td>";
         
           echo"<td>$traj->passager2";
          if($traj->passager2!=""){
              echo "<form action=\"index.php?page=admin\" method=\"post\" ><button data-original-title=\"Supprimer le passager\" data-toggle=\"tooltip\" type=\"submit\" name=\"suppressionPa2$traj->id\"  value =\"$traj\" class=\"btn btn-sm btn-danger\"><i class=\"glyphicon glyphicon-remove\"></i></button></form></td>";
          }
          echo "</td>";
          
           echo"<td>$traj->passager3";
          if($traj->passager3!=""){
              echo "<form action=\"index.php?page=admin\" method=\"post\" ><button data-original-title=\"Supprimer le passager\" data-toggle=\"tooltip\" type=\"submit\" name=\"suppressionPa3$traj->id\"  value =\"$traj\" class=\"btn btn-sm btn-danger\"><i class=\"glyphicon glyphicon-remove\"></i></button></form></td>";
          }
          echo "</td>";
          
           echo"<td>$traj->passager4";
          if($traj->passager4!=""){
              echo "<form action=\"index.php?page=admin\" method=\"post\" ><button data-original-title=\"Supprimer le passager\" data-toggle=\"tooltip\" type=\"submit\" name=\"suppressionPa4$traj->id\"  value =\"$traj\" class=\"btn btn-sm btn-danger\"><i class=\"glyphicon glyphicon-remove\"></i></button></form></td>";
          }
          echo "</td>";
    
          

                  echo<<<FIN
                  
<td><form action="" method="post" class="" id="" action="index.php?page=admin">
          <button data-original-title="Supprimer ce trajet" data-toggle="tooltip" type="submit" name="suppressionTrajet$traj->id"  value ="$traj" id=""class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
        </form></td>
            
            
        </tr>
        
 
FIN;
}
echo "</table>";
echo "</div>";

?>
