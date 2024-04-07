<?php

include "init.php";

if(!isset($page)){
    $page=1;
}
$community_id=$_SESSION['community_id'];
$limit=10;
$challenges=R::findAll('challenges',"challenge_submit!=?",['']);
$count=R::count('challenges');

if(isset($_GET['reward'])){
    echo $_GET['reward'];
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Challenges Confirmation | <?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body style='background-color:aqua'>
	<!--<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div> -->
	<div class="theme-layout"  style='background-color:#ffffff'>

		<?php include "includes/header2.php"; ?>

		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-9">
									<div class="main-wraper wrapper">
										<div class="main-title rev">Challenge Confirmations</div>
										</br>
										<?php
										foreach ($challenges as $challenge) {
										    $cred=json_decode($challenge['challenge_submit'],true);
										?>
											
											<div class="blog-posts mb-3 content-item" style='border-bottom:1px solid #eaeaea;padding-bottom:15px'>
											    <div class="row">

											        <div class='col-md-10'>
											            <h5 class='single-line'><?php echo $challenge['headline']; ?></h5>
											            <p>Member Name : <?php echo $cred['name'];?></br>
											            Email : <?php echo $cred['email'];?>
											            </p>
    											            <div class='row'>
    											                <div class='col-md-4'>
    											                    <i class="fa fa-coins"></i>&nbsp; <?php echo $challenge['reward'];?> Coins
    											                </div>
    											                
    											            </div>
											        </div>
											        <div class='col-md-2'>
											            <?php
											                if($challenge['challenge_type']=='questions' || $challenge['challenge_type']=='quiz'){
											                    echo "<button class='btn btn-outline-success rev' style='width:100%;margin-top:5px;margin-bottom:5px'>View</button>";
											                }
											            ?>
									                    
									                    <button class='btn btn-success con' style='width:100%;margin-top:5px;margin-bottom:5px'>Confirm</button>
											        </div>
											    </div>
											</div>
										<?php
										}
										?>

									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


    
    <div class="popup-wraper" id='rev_modal'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Responses</h5>
                </div>
                <div class="send-message">
                    <p>Text Field : Demo</p>
                    <p>Text Field : Demo</p>

                </div>
            </div>
        </div>
    </div>
    
        <div class="popup-wraper" id='con_modal'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Confirm</h5>
                </div>
                <div class="send-message">
                    30 Coins will be transfered to labofub2@gmail.com</br></br>
                    <a href='https://app-dev.onwintop.com/6x0ey/challenges-confirmation?reward=30' class='btn btn-success text-white'>Yes</a>
                </div>
            </div>
        </div>
    </div>



		<?php include "includes/footer.php"; ?>
	</div>


    



    <script>
        $(document).ready(function(){
            
            $('.rev').on('click',function(){
                $('#rev_modal').addClass('active');
            })
            
            $('.con').on('click',function(){
                $('#con_modal').addClass('active');
            })
            
            
            $(".wrapper .content-item").slice(8).hide();
        })
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
</body>

</html>