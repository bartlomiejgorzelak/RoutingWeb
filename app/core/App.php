<?php

class App{

    protected $contoller = 'home';

    protected  $method = 'index';

    protected $params= [];

    public function  __construct()
    {
        $url= $this->parseUrl();

        if (file_exists('../app/controllers/' . $url[0] . '.php')){

            $this->contoller = $url[0];
            unset($url[0]);
        }
        require_once '../app/controllers/' .$this->contoller . '.php';

        $this->contoller = new $this->contoller;
        if (isset($url[1]) && method_exists($this->contoller, $url[1])) {

            $this->method = $url[1];
            unset($url[1]);

        }

        $this->params = $url ? array_values($url) : [] ;

        call_user_func_array([$this->contoller,$this->method],$this->params);

    }

    public  function  parseUrl(){

        if(isset($_SERVER['REQUEST_URI'])){

            $url= str_replace("/public/", "",$_SERVER['REQUEST_URI']);

            $url = explode('/', filter_var(rtrim( $url,'/'),FILTER_SANITIZE_URL));


            //$this->action = isset($url[1]) ? $url[1].'Action' : 'indexAction';


            return $url;
//            return explode('/', trim($_SERVER['REQUEST_URI'],'/'));
        }
    }
}