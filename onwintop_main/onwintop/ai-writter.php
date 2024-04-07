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
      label{
          font-size:17px;
      }
      .check-label{
          margin-left:8px;
      }
   </style>
</head>
<?php
    $edit=false;
    if(isset($id)){
        $data=R::findOne("aiwritters","id=?",[$id]);
        if(!empty($data)){
            $edit=true;
        }
    }
   if(isset($_POST['name'])){
       if($edit==false){
            $data=R::dispense("aiwritters"); 
            $data->date=date('Y-m-d');
            $dates=array();
            $articles=intval($_POST['articles']);
            $weeks=intval($_POST['weeks']);;
            $curr_date=date_create();
            $c=1;
            for($c;$c<=$weeks;$c++){
                $a=1;
                for($a;$a<=$articles;$a++){
                    date_add($curr_date,date_interval_create_from_date_string($a." days"));
                    array_push($dates,date_format($curr_date,"Y-m-d"));
                }
                date_add($curr_date,date_interval_create_from_date_string("7 days"));
            }
            $data->dates=json_encode($dates);
       }
       $data->name=$_POST['name'];
       $data->community_id=$community_id;
       $data->url=$_POST['url'];
       $data->type=$_POST['type'];
       $data->articles=$_POST['articles'];
       $data->week=$_POST['weeks'];
       if(isset($_POST['approval'])){
           $data->approval='true';
       }
       $data->articles_completed='0';
       $data->weeks_completed='0';
       $data->status='Pending';
       if(R::store($data)){
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
                       <h4 class='my-3'>Manage AI Writter</h4>
                   </div>
                    <div class="col-lg-6 col-md-8 col-sm-8 content-item">
                        <div class="event-post mb-3 p-4">
                            <form action='' method='post' class="event-meta pt-2">
                                <div class='form-group row'>
                                    <label class='col-md-2' style="display:flex;align-items:center"><b>Name:</b></label>
                                    <input type='text' value="<?php if($edit) echo $data['name'];?>" name='name' class='form-control col-md-10'/>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-md-2' style="display:flex;align-items:center"><b>URL:</b></label>
                                    <input type='text' value="<?php if($edit) echo $data['url'];?>" name='url' class='form-control col-md-10'/>
                                </div>
                                <div class='form-group row mt-4'>
                                    <label class='col-md-12' style="display:flex;align-items:center"><b>Content Type:</b></label>
                                    <div class='row col-md-12'>
                                        <div class='col-md-6 mt-2'>
                                            <input type='checkbox' name='type' id='lb' value='List Benefits' <?php if($edit && $data['type']=='List Benefits') echo 'checked';?>/>
                                            <label for='lb' class='check-label'>List Benefits</label>
                                        </div>
                                        <div class='col-md-6 mt-2'>
                                            <input type='checkbox' name='type' id='strategy' value='Strategy' <?php if($edit && $data['type']=='Strategy') echo 'checked';?>/>
                                            <label for='strategy' class='check-label'>Strategy</label>
                                        </div>
                                        <div class='col-md-6 mt-2'>
                                            <input type='checkbox' id='pas' name='type' value='P-A-S' <?php if($edit && $data['type']=='P-A-S') echo 'checked';?>/>
                                            <label for='pas' class='check-label'>P-A-S</label>
                                        </div>
                                        <div class='col-md-6 mt-2'>
                                            <input type='checkbox' id='bs' name='type' value='Business Impact' <?php if($edit && $data['type']=='Business Impact') echo 'checked';?>/>
                                            <label for='bs' class='check-label'>Business Impact</label>
                                        </div>
                                        <div class='col-md-6 mt-2'>
                                            <input type='checkbox' id='lg' name='type' value='Lead Generation' <?php if($edit && $data['type']=='Lead Generation') echo 'checked';?>/>
                                            <label for='lg' class='check-label'>Lead Generation</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class='form-group row mt-4'>
                                    <label class='col-md-12' style="display:flex;align-items:center"><b>Capacity:</b></label>
                                    <div class='row col-md-12'>
                                        <div class='col-md-6 mt-2'>
                                            <label>Articles/Week:</label>
                                            <input type='text' name='articles' class='form-control' value='1' readonly/>
                                        </div>
                                        <div class='col-md-6 mt-2'>
                                            <label>Weeks:</label>
                                            <input type='text' name='weeks' class='form-control' value='1' readonly/>
                                        </div>
                                        <div class='col-md-12'>
                                            <small class='text-danger'>You can only generate 1 articles per week in development mode.</small>
                                        </div>
                                    </div>
                                </div>                                
                                <div class='form-group mt-4'>
                                    <input type='checkbox' id='ha' name='approval' value='Human Apporval' <?php if($edit && $data['approval']=='true') echo 'checked';?> />
                                    <label class='check-label' for='ha'><b>Needs Human Apporval</b></label>
                                </div>
                                <div class='form-group'>
                                    <button type='submit' class='btn btn-dark'>Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                                                
               </div>

            </div>
      </section>
      <?php include "includes/footer.php"; ?>
      
      
      
   </div>
   <script src="<?php URI("js/main.min.js"); ?>"></script>
   <script src="<?php URI("js/script.js"); ?>"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script>
      $(document).ready(function() {
          
        $("input:checkbox").on('click', function() {
          // in the handler, 'this' refers to the box clicked on
          var $box = $(this);
          if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
          } else {
            $box.prop("checked", false);
          }
        });
          
      })
   </script>

</body>

</html>