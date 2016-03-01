<?php

require_once("scripts/utilsBD.php");

Class Trajet {

    public $trajet;
    public $conducteur;
    public $passager1;
    public $passager2;
    public $passager3;
    public $passager4;
    public $date;
    public $horaire;
    public $nbplaces;
    public $depart;
    public $arrivee;
    public $itineraire;
    public $commentaire;
    public $id;

    public function __toString() {
        return "[" . $this->horaire . "] " . $this->nbplaces;
    }

    public static function getTrajetById($id) {
        $dbh = Database::connect();
        $query = "SELECT * FROM Trajet WHERE id = ?  ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
        $sth->execute(array($id));
        $result = array();
        while ($traj = $sth->fetch()) {
            array_push($result, $traj);
        }
        return $result;
    }

    public static function getTrajetConducteur($trajet1) {
        $dbh = Database::connect();
        $query = "SELECT * FROM Trajet WHERE trajet = ? ORDER BY date ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
        $sth->execute(array($trajet1));
        $result = array();
        while ($traj = $sth->fetch()) {
            array_push($result, $traj);
        }
        return $result;
    }

    public static function getTrajetPassager($trajet1) {
        $dbh = Database::connect();
        $query = "SELECT * FROM Trajet WHERE trajet = ? ORDER BY date";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
        $sth->execute(array($trajet1));
        $result = array();
        while ($traj = $sth->fetch()) {
            array_push($result, $traj);
        }
        return $result;
    }

    public static function insererTrajet($trajet, $conducteur, $passager1, $passager2, $passager3, $passager4, $date, $horaire, $nbplaces, $depart, $arrivee, $commentaire) {
        $dbh = Database::connect();
        $query = "INSERT INTO Trajet(trajet,conducteur,passager1,passager2,passager3,passager4,date,horaire,nbplaces,depart,arrivee,commentaire) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($trajet, $conducteur, $passager1, $passager2, $passager3, $passager4, $date, $horaire, $nbplaces, $depart, $arrivee, $commentaire));
        return ($sth->rowCount() > 0);
    }

    public static function sajouterPassager($traj, $login) {

        if ($traj->passager1 != $login && $traj->passager2 != $login && $traj->passager3 != $login && $traj->passager4 != $login && $traj->conducteur != $login) {

            if (!$traj->nbplaces == "") {
                $tmp = $traj->nbplaces - 1;
                $traj->nbplaces = $tmp;
                $dbh = Database::connect();
                $query = "UPDATE Trajet SET nbplaces=? WHERE id=?";
                $sth = $dbh->prepare($query);
                $sth->execute(array($tmp, $traj->id));
            }

            if ($traj->passager1 == "") {
                $dbh = Database::connect();
                $query = "UPDATE Trajet SET passager1=? WHERE id=?";
                $sth = $dbh->prepare($query);
                $sth->execute(array($login, $traj->id));
                echo '<script language="Javascript">alert ("Vous êtes désormais passager sur ce trajet");</script>';
    echo"<form name=\"formulaireBidon1\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon1.submit();</script>";
                return ($sth->rowCount() > 0);
            } else {
                if ($traj->passager2 == "") {
                    $dbh = Database::connect();
                    $query = "UPDATE Trajet SET passager2=? WHERE id=?";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($login, $traj->id));
                    echo '<script language="Javascript">alert ("Vous êtes désormais passager sur ce trajet");</script>';
    echo"<form name=\"formulaireBidon2\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon2.submit();</script>";
                    return ($sth->rowCount() > 0);
                } else {
                    if ($traj->passager3 == "") {
                        $dbh = Database::connect();
                        $query = "UPDATE Trajet SET passager3=? WHERE id=?";
                        $sth = $dbh->prepare($query);
                        $sth->execute(array($login, $traj->id));
                        echo '<script language="Javascript">alert ("Vous êtes désormais passager sur ce trajet");</script>';
    echo"<form name=\"formulaireBidon3\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon3.submit();</script>";
                        return ($sth->rowCount() > 0);
                    } else {
                        if ($traj->passager4 == "") {
                            $dbh = Database::connect();
                            $query = "UPDATE Trajet SET passager4=? WHERE id=?";
                            $sth = $dbh->prepare($query);
                            $sth->execute(array($login, $traj->id));
                            echo '<script language="Javascript">alert ("Vous êtes désormais passager sur ce trajet");</script>';
    echo"<form name=\"formulaireBidon4\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon4.submit();</script>";
                            return ($sth->rowCount() > 0);
                        }
                    }
                }
            }
        } else {
            echo '<script language="Javascript">alert ("Vous êtes déjà passager ou conducteur dans cette voiture");</script>';
        }
    }

    public static function sajouterConducteur($traj, $login, $nbplaces) {
        $nb = $nbplaces;
        if ($traj->passager1 != $login && $traj->passager2 != $login && $traj->passager3 != $login && $traj->passager4 != $login) {
            if ($traj->passager1 != '') {
                $nb = $nbplaces - 1;
                if ($traj->passager2 != '') {
                    $nb = $nbplaces - 2;
                    if ($traj->passager3 != '') {
                        $nb = $nbplaces - 3;
                        if ($traj->passager4 != '') {
                            $nb = $nbplaces - 4;
                        }
                    }
                }
            }
            
            $dbh = Database::connect();
            $query = "UPDATE Trajet SET conducteur=?, nbplaces=? WHERE id=?";
            $sth = $dbh->prepare($query);
            $sth->execute(array($login, $nb, $traj->id));
            echo '<script language="Javascript">alert ("Vous êtes désormais conducteur sur ce trajet");</script>';
    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
    
            return ($sth->rowCount() > 0);
        } else {
            echo '<script language="Javascript">alert ("Vous êtes déjà passager dans cette voiture");</script>';
        }
    }

    public static function seretirer($traj, $login) {
        
        if ($traj->conducteur == $login) {
            $dbh = Database::connect();
            $query = "UPDATE Trajet SET conducteur=? WHERE id=?";
            $sth = $dbh->prepare($query);
            $sth->execute(array("", $traj->id));
            return ($sth->rowCount() > 0);
        }
        if($traj->passager1==$login){
                $dbh = Database::connect();
                $query = "UPDATE Trajet SET passager1=? WHERE id=?";
                $sth = $dbh->prepare($query);
                $sth->execute(array('', $traj->id));
                return ($sth->rowCount() > 0);
        }
        if($traj->passager2==$login){
                $dbh = Database::connect();
                $query = "UPDATE Trajet SET passager2=? WHERE id=?";
                $sth = $dbh->prepare($query);
                $sth->execute(array('', $traj->id));
                return ($sth->rowCount() > 0);
        } 
        if($traj->passager3==$login){
                $dbh = Database::connect();
                $query = "UPDATE Trajet SET passager3=? WHERE id=?";
                $sth = $dbh->prepare($query);
                $sth->execute(array('', $traj->id));
                return ($sth->rowCount() > 0);
        }
        if($traj->passager4==$login){
                $dbh = Database::connect();
                $query = "UPDATE Trajet SET passager4=? WHERE id=?";
                $sth = $dbh->prepare($query);
                $sth->execute(array('', $traj->id));
                return ($sth->rowCount() > 0);
        } 
        
    
        
    }

}

