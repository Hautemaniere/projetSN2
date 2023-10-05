<?php
class User
{
    private $id_;
    private $logname_;
    private $logemail_;
    private $logpass_;

    public function __construct()
    {
        // Vous pouvez laisser le constructeur vide ou ajouter des paramètres selon vos besoins.
    }

    public function seConnecter($logemail, $logpass)
    {
        $requete = "SELECT * FROM `user` 
        WHERE
        `logemail` = '" . $logemail . "'
        AND
        `logpass` = '" . $logpass . "' ;";

        $result = $GLOBALS["pdo"]->query($requete);
        if ($result->rowCount() > 0) {
            $tab = $result->fetch();
            $_SESSION['Connexion'] = true;
            $_SESSION['id'] = $tab['id'];

            $this->id_ = $tab['id'];
            $this->logname_ = $tab['logname'];
            $this->logemail_ = $tab['logemail'];

            return true;
        } else {
            return false;
        }
    }

    public function CreateNewUser($logemail, $logpass, $logname)
    {
        $requete = "SELECT * FROM user 
        WHERE
        `logemail` = '" . $logemail . "';";
        $result = $GLOBALS["pdo"]->query($requete);
        if ($result->rowCount() > 0) {
            $tab = $result->fetch();
            $this->id_ = $tab['id'];
            $this->logname_ = $tab['logname'];
            $this->logemail_ = $tab['logemail'];
        } else {
            $requete = "INSERT INTO `user`(`logname`, `logemail`, `logpass`) 
            VALUES('$logname', '$logemail','$logpass');";
            $result = $GLOBALS["pdo"]->query($requete);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            $this->logname_ = $logname;
            $this->logemail_ = $logemail;
            $this->seConnecter($logemail, $logpass);
        }
    }

    public function isConnect()
    {
        if (isset($_SESSION['id'])) {
            $sql = "SELECT * FROM `user` 
            WHERE `id` = '" . $_SESSION['id'] . "'";
            $resultat = $GLOBALS["pdo"]->query($sql);
            if ($tab = $resultat->fetch()) {
                $this->logemail_ = $tab['logemail'];
                $this->id_ = $tab['id'];
                return true;
            }
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id_;
    }

    public function verifyPassword($enteredPassword)
    {
        // Comparez le mot de passe entré avec le mot de passe stocké en clair.
        return $enteredPassword === $this->logpass_;
    }

    public function setPassword($newPassword)
    {
        // Mettez à jour le mot de passe dans la base de données en clair.
        $this->updatePasswordInDatabase($newPassword);

        // Mettez à jour la propriété $logpass_ de l'objet User avec le nouveau mot de passe en clair.
        $this->logpass_ = $newPassword;
    }

   
}
?>