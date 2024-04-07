<?php
include "init.php";
?>
<!DOCTYPE html>
<?php
setcookie('reactions', '[{"views":23}]', time() + (86400 * 90), "/");
?>
<html lang="en">

<head>
	<title>Videos |
		<?php echo $title; ?>
	</title>
	<?php include "includes/head.php"; ?>
	<link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
		integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
		integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
		integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.new-comment form button i {
			transform: rotate(1deg) !important;
		}

		.vjs-big-play-centered .vjs-big-play-button {
			top: 50%;
			left: 50%;
			border-radius: 50%;
			margin-top: -0.81666em;
			margin-left: -1.5em;
		}

		.video-js .vjs-big-play-button {
			display: none;
		}

		.slick-next:before,
		.slick-prev:before {
			font-family: slick;
			font-size: 33px;
			line-height: 1;
			opacity: 0.5;
			color: #000000;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}


		.slick-next,
		.slick-prev {
			top: 34%;
			text-shadow: 1px 1px 5px #000000;
		}

		.slick-prev {
			left: -14px;
			position: absolute;
			z-index: 30;
		}

		.slick-next {
			right: -14px;
			position: absolute;
			z-index: 30;
		}
	</style>
	<?php
	function GetViews($id){
		$report_file=file_get_contents($id);
		$report=json_decode($report_file,true);
		return count($report['views']);
	}
	?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
	<div class="theme-layout">
		<?php include "includes/header2.php"; ?>

		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap">
				<div class="container px-5">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-12">
								
									<?php
									$admin_login=false;
									if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) { $admin_login=true;  ?>
										<a href='<?php URL('/video-projects'); ?>' class='btn btn-primary mb-2 mt-3 px-3'
											style="border-radius:0px;background-color:var(--primary-color);border:none">
											<i class="icofont-gear mr-1"></i> Generate More Videos</a>
										<p class='text-secondary'>We can help you to generate more branded videos faster</p>
									<?php } ?>

									<div class="main-wraper px-5 py-4" style="font-family: 'Roboto', sans-serif;">
										<div class="featured">
											<?php
												$fcount=R::count("featuredvideo");
												if($fcount!=0){
													$featured=R::findOne("featuredvideo","LIMIT 1");
													$vid=R::findOne("videos","id=?",[$featured['video_id']]);?>
													<div class="featured-video"
														style="overflow: hidden;position: relative;" poster="<?php echo $vid['thumbnail']; ?>">
														<?php
                                                        $image = $vid['video_layer'];
                                                        $uri = base64_encode($image);
                                                        $template = "l_fetch:" . $uri . "/fl_layer_apply";

                                                        $parts = explode("/", $vid['url']);
                                                        $last = $parts[count($parts) - 1];

                                                        $video_url = "https://res.cloudinary.com/tellselling/video/upload/b_blurred:400:15,c_pad,h_445,w_791/" . $template . "/" . $last;
                                                        ?>
														<video id="my-video" style="border-radius:10px"
															class="video-js vjs-layout-medium vjs-big-play-centered" controls
															preload="auto" fluid="true" data-setup='{}'>
															<source src="<?php echo $video_url; ?>" type="video/mp4" />
														</video>
													</div>
													<div class="featured-details px-4" style="flex:1">
														<h5 style="color:#242424;"><b><?php echo $vid['title'];?></b></h5>
														<p style="margin-top:8px;font-size:13px" class='text-secondary'><?php echo GetViews($vid['report']);?>
															views <i style="margin-left:5px;margin-right:5px">•</i> <?php echo DateAgo($vid['date']);?>
														</p>
														<p><?php echo $vid['description'];?> </p>
													</div>
												<?php }
											?>
											<!---->
											<div class="upload px-2 text-center">
												<?php
												$have_projects=false;
												$last_count=R::count("videoprojects","community_id=? ORDER BY id DESC LIMIT 1",[$community_id]);
												$last=R::findOne("videoprojects","community_id=? ORDER BY id DESC LIMIT 1",[$community_id]);
												
													if ($last_count!=0 && isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) { ?>
														<?php $pc=R::count("videos","community_id=? AND status=?",[$community_id,'Pending']);?>

														<img onclick="window.location='<?php echo URL_Make('/upload-invitation/'.$last['link']);?>'" style="border: 1px solid #ebebeb;border-radius:5px;width:250px;cursor:pointer"
													src='<?php URI('images/video-upload-btn.png') ?>' /></br></br>
												<small>Share your unique perspective and upload your</br> captivating
													video clips today, and let your video inspire</br> and amaze others
													while earning endless rewards.</small></br>
													<a href='<?php URL('/pending-videos'); ?>' class='btn btn-primary mb-2 mt-3 px-3'
															style="border-radius:0px;background-color:var(--primary-color);border:none"><i class="icofont-database-add mr-2"></i>Pending Videos <span style="<?php if($pc==0) echo 'display:none;';?>" class="badge badge-light"><?php echo $pc;?></span></a>
														
													<?php } ?>
													
													
											</div>

										</div>

										<?php
										$count=0;
										$projects=R::findAll("videoprojects","community_id=?",[$community_id]);
										foreach ($projects as $pro) {
											$datas = R::findAll("videos", "project_id=? AND status=?", [$pro['link'], 'Active']);
											if (count($datas) != 0) {
                                                $brand = R::findOne("videobrandings", "link=?", [$pro['link']]);
											?>
											<div class="videos py-3 mt-4" style="border-top:1px solid #ebebeb;border-bottom:1px solid #ebebeb">
												<h6>
													<b><?php echo $pro['name']?></b>
													<span onclick="window.location='<?php URL('/video-campaign/'.$pro['link']); ?>';"
														class='ml-3' style="cursor:pointer;">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														<b>View all</b>
													</span>
												</h6>
												<div class="playlist mt-2">
													<div class="your-class">
														<?php
														
														foreach($datas as $data){
															echo '
															<a href="' . URL_Make('/video/'.$pro['link']."/".base64_encode($data['id'])) . '" class="m-1">
																<img style="border-radius:5px;width:100%;height:auto"
																	src="'.$url.$data['thumbnail'].'" />
																<b class="single-line" style="margin-top:8px">'.$data['title'].'</b></br>
																<small class="text-secondary">'.$pro['name'].'</small></br>
																<small>'.GetViews($data['report']).' views <i style="margin-left:5px;margin-right:5px">•</i>'.DateAgo($data['date']).'</small>
															</a>
															';
															$count++;
														}

														if(count($datas)<=6){
															$i=0;
															while($i<=6){
																foreach($datas as $data){
																	echo '
																	<a href="' . URL_Make('/video/'.$pro['link']."/".base64_encode($data['id'])) . '" class="m-1">
																		<img style="border-radius:5px;width:100%;height:auto"
																			src="'.$url.$data['thumbnail'].'" />
																		<b class="single-line" style="margin-top:8px">'.$data['title'].'</b></br>
																		<small class="text-secondary">'.$pro['name'].'</small></br>
																		<small>'.GetViews($data['report']).' views <i style="margin-left:5px;margin-right:5px">•</i>'.DateAgo($data['date']).'</small>
																	</a>
																	';
																}
																$i++;
															}
															
														}
														

														?>
													</div>
												</div>
											</div>
											<?php }
										}
										?>

										<?php 
										if($count==0){
											echo '
											<div class="row">
												<div class="col-md-12 p-5 text-center">
													<img src="'.$url.'images/empty-video.png" style="height:140px;margin-bottom:40px;width:auto"/>
													<h3 class="text-secondary">It seems the playlist is empty!</h3>
												</div>
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
			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
	<script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.1/Youtube.min.js"
		integrity="sha512-W11MwS4c4ZsiIeMchCx7OtlWx7yQccsPpw2dE94AEsZOa3pmSMbrcFjJ2J7qBSHjnYKe6yRuROHCUHsx8mGmhA=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		var player = videojs('my-video');
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
		integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		$(document).ready(function () {
			$('.your-class').slick({
				slidesToShow: 6,
				slidesToScroll: 1,
				autoplay: true,
				arrows: true,
				prevArrow: "<img class='slick-prev' style='height:38px;width:38px' src='<?php URI('/images/arrow-left.png'); ?>'/>",
				nextArrow: "<img class='slick-next' style='height:38px;width:38px' src='<?php URI('/images/arrow-right.png'); ?>'/>",
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 6,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					}
				]
			});
			$('.comment-form').on('submit', function (e) {
				e.preventDefault();
				if (AuthWarning()) {
					formData = new FormData(this);
					var object = {};
					formData.forEach(function (value, key) {
						object[key] = value;
					});
					object['time'] = '<?php echo date('h:ia'); ?>';
					object['date'] = '<?php echo date('Y-m-d'); ?>';
					object['name'] = '<?php echo $_SESSION['credentials']['first_name'] . " " . $_SESSION['credentials']['last_name']; ?>';
					object['user_id'] = '<?php echo $_SESSION['credentials']['id']; ?>';
					var json = JSON.stringify(object);
					$.ajax({
						url: '<?php echo $url . "api/reactions.php"; ?>',
						type: 'POST',
						method: 'POST',
						data: {
							method: 'Comment',
							content_id: object['id'],
							data: json,
						},
						success: function (data) {
							$('.comment-form')[0].reset();
							ReloadComments(object['id']);
						}
					})
				}

			})

			function ReloadComments(content_id) {
				$.ajax({
					url: '<?php echo $url . "widgets/load_comments.php"; ?>',
					method: 'POST',
					type: 'POST',
					data: {
						content_id: content_id
					},
					success: function (data) {
						$('#comments_' + content_id).html(data);
					}
				})
			}
		})
	</script>
</body>

</html>