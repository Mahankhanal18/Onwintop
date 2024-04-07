<?php
session_start();
include "conf/controllers.php";
include "conf/conf.php";
include "conf/redbean.php";
include "conf/cookie.php";
include "conf/db.php";
include "api/email.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Set Time Zone
date_default_timezone_set("Asia/Calcutta"); 

$db = new Database();
$login = false;
$credentials = array();
//SetSession("demo","demo");

//overriding previous rule
$_SESSION['community_id'] = $community_id;
//R::setup( 'mysql:host=localhost;dbname=demodomain_tellselling','demodomain_tellselling', '4_2&{lOt)TyA' );
R::setup('mysql:host=' . $_ENV['db_host'] . ';dbname=' . $_ENV['db_name'], $_ENV['db_user'], $_ENV['db_password']);
if (strlen($community_id) == 0) {
    //echo "<script>window.location('error/404');</script>";
}
//Retrive Community Data
$community = R::findOne("communities", "WHERE link=?", [$community_id]);
if (!empty($community)) {
    $title = $community['name'];
    if (strlen($title) == 0) {
        $title = $community['name'];
    }
}
if (isset($_SESSION['community_login']) && isset($_SESSION['credentials'])) {
    $login = true;
    $credentials = $_SESSION['credentials'];
}
function LoggedIn()
{
    if (getCookieData('community_login') == 'true') {
        return true;
    } else {
        return false;
    }
}

//get Content
function getContentDetails($data_id, $type)
{
    $data = array();
    if ($type == 'File') {
        $data = R::findOne("files", $data_id);
    }
    if ($type == 'Blog') {
        $data = R::findOne("blogs", $data_id);
    }
    if ($type == 'Solution') {
        $data = R::findOne("solutions", $data_id);
    }
    if ($type == 'Video') {
        $data = R::findOne("videos", $data_id);
    }
    return $data;
}
function URL_Parts()
{
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = explode("/", $actual_link);
    $parts = array_filter($parts);
    return $parts;
}
//tenant user login authentication
$user_login = false;
$member_login = false;
$user_role = '';
$user_credentials = array();

$auth_credentials = array();



if ($_SESSION['user_login'] == 'true' && $community_id == $_SESSION['curr_community_id']) {
    $user_login = true;
    $member_login = false;
    $user_credentials = json_decode($_SESSION['community_credentials'], true);
    $user_role = $user_credentials['role'];
    $auth_credentials = $user_credentials;
}


$member_role = '';
if ($_SESSION['community_login'] == 'true' && $community_id == $_SESSION['curr_community_id']) {
    $member_login = true;
    $user_login = false;
    $member_credentials = json_decode($_SESSION['community_credentials'], true);
    $member_role = $user_credentials['role'];
    $auth_credentials = $member_credentials;
}

function DateAgo($timestamp)
{
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes = round($seconds / 60); // value 60 is seconds  
    $hours = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
    $days = round($seconds / 86400); //86400 = 24 * 60 * 60;  
    $weeks = round($seconds / 604800); // 7*24*60*60;  
    $months = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
    $years = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60  
    if ($seconds <= 60) {
        return "Just Now";
    } else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hrs ago";
        }
    } else if ($days <= 7) {
        if ($days == 1) {
            return "1 day ago";
        } else {
            return "$days days ago";
        }
    } else if ($weeks <= 4.3) //4.3 == 52/12  
    {
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    } else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    } else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}