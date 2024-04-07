<?php include "init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blogs | <?php echo $title; ?></title>
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
    <?php include "includes/head.php"; ?>
    <style>
        .daywise:hover {
            cursor: pointer;
        }
        .blank-wrapper {
            background: #fafafa00 none repeat scroll 0 0 !important;
            border: 1px solid #e1e8ed00 !important;
            border-radius: 5px;
            display: block;
            margin-bottom: 30px;
            padding: 15px 20px 20px;
            position: relative;
            width: 100%;
            z-index: 9;
        }
        .simple-pagination {
			margin-top:40px;
			margin-left: 30%;
		}
		h6:hover{
		    cursor:pointer;
		    border-bottom:3px solid #000000;
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
            <div class="gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Pending Blogs</div>
                                        <div class='row wrapper'>
                                            <div class='col-md-12 mb-3' style="display:inline">
                                                    <h6 onclick="window.location='<?php URL('/view-blogs');?>'" style="float:left;font-weight:500;">All</h6>
                                                    <h6 onclick="window.location='<?php URL('/pending-blogs');?>'" style="float:left;margin-left:20px;font-weight:500;border-bottom:3px solid #000000;">To be published</h6>
                                            </div>
                                        </div>
                                        <div class="row wrapper">
                                            <?php
                                            
                                            //
                                            if(isset($_GET['publish'])){
                                                $blog=R::findOne("blogs","id=?",[$_GET['publish']]);
                                                $blog->status="Active";
                                                R::store($blog);
                                            }
                                            
                                            
                                            $c = "SELECT * FROM `blogs` WHERE `community_id`='" . $_SESSION['community_id'] . "' AND `status`='Pending' ORDER BY `id` DESC ";
                                            $events = $db->RetriveArray($c);
                                            foreach ($events as $channel) {
                                            ?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 content-item">
                                                    <div class="event-post mb-3">
                                                        <figure onclick="window.location='<?php URL("/blog/" . $channel['id']); ?>'"><a title=""><img src="<?php echo $channel['cover']; ?>" style='height:220px;width:100%;object-fit:cover;object-position:center' alt=""></a></figure>
                                                        <div class="event-meta pt-1">
                                                            <h6><a class='single-line' title=""><?php echo $channel['name']; ?></a></h6>
                                                            <div class="more">
                                                                <div class="more-post-optns"> 
                                                                    <i class="">
                                                                        <svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                                            <circle r="1" cy="12" cx="12"></circle>
                                                                            <circle r="1" cy="12" cx="19"></circle>
                                                                            <circle r="1" cy="12" cx="5"></circle>
                                                                        </svg></i>
                                                                    <ul>
                                                                        <li onclick="window.location='<?php echo URL('/pending-blogs?publish=' . $channel['id']); ?>'">
                                                                            <a>
                                                                                <i class="icofont-share-alt"></i>Publish
                                                                                <span>Publish Blog</span>
                                                                            </a>
                                                                        </li>
                                                                        <li onclick="window.location='<?php echo URL('/edit-blog/' . $channel['id']); ?>'">
                                                                            <a>
                                                                                <i class="icofont-share-alt"></i>Edit
                                                                                <span>Edit Blog Contents</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class='delete-channel' data-id='<?php echo $channel['id']; ?>'>
                                                                            <i class="icofont-ui-delete"></i>Delete Blog
                                                                            <span>If inappropriate blog</span>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            if(count($events)==0){
												echo "<span style='padding:15px;text-align:center;width:100%'>No channels available</span>";
											}
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-lg-12 text-center mb-5'>
                                    <center>
                                    <?php 
                                    if(count($events)!=0){
										echo '<div style="margin-left:50%;" id="pagination"></div>';
									}
                                    ?>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <div class="popup-wraper" id='delete-channel-popup'>
            <div class="popup">
                <span class="popup-closed"><i class="icofont-close"></i></span>
                <div class="popup-meta">
                    <div class="popup-head">
                        <h5><i class="fa fa-filter"></i> Delete Blog</h5>
                    </div>
                    <div class="send-message">
                        <b>Are you sure want to delete this blog?</b></br></br>
                        <button id='confirm-delete' class="button soft-danger">Yes</button>
                        <button id='dismiss-delete' class="button soft-primary">No</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            
            
            $(".wrapper .content-item").slice(12).hide();
			$('#pagination').pagination({

				// Total number of items present
				// in wrapper class
				items: <?php echo count($events); ?>,

				// Items allowed on a single page
				itemsOnPage: 12,
				onPageClick: function(noofele) {
					$(".wrapper .content-item").hide()
						.slice(12 * (noofele - 1),
							12 + 12 * (noofele - 1)).show();
				}
			});
            
            var curr_ch = 0;
            $('.delete-channel').click(function() {
                curr_ch = $(this).attr('data-id');
                $('#delete-channel-popup').addClass('active');
            })
            $('#confirm-delete').click(function() {
                $.ajax({
                    url: '<?php echo $url . "api/blog.php"; ?>',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        method: 'DELETE',
                        id: curr_ch
                    },
                    success: function(data) {
                        alertify.success(data);
                        location.reload();
                    }
                })
            })
            $('#dismiss-delete').click(function() {
                $('#delete-channel-popup').removeClass('active');
            })
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
</body>

</html>