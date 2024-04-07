<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 *  Get Files Info
 */
include "init.php";
$db = new Database();
if (isset($_POST['method'])) {
    $method = $_POST['method'];

    //Files Module
    if ($method == 'SAVE_FILE_CATEGORY') {
        $c = "SELECT * FROM `files_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        $count = $db->CountRows($c);
        if ($count == 0) {
            $s = "INSERT INTO `files_filters`(`name`, `community_id`) VALUES ('" . $_POST['name'] . "','" . $_POST['community_id'] . "')";
        } else {
            $exits = $db->RetriveSingle($c);
            $s = "UPDATE `files_filters` SET `name`='" . $_POST['name'] . "' WHERE `community_id`='" . $_POST['community_id'] . "' AND `name`='" . $exits['name'] . "' ";
        }
        if ($db->Query($s)) {
            echo "Category Saved";
        } else {
            echo "Error";
        }
    }
    if ($method == 'GET_FILE_CATEGORY') {
        $c = "SELECT * FROM `files_filters` WHERE `community_id`='" . $_POST['community_id'] . "' ";
        $data = $db->RetriveArray($c);
        echo json_encode($data);
    }
    if ($method == 'REMOVE_FILE_CATEGORY') {
        $c = "DELETE FROM `files_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        if ($db->Query($c)) {
            echo "Category Removed";
        } else {
            echo "Error Occured";
        }
    }

    //Videos Module
    if ($method == 'SAVE_VIDEO_CATEGORY') {
        $c = "SELECT * FROM `videos_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        $count = $db->CountRows($c);
        if ($count == 0) {
            $s = "INSERT INTO `videos_filters`(`name`, `community_id`) VALUES ('" . $_POST['name'] . "','" . $_POST['community_id'] . "')";
        } else {
            $exits = $db->RetriveSingle($c);
            $s = "UPDATE `videos_filters` SET `name`='" . $_POST['name'] . "' WHERE `community_id`='" . $_POST['community_id'] . "' AND `name`='" . $exits['name'] . "' ";
        }
        if ($db->Query($s)) {
            echo "Category Saved";
        } else {
            echo "Error Occured";
        }
    }
    if ($method == 'GET_VIDEO_CATEGORY') {
        $c = "SELECT * FROM `videos_filters` WHERE `community_id`='" . $_POST['community_id'] . "' ";
        $data = $db->RetriveArray($c);
        echo json_encode($data);
    }
    if ($method == 'REMOVE_VIDEO_CATEGORY') {
        $c = "DELETE FROM `videos_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        if ($db->Query($c)) {
            echo "Category Removed";
        } else {
            echo "Error Occured";
        }
    }
    //Blog Module
    if ($method == 'SAVE_BLOG_CATEGORY') {
        $c = "SELECT * FROM `blogs_categories` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        $count = $db->CountRows($c);
        if ($count == 0) {
            $s = "INSERT INTO `blogs_categories`(`name`, `community_id`) VALUES ('" . $_POST['name'] . "','" . $_POST['community_id'] . "')";
        } else {
            $exits = $db->RetriveSingle($c);
            $s = "UPDATE `blogs_categories` SET `name`='" . $_POST['name'] . "' WHERE `community_id`='" . $_POST['community_id'] . "' AND `name`='" . $exits['name'] . "' ";
        }
        if ($db->Query($s)) {
            echo "Category Saved";
        } else {
            echo "Error";
        }
    }
    if ($method == 'GET_BLOG_CATEGORY') {
        $c = "SELECT * FROM `blogs_categories` WHERE `community_id`='" . $_POST['community_id'] . "' ";
        $data = $db->RetriveArray($c);
        echo json_encode($data);
    }
    if ($method == 'REMOVE_BLOG_CATEGORY') {
        $c = "DELETE FROM `blogs_categories` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        if ($db->Query($c)) {
            echo "Category Removed";
        } else {
            echo "Error Occured";
        }
    }
    //Support Module
    if ($method == 'SAVE_SUPPORT_CATEGORY') {
        $c = "SELECT * FROM `supports_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        $count = $db->CountRows($c);
        if ($count == 0) {
            $s = "INSERT INTO `supports_filters`(`name`, `community_id`) VALUES ('" . $_POST['name'] . "','" . $_POST['community_id'] . "')";
        } else {
            $exits = $db->RetriveSingle($c);
            $s = "UPDATE `supports_filters` SET `name`='" . $_POST['name'] . "' WHERE `community_id`='" . $_POST['community_id'] . "' AND `name`='" . $exits['name'] . "' ";
        }
        if ($db->Query($s)) {
            echo "Category Saved";
        } else {
            echo "Error";
        }
    }
    if ($method == 'GET_SUPPORT_CATEGORY') {
        $c = "SELECT * FROM `supports_filters` WHERE `community_id`='" . $_POST['community_id'] . "' ";
        $data = $db->RetriveArray($c);
        echo json_encode($data);
    }
    if ($method == 'REMOVE_SUPPORT_CATEGORY') {
        $c = "DELETE FROM `supports_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
        if ($db->Query($c)) {
            echo "Category Removed";
        } else {
            echo "Error Occured";
        }
    }

        //Event Module
        if ($method == 'SAVE_EVENT_CATEGORY') {
            $c = "SELECT * FROM `event_categories` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
            $count = $db->CountRows($c);
            if ($count == 0) {
                $s = "INSERT INTO `event_categories`(`name`, `community_id`) VALUES ('" . $_POST['name'] . "','" . $_POST['community_id'] . "')";
            } else {
                $exits = $db->RetriveSingle($c);
                $s = "UPDATE `event_categories` SET `name`='" . $_POST['name'] . "' WHERE `community_id`='" . $_POST['community_id'] . "' AND `name`='" . $exits['name'] . "' ";
            }
            if ($db->Query($s)) {
                echo "Category Saved";
            } else {
                echo "Error";
            }
        }
        if ($method == 'GET_EVENT_CATEGORY') {
            $c = "SELECT * FROM `event_categories` WHERE `community_id`='" . $_POST['community_id'] . "' ";
            $data = $db->RetriveArray($c);
            echo json_encode($data);
        }
        if ($method == 'REMOVE_EVENT_CATEGORY') {
            $c = "DELETE FROM `event_categories` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
            if ($db->Query($c)) {
                echo "Category Removed";
            } else {
                echo "Error Occured";
            }
        }

        //Discussion Module
        if ($method == 'SAVE_DISCUSSION_CATEGORY') {
            $c = "SELECT * FROM `discussions_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
            $count = $db->CountRows($c);
            if ($count == 0) {
                $s = "INSERT INTO `discussions_filters`(`name`, `community_id`) VALUES ('" . $_POST['name'] . "','" . $_POST['community_id'] . "')";
            } else {
                $exits = $db->RetriveSingle($c);
                $s = "UPDATE `discussions_filters` SET `name`='" . $_POST['name'] . "' WHERE `community_id`='" . $_POST['community_id'] . "' AND `name`='" . $exits['name'] . "' ";
            }
            if ($db->Query($s)) {
                echo "Category Saved";
            } else {
                echo "Error";
            }
        }
        if ($method == 'GET_DISCUSSION_CATEGORY') {
            $c = "SELECT * FROM `discussions_filters` WHERE `community_id`='" . $_POST['community_id'] . "' ";
            $data = $db->RetriveArray($c);
            echo json_encode($data);
        }
        if ($method == 'REMOVE_DISCUSSION_CATEGORY') {
            $c = "DELETE FROM `discussions_filters` WHERE `name`='" . $_POST['name'] . "' AND `community_id`='" . $_POST['community_id'] . "' ";
            if ($db->Query($c)) {
                echo "Category Removed";
            } else {
                echo "Error Occured";
            }
        }
}
?>