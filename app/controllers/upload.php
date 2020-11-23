<?php

class upload extends Controller

{
    protected  $userModel;
    protected  $songsModel;
    public  function __construct()
    {
        $this->userModel=$this->model('User');
        $this->songsModel=$this->model('Song');
    }

    public function  index(){
        $songs = $this->songsModel::all()->toArray();
        $email = $_POST['email'];

        if($this->isAudio($_FILES)==true){
            $result=$this->upload($_POST,$_FILES);
            if($result==0) {
                $data = array(
                    "userData" => array(
                        "email" => $email,
                        "wrongEmail" => 0,
                        "passwordUpdate" => 0),
                    "file" => array(
                        "wrongType" => 1),
                    "songs" => $songs);
                return $this->view('home/userPage', $data);
            }else{
                $data = array(
                    "userData" => array(
                        "email" => $email,
                        "wrongEmail" => 0,
                        "passwordUpdate" => 0),
                    "file"=>array(
                        "wrongType"=>0,
                        "wrongUpload"=>0),
                    "songs" => $songs);
                return $this->view('home/userPage', $data);
            }
        }else{
            $data = array(
                "userData" => array(
                    "email" => $email,
                    "wrongEmail" => 0,
                    "passwordUpdate" => 0),
                "file"=>array(
                    "wrongType"=>1),
                "songs" => $songs);
            return $this->view('home/userPage', $data);
        };
    }

    public function upload(){

            $title = $_POST;
            $musicuploaddir = "C:\php\WebApp\RoutingWeb\public\song";
            $songPath = $musicuploaddir . basename($_FILES['name_file']['name']);
            //zapis na dysku pliku
            $path = str_replace("\\",'/',"https://".$_SERVER['HTTP_HOST'].substr(getcwd(),strlen($_SERVER['DOCUMENT_ROOT'])));

            $fullPath=$path."/".$_FILES['name_file']['name'];
            move_uploaded_file($_FILES['name_file']['tmp_name'], $songPath);
            $blob = fopen($songPath, 'rb');
            $songPathCode = base64_encode($songPath);
        try {$user = $this->songsModel::create([
            'name_file' => $_FILES['name_file']['name'],
            'name_song' => $_POST['name_song'],
            'isrc' => $_POST['isrc'],
            'writer' => $_POST['writer'],
            'author' => $_POST['author'],
            'who_add' => $_POST['who_add'],
            'time' => $_POST['time'],
            'blob' => $fullPath,

        ]);
           return 0;

        }catch (Exception $e){
            return 1;
        };
    }

    public function isAudio( $file=''){
        if(explode("/", $_FILES['name_file']['type'])[0] === "audio"){
         return true;
        }
        return false;
    }
}