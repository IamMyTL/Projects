<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class AnimalController extends Controller {
    public function index() {
        $animals = Animal::all();
        include("../views/animals/list.php");
    }

    public function one($id){
        $animals = Animal::find($id['id']);
        include("../views/animals/one.php");
    }

    public function destroy($data){
        $animal = Animal::find($data['idAnimal']);
        if (!$animal){
            return false;
        }
        $animal->delete();
        return true;
    }

    public function create(){
        include("../views/animals/create.php");
    }

    public function addNewAnimal($data){
        foreach($data as &$value){
            $value = htmlspecialchars(trim($value));
        }
        if (isset($data['id'])){
            $animal_id = $data['id'];   // Créer un objet avec id pour l'update
        }else{
            $animal_id = false;         // Sinon false à la place de l'id dans l'objet
        }
        $animal = new Animal($animal_id, $data["name"], $data["gender"], $data["birthdate"], $data["sterilized"], $data["chip_id"], $data["owner"], false);
        
        $status = $animal->addNewAnimal() ? "true" : "false";
        echo($status);
    }

    public function edit($data){
        $animal = Animal::find($data['id']);
        include("../views/animals/create.php");
    }
}


?>