function printTrajetConducteur(Trajet $traj) {
    $now = date(DATE_ATOM, time());
    $now = new DateTime($now);
    $now = $now->format('Y-m-d H:i:s');
    $expire = new DateTime($traj->date . $traj->horaire);
    $expire = $expire->format('Y-m-d H:i:s');
    if ($expire > $now) {

        $conducteur = User::getUtilisateur($traj->conducteur);
        $user = User::getUtilisateur($_SESSION['login']);

        if (isset($traj->conducteur) && !$traj->conducteur == "") {
            echo<<<FIN
        
        <div class="col-sm-12 col-md-12 voyages" id="clac$traj->id">Départ le $traj->date à $traj->horaire et $traj->nbplaces places disponibles.</div>
                <hr height="12px">
               
        <ul class="trip1" id="trip$traj->id">
             <li>Conducteur : $conducteur->prenom $conducteur->nom ($conducteur->tel)</li>
FIN;
            if($traj->passager1 != "" || $traj->passager2 != "" || $traj->passager3 != "" || $traj->passager4 != ""){
                echo "<li>Passagers : <ol>";
                if (isset($traj->passager1) && $traj->passager1 != "") {
                    $passager1 = User::getUtilisateur($traj->passager1);
                    echo "<li>$passager1->prenom $passager1->nom ($passager1->tel)</li>";
                }  
                if (isset($traj->passager2) && $traj->passager2 != "") {
                    $passager2 = User::getUtilisateur($traj->passager2);
                    echo "<li>$passager2->prenom $passager2->nom ($passager2->tel)</li>";
                }
                if (isset($traj->passager3) && $traj->passager3 != "") {
                    $passager3 = User::getUtilisateur($traj->passager3);
                    echo "<li>$passager3->prenom $passager3->nom ($passager3->tel)</li>";
                }
                if (isset($traj->passager4) && $traj->passager4 != "") {
                    $passager4 = User::getUtilisateur($traj->passager4);
                    echo "<li>$passager4->prenom $passager4->nom ($passager4->tel)</li>";
                }
                echo "</ol>";
            }else{
                echo "<li>Aucun Passager à ce Jour</li>";
            }

            if (!$traj->depart == "") {
                echo "<li>Départ : $traj->depart</li>";
            } else {
                echo "<li> Lieu de Départ Non Précisé</li>";
            }

            if (!$traj->arrivee == "") {
                echo "<li>Arrivée : $traj->arrivee</li>";
            } else {
                echo "<li> Lieu d'Arrivée Non Précisé</li>";
            }

            if (!$traj->commentaire == "") {
                echo "<li>Commentaires : $traj->commentaire</li>";
            }

            $ok = false;
            if (isset($_POST[$traj->id])) {
                $ok = Trajet::sajouterPassager($traj, $user->login);
            }

            echo<<<FIN
            <br>
        <form action="" method="post" class="sajouter" id="$traj->id" action="index.php?page=covoiturage">
        <center><button type="submit" name="$traj->id" class="btn btn-trajet2" value ="$traj->id" id="$traj->id">S'ajouter au trajet en passager</button>
        </form>
                    
                    
           
   </center> 
                    <hr>
        </ul>
                    
        
        
   
       
FIN;
            return $traj->id;
            
        }
    
    }
}
?>





