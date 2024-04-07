<?php
    include "init.php";
    $db=new Database();
    if($_POST['community_id']){
        $s="INSERT INTO `custom_domains`(`community_id`, `link`) VALUES ('".$_POST['community_id']."','".$_POST['link']."')";
        //echo $s;
        if($db->Query($s)){
            $msg="<p>New Subdomain entered <a href='https://easycrack.in/ub'>Check</a></p>";
            //SendMail("New Subdomain Action Required", "badhanbarman@gmail.com", "Tellselling - Developer", $msg);
            echo "Domain Saved";
        }else{
            echo "Error Occured";
        }
    }
?>