<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function MakeThumbnail($url)
{
    $urls=explode("/",$url);
    $url=$urls[count($urls)-1];
    $parts=explode(".",$url);
    $url=$parts[0];
    $url="https://res.cloudinary.com/tellselling/video/upload/".$url.".jpg";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    $raw = curl_exec($ch);
    curl_close($ch);
    $name=time().".jpg";
    $saveto = "../images/thumbnails/".$name;
    if (file_exists($saveto)) {
        unlink($saveto);
    }
    $fp = fopen($saveto, 'x');
    fwrite($fp, $raw);
    fclose($fp);
    return "images/thumbnails/".$name;
}
if(isset($_POST['url'])){
    $res=MakeThumbnail($_POST['url']);
    $obj=array(
        "status"=>"Successful",
        "url"=>$res
    );
    echo json_encode($obj);
}

?>