<?php

function printTrajetPassager(Trajet $traj) {

    $now = date(DATE_ATOM, time());
    $now = new DateTime($now);
    $now = $now->format('Y-m-d H:i:s');
    $expire = new DateTime($traj->date . $traj->horaire);
    $expire = $expire->format('Y-m-d H:i:s');
    if ($expire > $now) {
        $user = User::getUtilisateur($_SESSION['login']);
        if ($traj->conducteur == "") {

            echo<<<FIN
        <div class="col-sm-12 col-md-12 voyages" id="clac$traj->id">Recherche conducteur le $traj->date à $traj->horaire.</div>
                <hr height="12px">
        <ul class="trip2" id="trip$traj->id">
            
FIN;
            if($traj->passager1 != "" || $traj->passager2 != "" || $traj->passager3 != "" || $traj->passager4 != ""){
                echo "<li>Passagers : <ol>";
                if (isset($traj->passager1) && $traj->passager1 != "") {
                    $passager1 = User::getUtilisateur($traj->passager1);
                    echo "<li>$passager1->prenom $passager1->nom ($passager1->tel)</li>";
                }  
                if (isset($traj->passager2) && $traj->passager2 != "") {
                    $passager2 = User::getUtilisateur($traj->passager2);
                    echo "<li>$passager2->prenom $passager2->nom ($passager2->tel)</li>";
                }
                if (isset($traj->passager3) && $traj->passager3 != "") {
                    $passager3 = User::getUtilisateur($traj->passager3);
                    echo "<li>$passager3->prenom $passager3->nom ($passager3->tel)</li>";
                }
                if (isset($traj->passager4) && $traj->passager4 != "") {
                    $passager4 = User::getUtilisateur($traj->passager4);
                    echo "<li>$passager4->prenom $passager4->nom ($passager4->tel)</li>";
                }
                echo "</ol>";
            }else{
                echo "<li>Aucun passager à ce jour</li>";
            }
            
            
            
            
            

            if (!$traj->depart == "") {
                echo "<li>Départ : $traj->depart</li>";
            } else {
                echo "<li> Lieu de Départ non Précisé</li>";
            }

            if (!$traj->arrivee == "") {
                echo "<li>Arrivée : $traj->arrivee</li>";
            } else {
                echo "<li> Lieu d'Arrivée non Précisé</li>";
            }

            if (!$traj->commentaire == "") {
                echo "<li>Commentaires : $traj->commentaire</li>";
            }

            $ok = FALSE;
            if (isset($_POST['cond' . $traj->id]) && isset($_POST['nbplaces'])) {
                $ok = Trajet::sajouterConducteur($traj, $user->login, $_POST['nbplaces']);
            }
            if (isset($_POST['pass' . $traj->id])) {
                $ok = Trajet::sajouterPassager($traj, $user->login);
            }

            echo<<<FIN
            <br>
        <form action="" method="post" class="sajouter" id="$traj->id" action="index.php?page=covoiturage">
FIN;
            if ($traj->passager4 == "") {
                echo "<center><button type=\"submit\" name=\"pass$traj->id\" class=\"btn btn-trajet1\" value =\"$traj->id\" id=\"$traj->id\">S'ajouter en passager</button></center>";
            }
          echo "</form>";
          echo "<br>";
            echo<<<FIN
          <form action="" method="post" class="sajouter" id="$traj->id" action="index.php?page=covoiturage">
        <center><button type="submit" name="cond$traj->id" class="btn btn-default btn-trajet2" value ="$traj->id" id="$traj->id">S'ajouter en conducteur</button></center>
                    <br>
                    <label for="input_nbplaces" class="col-sm-7 control-label">Places disponibles :<em>*</em></label>
        <div class="col-sm-4">
            <input type="int" data-toggle="tooltip" data-placement="bottom" data-original-title="Nombre TOTAL de places disponibles, SANS soustraire au préalable les passagers inscrits sur ce trajet" name="nbplaces" class="form-control" id="input_nbplaces" placeholder="3"  required>
        </div>
                    

                </form>
                
          <br><hr>  
        
        </ul>
FIN;

            return $traj->id;
        }
    }
}

