<?php

class Router {

    private $get;
    private $post;
    private $controllers;
    private $data;
    private $request;
    private $actions;

    public function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        
        //liste des actions possibles
        $this->actions = [
            'create',
            'edit',
            'destroy',
            // 'show',
            // 'update',
            // 'store',
            'index',
            'one',
            'register',
            'login',
            'logging',
            'addNewOwner',
            'addNewAnimal',
            'addNewVisit',
            'ownerLogin',
            'dashboard',
            'showUpdate',
            'updateOwner',
            'adminLogin'
        ];
        
        //liste des controllers existants
        $this->controllers = [
            'owner' => 'OwnerController',
            'animal' => 'AnimalController',
            'visit' => 'VisitController',
            'user' => 'UserController',
            'index' => 'MainController'
        ];
        
        $this->request = array();
        $this->data = $this->parseURI($_SERVER['REQUEST_URI']);
        $this->dispatch();
        $this->run();
    }

    private function parseURI ($server_uri) {
        // si il y a un ? dans $server_uri, alors enlever tout ce qu'il y a apres
        if (strpos( $server_uri, "?")) {
            $server_uri = strstr($server_uri, '?', true);
        }

        $server_uri = explode("/", substr($server_uri, 1));
        return $server_uri;
    }

    private function dispatch () {
        //verifier si on a 1 controller, 1 action et 1 id
        if (!array_key_exists($this->data[0], $this->controllers)) {
            $this->data[0] = 'index';
        }
        if (!isset($this->controllers[$this->data[0]])) {
            echo "ERR : CONTROLLER NOT FOUND";
        } else {
            $this->request['controller'] = $this->controllers[$this->data[0]];
        }
        

        //detecter l'action => voir si on en a trouvé une, ou pas, si celle qu'on a trouvé est autorisée
        if (count($this->data) >= 2 && $this->data[1]) {
            if(!in_array($this->data[1], $this->actions)) {
                echo "ERR : ACTION NOT FOUND";
                // var_dump($this->data[1]);
                // var_dump($this->actions);
                die;
            }

            $this->request['action'] = $this->data[1];
        } else {
            //l'action par défaut est l'index
            $this->request['action'] = "index";
        }

        //detection de l'id
        if (count($this->data) >= 3 && $this->data[2]) {
            $this->request['id'] = $this->data[2];
        } else {
            $this->request['id'] = false;
        }

        //detection get/post
        if ($this->post && count($this->post)) {
            $this->request['method'] = 'post';
        } else {
            $this->request['method'] = 'get';
        }

    }
    
    //code qui va instancier le controller et appeller l'action correspondante
    private function run () {
        //instancier 1 controller
        $this->controller_instance = new $this->request['controller'];

        $data = $this->get;
        if($this->request['method'] == 'post')  {
            $data = $this->post;
        }

        //appeller la méthode du controller
        if ($this->request['id'] == false){
           //si on avait pas détecter d'id, alors on lui passe les $data en parametre
          $this->controller_instance->{$this->request['action']}($data);
        } else{
            //si on a détecté une ID alors on lui passe l'ID en parametre
          $this->controller_instance->{$this->request['action']}($this->request['id']);
        }

    }
}
