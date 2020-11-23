<?php

class Contact extends Controller

{

    public function  index(){
        echo 'cocat index';
    }

    public function phone(){

        if ( isset( $_POST['submit'] ) ) {
            die(var_dump('dfd'));
        }
        echo 'contact by me';
    }
}