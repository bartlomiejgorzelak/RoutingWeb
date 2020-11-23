<?php

use Illuminate\Database\Eloquent\Model as Eloquent ;

class Song  extends  Eloquent {
    public  $name_file;
    public  $name_song;
    public  $isrc ;
    public  $writer ;
    public  $author ;
    public  $who_add ;
    public  $time ;
    public  $blob ;
    public $timestamps ;
    protected $fillable = ['name_file','name_song','isrc','writer','author','who_add','time','blob'];

}