<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Solutions | <?php echo $title;?></title>
	<?php include "includes/head.php"; ?>
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
								<div class="col-lg-9">
									<div class="main-wraper">
										<h4 class="main-title">Solutions</h4>
										<div class="row">
											<?php include "widgets/solutions_list.php"; ?>
										</div>
									</div>

									<div class="main-wraper">
										<h4 class="main-title">Recommended Files <a class="view-all" href="files.html" title="">view all</a></h4>

										<div class="books-caro">
											<?php
											$s = "SELECT * FROM `files` WHERE `community_id`='" . $community_id . "' ";
											$data = $db->RetriveArray($s);
											foreach ($data as $d) {
											?>
												<div class="book-post">
													<figure><a data-fancybox="" title="" href="#"><img src="<?php echo $d['thumbnail']; ?>" alt=""></a></figure>
													<a data-fancybox="" href="#" title=""><?php echo $d['name']; ?></a>
												</div>
											<?php
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