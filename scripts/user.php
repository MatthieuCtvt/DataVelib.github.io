<?php

require_once("scripts/utilsBD.php");

Class User {

    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $promotion;
    public $email;
    public $tel;
    public $photo;
    public $ProfilPic;
    

    public function __toString() {
        return "[" . $this->login . "] " . $this->prenom . " " . $this->nom;
    }

    public function updateUser($nom, $prenom, $email,$promo,$tel) {
        $dbh = Database::connect();
        $query = "UPDATE Users SET  nom=?, prenom=?,promotion=?,email=?,tel=? WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($nom, $prenom, $promo,$email,$tel,$this->login));
        return ($sth->rowCount() > 0);
    }

    public static function getUtilisateur($login) {
        $dbh = Database::connect();
        $query = "SELECT * FROM Users WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
        $sth->execute(array($login));
        if ($sth->rowCount() == 0) {
            return null;
        } else {
            return $sth->fetch();
        }
    }

    public static function insererUtilisateur($login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $tel) {
        if (User::getUtilisateur($login) == NULL) {
            $dbh = Database::connect();
            $query = "INSERT INTO Users(login,mdp,nom,prenom, promotion, naissance, email, tel) VALUES (?,sha1(?),?,?,?,?,?,?)";
            $sth = $dbh->prepare($query);
            $sth->execute(array($login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $tel));
            return ($sth->rowCount() > 0);
        } else {
            return false;
        }
    }

    public function testerMDP($mdp) {
        return sha1($mdp) == $this->mdp;
    }

    public function updateMDP($mdp) {
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE Users SET mdp=sha1(?) WHERE login=?");
        $sth->execute(array($mdp, $this->login));
    }
    
    public function updateProfilPic($ProfilPic) {
     
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE Users SET ProfilPic=? WHERE login=?");
        $sth->execute(array($ProfilPic, $this->login));
    }

}

?>