function getTrajetWhereIamConducteur($login) {

    $dbh = Database::connect();
    $query = "SELECT * FROM Trajet WHERE conducteur = ? ORDER BY date";
    $sth = $dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
    $sth->execute(array($login));
    $result = array();
    while ($con = $sth->fetch()) {
        array_push($result, $con);
    }
    return $result;
}

function getTrajetWhereIamPassager($login) {

    $dbh = Database::connect();
    $query = "SELECT * FROM Trajet WHERE passager1 = ? OR passager2=? OR passager3=? OR passager4=? ORDER BY date";
    $sth = $dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
    $sth->execute(array($login, $login, $login, $login));
    $result = array();
    while ($con = $sth->fetch()) {
        array_push($result, $con);
    }
    return $result;
}

function printTrajetWhereIamPassager(Trajet $traj) {
    $user = User::getUtilisateur($_SESSION['login']);
    echo<<<FIN
        <div class="col-sm-12 col-md-12 voyages" id="clac$traj->id">$traj->trajet le $traj->date à $traj->horaire.</div>
                
        <ul class="trip1" id="trip$traj->id">
            
FIN;
    if (!$traj->conducteur == "") {
        $conducteur = User::getUtilisateur($traj->conducteur);
        echo "<li>Conducteur : $conducteur->prenom $conducteur->nom ($conducteur->tel)</li>";
    } else {
        echo "<li>Toujours pas de conducteur à ce jour.</li>";
    }

    if($traj->passager1 != "" || $traj->passager2 != "" || $traj->passager3 != "" || $traj->passager4 != ""){
                echo "<li>Passagers : <ol>";
                if (isset($traj->passager1) && $traj->passager1 != "") {
                    $passager1 = User::getUtilisateur($traj->passager1);
                    echo "<li>$passager1->prenom $passager1->nom ($passager1->tel)</li>";
                }  
                if (isset($traj->passager2) && $traj->passager2 != "") {
                    $passager2 = User::getUtilisateur($traj->passager2);
                    echo "<li>$passager2->prenom $passager2->nom ($passager2->tel)</li>";
                }
                if (isset($traj->passager3) && $traj->passager3 != "") {
                    $passager3 = User::getUtilisateur($traj->passager3);
                    echo "<li>$passager3->prenom $passager3->nom ($passager3->tel)</li>";
                }
                if (isset($traj->passager4) && $traj->passager4 != "") {
                    $passager4 = User::getUtilisateur($traj->passager4);
                    echo "<li>$passager4->prenom $passager4->nom ($passager4->tel)</li>";
                }
                echo "</ol>";
            }else{
                echo "<li>Aucun passager à ce jour</li>";
            }

    if (!$traj->depart == "") {
        echo "<li>Départ : $traj->depart</li>";
    } else {
        echo "<li> Lieu de Départ non Précisé</li>";
    }

    if (!$traj->arrivee == "") {
        echo "<li>Arrivée : $traj->arrivee</li>";
    } else {
        echo "<li> Lieu d'Arrivée non Précisé</li>";
    }

    if (!$traj->commentaire == "") {
        echo "<li>Commentaires : $traj->commentaire</li>";
    }
    
    $ok = false;
        if (isset($_POST[$traj->id])) {
            $ok = Trajet::seretirer($traj, $user->login);
            echo '<script language="Javascript">alert ("Vous êtes retirés du trajet");</script>';
    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
        }
    echo<<<FIN
        <form action="" method="post" class="seretirer" id="$traj->id" action="index.php?page=covoiturage">
        <center><button type="submit" name="$traj->id" class="btn btn-default btn-trajet2" value ="$traj->id" id="$traj->id">Se retirer du trajet</button>
        </form>
            
        </ul>
FIN;

    return $traj->id;
}

