<?php
include "init.php";
$gifts=R::findOne('giftproducts','id=1');
$gift=json_decode($gifts['products'],true);
$products=array();
foreach($gift as $g){
    if(isset($_GET['brand'])){
        if(str_contains(strtoupper($g['name']),strtoupper($_GET['brand']))){
            array_push($products,$g);
        }
    }else{
        array_push($products,$g);
    }
}
echo json_encode($products);
?>