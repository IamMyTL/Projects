<?php

class VisitController extends Controller {
    public function index() {
        $visits = Visit::all();
        include("../views/visits/list.php");
    }

    public function one($id){
        $visits = Visit::find($id['id']);
        include("../views/visits/one.php");
    }

    public function destroy($data){
        $visit = Visit::find($data['idVisit']);
        if (!$visit){
            return false;
        }
        $visit->delete();
        return true;
    }

    public function create(){
        include("../views/visits/create.php");
    }

    public function addNewVisit($data){
        foreach($data as &$value){
            $value = htmlspecialchars(trim($value));
        }
        $visit = new Visit(false, $data['date'], $data['animal'], false);
        $status = $visit->addNewVisit() ? "true" : "false"; // Aficher true ou false en string sino 0 ou 1 en js
        echo($status);
    }
}


?>