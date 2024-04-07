<?php
include "init.php";
$error="";
$success="";

$community = R::findOne("communities", "WHERE link=?", [$community_id]);
//get color assets
$branding = R::findOne("branding", "WHERE community_id=?", [$community_id]);
$branding = json_decode($branding['colors'], true);
if (isset($_POST['email']) && isset($_POST['password'])) {
	$member = R::findOne("members", "WHERE email=? AND community_id=?", [$_POST['email'],$community_id]);
	$user = R::findOne("users", "WHERE email=?", [$_POST['email']]);
	//check if login user is tenant user
	if (!empty($user)) {
		if ($user['password'] == $_POST['password']) {
			if ($user['status'] == 'Active') {
				//setCookieData("user_login", 'true');
				//setCookieData("role", $user['role']);
				//setCookieData("community_credentials", json_encode($user));
				//setCookieData("community_id",$community['link']);
				
				$_SESSION['user_login']='true';
				$_SESSION['community_login']='false';
                $_SESSION['role']=$user['role'];
                $_SESSION['name']=$user['first_name']." ".$user['last_name'];
                $_SESSION['community_credentials']=json_encode($user);
                $_SESSION['community_id']=$community['link'];
                $_SESSION['curr_community_id']=$community['link'];
				
				$success = 'Signin successful. Redirecting...';
				//get latest community
				$community = R::findOne("communities", "tenant_id=? ORDER BY id DESC LIMIT 1", [$user['tenant_id']]);
				//echo "</br>";
				$success = 'Signin successful. Redirecting...';
				if(isset($_GET['q'])){
					$req=base64_decode($_GET['q'],true);
					echo "<script>setTimeout(function(){ window.location='" . $req . "'; }, 3000);</script>";
				}else{
					echo "<script>setTimeout(function(){ window.location='" . $root . $community['link'] . "/challange-focus'; }, 3000);</script>";
				}
				
			} else {
				$error = "Your account is inactive! please contact the tenant admin";
			}
		} else {
			$error = "Please enter a correct password";
		}
	}
	//else check if login user is community member
	elseif(!empty($member)) {
		if ($member['status'] == 'Active') {
		    /*
			setCookieData("community_login",'true');
			setCookieData("role",$member['role']);
			setCookieData("community_credentials",json_encode($member));
			setCookieData("community_id",$community['link']);*/
			
			$_SESSION['community_login']='true';
			$_SESSION['user_login']='false';
            $_SESSION['role']=$member['role'];
            $_SESSION['name']=$member['first_name']." ".$member['last_name'];
            $_SESSION['community_credentials']=json_encode($member);
            $_SESSION['community_id']=$community['link'];
            $_SESSION['curr_community_id']=$community['link'];
			
			$success = 'Signin successful. Redirecting...';
			echo "<script>setTimeout(function(){ window.location='" . $root . $community_id . "/challange-focus'; }, 3000);</script>";
		} else if ($member['status'] == 'Pending') {
			$error="Your account hasn't been activated yet.";
		} else {
			$error= "Your account has been deactivated";
		}
	}else{
		$error = "Account with this email does not exists.";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Signin | <?php echo $community['name']; ?></title>
	<?php include "includes/head.php"; ?>
	<style>
		.main-btn{
			color:var(--primary-color) !important;
		}
		.main-btn:hover{
			color:#ffffff !important;
		}
	</style>
</head>

<body>
    <?php
	    $img="https://source.unsplash.com/random/600x400/?technology";
	    //print_r($branding);
	    if (isset($branding['signin_image'])){
	        $img=$branding['signin_image'];
	    }
	 ?>
	<div class="theme-layout">
        <div class="authtication high-opacity"  style="background-image:url(<?php echo $img; ?>);background-size:cover;background-position:center">
		</div>
		<div class="auth-login">
			<div class="logo"></div>
			<div class="mockup left-bottom"><img src="<?php URI('images/mockup.png') ?>" alt=""></div>
			<div class="verticle-center">
				<div class="login-form">
					<h4><i class="fa fa-lock" aria-hidden="true"></i> Login</h4>
					<form method="post" action='' id='signin' class="c-form">

						<input type="email" id='email' name='email' placeholder="Your Email @" required>
						<input type="password" id='password' name='password' placeholder="xxxxxxxxxx" required>
						<span class='text-danger error'></span>
						<div class="checkbox">
							<input type="checkbox" id="checkbox" checked>
							<label for="checkbox"><span>Remember Me</span></label>
						</div>
						<b class="text-danger"><?php echo $error; ?></b>
                        <b class="text-success"><?php echo $success; ?></b></br></br>
						

    
                        <div class="uk-margin">
                            <a href="<?php URL('/signup'); ?>" title="" class="main-btn success">Signup</a>
                            <button class="main-btn" type="submit"><i class="icofont-key"></i> Login</button>
                            
                        </div>
                        <a style="float:right" href='<?php echo URL_Make('/forgot-password');?>' class='text-primary'>Forgot Password?</a>


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