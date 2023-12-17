<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class OwnerController extends Controller {
    public function index() {
        $owners = Owner::all();
        include("../views/owners/list.php");
    }

    public function one($id){
        $owners = Owner::find($id['id']);
        include("../views/owners/one.php");
    }

    public function register(){
        include("../views/owners/register.php");
    }

    public function dashboard(){
        include("../views/owners/dashboard.php");
    }

    public function destroy($data)
    {
        $owner = Owner::find($data['idOwner']);
        if (!$owner){
            return false;
        }
        $owner->delete();
        return true;
    }

    public function showUpdate($data){
        $owner = Owner::find($data['id']);
        include("../views/owners/update.php");
    }
}


?>