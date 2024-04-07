<?php
include "init.php";
$db=new Database();
$url_parts=URL_Parts();
//print_r($url_parts);
//$id = $url_parts[7];
$s = "SELECT * FROM `files` WHERE `id`='" . $id . "' AND `community_id`='" . $community_id . "' ";
$content = $db->RetriveSingle($s);
$d = $content;
$type = 'video';
$thumb = $content['thumbnail'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $content['name']; ?> | Files </title>
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
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4">
												<div class="full-book">
													<figure>
														<img src="<?php echo $thumb; ?>" alt="">
														<span>Trending</span>
													</figure>
													<div class="prod-stat">
														<ul>
															<li><span>Visited:</span> 0</li>
															<li><span>Downloads:</span> 0</li>
															<li><span>Availablity:</span> Available</li>
														</ul>
													</div>
												</div>
											</div>
											<div class="col-lg-8 col-md-8 col-sm-8">
												<div class="prod-detail">

													<h4><?php echo $content['name']; ?></h4>

													<p>
														<?php echo $content['description']; ?>
													</p>

													<div class="sale-button">
														<a href="#" title="" class="ask-qst main-btn">Preview Now</a>
														<a href="<?php echo $content["url"];?>" target='_blank' title="" class="main-btn">Download Now</a>
													</div>
												</div>
											</div>
										</div>
										<!--<div class="book-description">
											<p>
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
											</p>
										</div>-->

									</div>
									<div class="main-wraper">
										<h4 class="main-title">Related Files <a class="view-all" href="#" title="">view all</a></h4>
										<div class="books-caro">
											<?php
											$s = "SELECT * FROM `files` WHERE `community_id`='" . $community_id . "' ";
											$files = $db->RetriveArray($s);
											foreach ($files as $fil) {
												$name = $fil['name'];
											?>
												<div class="book-post">
													<figure><a title="" href="<?php URL('/file/' . $fil['id']) ?>"><div style="background-image:url(<?php echo $fil['thumbnail']; ?>);height:180px;border-radius:10px;width:100%;background-position:center"></div></a></figure>
													<a href="<?php URL('/file/' . $fil['id']) ?>" title=""><?php echo $name; ?></a>
												</div>
											<?php
											}
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
		</section>


		<div class="new-question-popup">
			<div class="popup">
				<span class="popup-closed">x</span>
				<div class="popup-meta">
					<div class="popup-head">
						<h5>File Preview</h5>
					</div>
					<div class="post-new">
						<iframe src='<?php echo $data["url"];?>' style='width:100%;height:400px;border:none'></iframe>
					</div>
				</div>
			</div>
		</div><!-- ask question -->

		<?php include "includes/footer.php"; ?>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/sparkline.js"); ?>"></script>
	<script src="<?php URI("js/chart.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>

</body>

</html>