<?php
include "init.php";
$edit_mode = false;
$data = array();
if (isset($channel_id)) {
    $method = 'create-file';
    $parts=URL_Parts();
    if(in_array('edit-file',$parts)){
        $method='edit-file';
    }
   // $channel_id = 0;
    if ($method == 'create-file') {
        //saving file
        if (isset($_POST['name'])) {
            $data = R::dispense("files");
            $data->name = $_POST['name'];
            $data->type = "Document";
            $data->community_id = $_SESSION['community_id'];
            $data->channel_id = $channel_id;
            $data->category = $_POST['categories'];
            $data->url = $_POST['file'];
            $data->thumbnail = $_POST['thumbnail'];
            $data->description = $_POST['description'];
            $id = R::store($data);
            //creating content
            $content = R::dispense("contents");
            $content->community_id = $_SESSION['community_id'];
            $content->channel_id = $channel_id;
            $content->name = $_POST['name'];
            $content->type = "File";
            $content->tags = $_POST['categories'];
            $content->thumbnail = $_POST['thumbnail'];
            $content->description = $_POST['description'];
            $content->data_id = $data['id'];
            $content->reactions = '[]';
            $content->comments = '[]';
            $content->shares = '[]';
            $content->views = '0';
            $content->modification_date = date('Y-m-d');
            $content->creator = $user_credentials['first_name']." ".$user_credentials['last_name'];
            if (R::store($content)) {
                echo "<script>window.location='" . URL_Make('/edit-channel/' . $channel_id) . "';</script>";
            }
        }
    } else if ($method == 'edit-file') {
        $file_id = $channel_id;
        $con = R::findOne("files", "WHERE id=?", [$file_id]);
        $channel_id = $con['channel_id'];
        $edit_mode = true;
        if (isset($_POST['name'])) {
            $data = R::findOne("files","WHERE id=?",[$file_id]);
            $data->name = $_POST['name'];
            $data->type = "Document";
            $data->community_id = $_SESSION['community_id'];
            $data->channel_id = $channel_id;
            $data->category = $_POST['categories'];
            $data->url = $_POST['file'];
            $data->thumbnail = $_POST['thumbnail'];
            $data->description = $_POST['description'];
            R::store($data);
            //creating content
            $content = R::findOne("contents","WHERE data_id=? AND type=?",[$data['id'],'File']);
            $content->community_id = $_SESSION['community_id'];
            $content->channel_id = $channel_id;
            $content->name = $_POST['name'];
            $content->type = "File";
            $content->tags = $_POST['categories'];
            $content->thumbnail = $_POST['thumbnail'];
            $content->description = $_POST['description'];
            $content->data_id = $data['id'];
            $content->modification_date = date('Y-m-d');
            $content->creator = $user_credentials['first_name']." ".$user_credentials['last_name'];
            if (R::store($content)) {
                echo "<script>window.location='" . URL_Make('/edit-channel/' . $channel_id) . "';</script>";
            }
        }
    }
    $channel_info = R::findOne("channels", "WHERE id=?", [$channel_id]);
} else {
    echo "<script>window.location='" . URL_Make('/channels') . "';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if($edit_mode) echo "Edit File"; else echo "Create File";?> | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #category_chosen {
            display: none;
        }
        .file_btn:hover {
            cursor: pointer;
        }
        .chosen-container-multi .chosen-choices {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            padding-top: 8px;
            padding-left: 8px;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }
        .select2-container--default .select2-selection--multiple {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            padding-top: 0px;
            padding-left: 0px;
            padding-bottom: 0px;
            padding-right: 0px;
            position: relative;
        }
        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline;
            list-style: none;
            padding: 0;
            float: left;
            padding-top: 5px;
            padding-left: 5px;
        }
        #tag_btn:hover {
            cursor: pointer;
        }
        .post{
            display:none;
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
                                        <div class="main-title"><?php if($edit_mode) echo "Edit File"; else echo "Create File";?>
                                        </div>
                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        </br>
                                                        <label>Title:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $con['name']; ?>' placeholder="Enter File Name" required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' class='editor' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $con['description']; ?></textarea></br>
                                                        <div class='hidden' style="display:none">
                                                            <label>Channel:<span class='text-danger'>*</span></label>
                                                            <select id='channel' style="width: 100%;border:none;" name="state">
                                                                <option selected><?php echo $channel_info['name']; ?></option>
                                                            </select></br></br>
                                                        </div>
                                                        <label>Categories:</label>
                                                        <select class='select2' id='category' multiple="multiple" value='[]' style="width: 100%;border:none" name="tags">
                                                        </select></br>
                                                        <input type='hidden' name='categories' id='categories' />
                                                        <label class='text-primary' id='tag_btn'>Manage Categories</label>
                                                        </br></br>
                                                    </div>
                                                    <div class="col-md-4">
                                                        </br>
                                                        <!--Attach file-->
                                                        <div class="attach-new">
                                                            <label for="">Attach File<span class='text-danger'>*</span></label></br>
                                                            <span id='attach_file' class="button soft-primary file_btn"><i class="icofont-upload"></i> Upload File</span>
                                                        </div>
                                                        <!--Replace file-->
                                                        <div class="attach-replace" style='display:none'>
                                                            <label for="">File Attached<span class='text-danger'>*</span></label></br>
                                                            <a id='preview_file' target='blank' class="button soft-primary file_btn"><i class="icofont-eye"></i> Preview Upload</a>
                                                            <span id='replace_file' class="button soft-success file_btn"><i class="icofont-upload"></i> Replace File</span>
                                                        </div>
                                                        <!--Loading Upload-->
                                                        <div class="loading-upload" style='display:none'>
                                                            <img src='<?php echo $url . "images/loading.webp"; ?>' style='height:30px;width:30px'>
                                                            <b>Uploading...</b>
                                                        </div>
                                                        <input type='file' id='file' style='display:none' />
                                                        <input type='hidden' name='file' id='file_url' value='' />


                                                        </br></br>
                                                        <label>Thumbnail Image:</label></br>
                                                        <img src='<?php if ($edit_mode) echo $con['thumbnail'];
                                                                    else echo "https://via.placeholder.com/600x400.png?text=Upload+Thumbnail+Image"; ?>' id='thumbnail_holder' style='height:auto;width:100%;'></br>
                                                        <div class="uploadimage2">
                                                            <i class="icofont-file-jpg"></i>
                                                            <label class="fileContainer">
                                                                <input id='thumbnail' accept='.png,.jpg,.gif,.bmp,.jpeg' type="file">Attach Thumbnail
                                                                <input type="hidden" name="method" value='<?php if ($edit_mode) echo "EDIT";
                                                                                                            else echo "NEW"; ?>'>
                                                                <input type="hidden" value='<?php if ($edit_mode) echo $con['thumbnail']; else echo "https://via.placeholder.com/600x400.png?text=Thumbnail+Image"; ?>' name="thumbnail" id='thumbnail_url'>
                                                            </label>
                                                        </div>
                                                        <b class='text-primary' id='loading2' style='display:none'>Loading...</b></br>
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
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            //file handle
            $('#attach_file').click(function() {
                $('#file').click();
            })
            $('#replace_file').click(function() {
                $('#file').click();
            })
            var file_url = '<?php if ($edit_mode) echo $con['url']; else echo "";?>';
            if (file_url.length != 0) {
                $('#file_url').val(file_url);
                $('#preview_file').attr('href', file_url);
                $('.loading-upload').hide();
                $('.attach-new').hide();
                $('.attach-replace').show();
            }
            $('#file').on('change', function() {
                thumbnail = $('#file')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.attach-new').hide();
                $('.attach-replace').hide();
                $('.loading-upload').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        file_url = data.secure_url;
                        $('#file_url').val(file_url);
                        $('#preview_file').attr('href', file_url);
                        $('.loading-upload').hide();
                        $('.attach-new').hide();
                        $('.attach-replace').show();
                    }
                })
            })
            //handle thumbnail
            $('#loading2').hide();
            thumbnail_url = '<?php if ($edit_mode) echo $con['thumbnail']; ?>';
            $('#thumbnail').on('change', function() {
                thumbnail = $('#thumbnail')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('#loading2').show();
                $.ajax({
                    url: '<?php echo $root . '/api/upload_file.php'; ?>',
                    method: 'post',
                    type:'post',
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
            $('#tag_btn').click(function() {
                $('#popup').addClass('active');
            });
            LoadCategories();
            //load available categories
            function LoadCategories() {
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'post',
                    data: {
                        method: 'GET_FILE_CATEGORY',
                        community_id: '<?php echo $_SESSION['community_id']; ?>'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        ele = "";
                        cat = "";
                        cats = []
                        for (i = 0; i < data.length; i++) {
                            sl = i + 1;
                            ele += "<tr><td>" + sl + "</td><td>" + data[i].name + "</td><td><div class='actions-btn'><i data-name='" + data[i].name + "' class='icofont-trash remove-category'></i></div></td></tr>"
                            cat += "<option>" + data[i].name + "</option>"
                            cats.push({
                                id: data[i].id,
                                value: data[i].id,
                                text: data[i].name
                            });
                        }
                        $('#available_categories').html(ele);
                        $("#category").select2({
                            data: cats
                        });
                        <?php
                        if ($edit_mode == true) {
                            $av_cat = explode(",", $con['category']);
                            $av_cats = array();
                            foreach ($av_cat as $av) {
                                array_push($av_cats, "'" . $av . "'");
                            }
                            $selected_cat = implode(",", $av_cats);
                            echo "$('#category').val([" . $selected_cat . "]).trigger('change');";
                        }

                        ?>
                    }
                })
            }
            //Remove Category
            $('#available_categories').delegate('.remove-category', 'click', function() {
                name = $(this).attr('data-name');
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        name: name,
                        community_id: '<?php echo $_SESSION['community_id']; ?>',
                        method: 'REMOVE_FILE_CATEGORY'
                    },
                    success: function(data) {
                        alert(data);
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
                        community_id: '<?php echo $_SESSION['community_id']; ?>',
                        method: 'SAVE_FILE_CATEGORY'
                    },
                    success: function(data) {
                        $('#category_form')[0].reset();
                        LoadCategories();
                        $('#popup').removeClass('active');
                        alertify.success(data);
                    }
                })
            })
            //submit file
            $('#create-data').on('submit', function(e) {
                e.preventDefault();
                categories = $('#category').val();
                if (file_url.length != 0 && categories.length.length != 0) {
                    $('#categories').val(categories);
                    $('#create-data')[0].submit();
                } else {
                    alertify.error('Please fill all the mandatory details');
                }
            })

        })
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>