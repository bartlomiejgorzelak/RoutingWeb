<?php


use Illuminate\Support\Facades\DB;


class  Home extends  Controller{

    public  function  index()
    {
        try {
            $mysqli = new mysqli("remotemysql.com:3306","z8zEdHoV56","RWiJmIE68g",z8zEdHoV56);
        }catch (Exception $e){
            die(var_dump($e));
        }

        $result = mysqli_query($mysqli,"SELECT * FROM Users");
        $result = mysqli_fetch_assoc($result);
  

        $this->model('Song');
        try {
            $songs =User::all();
        }catch (Exception $e){
            die(var_dump($e));
        }


        $data =array("songs"=>$songs);
        return $this->view('home/index', $data);
    }
    public  function getAll(){

        return $users=User::all();
    }


}