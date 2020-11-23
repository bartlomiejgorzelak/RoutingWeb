<?php

class  Controller{

    public function model($model){
       require_once '../app/models/' . $model . '.php';
       return new $model();


    }    public function view($view, $data = []){

       require_once '../app/views/' . $view . '.html';
    }

    public function render($filename, array $arguments = array())
    {
        echo $this->getHTML($filename, $arguments);
    }
}