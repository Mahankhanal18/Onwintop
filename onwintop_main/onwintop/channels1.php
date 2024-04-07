<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Tellselling | We help you to grow digitally</title>
	<?php include "includes/head.php"; ?>

</head>

<body>
	<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div><!-- page loader -->
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

									<div class="main-wraper blank-wrapper">
										<div class="main-title">Channels</div>

										<div class="row">
											<?php
											$c = "SELECT * FROM `channels` WHERE `community_link`='" . $_SESSION['community_id'] . "' ";
											$channels = $db->RetriveArray($c);
											foreach ($channels as $channel) {
											?>
											<div class="col-lg-3 col-md-3 col-sm-6">
												<div class="event-post mb-3">
													<figure><a href="event-detail.html" title=""><img src="<?php echo $channel['thumbnail'];?>" style='height:180px;width:100%;' alt=""></a></figure>
													<div class="event-meta">
														<h6><a href="event-detail.html" title=""><?php echo $channel['name']; ?></a></h6>
														<p>Some description about the event write here.</p>
														<div class="more">
															<div class="more-post-optns">
																<i class="">
																	<svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
																		<circle r="1" cy="12" cx="12"></circle>
																		<circle r="1" cy="12" cx="19"></circle>
																		<circle r="1" cy="12" cx="5"></circle>
																	</svg></i>
																<ul>
																	<li>
																		<i class="icofont-share-alt"></i>Edit
																		<span>Edit Channel Contents</span>
																	</li>
																	<li>
																		<i class="icofont-ui-delete"></i>Delete Post
																		<span>If inappropriate channel By Mistake</span>
																	</li>
																	<li>
																		<i class="icofont-flag"></i>Print
																		<span>Print soft copy for easy access</span>
																	</li>
																</ul>
															</div>
														</div>
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
			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</div>
	<?php include "includes/scripts.php"; ?>



</body>

</html>