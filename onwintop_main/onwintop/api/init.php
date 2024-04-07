<?php
    session_start();
    date_default_timezone_set("Asia/Calcutta"); 
    require_once("../vendor/autoload.php");
    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();
    require_once("../conf/controllers.php");
    require_once("../conf/conf.php");
    require_once("../conf/redbean.php");
    require_once("../conf/cookie.php");
    require_once("../conf/db.php");
    require_once("../api/email.php");
    $db=new Database();
    $login=false;
    $credentials=array();
    R::setup('mysql:host='.$_ENV['db_host'].';dbname='.$_ENV['db_name'],$_ENV['db_user'], $_ENV['db_password'] );
   
?>