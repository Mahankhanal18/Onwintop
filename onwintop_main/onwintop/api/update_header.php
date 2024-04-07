<?php
    include "init.php";
    $db=new Database();
    if(isset($_POST['current_header']) && isset($_POST['community_id'])){
        $u="UPDATE `headers` SET `current_header`='".$_POST['current_header']."' WHERE `community_link`='".$_POST['community_id']."' ";
        if($db->Query($u)){
            echo "Settings Updated";
        }
    }
    if(isset($_POST['community_id']) && isset($_POST['form'])){
       //print_r($_POST);
        if($_POST['form']=='Header1'){
            $h1=array(
                "heading"=>$_POST['heading'],
                "subheading"=>$_POST['subheading'],
                "link1-label"=>$_POST['link1-label'],
                "link1-url"=>$_POST['link1-url'],
                "link2-label"=>$_POST['link2-label'],
                "link2-url"=>$_POST['link2-url'],
                "banner"=>$_POST['banner']
            );
            $u="UPDATE `headers` SET `header1`='".json_encode($h1)."' WHERE `community_link`='".$_POST['community_id']."' ";
            if($db->Query($u)){
                echo "Settings Updated";
            }
        }else{
            $h2=array(
                "heading"=>$_POST['heading'],
                "subheading"=>$_POST['subheading'],
                "link1-label"=>$_POST['link1-label'],
                "link1-url"=>$_POST['link1-url'],
                "link2-label"=>$_POST['link2-label'],
                "link2-url"=>$_POST['link2-url'],
                "video-url"=>$_POST['video-url'],
                "video-thumbnail"=>$_POST['video-thumbnail'],
                "banner"=>$_POST['banner']
            );
            $u="UPDATE `headers` SET `header2`='".json_encode($h2)."' WHERE `community_link`='".$_POST['community_id']."' ";
            if($db->Query($u)){
                echo "Settings Updated";
            }
        }
        
    }
?>