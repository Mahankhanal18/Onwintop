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

$details=json_decode($r['redeem_data'],true);


if(isset($_POST['amount']) && isset($_POST['email'])){
    $r->status="Success";
    $coins=$c->coins-$_POST['amount'];
    $c->coins=$coins;
    $info=array(
        "email"=> $email,
        "reward"=>$details,
        "id"=>$id
    );
    $info=json_encode($info);
    $body="
    <center style='padding-top:40px;padding-bottom:40px'>
        <img src='https://app-dev.onwintop.com/images/surprise.png' style='height:100px;width:auto;'/></br>
        <h2 style='margin-top:12px'>Onwintop has sent you a gift</h2></br>
        <a href='https://app-dev.onwintop.com/".$community_id."/redeem-reward/".base64_encode($info)."' style='background-color:#a1a1a1;border-radius:20px;color:#ffffff;padding:13px;text-decoration:none;'>View your reward</a>
    </center>
    ";
    SendMail('Wonder happends here', 'badhanbarman@gmail.com', 'Utpalendu Barman', $body);
    
    if(R::store($r) && R::store($c)){
        echo "<script>window.location='".URL_Make('/successful-redemption')."';</script>";
    }else{
        echo "error occured";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Rewards | <?php echo $title; ?></title>
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
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-9">
									<div class="main-wraper wrapper">
										<div class="main-title"><?php echo $r['name'];?></div>

                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <img src='<?php echo $r['cover'];?>' style="height:220px;width:100%;object-position:center;object-fit:cover;border-radius:5px;border:1px solid #c1c1c1;"/>
                                                <p class='mt-2'><?php echo $r['description'];?></p></br>
                                            </div>
                                            <div class='col-md-12'>
                                                <b><i class='fa fa-coins text-warning'></i>&nbsp;<?php echo $r['amount'];?> Coins</b></br></br>
                                                
                                                <?php
                                                    if(empty($c)){
                                                        echo "<script>window.location='".URL_Make('/rewards')."';</script>";
                                                    }else{
                                                        if($c['coins']<$r['amount']){
                                                            echo "<b class='text-danger'>It seems you don't have sufficient coins to redeem this reward!</b>";
                                                        }else{
                                                            echo "
                                                            <b class='text-success'>Congratulations! You are eligible to redeem this reward</b></br>
                                                            <button id='confirm-btn' class='btn btn-success mt-2'>Redeem</button>
                                                            ";
                                                        }
                                                    }
                                                ?>
                                                
                                            </div>
                                            
                                        </div>

									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

<div class="popup-wraper" id='confirm'>
    <div class="popup">
        <span class="popup-closed"><i class="icofont-close"></i></span>
        <div class="popup-meta">
            <div class="popup-head">
                <h5><i class="fa fa-trophy"></i> Confirm Redeemption</h5>
            </div>
            <div class="send-message">
                <form id='qstn-form' action='' method='post' class='row'>
                    <div class='col-md-12'>
                        <label>Are you sure want to redeem this reward?</label>
                        <input type='hidden' name='wallet_address' class='form-control' value="<?php echo $c['wallet_address'];?>"/>
                        <input type='hidden' name='amount' value='<?php echo $r['amount'];?>'/>
                        <input type='hidden' name='email' value='<?php echo $c['email'];?>'/>
                    </div>

                    <div class='col-md-12 mt-3'>
                        <button type='submit'  class='btn btn-success'>Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


		<?php include "includes/footer.php"; ?>
		<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

	</div>

    <script>
        $(document).ready(function(){
            
            
            $(".wrapper .content-item").slice(8).hide();

            $('#confirm-btn').click(function(){
                $('#confirm').addClass('active');
            })
        })
    </script>

</body>

</html>