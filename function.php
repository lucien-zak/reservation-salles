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
           
           $this->_id = $_SESSION['id'];
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
        if(($login != $_SESSION['login']) && ($password != $_SESSION['password'])) {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `login`='$login', `password`='$password' WHERE id='".$_SESSION['id']."'");
                $req->execute();

                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;

                echo 'Vos informations ont été modifier.';
            } else {
                echo 'Vos mots de passes doivent être identique.';
            }
        } else if($login != $_SESSION['login']) {
            $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `login`='$login' WHERE id='".$_SESSION['id']."'");
            $req->execute();

            $_SESSION['login'] = $login;
            echo 'Votre nom d\'utilisateur à été modifier.';
        } else if($password != $_SESSION['password']) {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `password`='$password' WHERE id='".$_SESSION['id']."'");
                $req->execute();

                $_SESSION['password'] = $password;
                echo 'Votre mot de passe à été modifier.';
            } else {
                echo 'Vos mots de passes doivent être identique.';
            }
        }
    }

    /*

        GET LES INFOS À PARTIR D'UN ID

    */

    public function getAllInfosById($id) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE id='$id'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        $user = ['id' => $res[0]['id'], 'login' => $res[0]['login'], 'password' => $res[0]['password']];

        return $user;
    }

    public function getLoginById($id) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE id='$id'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        $login = $res[0]['login'];

        return $login;
    }

    public function getPasswordById($id) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE id='$id'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        $password = $res[0]['password'];

        return $password;
    }

    /*

        GET LES INFOS

    */

    public function getAllInfos() {
        $user = ['id' => $this->_id, 'login' => $this->_login, 'password' => $this->_password];

        return $user;
    }

    public function getLogin() {
        $login = $this->_login;

        return $login;
    }

    public function getPassword() {
        $password = $this->_password;

        return $password;
    }
}
?>