function printTrajetWhereIamPassagerPROFIL(Trajet $traj) {
    $user = User::getUtilisateur($_SESSION['login']);
    echo<<<FIN
        <div class="col-sm-12 col-md-12 voyages" id="clac$traj->id">$traj->trajet le $traj->date à $traj->horaire.</div>
                
        <ul class="trip1" id="trip$traj->id">
            
FIN;
    if (!$traj->conducteur == "") {
        $conducteur = User::getUtilisateur($traj->conducteur);
        echo "<li>Conducteur : $conducteur->prenom $conducteur->nom ($conducteur->tel)</li>";
    } else {
        echo "<li>Toujours pas de conducteur à ce jour.</li>";
    }

    if($traj->passager1 != "" || $traj->passager2 != "" || $traj->passager3 != "" || $traj->passager4 != ""){
                echo "<li>Passagers : <ol>";
                if (isset($traj->passager1) && $traj->passager1 != "") {
                    $passager1 = User::getUtilisateur($traj->passager1);
                    echo "<li>$passager1->prenom $passager1->nom ($passager1->tel)</li>";
                }  
                if (isset($traj->passager2) && $traj->passager2 != "") {
                    $passager2 = User::getUtilisateur($traj->passager2);
                    echo "<li>$passager2->prenom $passager2->nom ($passager2->tel)</li>";
                }
                if (isset($traj->passager3) && $traj->passager3 != "") {
                    $passager3 = User::getUtilisateur($traj->passager3);
                    echo "<li>$passager3->prenom $passager3->nom ($passager3->tel)</li>";
                }
                if (isset($traj->passager4) && $traj->passager4 != "") {
                    $passager4 = User::getUtilisateur($traj->passager4);
                    echo "<li>$passager4->prenom $passager4->nom ($passager4->tel)</li>";
                }
                echo "</ol>";
            }else{
                echo "<li>Aucun passager à ce jour</li>";
            }

    if (!$traj->depart == "") {
        echo "<li>Départ : $traj->depart</li>";
    } else {
        echo "<li> Lieu de Départ non Précisé</li>";
    }

    if (!$traj->arrivee == "") {
        echo "<li>Arrivée : $traj->arrivee</li>";
    } else {
        echo "<li> Lieu d'Arrivée non Précisé</li>";
    }

    if (!$traj->commentaire == "") {
        echo "<li>Commentaires : $traj->commentaire</li>";
    }
    
    
    echo<<<FIN
        
            
        </ul>
    
FIN;

    return $traj->id;
}


