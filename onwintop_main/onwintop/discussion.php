<?php include "init.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
$parts = URL_Parts();

$login = false;
$info = array();

if ($_COOKIE['user_login'] == true) {
   $login = true;
   $info = json_decode($_COOKIE['community_credentials'], true);
}

if ($_COOKIE['community_login'] == true) {
   $login = true;
   $info = json_decode($_COOKIE['community_credentials'], true);
}
if (isset($_POST['comment'])) {
   $discussion = R::findOne("discussions", "WHERE id=?", [$discussion_id]);
   $comments = json_decode($discussion['comments'], true);
   $obj = array(
      "comment" => $_POST['comment'],
      "creator" => $info['first_name'] . " " . $info['last_name'],
      "email" => $info['email'],
      "date" => date('Y-m-d'),
      "time" => date('hi:a'),
      "upvotes" => "0"
   );
   array_push($comments, $obj);
   $comnt = json_encode($comments);
   $discussion->comments = $comnt;
   R::store($discussion);
}


$discussion = R::findOne("discussions", "WHERE id=?", [$discussion_id]);


?>

<head>
   <title><?php echo $discussion['title']; ?> | <?php echo $title; ?></title>
   <?php include "includes/head.php"; ?>
   <style>
      .daywise:hover {
         cursor: pointer;
      }
   </style>
   <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
</head>

