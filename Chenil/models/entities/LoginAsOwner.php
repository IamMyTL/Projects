<?php

class LoginAsOwner implements LoginBehavior{
    public function login($login, $pass){
        $ownerData = Owner::where("mail", $login);
        if (!$ownerData || !password_verify($pass, $ownerData[0]->pass)){
            $_SESSION["errLogin"] = true;
            header("Location: ../main/login");
        }else{
            $_SESSION["ownerIsLogged"] = $ownerData[0]->id;
            header("Location: ../owner/dashboard");
        }
    }
}
?>