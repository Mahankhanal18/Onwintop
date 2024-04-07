<?php
include "init.php";
$edit_mode = false;
$data = array();

//check edit
if (isset($id)) {
    $data = R::findOne("blogs", "WHERE id=?", [$id]);
    $con = $data;
    $edit_mode = true;
    $category_=R::findOne("blogs_categories", "WHERE id=?", [$data['categories']]);
    $category=$category_['name'];
}

if (isset($_POST['name'])) {
    if ($_POST['method'] == 'NEW') {
        $data = R::dispense("blogs");
        $data->name = $_POST['name'];
        $data->post = $_POST['description'];
        $data->cover = $_POST['thumbnail'];
        $data->categories = $_POST['tags'];
        $data->community_id = $community_id;
        $data->date = date('Y-m-d');
        $data->time = date('h:ia');
        if (R::store($data)) {
            echo "<script>window.location='" . URL_Make('/view-blogs') . "';</script>";
        }
    } else {
        $data = R::findOne("blogs", "WHERE id=?", [$id]);
        $data->name = $_POST['name'];
        $data->post = $_POST['description'];
        $data->cover = $_POST['thumbnail'];
        $data->categories = $_POST['tags'];
        $data->community_id = $community_id;
        $data->date = date('Y-m-d');
        $data->time = date('h:ia');
        if (R::store($data)) {
            echo "<script>window.location='" . URL_Make('/view-blogs') . "';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if ($edit_mode) echo "Edit Mode";
            else echo "Create Blog"; ?> | <?php echo $title; ?></title>

    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #category_chosen {
            display: none;
        }

        #tag_btn:hover {
            cursor: pointer;
        }
        #ai_popup_btn:hover {
            cursor: pointer;
        }
        #category:hover {
            cursor: pointer;
        }

        .post {
            display: none;
        }
        .select2{
            display:none !important;
        }
        .select{
            display:block;
        }
        .category-item:hover{
            cursor:pointer;
        }
        #pagination{
            margin-left:50% !important;
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
                                        <div class="main-title">Blog Posts
                                        </div>
                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        </br>
                                                        <label>Title:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $con['name']; ?>' id='blog_title' placeholder="Enter Blog Title" required>
                                                        <label>Post:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' rows='10' class='editor' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $con['post']; ?></textarea></br>
                                                        <label>Category:<span class='text-danger'>*</span></label>
                                                        <input type='text' id='category' readonly/>
                                                        <input type='hidden' name='tags' id='tags' readonly/>
                                                        </br>
                                                        <label class='text-primary mt-2' id='tag_btn'>Manage Categories</label></br>
                                                        <label class='text-primary mt-2' id='ai_popup_btn'>Generate with AI</label>
                                                        </br></br>
                                                    </div>
                                                    <div class="col-md-6">
                                                        </br>
                                                        <label>Cover Image:<span class='text-danger'>*</span></label></br>
                                                        <img src='<?php if ($edit_mode) echo $con['cover'];
                                                                    else echo "https://via.placeholder.com/600x400.png?text=Upload+Thumbnail+Image"; ?>' id='thumbnail_holder' style='height:auto;width:100%;'></br>
                                                        <div class="uploadimage2">
                                                            <i class="icofont-file-jpg"></i>
                                                            <label class="fileContainer">
                                                                <input id='thumbnail' type="file" <?php if (!$edit_mode) echo ''; ?>>Attach Thumbnail
                                                                <input type="hidden" name="method" value='<?php if ($edit_mode) echo "EDIT";
                                                                                                            else echo "NEW"; ?>'>
                                                                <input type="hidden" value='<?php if ($edit_mode) echo $con['cover']; ?>' name="thumbnail" id='thumbnail_url'>
                                                            </label>
                                                        </div>
                                                        <b id='loading2' class='text-primary'>Loading...</b></br>
                                                    </div>
                                                </div>
                                                <button type='submit' class="button primary circle">Save</button>
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
    <div class="popup-wraper" id='popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Categories</h5>
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
                            <input type="text" placeholder style='width:100%;background-color: #f8fafa;border: 2px solid #f2f3f3;padding:10px;border-radius:10px' name="category_name" id="">
                            <button class="button soft-success mt-1">Insert</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="popup-wraper" id='ai-popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Categories</h5>
                </div>
                <div class="send-message">
                    <div class='form-group'>
                        <label>Enter Topic/Keyword<span class='text-danger'>*</span>:</label>
                        <input type='text' class='form-control' id='keyword'/>
                    </div>
                    <div class='form-group'>
                        <label>Choose Template<span class='text-danger'>*</span>:</label>
                        <div class='row'>
                            <?php
                                $templates=R::findAll("blogtemplate","community_id=?",[$community_id]);
                                foreach($templates as $t){
                                    echo '
                                    <div class="col-md-4">
                                        <input name="selector[]" id="ad_Checkbox1" class="ads_Checkbox" type="checkbox" value="'.$t['name'].'" />
                                        <label>'.$t['name'].'</label>
                                    </div>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='text-danger' id='ai-error'></label></br>
                        <button class="button soft-success mt-1" id='process-ai'>Process</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#process-ai').click(function(){
                $('#ai-error').html('Loading...');
                $('#process-ai').prop('disabled',true);
                var val = [];
                var q="";
                $(':checkbox:checked').each(function(i){
                  val[i] = $(this).val();
                  if(q.length==0){
                      q+=$(this).val();
                  }else{
                      q+=", "+$(this).val();
                  }
                });
                var keyword=$('#keyword').val();
                if(keyword.length!=0){
                    $('#ai-error').html('Loading...');
                    var query="Write a "+q+" blog on "+keyword;
                    $.ajax({
                        url:'https://organic-service-371417.de.r.appspot.com/generate-blog',
                        method:'POST',
                        data:{
                            query:query
                        },
                        success:function(data){
                            data=JSON.parse(data);
                            cover=data.cover[0].url;
                            blog_title=$('#blog_title').val();
                            if(blog_title.length==0){
                                $('#blog_title').val(keyword);
                            }
                            article=data.article[0].text;
                            $('.editor').val(article);
                            $('#thumbnail_holder').attr('src',cover);
                            $('#thumbnail_url').val(cover);
                            
                            $('#ai-error').html('');
                            $('#ai-popup').removeClass('active');
                            $('#process-ai').prop('disabled',false);
                        }
                    })
                }else{
                    $('#ai-error').html('Enter your keyword first');
                    $('#process-ai').prop('disabled',false);
                }
                
            })

            $('#ai_popup_btn').click(function(){
                $('#ai-popup').addClass('active');
            })

            $('#tag_btn').click(function() {
                $('#popup').addClass('active');
            });
            $('#category').click(function() {
                $('#popup').addClass('active');
            });
            LoadCategories();
            //load available categories
            function LoadCategories() {
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'post',
                    data: {
                        method: 'GET_BLOG_CATEGORY',
                        community_id: '<?php echo $community_id; ?>'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        ele = "";
                        cat = "";
                        var curr_cat = '<?php echo $con['categories']; ?>';
                        cats = []
                        for (i = 0; i < data.length; i++) {
                            sl = i + 1;
                            ele += "<tr><td>" + sl + "</td><td class='category-item' data-name='" + data[i].name + "' data-id='" + data[i].id + "'>" + data[i].name + "</td><td><div class='actions-btn'><i data-name='" + data[i].name + "' class='icofont-trash remove-category'></i></div></td></tr>"
                            cat += "<option>" + data[i].name + "</option>"
                            cats.push({
                                id: data[i].id,
                                value: data[i].name,
                                text: data[i].name
                            });
                        }
                        if (data.length == 0) {
                            ele = "<tr><td colspan='3'>No categories available</td></tr>";
                        }
                        $('#available_categories').html(ele);
                        /*$("#category").select2({
                            data: cats
                        });*/
                    }
                })
            }
            
            
            //Select Category
            $('#available_categories').delegate('.category-item', 'click', function() {
                name = $(this).attr('data-name');
                id=$(this).attr('data-id');
                $('#category').val(name);
                $('#tags').val(id);
                $('#popup').removeClass('active');
            })
            //Remove Category
            $('#available_categories').delegate('.remove-category', 'click', function() {
                name = $(this).attr('data-name');
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        name: name,
                        community_id: '<?php echo $community_id; ?>',
                        method: 'REMOVE_BLOG_CATEGORY'
                    },
                    success: function(data) {
                        $('#popup').removeClass('active');
                        LoadCategories();
                        alertify.success(data);
                    }
                })
            })
            //New Category
            $('#category_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        name: $('[name="category_name"]').val(),
                        community_id: '<?php echo $community_id; ?>',
                        method: 'SAVE_BLOG_CATEGORY'
                    },
                    success: function(data) {
                        $('#category_form')[0].reset();
                        LoadCategories();
                        $('#popup').removeClass('active');
                        alertify.success(data);
                    }
                })
            })
            //thumbnail handle
            $('#loading2').hide();
            thumbnail_url = '<?php if ($edit_mode) echo $data['thumbnail']; ?>';
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


        })
    </script>

</body>

</html>