<?php
include "init.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $db = new Database();
    if ($method == 'SIGNUP') {
        $first_name = $db->FilterString($_POST['first_name']);
        $last_name = $db->FilterString($_POST['last_name']);
        $email = $db->FilterString($_POST['email']);
        $password = $db->FilterString($_POST['password']);
        $community_id = $db->FilterString($_POST['community_id']);
        $community = $db->RetriveSingle("SELECT * FROM `communities` WHERE `link`='" . $community_id . "' ");
        $c = "SELECT * FROM `members` WHERE `community_id`='" . $_POST['community_id'] . "' AND `email`='" . $email . "' ";
        if ($db->CountRows($c) == 0) {
            //Unique Email
            $s = "INSERT INTO `members`(`community_id`, `first_name`, `last_name`, `email`, `password`, `registration_date`) VALUES 
                ('" . $community_id . "','" . $first_name . "','" . $last_name . "','" . $email . "','" . $password . "','" . date('Y-m-d') . "')";
            if ($db->Query($s)) {
                $activate_url = $url .$community_id ."/activate-account/". base64_encode($email);
                $body = '
                    <p>Hi ' . $first_name . ',</p>
                    <p>Thanks for joining ' . $community['name'] . ', click on the link below to activate your account.</p>
                    <p>' . $activate_url . '</p>
                    <p><b>Regards ' . $community['name'] . '</b></p>
                    ';
                SendMail('Account Activation', $email, $first_name, $body);
                echo "200";
            } else {
                echo "Error Occured";
            }
        } else {
            //Duplicate
            echo "User with same email already exists";
        }
    }
    if ($method == 'SIGNIN') {
        $email = $db->FilterString($_POST['email']);
        $password = $db->FilterString($_POST['password']);
        /*$c = "SELECT * FROM `members` WHERE `community_id`='" . $_POST['community_id'] . "' AND `email`='" . $email . "' AND `password`='" . $password . "' ";
        if ($db->CountRows($c) != 0) {
            $data = $db->RetriveSingle($c);
            if ($data['status'] == 'Active') {
                //$_SESSION['community_login'] = true;
                setCookieData("community_login",'true');
                //$_SESSION['role']=$data['role'];
                setCookieData("role",$data['role']);
                //$_SESSION['community_credentials'] = $data;
                setCookieData("community_credentials",json_encode($data));
                echo "200";
            } else if ($data['status'] == 'Pending') {
                echo "Your account hasn't been activated yet.";
            } else {
                echo "Your account has been deactivated";
            }
        } else {
            echo "Invalid Signin Credentials";
            //echo $c;
            //echo $db->CountRows($c);
        }*/
        $user=R::findOne("users","WHERE email=? AND password=?",[$_POST['email'],$_POST['password']]);
        //$_SESSION['community_login'] = true;
        setCookieData("community_login",'true');
        //$_SESSION['role']=$data['role'];
        setCookieData("role",$user['role']);
        //$_SESSION['community_credentials'] = $data;
        setCookieData("community_credentials",json_encode($user));
        $con=R::findOne("communities","WHERE tenant_id=? LIMIT 1",[$user['tenant_id']]);
        echo $con['link'];
    }
}
