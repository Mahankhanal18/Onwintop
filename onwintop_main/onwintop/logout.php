<?php
//session_start();
include "conf/conf.php";
include "conf/cookie.php";
//session_start();
//

    $_SESSION["user_login"]='false';
    $_SESSION["community_login"]= 'false';
    $_SESSION["role"]='';
    $_SESSION["community_credentials"]= '[]';
    
$url = URL_Make('/');
//session_destroy();
echo "<script>setTimeout(function(){ window.location='".$url."'; }, 100);</script>";

