<?php

include "init.php";

if(!isset($page)){
    $page=1;
}
$community_id=$_SESSION['community_id'];
$limit=10;
$r=R::findOne('rewards','id=?',[$id]);


$cred=json_decode($_SESSION['community_credentials'],true);

$email=$cred['email'];
$c=R::findOne("members","email=?",[$email]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Successfull Redeemption | <?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>

</head>

<body style='background-color:aqua'>
	<!--<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div> -->
	<div class="theme-layout"  style='background-color:#ffffff'>

		<?php include "includes/header2.php"; ?>

		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>;background-color:#ffffff;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
							    <div class="col-lg-3"></div>
								<div class="col-lg-6">
									<div class="main-wraper wrapper" style="background-color:#ffffff !important;">

                                        <div class='row'>
                                            <div class='col-md-12'>
                                                
                                                <center>
                                                    <img src='https://i.gifer.com/XZ0q.gif' style="height:300px;width:auto"/>
                                                    <h4>Successful!</h4>
                                                    <b>Rewards has been successfully redeemed! Thank you.</b></br>
                                                    <a href='<?php URL('/rewards');?>' class='btn btn-outline-success mt-5'>Done</a>
                                                </center>
                                                
                                            </div>
                                            
                                        </div>

									</div>
								</div>
								<div class="col-lg-3"></div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>



		<?php include "includes/footer.php"; ?>
		<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

	</div>



</body>

</html>