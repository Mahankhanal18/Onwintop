<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "../conf/conf.php";
include "../conf/controllers.php";
include "../conf/email.php";
$db=new Database();
if($_POST['method']=='Comment'){
    $data=$db->RetriveSingle("SELECT * FROM `contents` WHERE `id`='".$_POST['content_id']."' ");
    $comments=json_decode($data['comments'],true);
    $comment=json_decode($_POST['data'],true);
    array_push($comments,$comment);
    if($db->Query("UPDATE `contents` SET `comments`='".json_encode($comments)."' WHERE `id`='".$_POST['content_id']."' ")){
        echo "Comment Posted";
    }else{
        echo "Error Occured";
    }
}
