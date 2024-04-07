<?php
include "init.php";
if(isset($_POST['video_id']) && isset($_POST['project_id']) && isset($_POST['community_id'])){
    //check if empty or exists
    $count=R::count("featuredvideo");
    if($count!=0){
        $data=R::findOne("featuredvideo","LIMIT 1");
    }else{
        $data=R::dispense("featuredvideo");
    }
    $data->community_id=$_POST['community_id'];
    $data->video_id=$_POST['video_id'];
    $data->project_id=$_POST['project_id'];
    if(R::store($data)){
        echo "Successful";
    }else{
        echo "Error";
    }
}
?>