<?php
    include "init.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if(isset($_POST['email']) && isset($_POST['address'])){
        $member=R::findOne("members",'email=?',[$_POST['email']]);
        if(!empty($member)){
            $member->wallet_address=$_POST['address'];
            if(R::store($member)){
                echo "True";
            }else{
                echo "Error";
            }
        }else{
            echo "Not Found with ".$_POST['email'];
        }
    }else{
        echo "User Not Found";
    }
?>