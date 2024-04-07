<?php

    $url=$_ENV['project_url'];
    $root=$url;
    if(isset($community_id)){
        $GLOBALS['community_id']=$community_id;
    }else{
        $community_id='';
    }

    function URI($path){
        $url=$_ENV['project_url'];
        echo $url.$path;
    }
    function URI_Make($path){
        $url=$_ENV['project_url'];
        return $url.$path;
    }
    function URL($path){
        $url=$_ENV['project_url'];
        echo $url.$GLOBALS['community_id'].$path;
    }
    function URL_Make($path){
        $url=$_ENV['project_url'];
        return $url.$GLOBALS['community_id'].$path;
    }
    function URI_Main($path){
        $url=$_ENV['project_url'];
        echo $url.$path;
    }

    function UID($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }

?>