<?php
require('database.php');

class user {
    private $_id;
    public $_login;
    public $_password;

    public function __construct()
    {
    }

    public function login($login, $password) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE login='$login' AND password='$password'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        if(count($res)) {
           $_SESSION['id'] = $res[0]['id'];
           $_SESSION['login'] = $login;
           $this->_id = $res[0]['id'];
           $this->_login = $login;
           $this->_password = $password;

           echo 'Connexion réussi, vous allez être redirigé.';
           echo $_SESSION['id'] . ' | ' . $_SESSION['login'];
           header('refresh:2;url=./profil.php');
        } else {
            echo 'Aucun utilisateur trouvé.';
        }
    }

    public function register($login, $password, $password2) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE login='$login'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        if(count($res)) {
            echo 'Nom d\'utilisateur déjà utilisé.';
        } else {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("INSERT INTO `utilisateurs`(`login`, `password`) VALUE ('$login','$password')");
                $req->execute();

                echo 'Utilisateur créer';
                header('refresh:2;url=./login.php');
            } else {
                echo 'Vos mots de passe doivent être identique.';
            }
        }
    }

    public function update($login, $password, $password2) {
        if(($login != $this->_login) && ($password != $this->_password)) {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `login`='$login', `password`='$password' WHERE id='$this->_id'");
                $req->execute();
                echo 'Vos informations ont été modifier.';
            }
        }
        if($login != $this->_login) {
            $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `login`='$login' WHERE id='$this->_id'");
            $req->execute();
            echo 'Votre nom d\'utilisateur à été modifier.';
        }
        if($password != $this->_password) {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `password`='$password' WHERE id='$this->_id'");
                $req->execute();
                echo 'Votre mot de passe à été modifier.';
            }
        }
    }
}
?>