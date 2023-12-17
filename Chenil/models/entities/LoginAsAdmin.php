<?php

class LoginAsAdmin implements LoginBehavior{
    public function login($login, $pass){
        $adminData = Admin::where("username", $login);
        if (!$adminData || !password_verify($pass, $adminData[0]->pass)){
            $_SESSION["errLogin"] = true;
            header("Location: ../main/login");
        }else{
            $_SESSION["adminIsLogged"] = $adminData[0]->id;
            header("Location: ../main");
        }
    }
}
?>