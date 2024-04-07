<?php
include "init.php";
$error="";
$success="";

$community = R::findOne("communities", "WHERE link=?", [$community_id]);
//get color assets
$branding = R::findOne("branding", "WHERE community_id=?", [$community_id]);
$branding = json_decode($branding['colors'], true);
$data=base64_decode($data,true);
$user=json_decode($data);

if(isset($_POST['email'])){
    $success='Password has been successfully updated! Your will be redirected shortly';
    echo "<script>setTimeout(function(){ window.location='".URL_Make('/signin')."' },3000)</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Reset Password | <?php echo $community['name']; ?></title>
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
                        <input type="email" name='email' value='<?php echo $user->email;?>' readonly>
						<input type="password" name='password' placeholder="Enter Password" required>
						<input type="password" name='confirm' placeholder="Confirm Password" required>
						<span class='text-danger error'></span>
						<b class="text-danger"><?php echo $error; ?></b>
                        <b class="text-success"><?php echo $success; ?></b></br></br>
						

    
                        <div class="uk-margin">
                            <button type='submit' class="main-btn success">Update</button>
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