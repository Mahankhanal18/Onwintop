<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Channels - <?php echo $title; ?></title>
	<?php include "includes/head.php"; ?>
	<?php
	$s = "SELECT * FROM `channels` WHERE `link`='" . $_SESSION['path'] . "' ";
	$channel = $db->RetriveSingle($s);


	$s = "SELECT * FROM `contents` WHERE `community_id`='" . $community_id . "' ";
	$all_contents = $db->RetriveArray($s);

	?>
	<style>
		.single-line {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
	</style>
</head>

<body>
	<!-- <div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div> -->
	<div class="theme-layout">
		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>
		<div class="gap no-gap">
			<div class="top-area mate-black low-opacity">
				<div class="bg-image" style="background-image: url(<?php echo $channel['thumbnail']; ?>)"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="post-subject">
								<div class="university-tag">
									<div class="uni-name">
										<h4><?php echo $channel['name']; ?> </h4>
									</div>
									<ul class="sharing-options">
										<li><a title="Follow" href="#" data-toggle="tooltip"><i class="icofont-star"></i></a> </li>
										<li><a title="Share" href="#" data-toggle="tooltip"><i class="icofont-share-alt"></i></a> </li>
									</ul>
								</div>
								<ul class="nav nav-tabs post-detail-btn">
									<li class="nav-item"><a class="active" href="#content" data-toggle="tab">Content</a></li>
									<li class="nav-item"><a class="" href="#members" data-toggle="tab">Members</a><span></span></li>
									<li class="nav-item"><a class="" href="#contributors" data-toggle="tab">Contributors</a><span></span></li>
									<li class="nav-item"><a class="" href="#about" data-toggle="tab">About</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- top Head -->
		<section>
			<div class="gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-12">
									<div class="tab-content">
										<div class="tab-pane fade active show" id="content">
											<div class="main-wraper" id='contents_holder'>
												<div id='demo'></div>
												<div class="row" id='wrapper'>

													<?php

													$i = 0;
													foreach ($all_contents as $content) {
														$channels = json_decode($content['channel_id'], true);

														if (in_array($channel['id'], $channels)) {
															$reactions = count(json_decode($content['reactions']));
															$shares = count(json_decode($content['shares']));
															$description = "";
															$thumbnail_url = "";
															$sub = '';
															if ($content['type'] == "File") {
																$d = "SELECT * FROM `files` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['thumbnail'];
																$description = $con['description'];
																$sub = 'file';
															}
															if ($content['type'] == "Video") {
																$d = "SELECT * FROM `videos` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['thumbnail'];
																$description = $con['description'];
																$sub = 'video';
															}
															if ($content['type'] == "Solution") {
																$d = "SELECT * FROM `solutions` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['thumbnail'];
																$description = $con['short_description'];
																$sub = 'solution';
															}
															if ($content['type'] == "Blog") {
																$d = "SELECT * FROM `blogs` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['cover'];
																$description = strip_tags($con['post']);
																$sub = 'blog';
															}
													?>
															<div class="col-lg-4 col-md-4 col-sm-6 content">
																<div class="event-post mb-3">
																	<figure><a href="<?php URL('/' . $sub . '/' . $content['data_id']) ?>" title=""><img class='lazy thumbnail2' src='https://via.placeholder.com/360x150?text=Loading' data-src="<?php echo $thumbnail_url; ?>" alt=""></a></figure>
																	<div class="event-meta">
																		<span><?php echo date_format(date_create($content['modification_date']), 'M, d Y'); ?></span>
																		<h6 class='single-line'><a href="<?php URL('/' . $sub . '/' . $content['data_id']) ?>" title=""><?php echo $content['name']; ?> </a></h6>
																		<p class='single-line'><?php echo $description; ?></p>

																		<a href="#" title="" class="shop-btn">Category : <?php echo $content['type']; ?></a>
																		<div class="share-info">
																			<span><?php echo $shares ?> Shares</span>
																			<span><?php echo $reactions ?> Likes</span>
																		</div>
																		<div class="stat-tools">
																			<div class="box">
																				<div class="Like"><a class="Like__link"><i class="icofont-like"></i> Like</a>
																					<div class="Emojis">
																						<div class="Emoji Emoji--like">
																							<div class="icon icon--like"></div>
																						</div>
																						<div class="Emoji Emoji--love">
																							<div class="icon icon--heart"></div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="box">
																				<div class="Emojis">
																					<div class="Emoji Emoji--like">
																						<div class="icon icon--like"></div>
																					</div>
																					<div class="Emoji Emoji--love">
																						<div class="icon icon--heart"></div>
																					</div>
																				</div>
																			</div>
																			<a title="" href="#" class="share-to"><i class="icofont-share-alt"></i> Share</a>
																		</div>
																	</div>
																</div>
															</div>

													<?php
														}
													} ?>
												</div>

												<div class="load mt-0 mb-5">

													<!--<ul class="pagination">
														<li><a title="" href="#"><i class="icofont-arrow-left"></i></a></li>
														<li><a title="" href="#" class="active">1</a></li>
														<li><a title="" href="#">2</a></li>
														<li><a title="" href="#">3</a></li>
														<li><a title="" href="#">4</a></li>
														<li><a title="" href="#">5</a></li>
														<li><a title="" href="#">10</a></li>
														<li><a title="" href="#"><i class="icofont-arrow-right"></i></a></li>
													</ul>-->
												</div>


											</div>


										</div>

										<div class="tab-pane fade" id="members">
											<div class="row col-xs-6 merged-10 lazy">



												<?php
												$members = $db->RetriveArray("SELECT * FROM `members` WHERE `community_id`='" . $_SESSION['community_id'] . "' ");
												foreach ($members as $member) {
													echo '
														<div class="col-lg-4 col-md-4 col-sm-6">
															<div class="friendz">
																<figure><img class="lazy" src="https://via.placeholder.com/200x200?text=Loading" data-src="https://ui-avatars.com/api/?name=' . $member['first_name'] . " " . $member['last_name'] . '&background=random" alt=""></figure>
																<span><a href="' . URL_Make('/member/' . $member['id']) . '" title="">' . $member['first_name'] . " " . $member['last_name'] . '</a></span>
																<ins>' . $member['role'] . '</ins>
																<a href="' . URL_Make('/member/' . $member['id']) . '" title="" data-ripple=""><i class="icofont-star"></i>Follow</a>
															</div>
														</div>
														';
												}
												if (count($members) >= 2000) {
													echo '
														<div class="col-lg-4 col-md-4 col-sm-6">
															<div class="friendz">
																<figure><img class="lazy" src="https://via.placeholder.com/200x200?text=Loading" data-src="https://ui-avatars.com/api/?name=' . $member['first_name'] . " " . $member['last_name'] . '&background=random" alt=""></figure>
																<span><a href="' . URL_Make('/member/' . $member['id']) . '" title="">' . $member['first_name'] . " " . $member['last_name'] . '</a></span>
																<ins>' . $member['role'] . '</ins>
																<a href="' . URL_Make('/member/' . $member['id']) . '" title="" data-ripple=""><i class="icofont-star"></i>Follow</a>
															</div>
														</div>
														';
												}
												?>
												<!--
												<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?profile" alt=""></figure>
														<span><a href="profile.html" title="">Muhammad Khan</a></span>
														<ins>Oxford University, UK</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i> Unfollow</a>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?girl" alt=""></figure>
														<span><a href="profile.html" title="">Sadia Gill</a></span>
														<ins>WB University, USA</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i> Unfollow</a>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?boy" alt=""></figure>
														<span><a href="profile.html" title="">Rjapal</a></span>
														<ins>Km University, India</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i> Unfollow</a>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="sp sp-bars"></div>
												</div>-->
											</div>
										</div>
										<div class="tab-pane fade" id="contributors">
											<div class="row merged-10 col-xs-6">
												<!--<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?employee" alt=""></figure>
														<span><a href="profile.html" title="">Amy Watson</a></span>
														<ins>Bz University, Pakistan</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i>Unfollow</a>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?profile" alt=""></figure>
														<span><a href="profile.html" title="">Muhammad Khan</a></span>
														<ins>Oxford University, UK</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i> Unfollow</a>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?girl" alt=""></figure>
														<span><a href="profile.html" title="">Sadia Gill</a></span>
														<ins>WB University, USA</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i> Unfollow</a>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6">
													<div class="friendz">
														<figure><img src="https://source.unsplash.com/random/250x250/?boy" alt=""></figure>
														<span><a href="profile.html" title="">Rjapal</a></span>
														<ins>Km University, India</ins>
														<a href="#" title="" data-ripple=""><i class="icofont-star"></i> Unfollow</a>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="sp sp-bars"></div>
												</div>-->
											</div>
										</div>

										<div class="tab-pane fade " id="about">
											<div class="main-wraper">
												<h3 class="main-title">About</h3>
												<div class="lang">

													<span>Description </span>
												</div>


											</div>

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

	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<?php include "includes/scripts.php"; ?>
	<script src='https://pagination.js.org/dist/2.1.5/pagination.min.js'></script>
	<script>
		var myLazyLoad = new LazyLoad();
		$(document.ready(function() {
			$('#demo').pagination({
				dataSource: [1, 2, 3, 4, 5, 6, 7, 34, 23, 34, 45, 46, 7, 45, , 343, 4, 4, 6, 5, 55, 34, 3, 45, 45, 100],
				pageSize: 8,
				formatResult: function(data) {
					var result = [];
					for (var i = 0, len = data.length; i < len; i++) {
						result.push(data[i] + ' - good guys');
					}
					return result;
				},
				callback: function(data, pagination) {
					// template method of yourself
					var html = template(data);
					dataContainer.html(html);
				}
			})
		}))
	</script>
	<script src='https://pagination.js.org/dist/2.1.5/pagination.min.js'></script>




</body>

</html>