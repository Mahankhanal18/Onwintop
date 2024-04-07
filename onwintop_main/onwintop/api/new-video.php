<?php
include "init.php";
if(isset($_POST['collectables']) && isset($_POST['url']) && isset($_POST['thumbnail'])){
    $project=R::findOne("videoprojects","link=?",[$_POST['project_id']]);
    
    $collect=json_decode($_POST['collectables'],true);
    $uploader='';
    foreach($collect as $c){
        if($c['label']=='name'){
            $uploader=$c['value'];
        }
    }

    $data=R::dispense("videos");
    $data->project=$project['name'];
    $data->project_id=$project['link'];
    $data->thumbnail=$_POST['thumbnail'];
    $data->community_id=$_POST['community_id'];
    $data->url=$_POST['url'];
    $data->video_layer=$_POST['layer_url'];
    $data->uploader=$uploader;
    $data->uploader_data=$_POST['collectables'];
    $data->date=date('Y-m-d h:ia');
    if(R::store($data)){
        $obj=array(
            "status"=>"Successful"
        );
        echo json_encode($obj);
    }
}

?>