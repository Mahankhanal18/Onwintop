<?php
//session_start();

include "init.php";

//check edit mode
$edit_mode=false;
if(isset($id)){
    $channel=R::findOne("channels","WHERE id=?",[$id]);
    if(!empty($channel)){
        $edit_mode=true;
    }
}

//save
if(isset($_POST['name'])){
    if($_POST['method']=='NEW'){
        $data=R::dispense("channels");
        $data->name=$_POST['name'];
        $data->description=$_POST['description'];
        $data->thumbnail=$_POST['thumbnail'];
        $data->community_link=$community_id;
        $data->link=time();
        if(R::store($data)){
            echo "<script>window.location='".URL_Make('/channels')."';</script>";
        }
    }else if($_POST['method']=='EDIT'){
        $parts=URL_Parts();
        $data=R::findOne("channels","WHERE id=?",[$id]);
        $data->name=$_POST['name'];
        $data->description=$_POST['description'];
        $data->thumbnail=$_POST['thumbnail'];
        $data->community_link=$community_id;
        if(R::store($data)){
            echo "<script>window.location='".URL_Make('/channels')."';</script>";
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if($edit_mode) echo "Edit"; else echo "Create";?> Channel | <?php echo $title; ?></title>

    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #category_chosen {
            display: none;
        }

        .select2-container--default .select2-selection--multiple {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
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
                                        <div class="main-title"><?php if($edit_mode) echo "Edit Channel Information"; else echo "Create Channel";?></div>
                                        <div class="d-widget-content">
                                            <form id='create-data' method='post' action='' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        </br>
                                                        <label>Title:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $channel['name']; ?>' placeholder="Enter Channel Title" required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' row='5' name='description' placeholder="Channel Description..." required><?php if ($edit_mode) echo $channel['description']; ?></textarea></br>
                                                        </br></br>
                                                    </div>
                                                    <div class="col-md-4">
                                                        </br>
                                                        <label>Cover Image:<span class='text-danger'>*</span></label></br>
                                                        <img src='<?php if ($edit_mode) echo $channel['thumbnail'];
                                                                    else echo "https://via.placeholder.com/600x400.png?text=Upload+Thumbnail+Image"; ?>' id='thumbnail_holder' style='height:auto;width:100%;object-fit:cover;object-position:center'></br>
                                                        <div class="uploadimage2">
                                                            <i class="icofont-file-jpg"></i>
                                                            <label class="fileContainer">
                                                                <input id='thumbnail' type="file" <?php if (!$edit_mode) echo "required";?>>Attach Thumbnail
                                                                <input type="hidden" name="method" value='<?php if ($edit_mode) echo "EDIT"; else echo "NEW";?>'>
                                                                <input type="hidden" value='<?php if ($edit_mode) echo $channel['thumbnail'];?>' name="thumbnail" id='thumbnail_url'>
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

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#loading2').hide();
            thumbnail_url = '<?php if($edit_mode) echo $data['thumbnail'];?>';
            $('#thumbnail').on('change', function() {
                thumbnail = $('#thumbnail')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('#loading2').show();
                $.ajax({
                    url: '<?php echo $url.'/api/upload_file.php';?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#thumbnail_holder').attr('src',thumbnail_url);
                        $('#thumbnail_url').val(thumbnail_url);
                        $('#loading2').hide();
                    }
                })
            })

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>