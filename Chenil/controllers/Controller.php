<?php

abstract class Controller {
    public function index () {
        var_dump('action index not defined');
    }
    
    public function show ($id) {
       var_dump('action show not defined');
    }
    
    public function create () {
        var_dump('action create not defined');
    }
    
    public function store ($data) {
        var_dump('action store not defined');
    }
    
    public function destroy ($id) {
        var_dump('action destroy not defined');
    }
    
    public function edit ($id) {
        var_dump('action edit not defined');
    }
    
    public function update ($id, $data) {
        var_dump('action update not defined');
    }
}