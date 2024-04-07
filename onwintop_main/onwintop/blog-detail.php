<?php
include "init.php";
$db = new Database();
$parts=URL_Parts();
$s = "SELECT * FROM `blogs` WHERE `id`='" . $id . "' AND `community_id`='" . $community_id . "' ";
$blog = $db->RetriveSingle($s);
$cover = $blog['cover'];
//get nav to other posts
$prev = $id - 1;
$next = $id + 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $blog['name']; ?> | <?php echo $title; ?></title>
	<?php include "includes/head.php"; ?>
</head>

<body>

	<div class="theme-layout">

		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>

		<section class='panel-content'>
			<div class="gap" id='content' style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							<div class="blog-detail">
								<div class="blog-title">
									<h2><?php echo $blog['name']; ?></h2>
								</div>
								<div class="blog-details-meta">
									<figure><img src="<?php echo $cover; ?>" style="width:100%;height:320px;object-position:center;object-fit:cover" alt=""></figure>
									<ul>
										<li><i class="">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg></i> 0</li>
										<li><i class="">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
													<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
													<line x1="16" y1="2" x2="16" y2="6"></line>
													<line x1="8" y1="2" x2="8" y2="6"></line>
													<line x1="3" y1="10" x2="21" y2="10"></line>
												</svg></i> <?php echo date_format(date_create($data['date']), 'd M, Y'); ?></li>
									</ul>
									<p style="text-align:justify;font-size:24px;line-height:35px"><?php echo $blog['post']; ?></p>
									<div class="tag-n-cat">

										<div class="tags">
											<span><i class="">
													<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
														<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
													</svg></i> Post Categories:</span>
											<?php
											$tags = explode(",", $blog['categories']);
											foreach ($tags as $tag) {
												$tb = "SELECT * FROM `blogs_categories` WHERE `id`='" . $tag . "' ";
												$t = $db->RetriveSingle($tb);
												echo '<a title="" href="#">' . $t['name'] . '</a>';
											}
											?>
										</div>
									</div>
								</div>
								<div class="next-prev-posts">
									<?php
									$p = "SELECT * FROM `blogs` WHERE `id`='" . $prev . "' AND `community_id`='" . $community_id . "' ";
									if ($db->CountRows($p) != 0) {
										$prev = $db->RetriveSingle($p);
										echo '
											<div class="prev">
												<a href="' . URL_Make("/blog/" . $prev['id']) . '" title="">
													<i class="fa fa-angle-double-left" aria-hidden="true"></i>
													<div class="translate">
														<span>Previous</span>
														<p>' . $prev['name'] . '</p>
													</div>
												</a>
											</div>
											';
									}
									?>
									<?php
									$n = "SELECT * FROM `blogs` WHERE `id`='" . $next . "' AND `community_id`='" . $community_id . "' ";
									if ($db->CountRows($n) != 0) {
										$nex = $db->RetriveSingle($n);
										echo '
											<div class="next">
												<a href="' . URL_Make("/blog/" . $nex['id']) . '" title="">
													<i class="fa fa-angle-double-right" aria-hidden="true"></i>
													<div class="translate">
														<span>Next</span>
														<p >' . $nex['name'] . '</p>
													</div>
												</a>
											</div>
											';
									}
									?>
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
	<?php include "includes/scripts.php"; ?>
	<script>
		$(document).ready(function() {
			$('.theme-layout').click(function() {
				sidebar = $('#sidenav').prop("classList");
				console.log(sidebar);
			})
		})
	</script>

</body>

</html>