<?php
include "init.php";
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Challange Accomplished | <?php echo $title; ?></title>
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
								<div class="blog-details-meta">
								    </br></br>
									<h2>Challenge Completed</h2>
									<p>Your challanges has been successfully completed! you will be awarded once admin approves your submission.</p>
									<a href='https://app-dev.onwintop.com/<?php echo $community_id;?>/challenges' class='text-white btn btn-success'>Got it</a>
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