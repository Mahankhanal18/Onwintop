<?php

include "init.php";
$path = $id;
$s = "SELECT * FROM `solutions` WHERE `id`='" . $path . "' ";
$sol = $db->RetriveSingle($s);
$thumbnail = $sol['thumbnail'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $sol['name']; ?> | Solutions </title>
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<div class="theme-layout">

		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-12">
									<div class="main-wraper">
										<div class="row">
											<div class="col-lg-7 col-md-7">
												<div class="course-details">

													<h4><?php echo $sol['name']; ?></h4>

													<p>
														<?php echo $sol['short_description']; ?>
													</p>


												</div>
											</div>
											<div class="col-lg-5 col-md-5">
												<div class="course-video">
													<figure>
														<img src="<?php echo $sol['thumbnail']; ?>" alt="">
														<a class="play-btn" data-fancybox="" href="<?php echo $sol['videos']; ?>"><i class="fa fa-play"></i></a>
													</figure>

												</div>
											</div>
											<div class="col-lg-12">
												<div class="desc-course">
													<h4 class="main-title">Description:</h4>
													<?php echo $sol['long_description']; ?>
												</div>
											</div>

										</div>
									</div>

									<div class="row">
										<div class="col-lg-9">



											<div class="main-wraper">
												<h4 class="main-title">Ask out experts</h4>
												<div class="row col-xs-6 merged-10">
													<?php
													    /*$ex=json_decode($sol['experts'],true);
													    if(count($ex)!=0){
													        foreach($ex as $e){
    													        $eq="SELECT * FROM `members` WHERE `id`='".$e."' ";
    													        $expert=$db->RetriveSingle($eq);
    													        $role=$expert['designation'];
    													        if(strlen($role)==0){
    													            $role=$expert['role'];
    													        }
    													        echo '
    													        <div class="col-lg-3 col-md-3 col-sm-6">
            														<div class="members">
            															<figure><img alt="" src="https://ui-avatars.com/api/?name='.$expert['first_name']." ".$expert['last_name'].'&background=random"></figure>
            															<span><a href="profile-page2.html" title="">'.$expert['first_name']." ".$expert['last_name'].'</a></span>
            															<ins>'.$role.'</ins>
            															<a data-ripple="" title="" href="'.URL_Make('/member/'.$expert['id']).'">Book a meeting</a>
            														</div>
            													</div>
    													        ';
    													    }
													    }*/
													    
													?>
													
													
												</div>
											</div>



											<div class="main-wraper">
												<h4 class="main-title">Related Files</h4>
												<div class="books-caro">
													<?php
													/*$files = json_decode($sol['files'],true);
    													if(count($files)!=0){
    													   //print_r($files);
    													foreach ($files as $file) {
    														$s = "SELECT * FROM `files` WHERE `name`='" . $file . "' AND `community_id`='" . $community_id . "' ";
    														$fil = $db->RetriveSingle($s);
    														$name = $fil['name'];
    													?>
    														<div class="book-post">
    															<figure><a title="" href="<?php URL('/file/'.$fil['id']) ?>"><img src="<?php echo $fil['thumbnail']; ?>" style='height:180px;width:100%' alt=""></a></figure>
    															<a  href="<?php URL('/file/'.$fil['id']) ?>" title=""><?php echo $name; ?></a>
    														</div>
    													<?php
    													} 
													}*/
													
													?>

												</div>
											</div>

											<div class="main-wraper">
												<h4 class="main-title">Related Solutions</h4>
												<div class="books-caro">
													<?php
													/*$s = "SELECT * FROM `solutions` WHERE `community_id`='" . $community_id . "' ";
													$solutions = $db->RetriveArray($s);
													foreach ($solutions as $fil) {
														$name = $fil['name'];
														$thumbnail=$fil['thumbnail'];
													?>
														<div class="book-post">
															<figure><a href="<?php URL('/solution/'.$fil['id']);?>"><img style='height:200px;width:100%' src="<?php echo $thumbnail;?>" alt=""></a></figure>
															<a href="<?php URL('/solution/'.$fil['id']);?>"><?php echo $name; ?></a>
														</div>
													<?php
													}*/
													?>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<aside class="sidebar static right">
												<?php include "widgets/explore_events.php"; ?>
												<?php include "widgets/files.php"; ?>
											</aside>
										</div>
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
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>


</body>

</html>