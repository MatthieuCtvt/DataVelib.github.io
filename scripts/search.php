
<?php
require_once("../scripts/utilsBD.php");

if (isset($_POST['search']) && !empty($_POST['search'])) {
   $searchtmp = htmlspecialchars($_POST['search']);
   $search = '%' . $searchtmp . '%';
   
   $dbh = Database::connect();
   $sth = $dbh->prepare("SELECT * FROM Users WHERE nom LIKE ?  LIMIT 10");
   $sth->execute(array($search));
   while ($results = $sth->fetch()) {
       
       echo "<li>".$results['nom']."</li>";
   }
}
?>