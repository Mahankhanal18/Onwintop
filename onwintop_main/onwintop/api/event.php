<?php
    include "init.php";
    //print_r($_POST);
    if($_POST['method']=='DELETE'){
        $data=R::findOne("events","WHERE id=?",[$_POST['id']]);
        if(R::trash($data)){
            echo "Event Successfully Removed";
        }else{
            echo "Error";
        }
        //print_r($data);
    }

