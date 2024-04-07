<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include "init.php";
    if(isset($_POST['challenge_id']) && isset($_POST['submit_data'])){
        $data=R::findOne("challenges","id=?",[$_POST['challenge_id']]);
        $data->challenge_submit=$_POST['submit_data'];
        if(R::store($data)){
            echo "Challange Submitted!";
        }
    }
?>