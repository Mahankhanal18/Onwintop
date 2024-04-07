<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Supports | <?php echo $title;?></title>
	<?php include "includes/head.php"; ?>
	<style>
	    .daywise:hover{
	        cursor:pointer;
	    }
	</style>
</head>

<body>
	<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div><!-- page loader -->
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
                           <div class="search-question">
                              <form method="post">
                                 <input type="text" placeholder="Search Questoin?">
                                 <button type="submit"><i class="icofont-search-1"></i></button>
                              </form>
                           </div>
                           
                           
                           <?php
                           $s="SELECT * FROM `supports` WHERE `community_id`='".$_SESSION['directory']."' ";
                           $supports=$db->RetriveArray($s);
                           foreach($supports as $support){
                               $cat=json_decode($support['categories'],true);
                               ?>
                               <div class="main-wraper">
                                  <div class="friend-info">
                                     <h2 class="question-title"><a href="<?php echo URL_Make("/support/".$support['id']);?>" title=""><?php echo $support['question'];?></a>
                                     </h2>
                                     
                                     <figure>
                                        <img src="https://ui-avatars.com/api/?name=<?php echo $support['author'];?>&background=random" alt="">
                                     </figure>
                                     <div class="friend-name">
    
                                        <ins><a href="<?php echo URL_Make("/support/".$support['id']);?>" title=""><?php echo $support['author'];?></a> added a chapter</ins>
                                        <span><i class="icofont-globe"></i> published: <?php echo date_format(date_create($support['date']),'d M, Y');?></span>
                                     </div>
                                     <div class="question-meta">
                                        <p>
                                           <?php echo $support['description'];?>
                                        </p>
                                        <ul class="tags">
                                           
                                           <?php
                                           foreach($cat as $c){
                                               $cc="SELECT * FROM `supports_filters` WHERE `id`='".$c."' ";
                                               $topic=$db->RetriveSingle($cc);
                                               echo '<li><a data-ripple="" title="">'.$topic['name'].'</a></li>';
                                           }
                                           ?>
                                        </ul>
                                        <a href="<?php echo URL_Make("/support/".$support['id']);?>" title="" class="main-btn">view Answers</a>
                                     </div>
                                  </div>
                               </div>
                               <?php
                           }
                           
                           ?>
                           
                           
                           
                        </div>
                        
                        
                        <div class="col-lg-3">
                           <aside class="sidebar static right mt-5">
                              <div class="widget">
                                 <h4 class="widget-title">Ask Research Question?</h4>
                                 <div class="ask-question">
                                    <i class="icofont-question-circle"></i>
                                    <h6>Ask questions in Q&A to get help from experts in your field.</h6>
                                    <a class="ask-qst" href="#" title="">Ask a question</a>
                                 </div>
                              </div>
                              <?php include "widgets/explore_events.php";?>

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



</body>

</html>