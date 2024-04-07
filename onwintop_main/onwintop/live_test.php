<?php
include "init.php"; 
$db=new Database();
$s = "SELECT * FROM `events` WHERE `community_id`='" . $community_id . "' AND `url`='" . $_SESSION['path'] . "' ";
$db = new Database();
$event = $db->RetriveSingle($s);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Tellselling | We help you grow digitally</title>
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
			<div class="gap no-gap">
				<?php
				$credentials = $_SESSION['credentials'];
				$name = $credentials['first_name'] . " " . $credentials['last_name'];
				$user_id = $credentials['id'];
				$event_id = '29';

				//decode video
				$videos=json_decode($event['sessions'],true);
				$video=$videos[0];
				$youtube=$video['url'];
				
				?>
				<div class="container-fluid no-pad">
					<div class="row no-gutters">
						<!--<div class="col-lg-2">
							<div class="side-area">
								<ul class="side-links">
									<li><a class="active" href="#" title=""><i class="icofont-video-cam"></i> Live Stream</a></li>

									<li><a href="#" title=""><i class="icofont-comment"></i> Files</a></li>
								</ul>
							</div>
						</div>-->
						<div class="col-lg-9">
							<div class="screen-area mt-3 pd-20">
								<!--<div id="my_camera"></div>-->
								<iframe allow='autoplay' style='width:100%;height:100%' src="<?php echo $youtube;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<!--<div class="stream-controls">
									<ul>
										<li><i class="icofont-users-alt-3"></i> Participants <span>2</span></li>
										<li><i class="icofont-record"></i> Mute</li>
										<li><i class="icofont-video"></i> Stop video</li>
										<li><i class="icofont-dotcms"></i> Record Video</li>
										<li><i class="icofont-comment"></i> Chat</li>
										<li><i class="icofont-slidshare"></i> Share Screen</li>
									</ul>
								</div>-->
							</div>
						</div>
						<div class="col-lg-3">

							<div class="livestream-chat">
								<div class="livechat-head">
									<h5><i class="icofont-live-support"></i> Live Chat</h5>
									<div class="more">
										<div class="more-post-optns">
											<i class="">
												<svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
													<circle r="1" cy="12" cx="12" />
													<circle r="1" cy="12" cx="19" />
													<circle r="1" cy="12" cx="5" />
												</svg></i>
											<ul>
												<li>
													<i class="icofont-user-alt-3"></i> Participants
													<span>How many user are live with you</span>
												</li>
												<li>
													<i class="icofont-external-link"></i> Popout chat
													<span>Open chat in new tab</span>
												</li>
												<li>
													<i class="icofont-ban"></i> Hide Chat
													<span>Hide chat from Your side</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="chat-content">
									<div class="date"><?php echo date('D d, M'); ?></div>
									<ul class="chatting-area max-height">

										<!--<li class="me">
											<figure><img src="<?php URI('images/resources/userlist-1.jpg'); ?>" alt=""></figure>
											<p>i know him 5 years ago</p>
										</li>
										<li class="you">
											<figure><img src="<?php URI('images/resources/userlist-2.jpg'); ?>" alt=""></figure>
											<p>coooooooooool dude ;)</p>
										</li>-->
									</ul>
								</div>
								<form method="post" id='comment' class="text-bottom">
									<textarea id="emojionearea2" placeholder="wirte someting"></textarea>
									<button class="button btn-soft-success" style='float:right;margin-top:10px'>Send</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
	<script>
		$(document).ready(function() {

			//get live chat
			Pusher.logToConsole = true;

			var pusher = new Pusher('04e73173b63e9ab850b8', {
				cluster: 'ap2'
			});

			var channel = pusher.subscribe('test_channel');
			channel.bind('test_data', function(data) {

				chat = data
				console.log(chat);
				ele = '';
				if (chat.user_id == '<?php echo $user_id ?>') {
					ele = '<li class="me"><figure><img src="' + chat.thumbnail + '" alt=""></figure><p>' + chat.message + '</p></li>';
				} else {
					ele = '<li class="you"><figure><img src="' + chat.thumbnail + '" alt=""></figure><p>' + chat.message + '</p></li>';
				}
				$('.chatting-area').append(ele);
				var elem = document.getElementsByClassName('chatting-area');
				elem.scrollTop = elem.scrollHeight;
			});


			LoadChats();

			function LoadChats() {
				$.ajax({
					url: '<?php echo $root; ?>api/chat.php',
					type: 'POST',
					method: 'POST',
					data: {
						"method": "GET_COMMENT",
						"event_id": '<?php echo $event_id ?>'
					},
					success: function(data) {
						var res = JSON.parse(data);
						console.log(data);
						$('.chatting-area').html('');
						for (i = 0; i < res.length; i++) {
							chat = res[i];
							ele = '';
							if (chat.user_id == '<?php echo $user_id ?>') {
								ele = '<li class="me"><figure><img src="' + chat.thumbnail + '" alt=""></figure><p>' + chat.message + '</p></li>';
							} else {
								ele = '<li class="you"><figure><img src="' + chat.thumbnail + '" alt=""></figure><p>' + chat.message + '</p></li>';
							}
							$('.chatting-area').append(ele);
							var elem = document.getElementsByClassName('chatting-area');
							elem.scrollTop = elem.scrollHeight;

							$(".chatting-area").animate({
								scrollTop: $('.chatting-area').get(0).scrollHeight
							}, 2000);
						}
					}
				})
			}
			/*var key = window.event.keyCode;*/
			$('#comment').on('submit', function(e) {
				e.preventDefault();
				comm = $('#emojionearea2')[0].emojioneArea.getText();
				$.ajax({
					url: '<?php echo $root; ?>api/chat.php',
					type: 'POST',
					method: 'POST',
					data: {
						"method": "PUT_COMMENT",
						"name": '<?php echo $name; ?>',
						"user_id": '<?php echo $user_id; ?>',
						"message": comm,
						"event_id": '<?php echo $event_id ?>',
						"thumbnail": 'https://ui-avatars.com/api/?name=<?php echo $name; ?>&background=random'
					},
					success: function(data) {
						$('#emojionearea2')[0].emojioneArea.setText('');
						LoadChats();
					}
				})
			})
		})
		/*
		$name=$credentials['first_name']." ".$credentials['last_name'];
						$user_id=$credentials['id'];
						$event_id='29';
		*/
	</script>

	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
	<script src="<?php URI("js/webcam.min.js"); ?>"></script>
	<script src="<?php URI("js/jquery.wizard-init.js"); ?>"></script>
	<script src="<?php URI("js/jquery.wizard.js"); ?>"></script>



</body>

</html>