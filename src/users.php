<?php
require('../config.php');

class user {
    private $_id;
    private $_login;
    private $_password;
    private $_Malert;
    private $_Talert;

    public function alerts()
    {
        if ($this->_Talert == 1) {
            echo "<div class='succes'>" . $this->_Malert . "</div>";
        } else {
            echo "<div class='error'>" . $this->_Malert . "</div>";
        }
    }

    public function login($login, $password) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE login='$login' AND password='$password'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        if(count($res)) {
           $_SESSION['id'] = $res[0]['id'];
           $_SESSION['login'] = $login;
           $_SESSION['password'] = $password;
           
           $this->_id = $_SESSION['id'];
           $this->_login = $login;
           $this->_password = $password;

           $this->_Malert = 'Connexion réussi, vous allez être redirigé.';
           $this->_Talert = 1;

           header('refresh:3;url=../users/profil.php');
        } else {
            $this->_Malert = 'Aucun utilisateur trouvé.';
            $this->_Talert = 2;

        }
    }

    public function register($login, $password, $password2) {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE login='$login'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        if(count($res)) {
            $this->_Malert = 'Nom d\'utilisateur déjà utilisé.';
            $this->_Talert = 2;
        } else {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("INSERT INTO `utilisateurs`(`login`, `password`) VALUE ('$login','$password')");
                $req->execute();

                $this->_Malert = 'Félicitation votre compté à été créer avec succès, vous être redirigé.';
                $this->_Talert = 1;
                header('refresh:2;url=./login.php');
            } else {
                $this->_Malert = 'Vos mots de passe doivent être identiques.';
                $this->_Talert = 2;
            }
        }
    }

    public function update($login, $password, $password2) {
        $reqLogin = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE login='$login'");
        $resLogin = $reqLogin->fetchAll(PDO::FETCH_ASSOC);

        if(($login != $_SESSION['login']) && ($password != $_SESSION['password'])) {
            if(!count($resLogin)) {
                if($password == $password2) {
                    $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `login`='$login', `password`='$password' WHERE id='".$_SESSION['id']."'");
                    $req->execute();
    
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
    
                    $this->_Malert = 'Félicitation, vos informations ont été changer.';
                    $this->_Talert = 1;
                } else {
                    $this->_Malert = 'Vos mots de passe doivent être identiques.';
                    $this->_Talert = 2;
                }
            }
        } else if($login != $_SESSION['login']) {
            if(!count($resLogin)) {
                $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `login`='$login' WHERE id='".$_SESSION['id']."'");
                $req->execute();

                $_SESSION['login'] = $login;

                $this->_Malert = 'Félicitation, votre nom d\'utilisateur à été modifier.';
                $this->_Talert = 1;
            } else {
                $this->_Malert = 'Le nom d\'utilisateur que vous aviez choisi est déjà utiliser.';
                $this->_Talert = 2;
            }
        } else if($password != $_SESSION['password']) {
            if($password == $password2) {
                $req = $GLOBALS['bdd']->prepare("UPDATE `utilisateurs` SET `password`='$password' WHERE id='".$_SESSION['id']."'");
                $req->execute();

                $_SESSION['password'] = $password;
                $this->_Malert = 'Félicitation, votre mot de passe à été modifier.';
                $this->_Talert = 1;
            } else {
                $this->_Malert = 'Vos mots de passe doivent être identiques.';
                $this->_Talert = 2;
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