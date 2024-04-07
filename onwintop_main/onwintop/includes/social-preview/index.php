<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if(isset($data)){
    $data=base64_decode($data);
    $data=json_decode($data,true);
    if($data['type']=='Facebook'){ ?>
        
        <img src='https://visualime.com/wp-content/uploads/2020/09/cropped_elephant_image_twitter_after-1024x829.png' style='width:100%'/>
        
        
        
        
    <?php }
}else{
    echo "<center><b>Preview</b></center>";
}
?>