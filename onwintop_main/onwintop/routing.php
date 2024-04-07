<?php
/*
session_start();
*/
/*
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/
    

    $have_paths=false;
    //set default index to home
    $tmp = explode("/", get_url());
    $parts=count(explode("/", get_url()));
    //print_r($parts);
    if ( $parts>=1 && $parts<= 2 && strlen($tmp[0])!=0 && strlen($tmp[1])==0) {
        $_SESSION['community_id']=community_id();
        //echo $_SESSION['community_id'];
        include "index.php";
        $have_paths=true;
    }
    if(!check_valid()){
        include "404.php";
    }
    //check if community id is provided or not
    function check_valid(){
        $tmp = explode("/", get_url());
        $parts=count(explode("/", get_url()));
        if ( $parts>= 1 && strlen($tmp[0])!=0) {
            return true;
        }else{
            return false;
        } 
    }
    //get community id
    function community_id(){
        $tmp = explode("/", get_url());
        return $tmp[0];
    }

    function get_url(){
        $complete_url = $_SERVER['REQUEST_URI'];
        $routes = explode("/", $complete_url);
        $routes = array_splice($routes, 3, 2);
        return implode("/", $routes);
    }

    function index($url, $forward){
        if (community_id()."/".$url == get_url() || community_id()."/".$url == get_url()."/") {
            $_SESSION['community_id']=community_id();
            include $forward;
            $have_paths=true;
        }
    }
    function path($url, $forward){
        $complete_url = $_SERVER['REQUEST_URI'];
        $routes = explode("/", $complete_url);
        $routes = array_splice($routes, 3, 4);
        $path=$routes[1];
        if (community_id()."/".$url == get_url()) {
            $_SESSION['community_id']=community_id();
            $_SESSION['path']=$path;
            include $forward;
            $have_paths=true;
        }
    }





