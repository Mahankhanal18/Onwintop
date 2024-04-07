<?php
include "init.php";
$u=$id;
$s = "SELECT * FROM `events` WHERE `community_id`='" . $community_id . "' AND `url`='" . $u . "' ";
$db = new Database();
$event = $db->RetriveSingle($s);
$is_live = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $event['name']; ?> | We help you grow digitally</title>
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .post{
            display:none;
        }
    </style>
</head>

<body>
	<!--<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div>-->
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
										<h4 class="main-title"><?php echo $event['name']; ?></h4>
										<figure class="event-detail-img"><img src="<?php echo $event['cover']; ?>" style='height:300px;width:100%;object-fit:cover;object-position:center' alt=""></figure>
										<div class="event-schedule">
											<h6>schedule</h6>
											<span>Next date of your event</span>
											<?php
											$location = "";
											$sessions = json_decode($event['sessions'], true);
											$post_event = false;
											foreach ($sessions as $session) {
												$location = $session['location'];
												if ($session['date'] < date('Y-m-d')) {
													$post_event = true;
												}
												if (date('Y-m-d') == $session['date']) {
													$is_live = true;
												} else {
													if ($session['type'] == 'stream' && $is_live) {
														echo "<script>window.location='" . URL_Make('/event-live/' . $u) . "'</script>";
													}
													if ($session['type'] == 'stream' && $post_event) {
        												echo "<script>window.location='" . URL_Make('/event-live/' . $u) . "'</script>";
        											} 
												}
											?>
												<h5><i class="">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
															<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
															<line x1="16" y1="2" x2="16" y2="6"></line>
															<line x1="8" y1="2" x2="8" y2="6"></line>
															<line x1="3" y1="10" x2="21" y2="10"></line>
														</svg></i> <?php echo date_format(date_create($session['date']), 'd M Y'); ?> at <b><?php echo $session['time']; ?></b> </h5>
											<?php
											}
											
											?>
										</div>
										<div class="event-desc">
											<h6>Event Description</h6>
											<p>
												<?php echo $event['description']; ?>
											</p>
										</div>
										<div class="event-loc">
											<?php
											if (strlen($location) != 0) {
												echo '<h6>Event Location</h6><span><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $location . '</span></br>';
											}
											?>
<?php if (strlen($location) != 0){?>										
<iframe
  width="100%"
  height="350"
  style="border:0"
  loading="lazy"
  allowfullscreen
  referrerpolicy="no-referrer-when-downgrade"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCB6Xoj-0ouo4IZ-QwOWBFdqIU-8DqOuVs
    &q=<?php echo $location;?>">
</iframe>
<?php } ?>

											</br></br>
											<?php
											if ($is_live) {
												echo '<a href="' . URL_Make('/event-live/' . $u) . '" title="" class="main-btn">Join Now</a>';
											}
											?>

										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<aside class="sidebar static right">
										<div class="widget">
											<h4 class="widget-title">Date</h4>
											<span><?php echo date_format(date_create($session['date']), 'd M Y'); ?> at <b><?php echo $session['time']; ?></b></span>
											<br></br>
											<h4 class="widget-title">Location</h4>
											<span><i class="fa fa-map-marker"></i>
												<?php
												if (strlen($location) != 0) {
													echo $location;
												}
												?>
											</span>
											<br></br>
											<a id='join' title="" class="main-btn">Join Now</a>
										</div>
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
	<div class="popup-wraper" id='archieved'>
		<div class="popup" style='width:800px'>
			<div class="popup-meta">
				<div class="ver-center">
					<div class="reg-from">
						<span>Thank you!</span>
						<p>We have registered you for this event! Please wait till the host confirms your request.</p>
						<center><button class="main-btn" id='continue' type="submit">Continue</button></center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/map-init.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
	<script>
		$(document).ready(function(){
		    $('#join').click(function(){
		        $('#archieved').addClass('active');
		    })
		    $('#continue').click(function(){
		        $('#archieved').removeClass('active');
		    })
			<?php
			if ($post_event) {
				//echo "$('#archieved').addClass('active');";
				?>
				//window.location="<?php URL('/event-live/' . $u);?>";
			    <?php
			}	
			?>
			$('#archieved-form').submit(function(e){
				e.preventDefault();
				window.location="<?php URL('/event-live/' . $u);?>";
			})
			
		})
	</script>
</body>

</html>