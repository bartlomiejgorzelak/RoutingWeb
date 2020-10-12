<?php

class  Home extends  Controller{

    public  function  index($name ='',$other='')
    {
        echo $name.' '.$other;
    }

}