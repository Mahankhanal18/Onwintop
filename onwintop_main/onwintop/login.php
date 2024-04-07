<?php
//session_start();
include "init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signin | <?php echo $_ENV['app_name'];?> </title>
    <?php include "includes/head.php"; ?>
    <?php
    $error = '';
    $success = '';
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $user = R::findOne("users", "WHERE email=?", [$email]);
        if (!empty($user)) {
            if ($user['password'] == $_POST['password']) {
                if ($user['status'] == 'Active') {
                    $community = R::findOne("communities", "WHERE tenant_id=? ORDER BY id DESC LIMIT 1", [$user['tenant_id']]);
                    
                    //setCookieData("user_login", "true");
                    //setCookieData("role", $user['role']);
                    //setCookieData("name", $user['first_name']." ".$user['last_name']);
                    //setCookieData("community_credentials", json_encode($user));
                    //setCookieData("community_id", $community['link']);
                    
                    $_SESSION['user_login']='true';
                    $_SESSION['role']=$user['role'];
                    $_SESSION['name']=$user['first_name']." ".$user['last_name'];
                    $_SESSION['community_credentials']=json_encode($user);
                    $_SESSION['community_id']=$community['link'];
                    $_SESSION['curr_community_id']=$community['link'];
                    $success = 'Signin successful. Redirecting...';
                    echo "<script>setTimeout(function(){ window.location='" . $root . $community['link'] . "'; }, 3000);</script>";
                } else {
                    $error = "Your account is inactive! please contact the tenant admin";
                }
            } else {
                $error = "Please enter a correct password";
            }
        } else {
            $error = "Please enter your registered email address";
        }
    }
    ?>
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
            <div class="logo"></div>
            <div class="mockup left-bottom"><img src="<?php URI('images/mockup.png') ?>" alt=""></div>
            <div class="verticle-center">
                <div class="login-form">
                    <h4><i class="fa fa-lock" aria-hidden="true"></i> Login</h4>
                    <form method="post" action="" class="c-form">
                        <input type="email" id='email' name='email' placeholder="Your Email @" required>
                        <input type="password" id='password' name='password' placeholder="xxxxxxxxxx" required>
                        <span class='text-danger error'></span>
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox" checked>
                            <label for="checkbox"><span>Remember Me</span></label>
                        </div>
                        <b class="text-danger"><?php echo $error; ?></b>
                        <b class="text-success"><?php echo $success; ?></b>

                        <div class="uk-margin">
                            <a href="<?php echo $root . "signup"; ?>" title="" class="main-btn success">Signup</a>
                            <button class="main-btn " type="submit"><i class="icofont-key"></i> Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mockup right"><img src="<?php URI('images/star-shape.png') ?>" alt=""></div>
        </div>
    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

        })
    </script>

</body>

</html>