<body>
   <!-- page loader<div class="page-loader" id="page-loader">
      <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
   </div> -->
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
                           <div class="search-question">
                              <form id='search'>
                                 <input id='search_text' type="text" placeholder="Search Questoin?">
                                 <button type="submit"><i class="icofont-search-1"></i></button>
                              </form>
                           </div>
                           <div class="main-wraper">
                              <div class="friend-info">


                                 <figure>
                                    <img src="https://ui-avatars.com/api/?name=<?php echo $discussion['creator']; ?>&background=random" alt="">
                                 </figure>
                                 <div class="friend-name">

                                    <ins><a href="#" title=""><?php echo $discussion['creator']; ?></a> added a chapter</ins>
                                    <span><i class="icofont-globe"></i> published: <?php echo date_format(date_create($discussion['date']), 'd M, Y'); ?></span>
                                 </div>
                                 <div class="question-meta">
                                    <h2 class="question-title"><?php echo $discussion['title']; ?>
                                    </h2>
                                    <p>
                                       <?php echo $discussion['description']; ?>
                                    </p>
                                    <ul class="tags">

                                       <?php
                                       $cc = "SELECT * FROM `discussions_filters` WHERE `id`='" . $discussion['category'] . "' ";
                                       $topic = $db->RetriveSingle($cc);
                                       echo '<li><a data-ripple="" title="">' . $topic['name'] . '</a></li>';

                                       ?>


                                    </ul>
                                    <button class='add button soft-success my-2'><i class="icofont-comment mr-2"></i>Add Comment</button>
                                 </div>

                                 <form class='add-inp' action='' method='post' style='display:none'>
                                    <textarea id='comment' name='comment' class='form-control' rows='4'></textarea>
                                    <button type='submit' style='float:right' class='button soft-primary mt-1'>Save</button>
                                 </form>


                                 <?php
                                 $n = 0;
                                 $comments = json_decode($discussion['comments'], true);
                                 foreach ($comments as $comment) {
                                 ?>
                                    <div class="anser">
                                       <!--<i class="icofont-check-circled" title="Best Answer"></i>-->
                                       <div class="friend-info">
                                          <figure>
                                             <img src="https://ui-avatars.com/api/?name=<?php echo $comment['creator']; ?>&background=random" alt="">
                                          </figure>
                                          <div class="friend-name">

                                             <ins><a href="time-line.html" title=""><?php echo $comment['creator']; ?></a> added a chapter</ins>
                                             <span><i class="icofont-globe"></i> published: <?php echo $comment['date']; ?></span>
                                          </div>
                                          <div class="question-meta">
                                             <p>
                                                <?php echo $comment['comment']; ?>
                                             </p>
                                             <a data-id='<?php echo $n; ?>' data-count='<?php echo $comment['upvotes']; ?>' title="" class="upvote main-btn"><?php echo $comment['upvotes']; ?> Upvotes</a>
                                          </div>
                                       </div>
                                    </div>
                                 <?php
                                    $n++;
                                 }
                                 ?>

                              </div>
                           </div>
                           <?php


                           ?>
                        </div>

                        <div class="col-lg-3">
                           <aside class="sidebar static right">
                              <div class="widget">
                                 <h4 class="widget-title">Ask Research Question?</h4>
                                 <div class="ask-question">
                                    <i class="icofont-question-circle"></i>
                                    <h6>Ask questions in Q&A to get help from experts in your field.</h6>
                                    <a class="ask-qst" href="#" title="">Ask a question</a>
                                 </div>
                              </div>
                              <?php include "widgets/explore_events.php"; ?>

                           </aside>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-9">
                     <div class="main-wraper">
                        <h4 class="main-title">Related Questions</h4>
                        <ul class="related-qst">
                           <?php
                           $qstns = R::findAll("discussions", "WHERE category=? ORDER BY title DESC LIMIT 10", [$discussion['category']]);
                           foreach ($qstns as $qstn) {
                              echo '
                                 <li>
                                    <a href="' . URL_Make('/discussion/' . $qstn['id']) . '" title="">' . $qstn['title'] . '</a>
                                 </li>
                                 ';
                           }
                           ?>

                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <?php include "includes/footer.php"; ?>

      <div class="new-question-popup">
         <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
               <div class="popup-head">
                  <h5><i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
                           <circle cx="12" cy="12" r="10"></circle>
                           <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                           <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg></i> Ask Question</h5>
               </div>
               <div class="post-new">
                  <form method="post" action='' class="c-form">

                     <input type="text" placeholder="Question Title" required>
                     <textarea placeholder="Write Question"></textarea>

                     <select required>
                        <option>Select Your Question Type</option>
                     </select>
                     <div class="uploadimage">
                        <i class="icofont-eye-alt-alt"></i>
                        <label class="fileContainer">
                           <input type="file" required>Upload File
                        </label>
                     </div>

                     <button type="submit" class="main-btn">Post</button>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!--<div class="login-popup">
		<div class="popup">
			<span class="popup-closed"><i class="icofont-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<h5><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></i> Login Alert</h5>
				</div>
				<div class="post-new">
					<b>You need to login to participate in discussion</b>
				</div>
			</div>
		</div>
	</div>-->

   </div>

   <script src="<?php URI("js/main.min.js"); ?>"></script>
   <script src="<?php URI("js/script.js"); ?>"></script>
   <script>
      $(document).ready(function() {

         $('#search').on('submit', function(e) {
            e.preventDefault();
            var keyword = $('#search_text').val();
            if (keyword.length != 0) {
               window.location = '<?php URL('/discussions/search'); ?>/' + keyword;
            } else {
               alertify.error('Enter some text to search');
            }

         })
         $('.ask-question').click(function() {
            $('.new-question-popup').addClass('active');
         })
         $('.upvote').click(function() {
            id = $(this).attr('data-id');
            count = $(this).attr('data-count');
            var login = false;
            <?php
            if ($login == true) {
               echo "login=true;";
            } else {
               echo "$('.login-popup').addClass('active');";
            }
            ?>
            if (login) {
               count++;
            }
            $(this).html(count + " Upvotes");
            $.ajax({
               url: '<?php echo $root ?>api/upvote.php',
               method: 'POST',
               data: {
                  id,
                  count
               }
            })
         })

         $('.add').click(function() {
            $('.add').hide();
            $('.add-inp').slideDown();
         })

         $('.add-inp').on('submit', function(e) {
            e.preventDefault();
            var login = false;
            <?php
            if ($login == true) {
               echo "login=true;";
            }
            ?>
            if (login) {
               $('.add-inp')[0].submit();
            } else {
               $('.login-popup').addClass('active');
            }
         })

      })
   </script>



</body>

</html>