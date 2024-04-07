<?php
session_start();
include "../conf/conf.php";
include "../conf/controllers.php";
require '../vendor/autoload.php';

$db = new Database();
if (isset($_POST['event_id'])) {
    if ($_POST['method'] == 'PUT_COMMENT') {
        //get comments
        $comments = array();
        $found = false;
        if ($db->CountRows("SELECT * FROM `event_chats` WHERE `event_id`='" . $_POST['event_id'] . "' ") != 0) {
            $found = true;
            $comments = $db->RetriveSingle("SELECT * FROM `event_chats` WHERE `event_id`='" . $_POST['event_id'] . "' ");
            $comments = json_decode($comments['chats'], true);
            
        }
        $obj = array(
            "name" => $_POST['name'],
            "user_id" => $_POST['user_id'],
            "date" => date('Y-m-d'),
            "time" => date('h:ia'),
            "message" => $_POST['message'],
            "thumbnail" => $_POST['thumbnail']
        );
        array_push($comments, $obj);
        if ($found) {
            if ($db->Query("UPDATE `event_chats` SET `chats`='" . json_encode($comments) . "' WHERE `event_id`='" . $_POST['event_id'] . "' ")) {
                echo "200";
            }
        } else {
            if ($db->Query("INSERT INTO `event_chats`(`event_id`, `chats`) VALUES ('" . $_POST['event_id'] . "','" . json_encode($comments) . "')")) {
                echo "200";
            }
        }
        $pusher = new Pusher\Pusher(
            "04e73173b63e9ab850b8",
            "be1357a175ce39e41322",
            "1462535",
            array(
                'cluster' => 'ap2' // Replace with 'cluster' from dashboard
            ),
        );
        if($pusher->trigger('test_channel', 'test_data', $obj)){
            echo "200";
        }
        
    }
    if ($_POST['method'] == 'GET_COMMENT') {
        //get comments
        $comments = array();
        if ($db->CountRows("SELECT * FROM `event_chats` WHERE `event_id`='" . $_POST['event_id'] . "' ") != 0) {
            $comments = $db->RetriveSingle("SELECT * FROM `event_chats` WHERE `event_id`='" . $_POST['event_id'] . "' ");
            echo $comments['chats'];
        }else{
            echo "[]";
        }
       
    }
}
