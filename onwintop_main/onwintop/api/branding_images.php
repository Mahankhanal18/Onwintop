<?php    
    include "init.php";
    $db=new Database();
    if(isset($_POST['community_id'])){
        $branding=R::findOne("branding","WHERE community_id=?",[$_POST['community_id']]);
        $colors=json_decode($branding['colors'],true);
        $colors[$_POST['method']]=$_POST['value'];
        $c=json_encode($colors);
        $branding->colors=$c;
        if(R::store($branding)){
            echo "Image successfully updated";
        }else{
            echo "Error occured in setting the image";
        }
    }
?>