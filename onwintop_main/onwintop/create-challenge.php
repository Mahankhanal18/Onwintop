<?php
include "init.php";
$edit_mode=false;
if(isset($_POST['headline'])){
    if($_POST['method']=='NEW'){
        $data=R::dispense("challenges");
        $data->headline=$_POST['headline'];
        $data->community_link=$community_id;
        $data->description=$_POST['description'];
        $data->submit_text=$_POST['submit_text'];
        $data->reward=$_POST['reward'];
        $data->thumbnail=$_POST['thumbnail'];
        $data->name=$_POST['name'];
        $data->type=$_POST['type'];
        $data->url=$_POST['url'];
        $data->challenge_type=$_POST['challenge_type'];
        $data->challenge_data=$_POST['challenge_data'];
        if(R::store($data)){
            echo "<script>window.location='".URL_Make('/challenges')."';</script>";
        }else{
               R::debug( TRUE, 1 );
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if ($edit_mode) echo "Edit Challenge";
            else echo "Create Challenge"; ?> | <?php echo $title; ?></title>

    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <style>
        #category_chosen {
            display: none;
        }


        #tag_btn:hover {
            cursor: pointer;
        }

        .post {
            display: none;
        }
        .option-btn{
            width:100%;
            font-size:12px;
            background-color:#ebebeb;
            color:#000000;
            font-style:bold;
            border-radius:5px;
        }
        .option{
            display:none;
        }
        .selected-option{
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .ck-editor__editable {
            min-height: 200px;
        }
        .cat:hover{
            background-color:#ebebeb;
            cursor:pointer;
        }
        .cat-rem:hover{
            color:#ff0000;
            cursor:pointer;
        }
        #select-type:hover{
            cursor:pointer;
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
                                <div class="col-lg-12">
                                    <div class="main-wraper">
                                        <div class="main-title" style="margin-bottom:0px">Create Challenge
                                        </div>
                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        
                                                        </br>
                                                        <h5>Challenge Content</h5></br>
                                                        <label>Headline:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='headline' value='<?php if ($edit_mode) echo $con['name']; ?>' required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea rows='3' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $con['post']; ?></textarea></br>
                                                        <label>Submit Button Text:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='submit_text' value='Submit' required>
                                                        <label>Points awarded for completion:<span class='text-danger'>*</span></label>
                                                        <input type="number" name='reward' value='0' required>
                                                        <label>Thumbnail Image:</label></br>
                                                            <img src='<?php if ($edit_mode) echo $con['cover'];
                                                                        else echo "https://via.placeholder.com/600x400.png?text=Upload+Thumbnail+Image"; ?>' id='thumbnail_holder' style='height:auto;width:50%;'></br>
                                                            <div class="uploadimage2">
                                                                <i class="icofont-file-jpg"></i>
                                                                <label class="fileContainer">
                                                                    <input id='thumbnail' type="file" <?php if (!$edit_mode) echo 'required'; ?>>Attach Thumbnail
                                                                    <input type="hidden" name="method" value='<?php if ($edit_mode) echo "EDIT";
                                                                                                                else echo "NEW"; ?>'>
                                                                    <input type="hidden" value='<?php if ($edit_mode) echo $con['cover']; else echo "https://via.placeholder.com/600x400.png?text=Thumbnail+Image"; ?>' name="thumbnail" id='thumbnail_url'>
                                                                </label>
                                                            </div>
                                                            <b id='loading2' class='text-primary'>Loading...</b></br>
                                                        </br></br>
                                                    </div>
                                                    <div class="col-md-6 pb-3">
                                                        <div class='px-3 mb-2' style="background-color:#ebebeb !important;margin-bottom:20px">
                                                            </br>
                                                            <h5>Setup only visible to Administrator</h5></br>
                                                            <label>Challenge Name:<span class='text-danger'>*</span></label>
                                                            <input type="text" name='name' value='<?php if ($edit_mode) echo $con['name']; ?>' required>
                                                            <label>Challenge Type:<span class='text-danger'>*</span></label>
                                                        
                                                            <input type="text" id='select-type' name='type' value='<?php if ($edit_mode) echo $con['category']; else echo "Select Type"; ?>' required readonly>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            <label>Embed URL:<span class='text-danger'>*</span></label>
                                                            <input type="text" name='url' value='<?php if ($edit_mode) echo $con['name']; ?>' required>
                                                            <small>Use the wildcard * to match multiple URL's from the same domain eg. www.mysite.com</small></br></br>
                                                            <a href='#' style='color:blue'>Add URL</a>
                                                            </br></br>
                                                            <label>Who will see this?</label>
                                                            <div class='container p-4' style='background-color:#fff'>
                                                                <input type='checkbox'checked/>Unidentified Users</br>
                                                                <input type='checkbox' checked/>Targeted Members</br>
                                                                <span>* Under Construction</span>
                                                            </div>
                                                            </br>
                                                        </div>
                                                    </div>
                                                    <input type='hidden' id='challenge_type' name='challenge_type'/>
                                                    <input type='hidden' id='challenge_data' name='challenge_data'/>
                                                    <div class='col-md-12'>
                                                        <div class='row'>
                                                            <div class='col-md-2'>
                                                                <span id='question-btn' class='btn btn-secondary option-btn p-3 selected-option'><span uk-icon="question"></span>&nbsp; Questions</span>
                                                            </div>
                                                            <div class='col-md-2'>
                                                                <span id='quiz-btn' class='btn btn-secondary option-btn p-3'><span uk-icon="check"></span>&nbsp; Quiz</span>
                                                            </div>
                                                            <div class='col-md-2'>
                                                                <span id='share-btn' class='btn btn-secondary option-btn p-3'><span uk-icon="social"></span>&nbsp; Share a link</span>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <span id='advocate-btn' class='btn btn-secondary option-btn p-3' style="font-size:10px"><span uk-icon="happy"></span>&nbsp; Advocate Workflow</span>
                                                            </div>
                                                            <div class='col-md-2'>
                                                                <span id='referral-btn' class='btn btn-secondary option-btn p-3'><span uk-icon="user"></span>&nbsp; Referral</span>
                                                            </div>
                                                            <div class='col-md-1'></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!--Questions-->
                                                    <div class='col-md-12 option' id='question'>
                                                        <div class='container pt-4 pb-4'>
                                                            <?php include "includes/challanges/questions.php";?>
                                                        </div>
                                                    </div>
                                                    <!--Quiz-->
                                                    <div class='col-md-12 option' id='quiz'>
                                                        <div class='container pt-4 pb-4'>
                                                            <?php include "includes/challanges/quiz.php";?>
                                                        </div>
                                                    </div>
                                                    <!--Link-->
                                                    <div class='col-md-12 option' id='share'>
                                                        <div class='container pt-4 pb-4'>
                                                            <?php include "includes/challanges/link.php";?>
                                                        </div>
                                                    </div>
                                                    <!--Advocate-->
                                                    <div class='col-md-12 option' id='advocate'>
                                                        <div class='container pt-4 pb-4'>
                                                            <?php include "includes/challanges/advocate.php";?>
                                                        </div>
                                                    </div>
                                                    <!--Referral-->
                                                    <div class='col-md-12 option' id='referral'>
                                                        <div class='container pt-4 pb-4'>
                                                            <?php include "includes/challanges/referral.php";?>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </form>
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
    
    <div class="popup-wraper" id='challenge-type'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Select Type</h5>
                </div>
                <div class="send-message">
                    <table class='table' style='margin:0px'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='available_categories'></tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <form class="col-md-12" id='category_form'>
                            <b class="inc-cat">Insert new category</b>
                            <input type="text" placeholder style='width:100%;background-color: #f8fafa;border: 2px solid #f2f3f3;padding:10px;border-radius:10px' name="category_name" id="cat_name">
                            <button class="button soft-success mt-1">Insert</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script>
        $(document).ready(function() {
            
            $('#select-type').on('click',function(){
                $('#challenge-type').addClass('active');
            })
            //select category
            $('#available_categories').delegate('.selected-cat','click',function(){
                name=$(this).attr('data-name');
                $('#select-type').val(name);
                $('#challenge-type').removeClass('active');
            })
            
            LoadCategories();
            function LoadCategories(){
                $.ajax({
                    url:'<?php echo $url."/api/manage-challenge-categories.php";?>',
                    method:'POST',
                    data:{
                        method:'LOAD',
                        community_id:'<?php echo $community_id;?>',
                    },
                    success:function(data){
                        data=JSON.parse(data);
                        ele="";
                        j=1;
                        for(i=0;i<data.length;i++){
                            ele+="<tr class='cat'><td class='selected-cat' data-name='"+data[i].name+"'>"+j+"</td><td class='selected-cat' data-name='"+data[i].name+"'>"+data[i].name+"</td><td class='cat-rem' data-id='"+data[i].id+"'>Delete</td></tr>";
                            j++;
                        }
                        $('#available_categories').html(ele);
                    }
                })
            }
            
            //remove category
            $('#available_categories').delegate('.cat-rem','click',function(){
                cat_id=$(this).attr('data-id');
                $.ajax({
                    url:'<?php echo $url."/api/manage-challenge-categories.php";?>',
                    method:'POST',
                    data:{
                        id:cat_id,
                        method:'REMOVE',
                    },
                    success:function(data){
                        alert(data);
                        LoadCategories();
                    }
                })
            })
            
            $('#category_form').on('submit',function(e){
                e.preventDefault();
                name=$('#cat_name').val();
                $('#cat_name').val('');
                $.ajax({
                    url:'<?php echo $url."/api/manage-challenge-categories.php";?>',
                    method:'POST',
                    data:{
                        method:'NEW',
                        name,
                        community_id:'<?php echo $community_id;?>',
                    },
                    success:function(data){
                        alert(data);
                        LoadCategories();
                    }
                
                })
            })
            
            
            $('#question').show();
            $('.option-btn').on('click',function(){
                $('.option-btn').removeClass('selected-option');
                $(this).addClass('selected-option');
                $('.option').hide();
                var option=$(this).attr('id');
                option=option.replace("-btn","");
                $('#'+option).show();
            })

            //thumbnail handle
            $('#loading2').hide();
            thumbnail_url = '<?php if ($edit_mode) echo $data['thumbnail']; else echo "https://via.placeholder.com/600x400.png?text=Thumbnail+Image";?>';
            $('#thumbnail').on('change', function() {
                thumbnail = $('#thumbnail')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('#loading2').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#thumbnail_holder').attr('src', thumbnail_url);
                        $('#thumbnail_url').val(thumbnail_url);
                        $('#loading2').hide();
                    }
                })
            })

        var options = {
            disableFields: ['button','checkbox-group','autocomplete','file','hidden','number','radio-group','select']
        };
        var options2 = {
            disableFields: ['button','checkbox-group','autocomplete','file','hidden','number','select','date','header','paragraph','text','textarea']
        };
        //for questions
        
          var list = ['#question-editor', '#quiz-editor', '#referral-editor'];
          var instances = [];
          
          var init = function(i) {
            if (i < list.length) {
              var options = JSON.parse(JSON.stringify([])); // deep copy
              $(list[i]).formBuilder(options).promise.then(function(res){
                instances.push(res);
                i++;
                init(i);
              });
            } else {
              return;
            }
            
          };
          init(0);
        
        //for question
        $('#question-save').click(function(){
            data1=JSON.stringify(instances[0].actions.getData());
            $('#challenge_type').val('questions');
            $('#challenge_data').val(data1);
            $('#create-data')[0].submit();
        })
        
        //for quiz
        $('#save-quiz').click(function(){
            $('#challenge_type').val('quiz');
            $('#create-data')[0].submit();
        })
        
        var editor;
        ClassicEditor
        .create( document.querySelector( '#referral-text' ) )
        .then( editor_ => {
                editor=editor_;
        } )
        .catch( error => {
                console.error( error );
        } );
        
        //for referral
        var default_ref=[{"type":"text","required":true,"label":"First Name","className":"form-control","name":"first-name","access":false,"subtype":"text"},{"type":"text","required":true,"label":"Last Name","className":"form-control","name":"last-name","access":false,"subtype":"text"},{"type":"text","required":true,"label":"Email","className":"form-control","name":"email","access":false,"subtype":"text"},{"type":"text","required":false,"label":"Company","className":"form-control","name":"company","access":false,"subtype":"text"}];
        setTimeout(function(){ instances[2].actions.setData(default_ref); }, 1000);
        $('#save-referral').click(function(){
            var data3=editor.getData();
            referral_qstn=instances[2].actions.getData();
            obj={
                description:data3,
                questions:referral_qstn
            }
            var ref_data=JSON.stringify(obj);
            $('#challenge_type').val('referral');
            $('#challenge_data').val(ref_data);
            $('#create-data')[0].submit();
        })
        
        //quiz
        var questions=[]
        $('.btn-add-qstn').click(function(){
            $('#add_quiz_qstn').addClass('active');
        })
        
        function RenderQuiz(){
            elements="";
            questions.forEach((qstn,key)=>{
                elements+="<div class='container'><b>Q. "+qstn.question+"?</b>&nbsp;<small>"+qstn.credit+" Credits</small></br><p>Option 1. "+qstn.option1+"</br>Option 2. "+qstn.option2+"</br>Option 3. "+qstn.option3+"</br>Option 4. "+qstn.option4+"</br></p></div>";
            })
            $('#quiz-questions').html(elements);
            $('#challenge_data').val(JSON.stringify(questions));
        }
        
        $('#submit-qstn').on('click',function(e){
            e.preventDefault();
            question=$('#qtz_question').val();
            option1=$('#option1').val();
            option2=$('#option2').val();
            option3=$('#option3').val();
            option4=$('#option4').val();
            credit=$('#credit').val();
            answer=$('#answer').val();
            temp={
                question,option1,option2,option3,option4,answer,credit
            }
            questions.push(temp);
            $('#add_quiz_qstn').removeClass('active');
            //resetting values
            question=$('#qtz_question').val('');
            option1=$('#option1').val('');
            option2=$('#option2').val('');
            option3=$('#option3').val('');
            option4=$('#option4').val('');
            credit=$('#credit').val('');
            answer=$('#answer').val('');
            RenderQuiz();
        })
    })
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

</body>

</html>