<?php    
    include "init.php";
    $db=new Database();
    if(isset($_POST['community_id'])){
        $brand=R::findOne("branding","WHERE community_id=?",[$_POST['community_id']]);
        $colors=json_decode($brand['colors'],true);

            $colors["post_background"]=$_POST['post_background'];
            $colors["post_text"]=$_POST['post_text'];
            $colors["background_color"]=$_POST['background'];
            $colors["header_text_color"]=$_POST['header_text_color'];
            $colors["body_text_color"]=$_POST['body_text_color'];
            $colors["topnav_text"]=$_POST['topnav_text'];
        
        $s="UPDATE `branding` SET `colors`='".json_encode($colors)."' WHERE `community_id`='".$_POST['community_id']."' ";
        if($db->Query($s)){
            echo "Successfully Saved";
        }else{
            echo "Error";
        }
    }
?>