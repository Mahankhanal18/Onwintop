<?php
    include "init.php";
    if($_POST['method']=='CHECK'){
        $user=R::findOne("users","WHERE email=?",[$_POST['email']]);
        if(empty($user)){
            echo "200";
        }else{
            echo "User with this email is already associated with another account";
        }
    }
?>