<?php
    include "init.php";
    //print_r($_POST);
    if(isset($_POST['community_id'])){
        $navs=R::findOne("communities","WHERE link=?",[$_POST['community_id']]);
        //$nav=$navs['title'];
        $data=array();
        if(strlen($navs['title'])!=0){
            $data=json_decode($navs['title'],true);
        }
        $name=$_POST['name'];
        if($name=='blogs'){
            $data['blogs']=$_POST['value'];
        }
        if($name=='salesrooms'){
            $data['salesrooms']=$_POST['value'];
        }
        if($name=='discussion'){
            $data['discussion']=$_POST['value'];
        }
        if($name=='channels'){
            $data['channels']=$_POST['value'];
        }
        if($name=='events'){
            $data['events']=$_POST['value'];
        }
        
       // $data[$name]=$_POST['value'];
        $data=json_encode($data);
        $navs->title=$data;
        if(R::store($navs)){
            echo $_POST['name'] ." access updated!";
        }else{
            echo "Error";
        }
    }
?>