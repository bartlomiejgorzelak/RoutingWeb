<?php


use Illuminate\Support\Facades\DB;

class  Home extends  Controller{

    public  function  index()
    {
        $dfd = $this->getAll();
        $results = DB::select('select * from users where id = ?', array(1));
        die(var_dump($results));
        foreach ($users as $user){
            $users[] = null ;
            $users[]= $users['name'];
        }

       $this->view('home/index', ['name' => $user->name]);
    }

    public  function  create ($name ='',$email = ''){

        User::create([
            'name'=>$name,
            'email'=>$email,
        ]);
    }

    public  function getAll(){

        return $users=User::all();
    }

}