<?php
include "init.php";

if(!isset($page)){
    $page=1;
}
$community_id=$_SESSION['community_id'];
$limit=10;

$cred=json_decode($_SESSION['community_credentials'],true);

if($cred['role']=='Admin'){
    $challenges_submitted=R::findAll('challengesubmissions','community_link=? AND status=? ORDER BY id DESC',[$community_id,'Pending']);
}else{
    $challenges_submitted=R::findAll('challengesubmissions','community_link=? AND status=? AND member_id=? ORDER BY id DESC',[$community_id,'Pending',$cred['id']]);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Pending Challenges | <?php echo $title; ?></title>
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
								<div class="col-lg-8 col-md-8">
									<div class="main-wraper wrapper">
										<div class="main-title">Waiting Challenges

										</div>
										<h6 class='mb-3'><a href='<?php URL('/challenges/');?>' style='font-weight:500;'>All</a> <a class='ml-3'><u>Waiting</u></a> <a  href='<?php URL('/completed-challenges/');?>' class='ml-3'>Completed</a></h6>
										</br>
										<?php
										//$count=count($blogs);
										foreach ($challenges_submitted as $ss) {
										    $challenge=R::findOne("challenges","id=?",[$ss['challenge_id']]);
											$cover = $challenge['thumbnail'];
										?>
											<div class="blog-posts mb-3 content-item" style='padding:15px;border-bottom:1px solid #eaeaea;margin-bottom:15px;background-color:#ffffff;border-radius:8px;'>
											    <div class="row">
	
											        <div class='col-md-4'>
											            <figure><img src="<?php echo $cover; ?>" style='height:140px;width:100%;object-fit:cover;object-position:center;border-radius:8px;border:1px solid #ebebeb;' alt=""></figure>
											        </div>
											        <div class='col-md-4'>
											            <b class='single-line'><?php echo $challenge['headline']; ?></b></br>
											            Submitted By <b><?php echo $ss['name'];?></b></br>
											            <small>Submitted on <?php echo date_format(date_create($ss['date']),'d M Y');?></small></br>
											            <a href="<?php URL('/review-challenge/'.$challenge['id']);?>" class='btn btn-primary btn-sm my-3'>Review</a>
											            
											            
											            <div class='row'>
											                <div class='col-md-4'>
											                    <i class="fa fa-coins text-warning"></i>&nbsp; <?php echo $challenge['reward'];?>
											                </div>
											            </div>
											        </div>
											        <div class='col-md-4'>
											            <span class="badge badge-warning"><?php echo $ss['status'];?></span></br>
											            <small>Email : <?php echo $ss['email'];?></small></br>
											            <small>Category : <?php echo strtoupper($ss['challenge_type']);?></small>
											        </div>
											    </div>
											</div>
										<?php
										}
										if(count($challenges_submitted)==0){
										    echo "
										    <p class='p-5 text-center text-secondary'>
										        No Pending Challenges
										    </p>
										    ";
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

		<?php include "includes/footer.php"; ?>
	</div>

    <script>
        $(document).ready(function(){
            
            
            $(".wrapper .content-item").slice(8).hide();
            $('#pagination').pagination({
                items: <?php echo $count;?>,
                itemsOnPage: 8,
                onPageClick: function(noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });
        })
    </script>

</body>

</html>