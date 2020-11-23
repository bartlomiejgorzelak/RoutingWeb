<?php

class Login extends Controller
{
    protected  $userModel;
    protected  $songsModel;
       public  function __construct()
       {
           $this->userModel=$this->model('User');
           $this->songsModel=$this->model('Song');
       }
    public function  index(){

           if($_POST['method']=='Login'){
               $this->Login($_POST);
           }elseif ($_POST['method']=='Change password'){

               $this->changePassword($_POST);
           }

    }


    public function Login()
    {

        if (!empty($_POST['email']) || !empty($_POST['password'])) {
            $songs = $this->songsModel::all()->toArray();
            $email = $_POST['email'];
            $password = $_POST['password'];

            //Sprawdzanie poprawności wpisanego emaila
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data = array(
                    "userData" => array(
                        "email" => $email,
                        "wrongEmail" => 1),
                    "songs" => $songs);
                return $this->view('home/index', $data);
            }

            //Pobeirnaie hasła po email
            $data = $this->userModel::where(function ($query) use ($email) {
                $query->where('email', '=', $email);
            })->get()->toArray();
            //werfikacja hasła
            if (!empty($data['0']['password']) && password_verify($password, $data['0']['password'])) {
                if (!empty($data)) {
                    $data = array(
                        "userData" => array(
                            "email" => $email,
                            "wrongEmail" => 0),
                        "songs" => $songs);
                    return $this->view('home/userPage', $data);
                }
            } else {

                $data = array(
                    "userData" => array(
                        "email" => $email,
                        "wrongPassword" => 1),
                    "songs" => $songs);
                return $this->view('home/index', $data);
            }
        }
    }
    
    public function changePassword(){
        $songs = $this->songsModel::all()->toArray();
    ;
        if ( !empty($_POST['oldPassword'] && !empty($_POST['newPassword'] && !empty($_POST['email'])))) {
            $email=$_POST['email'];
            $oldPassword=$_POST['oldPassword'];
            $newPassword= password_hash($_POST['newPassword'],PASSWORD_DEFAULT);
            
            $data = $this->userModel::where(function ($query) use ($email) {
                $query->where('email', '=', $email);
            })->get()->toArray();
         
            //werfikacja hasła
            if (!empty($oldPassword) && password_verify($oldPassword, $data['0']['password'])) {

                $data = array(
                    "userData" => array(
                        "email" => $email,
                        "wrongEmail" => 0),
                    "songs" => $songs);

                //update hasla
                $data = [
                    'password' =>  $newPassword
                ];


                $passwordUpdate=$this->userModel::where('email',$email)->update(['password'=>$newPassword]);

                if ($passwordUpdate==true) {
                    $data = array(
                        "userData" => array(
                            "email" => $email,
                            "wrongEmail" => 0,
                            "passwordUpdate" => 1),
                        "songs" => $songs);
                    return $this->view('home/index', $data);
                }else{
                    $data = array(
                        "userData" => array(
                            "email" => $email,
                            "wrongEmail" => 0,
                            "passwordUpdate" => 0),
                        "songs" => $songs);
                    return $this->view('home/userPage', $data);
                }
            } else {
                $data = array(
                    "userData" => array(
                        "email" => $email,
                        "wrongPassword" => 1),
                    "songs" => $songs);
                return $this->view('home/index', $data);
            }
        }
    }
    
}