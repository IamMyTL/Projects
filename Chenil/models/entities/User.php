<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class User extends Entity {
    protected $pass;
    protected static $dao_name;
    private $loginBehavior;

    public function __construct ($pass, $dao_name, $loginBehavior) {
        $this->pass = $pass;
        $this->behavior = $loginBehavior;
        switch ($loginBehavior){
            case "owner":
                $this->loginBehavior = new LoginAsOwner();
                break;
            case "admin":
                $this->loginBehavior = new LoginAsAdmin();
                break;
        }
        parent::__construct($dao_name);
    }

    public function checkNewOwner($cpass){

        //check si le mail existe déjà
        $checkMailFormat = filter_var($this->mail, FILTER_VALIDATE_EMAIL);
        $checkMail = Owner::first("mail", $this->mail);
        if ($this->id == false){    // Si c'est un nouvel ajout
            if ($checkMail != false || $checkMailFormat == false){
                $_SESSION["errCreate"] = true;
                header("Location: ../main/login");
                exit();
            }
        }



        //check mdp entré
        if ($this->pass != $cpass           // Mdp = confirmation du mdp
            || !preg_match('@[A-Z]@', $this->pass) // Majuscule
            || !preg_match('@[a-z]@', $this->pass) // Minuscule
            || !preg_match('@[0-9]@', $this->pass) // Chiffre
            || !preg_match('@[^\w]@', $this->pass) // Symbole
            || strlen($this->pass) < 8){
            $_SESSION["errCreate"] = true;
        }else{
            $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);
            // Ajouter propriétaire
           
            $this->save();
            $_SESSION["registered"] = true;
        }
        header("Location: ../main/login");
    }
    public function login(){
        
        if ($this instanceof Admin) {
            $login = $this->username;
        }elseif($this instanceof Owner){
            $login = $this->mail;
        }
        
        $this->loginBehavior->login($login, $this->pass);
    }
}


?>