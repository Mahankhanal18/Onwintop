<?php
include "init.php";
if(isset($_POST['community_id'])){
    $branding=R::findOne("branding","WHERE community_id=?",[$_POST['community_id']]);
    $assets=json_decode($branding['colors'],true);
    $assets['body_font_color']=$_POST['body_font_color'];
    $assets['font_size']=$_POST['size'];
    $assets['font_family']=$_POST['font'];
   $asset=json_encode($assets);
   $branding->colors=$asset;
   if(R::store($branding)){
       echo "Successfully Saved";
   }
}
?>