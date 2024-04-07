<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include "init.php";
    if($_POST['method']=='create'){
        $data=R::dispense("nftcontents");
        $data->email=$_POST['email'];
        $data->name=$_POST['name'];
        $nft=array(
            "name"=>$_POST['name'],
            "description"=>$_POST['description'],
            "image"=>"https://ipfs.moralis.io:2053/ipfs/".md5($_POST['image']),
        );
        $data->data=json_encode($nft);
        $data->url=$_POST['image'];
        $data->preview=$_POST['preview'];
        if(R::store($data)){
            echo json_encode($nft);
        }
    }  
    if($_POST['method']=='load'){
        $data=R::findAll("nftcontents","email=?",[$_POST['email']]);
        $res=array();
        foreach($data as $nft){
            $temp=array(
                "name"=>$nft['name'],
                "email"=>$nft['email'],   
                "description"=>$nft['description'], 
                "url"=>$nft['url'],
                "preview"=>$nft['preview'],
            );
            array_push($res,$temp);
        }
        echo json_encode($res);
    }
?>