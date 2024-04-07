<?php

include "init.php";
$error = '';
$success = '';
$url_parts = URL_Parts();
$sp = $invite_id;
$data = base64_decode($sp);
$invite = json_decode($data, true);
//print_r($invite);
if (isset($_POST['password'])) {

    if ($_POST['password'] == $_POST['confirm_password']) {
        $email=$_POST['email'];
        $user = R::findOne("users", "WHERE email=? AND status=?", [$email,'Pending']);
        if(!empty($user)){
            $user->password = $_POST['password'];
            $user->status = 'Active';
            if (R::store($user)) {

                $success = 'Your account has been successfully created. You will be automatically redirected to the login page...';
                echo "<script>setTimeout(function(){ window.location='".$root."user/login'; }, 3000);</script>";
            }
        }else{
            $error = "This invitation doesn't exists anymore";    
        }
        
    } else {
        $error = "Password doesn't matched";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup | Tellselling </title>
    <?php include "includes/head.php"; ?>

</head>

<body>
    <div class="theme-layout">
        <div class="authtication high-opacity" style='background-image:url(https://onwintop.com/assets/images/banner/page-banner.jpg);background-size:cover;background-position:left'>
            <div class="verticle-center">
                <div class="welcome-note">
                    <img src='<?php URI('images/logo.png') ?>' /></br>
                    <div class="logo"><span>Signup to the community</span></div>
                    <h1 style='color:#ae3793'>We turn digital channels into growth engines</h1>
                    <p style='color:#ae3793'>
                        The future of growth in a technology driven world
                    </p>
                </div>
                <div class="bg-image" style="https://source.unsplash.com/random/2109x1974/?nature"></div>
            </div>
        </div>
        <div class="auth-login">
            <div class="verticle-center">
                <div class="signup-form">
                    <h4><i class="fa fa-lock" aria-hidden="true"></i> Singup</h4>
                    <form method="post" action="" class="c-form">
                        <div class="row merged-10">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <span class='text-danger error'></span>
                                <span class='text-success success'></span>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="text" name='first_name' placeholder="First Name" value="<?php echo $invite['first_name']; ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="text" name='last_name' value="<?php echo $invite['last_name']; ?>" placeholder="Last Name" readonly>
                                <input type="hidden" name="email" value="<?php echo $invite['email']; ?>">
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="password" name='password' placeholder="Password" required>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="password" name='confirm_password' placeholder="Confirm Password" required>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <b class="text-danger"><?php echo $error; ?></b>
                                <b class="text-success"><?php echo $success; ?></b>
                            </div>

                            <div class="col-lg-12">
                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox" checked>
                                    <label for="checkbox"><span>I agree the terms of Services and acknowledge the privacy policy</span></label>
                                </div>
                                <div class="uk-margin">
                                    <button type='submit' class="main-btn button soft-primary py-3">Signup</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>