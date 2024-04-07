<?php
include "init.php";
$error="";
$success="";

$community = R::findOne("communities", "WHERE link=?", [$community_id]);
//get color assets
$branding = R::findOne("branding", "WHERE community_id=?", [$community_id]);
$branding = json_decode($branding['colors'], true);
if(isset($_POST['email'])){
    $member=R::findOne("members","WHERE community_id=? AND email=? ",[$community_id,$_POST['email']]);
    if(!empty($member)){
        $obj=array(
            'community_id'=>$member['community_id'],
            'email'=>$member['email'],    
        );
        $obj=json_encode($obj);
        $enc=base64_encode($obj);
        $complete_url=URL_Make('/reset-password/'.$enc);
        $body = "
        <p>
        Hi " . $member['first_name'] . "!</br>
        It seems you forgot your password! Click on the following link to reset your password : </br>
        " . $complete_url . "</br>
        </p>
        ";
        SendMail("Account Activation Invitation", $member['email'], $member['first_name'] . " " . $member['last_name'], $body);
        $success="A recovery email has been successfully delivered to your registered email address";
            
        
    }else{
        $error="Member with this email doesn't exists";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Forgot Password | <?php echo $community['name']; ?></title>
	<?php include "includes/head.php"; ?>
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
					<h4><i class="fa fa-lock" aria-hidden="true"></i> Password Reset</h4>
					<form method="post" action='' class="c-form">

						<input type="email" id='email' name='email' placeholder="Your Email @" required>
						<span class='text-danger error'></span>
						<b class="text-danger"><?php echo $error; ?></b>
                        <b class="text-success"><?php echo $success; ?></b></br></br>
						

    
                        <div class="uk-margin">
                            <button type='submit' class="main-btn success">Send Password Reset Link</button>
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