<?php

class UserController extends Controller {
    public function index() {
        include("../views/main/login.php");
    }

    public function addNewOwner($data){
        // htmlspecialchars et trim
        foreach($data as &$value){
            $value = htmlspecialchars(trim($value));
        }
        if (isset($data['id'])){
            $owner_id = $data['id'];
        }else{
            $owner_id = false;
        }
        $owner = new Owner($owner_id, $data["name"], $data["firstname"], $data["birthdate"], $data["mail"], $data["phone"], $data["pass"], false);
        $owner->checkNewOwner($data["cpass"]);
    }

    public function ownerLogin($data){
        foreach($data as &$value){
            $value = htmlspecialchars(trim($value));
        }
        //$owner = new User($data["mail"], $data["pass"], "OwnerDAO");
        $owner = new Owner(false, false, false, false, $data['mail'], false, $data['pass'], false);
        // $owner->Login();
        $owner->login();
    }

    public function adminLogin($data){
        foreach($data as &$value){
            $value = htmlspecialchars(trim($value));
        }
        $admin = new Admin(false, $data['username'], $data['pass']);
        $admin->login();
    }
}


?>