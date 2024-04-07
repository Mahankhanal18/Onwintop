<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Salesrooms | <?php echo $title; ?></title>
	<?php include "includes/head.php"; ?>
</head>

<body>
	<div class="theme-layout">
		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>
		<section>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-9">

									<div class="main-wraper">
										<h4 class="main-title">Digital Salesrooms</h4>

										<div class='row'>
											<?php
											$s = "SELECT * FROM `salesrooms` WHERE `community_id`='" . $_SESSION['community_id'] . "' AND `type`='Public' ";
											$data = $db->RetriveArray($s);
											foreach ($data as $sol) {
												$thumbnail = $sol['thumbnail'];
											?>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="course">
														<figure>
															<img src="<?php echo $thumbnail; ?>" style='height:280px;width:100%' alt="">
															<em>Best choice</em>
														</figure>
														<div class="course-meta">

															<h5 class="course-title"><a href="<?php URL('/salesroom/' . $sol['link']); ?>" title=""><?php echo $sol['name']; ?></a></h5>
															<div class="course-info">

															</div>
														</div>
													</div>
												</div>


											<?php

											}
											if(count($data)==0){
												echo "<span style='padding:15px;text-align:center;width:100%'>No Digital Salesrooms available</span>";
											}
											?>
										</div>
									</div><!-- books carousel -->
								</div>
								<div class="col-lg-3">
									<aside class="sidebar static right">
										<?php include "widgets/files.php"; ?>
										<?php include "widgets/explore_events.php"; ?>
									</aside>
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
	<script src="<?php URI("js/sparkline.js"); ?>"></script>
	<script src="<?php URI("js/chart.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>


</body>

</html>