function printTrajetWhereIamConducteur(Trajet $traj) {
    $conducteur = User::getUtilisateur($traj->conducteur);
    $user = User::getUtilisateur($_SESSION['login']);
    if (isset($traj->conducteur) && !$traj->conducteur == "") {
        echo<<<FIN
        
        <div class="col-sm-12 col-md-12 voyages" id="clac$traj->id">$traj->trajet le $traj->date à $traj->horaire.</div>
                
               
        <ul class="trip2" id="trip$traj->id">
             
FIN;
        if($traj->passager1 != "" || $traj->passager2 != "" || $traj->passager3 != "" || $traj->passager4 != ""){
                echo "<li>Passagers : <ol>";
                if (isset($traj->passager1) && $traj->passager1 != "") {
                    $passager1 = User::getUtilisateur($traj->passager1);
                    echo "<li>$passager1->prenom $passager1->nom ($passager1->tel)</li>";
                }  
                if (isset($traj->passager2) && $traj->passager2 != "") {
                    $passager2 = User::getUtilisateur($traj->passager2);
                    echo "<li>$passager2->prenom $passager2->nom ($passager2->tel)</li>";
                }
                if (isset($traj->passager3) && $traj->passager3 != "") {
                    $passager3 = User::getUtilisateur($traj->passager3);
                    echo "<li>$passager3->prenom $passager3->nom ($passager3->tel)</li>";
                }
                if (isset($traj->passager4) && $traj->passager4 != "") {
                    $passager4 = User::getUtilisateur($traj->passager4);
                    echo "<li>$passager4->prenom $passager4->nom ($passager4->tel)</li>";
                }
                echo "</ol>";
            }else{
                echo "<li>Aucun passager à ce jour</li>";
            }

        if (!$traj->depart == "") {
            echo "<li>Départ : $traj->depart</li>";
        } else {
            echo "<li> Lieu de Départ non Précisé</li>";
        }

        if (!$traj->arrivee == "") {
            echo "<li>Arrivée : $traj->arrivee</li>";
        } else {
            echo "<li> Lieu d'Arrivée non Précisé</li>";
        }

        if (!$traj->commentaire == "") {
            echo "<li>Commentaires : $traj->commentaire</li>";
        }

        $ok = false;
        if (isset($_POST[$traj->id])) {
            $ok = Trajet::seretirer($traj, $user->login);
            echo '<script language="Javascript">alert ("Vous êtes retirés du trajet");</script>';
    echo"<form name=\"formulaireBidon\" method=\"post\" action=\"index.php?page=compte\"><input type=\"hidden\"></form>";
                                    echo "<script>document.formulaireBidon.submit();</script>";
        }
        echo<<<FIN
        <form action="" method="post" class="sajouter" id="$traj->id" action="index.php?page=covoiturage">
        <center><button type="submit" name="$traj->id" class="btn btn-trajet1" value ="$traj->id" id="$traj->id">Se retirer du trajet</button>
        </form>
           
   
        </ul>
        
        
   
        <hr>
FIN;
        return $traj->id;
    }
}

function printTrajetWhereIamConducteurPROFIL(Trajet $traj) {
    $conducteur = User::getUtilisateur($traj->conducteur);
    $user = User::getUtilisateur($_SESSION['login']);
    if (isset($traj->conducteur) && !$traj->conducteur == "") {
        echo<<<FIN
        
        <div class="col-sm-12 col-md-12 voyages" id="clac$traj->id">$traj->trajet le $traj->date à $traj->horaire.</div>
                
               
        <ul class="trip2" id="trip$traj->id">
             
FIN;
        if($traj->passager1 != "" || $traj->passager2 != "" || $traj->passager3 != "" || $traj->passager4 != ""){
                echo "<li>Passagers : <ol>";
                if (isset($traj->passager1) && $traj->passager1 != "") {
                    $passager1 = User::getUtilisateur($traj->passager1);
                    echo "<li>$passager1->prenom $passager1->nom ($passager1->tel)</li>";
                }  
                if (isset($traj->passager2) && $traj->passager2 != "") {
                    $passager2 = User::getUtilisateur($traj->passager2);
                    echo "<li>$passager2->prenom $passager2->nom ($passager2->tel)</li>";
                }
                if (isset($traj->passager3) && $traj->passager3 != "") {
                    $passager3 = User::getUtilisateur($traj->passager3);
                    echo "<li>$passager3->prenom $passager3->nom ($passager3->tel)</li>";
                }
                if (isset($traj->passager4) && $traj->passager4 != "") {
                    $passager4 = User::getUtilisateur($traj->passager4);
                    echo "<li>$passager4->prenom $passager4->nom ($passager4->tel)</li>";
                }
                echo "</ol>";
            }else{
                echo "<li>Aucun passager à ce jour</li>";
            }

        if (!$traj->depart == "") {
            echo "<li>Départ : $traj->depart</li>";
        } else {
            echo "<li> Lieu de Départ non Précisé</li>";
        }

        if (!$traj->arrivee == "") {
            echo "<li>Arrivée : $traj->arrivee</li>";
        } else {
            echo "<li> Lieu d'Arrivée non Précisé</li>";
        }

        if (!$traj->commentaire == "") {
            echo "<li>Commentaires : $traj->commentaire</li>";
        }

        
        echo<<<FIN
        
           
   
        </ul>
        
        
   
FIN;
        return $traj->id;
    }
}
?>