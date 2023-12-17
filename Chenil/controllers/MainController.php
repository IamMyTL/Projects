<?php

class MainController extends Controller {
    public function index() {
        include("../views/main/main.php");
    }

    public function login() {
        include("../views/main/login.php");
    }
}


?>