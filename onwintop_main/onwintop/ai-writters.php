<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Manage AI Writters | <?php echo $title; ?></title>

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
      .label-discussion:hover {
         cursor: pointer;
      }
      .event-meta {
         display: inline-block;
         padding: 0 15px 5px;
         position: relative;
         width: 100%;
      }
      .uk-icon:hover{
          cursor:pointer;
      }
   </style>
</head>
<?php
   if(isset($_GET['delete'])){
       $c=R::findOne("aiwritters","id=?",[$_GET['delete']]);
       if(R::trash($c)){
           echo "<script>window.location='".URL_Make('/ai-writters')."';</script>";
       }
   }
?>
<body>
   <div class="theme-layout">
      <?php include "includes/header2.php"; ?>
      <?php include "includes/nav.php"; ?>
      <section>
         <div class="gap"  style='<?php if($mobile) echo 'padding-left:0px !important;';?>margin-top:10px !important'>
            <div class="container">
               
               <div class="row merged20 px-2">
                   <div class='col-md-12 container'>
                       <h4 class='my-3' style="float:left">AI Writters</h4>
                       <a href='<?php URL('/ai-writter');?>' class='btn btn-dark text-white' style="float:right">Create New +</a>
                   </div>
                   <?php
                    $data=R::findAll("aiwritters","community_id=?",[$community_id]);
                    foreach($data as $d){
                   ?>
                   
                    <div class="col-lg-6 col-md-6 col-sm-6 content-item">
                        <div class="event-post mb-3 p-4">
                            <div class="event-meta">
                                <h6><a class='single-line' href='<?php URL('/ai-writter/'.$d['id']);?>' title=""><?php echo $d['name'];?></a></h6></br>
                                <label class='single-line mt-2'>URL : <?php echo $d['url'];?></label></br>
                                <label class='single-line'>Generated Contents : <?php echo $d['articles_completed'];?></label></br>
                                <label class='single-line'>To be published : <?php echo (intval($d['articles'])-intval($d['articles_completed']));?></label>
                                
                                <div class="more">
                                    <div class="more-post-optns">
                                        <i class="">
                                            <svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                <circle r="1" cy="12" cx="12"></circle>
                                                <circle r="1" cy="12" cx="19"></circle>
                                                <circle r="1" cy="12" cx="5"></circle>
                                            </svg></i>
                                        <ul>
                                            <li onclick="window.location='<?php URL('/ai-writter/'.$d['id']);?>'">
                                                <a>
                                                    <i class="icofont-share-alt"></i>Edit
                                                    <span>Edit AI Writter Configuration</span>
                                                </a>
                                            </li>
                                            <li onclick="window.location='<?php URL('/ai-writters?delete='.$d['id']);?>'" class='delete-channel' data-id=''>
                                                <i class="icofont-ui-delete"></i>Delete Writter
                                                <span>If inappropriate writter</span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } 
                    if(count($data)==0){
                        echo "<p class='text-center p-5'>It seems you have no AI writters yet. Click on the `Create New +` button to create one.</p>";
                    }
                    ?>
                    
                                                
               </div>

            </div>
      </section>
      <?php include "includes/footer.php"; ?>
      
      <div class="popup-wraper" id='new-command'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <form action='' method='post' class="popup-meta">
                <div class="popup-head">
                    <h5>New AI Command</h5>
                </div>
                <div class="send-message">
                    <div class='form-group'>
                        <label>Enter Keyword <span class='text-danger'>*</span></label>
                        <input name='name' class='form-control' />
                    </div>
                    <div class='form-group'>
                        <button type='submit' class='btn btn-success'>Submit</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      
      
   </div>
   <script src="<?php URI("js/main.min.js"); ?>"></script>
   <script src="<?php URI("js/script.js"); ?>"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script>
      $(document).ready(function() {
          
          $('#new-command-btn').click(function(){
              $('#new-command').addClass('active');
          })
          
      })
   </script>

</body>

</html>