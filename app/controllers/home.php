<?php


use Illuminate\Support\Facades\DB;


class  Home extends  Controller{

    public  function  index()
    {
        $this->model('Song');
        $songs =Song::all()->toArray();
        $data =array("songs"=>$songs);
        return $this->view('home/index', $data);
    }
    public  function getAll(){

        return $users=User::all();
    }


}