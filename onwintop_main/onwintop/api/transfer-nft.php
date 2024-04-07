<?php
    include "init.php";
    if(isset($_POST['email']) && isset($_POST['id']) ){
        $nft=R::findOne("nftcontents","id=?",[$_POST['id']]);
        $nft->email=$_POST['email'];
        $nft->status='Active';
        if(R::store($nft)){
            echo "NFT Successfully Transfered";
        }else{
            echo "Error Occured";
        }
    }
?>