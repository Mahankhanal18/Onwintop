<?php

include "init.php";
$db = new Database();
$s = "SELECT * FROM `communities` WHERE `id`='" . $community_id . "' ";
$com=$db->RetriveSingle($s);
$user_email = base64_decode($_SESSION['path']);
$a="UPDATE `members` SET `status`='Active' WHERE `email`='".$user_email."' AND `community_id`='".$community_id."' ";
$stat="";
if($db->Query($a)){
    $stat="Your account has been succesfully activated!";
}else{
    $stat="Opps! Something went wrong";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Account Activation | <?php echo $title;?></title>
    <?php include "includes/head.php";?>
</head>
<body>
<div class="page-loader" id="page-loader">

  <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>

</div><!-- page loader -->
<div class="theme-layout">
	<div class="error-page">
		<div id="container-inside">
		  <div id="circle-small"></div>
		  <div id="circle-medium"></div>
		  <div id="circle-large"></div>
		  <div id="circle-xlarge"></div>
		  <div id="circle-xxlarge"></div>
	  	</div>
		<div class="thanks-purchase">
			<div class="logo"></div>
            <span><?php echo $stat;?></span>
			<h3 style='color:aliceblue'>You will continue to next step!</h3>
			<a class="button dark circle mt-4 btn-lg" href="<?php URL('/signin');?>" title="">Login</a>
		</div>
	</div>
</div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>

</body>
</html>
