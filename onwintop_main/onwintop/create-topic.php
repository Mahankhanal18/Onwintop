<?php
include "init.php";
$edit_mode = false;
$data = array();
$url_parts = URL_Parts();
$credentials = json_decode($_COOKIE['community_credentials'], true);
//if (count($url_parts) >= 6) {
$method = 'create-topic';
if(!$member_login || !$user_login){
    echo "<script>window.location='" . URL_Make('/signin') . "';</script>";
}
if(in_array("edit-topic",$url_parts)){
    $method = 'edit-topic';
}
if ($method == 'create-topic') {
    //saving file
    if (isset($_POST['name'])) {
        $data = R::dispense("discussions");
        $data->title = $_POST['name'];
        $data->description = $_POST['description'];
        $data->creator = $user_credentials['first_name'] . " " . $user_credentials['last_name'];
        $data->community_id = $_SESSION['community_id'];
        $data->category = $_POST['categories'];
        $data->url = $_POST['file'];
        $data->date = date('Y-m-d');
        $data->time = date('h:ia');
        if (R::store($data)) {
            echo "<script>window.location='" . URL_Make('/discussions') . "';</script>";
        }
    }
} else if ($method == 'edit-topic') {
    $file_id = $id;
    $con = R::findOne("discussions", "WHERE id=?", [$file_id]);
    $channel_id = $con['channel_id'];
    $edit_mode = true;
    if (isset($_POST['name'])) {
        $data = R::findOne("discussions", "WHERE id=?", [$file_id]);
        $data->title = $_POST['name'];
        $data->description = $_POST['description'];
        $data->creator = $user_credentials['first_name'] . " " . $user_credentials['last_name'];
        $data->community_id = $_SESSION['community_id'];
        $data->category = $_POST['categories'];
        $data->url = $_POST['file'];
        $data->date = date('Y-m-d');
        $data->time = date('h:ia');
        if (R::store($data)) {
            echo "<script>window.location='" . URL_Make('/discussions') . "';</script>";
        }
    }
}
//}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if ($edit_mode) echo "Edit Discussion";
            else echo "Create Discussion"; ?> | <?php echo $title; ?></title>
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

        .post {
            display: none;
        }
    </style>
</head>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>
        <?php include "includes/nav.php"; ?>
        <section>
            <div class="gap"  style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper">
                                        <div class="main-title"><?php if ($edit_mode) echo "Edit Topic";
                                                                else echo "Create Topic"; ?>
                                        </div>
                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        </br>
                                                        <label>Topic:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $con['title']; ?>' placeholder="Enter Topic Title" required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' class='editor' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $con['description']; ?></textarea></br>
                                                        <label>Categories:<span class='text-danger'>*</span></label>
                                                        <select class='select2' id='category' multiple="multiple" value='[]' style="width: 100%;border:none">
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
    <script>
        $(document).ready(function() {
            //file handle
            $('#attach_file').click(function() {
                $('#file').click();
            })
            $('#replace_file').click(function() {
                $('#file').click();
            })
            var file_url = '<?php if ($edit_mode) echo $con['url'];
                            else echo ""; ?>';
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
                        if (file_url.length == 0) {
                            $('#file_url').val('');
                        } else {
                            $('#file_url').val(file_url);
                        }
                        $('#preview_file').attr('href', file_url);
                        $('.loading-upload').hide();
                        $('.attach-new').hide();
                        $('.attach-replace').show();
                    }
                })
            })
            //handle thumbnail
            $('#loading2').hide();
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
                        method: 'GET_DISCUSSION_CATEGORY',
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
                        method: 'REMOVE_DISCUSSION_CATEGORY'
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
                        method: 'SAVE_DISCUSSION_CATEGORY'
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
                $('#categories').val(categories);
                $('#create-data')[0].submit();
            })

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>