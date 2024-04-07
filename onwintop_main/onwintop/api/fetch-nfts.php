<?php
    include "init.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if(isset($_GET['email'])){
        $nfts=R::findAll("nftcontents","email=? AND status=?",[$_GET['email'],'Active']);
        $res=array();
        foreach($nfts as $nft){
            $info=json_decode($nft['data'],true);
            $obj=array(
                "name"=>$nft['name'],
                "email"=>$nft['email'],
                "preview"=>$nft['preview'],   
                "url"=>$nft['url'],    
                "description"=>$info['description']
            );
            array_push($res,$obj);
        }
        echo json_encode($res);
    }else{
        echo "User Not Found";
    }
?>