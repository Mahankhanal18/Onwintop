<?php
include "init.php";
$db = new Database();
$s = "SELECT * FROM `files` WHERE `community_id`='" . $community_id . "' ORDER BY `id` DESC ";
$data = $db->RetriveArray($s);
$raw = array();
foreach ($data as $d) {
	$type = 'video';
	$thumb = $d['thumbnail'];
	if(strlen($thumb)==0){
		$thumb='https://res.cloudinary.com/demo/image/fetch/w_208,h_258,c_thumb,q_95,f_jpg/'.$d['url'];
	}
	$temp = array(
		"name" => $d['name'],
		"category" => json_decode($d['category'],true),
		"type" => $type,
		"link" => URL_Make("/file/".$d['id']),
		"thumbnail" => $thumb,
		"description" => $d['description'],
		"url" => $d['url']
	);
	array_push($raw, $temp);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Files | Community</title>
	<?php include "includes/head.php"; ?>
	<style>
		.filter:hover {
			cursor: pointer;
		}
	</style>
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
										<h4 class="main-title">Files</h4>
										<ul class="category">
											<?php
											//get community id
											$c = "SELECT * FROM `communities` WHERE `link`='" . $community_id . "' ";
											$com=$db->RetriveSingle($c);
											$s = "SELECT * FROM `files_filters` WHERE `community_id`='" . $com['id'] . "' ";
											$filters = $db->RetriveArray($s);
											foreach ($filters as $filter) {
												echo '<li><a class="filter mt-1" data-name="' . $filter['id'] . '">' . $filter['name'] . '</a></li>';
											}
											?>
											<li><a class="filter mt-1" data-name="">Reset x</a></li>

										</ul>
										<div class="row col-xs-6" id='files'>
											


										</div>
									</div>
									<!--<div class="load mb-5 mt-1">
										<ul class="pagination">
											<li><a title="" href="#"><i class="icofont-arrow-left"></i></a></li>
											<li><a title="" href="#" class="active">1</a></li>
											<li><a title="" href="#">2</a></li>
											<li><a title="" href="#">3</a></li>
											<li><a title="" href="#">4</a></li>
											<li><a title="" href="#">5</a></li>
											<li>....</li>
											<li><a title="" href="#">10</a></li>
											<li><a title="" href="#"><i class="icofont-arrow-right"></i></a></li>
										</ul>
									</div>-->

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
	<script src="<?php URI("js/script.js"); ?>"></script>
	<script>
		$(document).ready(function() {
			var str = '<?php echo json_encode($raw); ?>';
			var data = JSON.parse(str);
			filter = '';
			ProcessFiles();
			$('.filter').click(function() {
				filter = $(this).attr('data-name');
				ProcessFiles();
			})

			function ProcessFiles() {
				ele = '';
				if (filter.length != 0) {
					ele = '';
					for (i = 0; i < data.length; i++) {
						if(data[i].category.includes(filter)){
							obj=data[i];
							ele+='<div class="col-lg-3 col-md-3 col-sm-6"><div class="book-post"><figure><a href="'+obj.link+'" title=""><div style="height:258px !important;width:100%;background-image:url('+obj.thumbnail+');border-radius:10px" alt=""></div></a></figure><a href="'+obj.link+'" title="">'+obj.name+'</a></div></div>';
						}
					}
				} else {
					ele = '';
					for (i = 0; i < data.length; i++) {
						obj=data[i];
						ele+='<div class="col-lg-3 col-md-3 col-sm-6"><div class="book-post"><figure><a href="'+obj.link+'" title=""><div style="height:258px !important;width:100%;background-image:url('+obj.thumbnail+');background-position:center;border-radius:10px"></div></a></figure><a href="'+obj.link+'" title="">'+obj.name+'</a></div></div>';
					}
				}
				$('#files').html(ele);
			}
		})
	</script>

</body>

</html>