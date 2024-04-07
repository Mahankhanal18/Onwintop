<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include "init.php";
//$searches=json_decode($_COOKIE['search'],true);

//print_r($_COOKIE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        $db=new Database();
        $parts=URL_Parts();
        $keywords=explode("=",$parts[5]);
        $keyword=$keywords[1];
        //array_push($searches,$keyword);
        //print_r($searches);
        //setCookieData('search',$searches,1);
        //setcookie('search', $searches, time() + (86400 * 90), "/");
        $community_id=$_SESSION['community_id'];
        
        $f="SELECT * FROM `files` WHERE `name` LIKE '%".$keyword."%' AND `community_id`='".$community_id."' ";
        $files=$db->RetriveArray($f);
        //$files=R::findAll("files");
        
        $v="SELECT * FROM `videos` WHERE `name` LIKE '%".$keyword."%' AND `community_id`='".$community_id."' ";
        $videos=$db->RetriveArray($v);
        
        $e="SELECT * FROM `events` WHERE `name` LIKE '%".$keyword."%' AND `community_id`='".$community_id."' ";
        $events=$db->RetriveArray($e);

    ?>
    <title><?php echo $keyword;?> - Search Result | <?php echo $title;?> </title>
    <?php include "includes/head.php"; ?>
    <style>
        #share-buttons img {
            height: 30px !important;
            width: auto;
        }
    </style>
</head>

<body>
    <!-- page loader<div class="page-loader" id="page-loader">

        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>

    </div> -->
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>
        <?php include "includes/nav.php"; ?>
        


    <section>
		<div class="top-area high-opacity"  style="<?php if($mobile) echo 'padding-left:0px !important;'; else echo 'padding-left:350px;';?>">
			<div class="bg-image" style="background-image: url(<?php echo $root;?>images/banner.jpg)"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="post-subject">
							<div class="university-tag">
								<div class="Search-result">
									<h4>Search Result for <strong>"<?php echo $keyword;?>"</strong></h4>
								</div>
							</div>

							<ul class="nav nav-tabs post-detail-btn">
                            	<li class="nav-item"><a class="active" href="#allposts" data-toggle="tab">All Content</a></li>
                                <li class="nav-item"><a class="" href="#events" data-toggle="tab">Events</a></li>
								<li class="nav-item"><a class="" href="#files" data-toggle="tab">Files</a></li>
								<li class="nav-item"><a class="" href="#videos" data-toggle="tab">Videos</a></li>
                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section>
		<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div id="page-contents" class="row merged20">
							<div class="col-lg-12">
								<div class="tab-content">
								    <div class="tab-pane fade active show" id="allposts">
										<div class="main-wraper">
											<h4 class="main-title">Files <a href="<?php echo URL('/files');?>" title="">view all</a></h4>
											<div class="row merged-10 remove-ext20">
												
												
												<?php
												foreach($files as $file){
												    echo '
												    <div class="col-lg-4 col-md-4 col-sm-4">
    													<div class="images-post">
    														<a class="uk-inline" href="'.URL_Make('/file/').$file['id'].'">
    															<img style="width:100%;height:225px" src="'.$file['thumbnail'].'" alt="">
    														</a>
    													</div>
    												</div>
												    ';
												}
												if(count($file)==0){
												    echo "<div class='col-md-12 p-4'>
												        <center>No Content Found</center>
												    </div>";
												}
												
												?>
												
												
											</div>
										</div><!-- photos -->
										<div class="main-wraper">
											<h4 class="main-title">Videos <a href="<?php echo URL('/videos');?>" title="">view all</a></h4>
											<div class="row merged-10 remove-ext20">
												
												<?php
												foreach($videos as $video){
												    echo '
    												<div class="col-lg-4 col-md-4 col-sm-4">
    													<div class="video-posts">
    														<img style="width:100%;height:200px" src="'.$video['thumbnail'].'" alt="">
    														<a class="play-btn" data-fancybox="" href="'.$video['url'].'"><i class="icofont-play"></i></a>
    													</div>
    												</div>
												    ';
												}
												if(count($videos)==0){
												    echo "<div class='col-md-12 p-4'>
												        <center>No Content Found</center>
												    </div>";
												}
												
												?>
												
												
											</div>
										</div><!-- videos -->



								    </div>
								  	<div class="tab-pane fade" id="depart">

									</div>
									
								  	<div class="tab-pane fade" id="members">


									</div>
									<div class="tab-pane fade" id="events">
										<div class="main-wraper">
											<h4 class="main-title">Events <a href="<?php echo URL('/events');?>" title="">view all</a></h4>
											<div class="row merged-10 remove-ext20">
												<?php
												foreach($events as $event){
												    echo '
												    <div class="col-lg-4 col-md-4 col-sm-4">
    													<div class="images-post">
    														<a class="uk-inline" href="'.URL_Make('/event/').$event['url'].'">
    															<img style="width:100%;height:150px" src="'.$event['cover'].'" alt="">
    														</a>
    													</div>
    												</div>
												    ';
												}
												if(count($file)==0){
												    echo "<div class='col-md-12 p-4'>
												        <center>No Event Found</center>
												    </div>";
												}
												
												?>
											</div>
										</div>
									</div>
									
									<div class="tab-pane fade" id="files">
										<div class="main-wraper">
											<h4 class="main-title">Files <a href="<?php echo URL('/files');?>" title="">view all</a></h4>
											<div class="row merged-10 remove-ext20">
												<?php
												foreach($files as $file){
												    echo '
												    <div class="col-lg-4 col-md-4 col-sm-4">
    													<div class="images-post">
    														<a class="uk-inline" href="'.URL_Make('/file/').$file['id'].'">
    															<img style="width:100%;height:225px" src="'.$file['thumbnail'].'" alt="">
    														</a>
    													</div>
    												</div>
												    ';
												}
												if(count($file)==0){
												    echo "<div class='col-md-12 p-4'>
												        <center>No Content Found</center>
												    </div>";
												}
												
												?>
											</div>
										</div>
									</div>
									
									
									<div class="tab-pane fade" id="videos">
										<div class="main-wraper">
											<h4 class="main-title">Videos <a href="<?php echo URL('/videos');?>" title="">view all</a></h4>
											<div class="row merged-10 remove-ext20">
												
												<?php
												foreach($videos as $video){
												    echo '
    												<div class="col-lg-4 col-md-4 col-sm-4">
    													<div class="video-posts">
    														<img style="width:100%;height:200px" src="'.$video['thumbnail'].'" alt="">
    														<a class="play-btn" data-fancybox="" href="'.$video['url'].'"><i class="icofont-play"></i></a>
    													</div>
    												</div>
												    ';
												}
												if(count($videos)==0){
												    echo "<div class='col-md-12 p-4'>
												        <center>No Content Found</center>
												    </div>";
												}
												
												?>
												
											</div>

										</div>
									</div>
								</div>

							</div>
							<div class="col-lg-4">

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
    <script>
        $(document).ready(function(){
            $('#live').on('submit',function(e){
                e.preventDefault();
                window.location='<?php echo $u?>';
            })
        })
    </script>

</body>

</html>