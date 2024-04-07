<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Header Editor | <?php echo $title; ?></title>
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

        .top_nav_landing label {
            font-size: 12px;
            font-weight: 400;
            color: #737373;
        }

        .top_nav_landing select {
            background-color: #ddd !important;
            padding: 5px;
            color: #737373;
            border-radius: 2px;
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
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">

                                            Header Editor
                                        </div>
                                        <div class="row">
                                            <?php
                                            $db = new Database();
                                            $c = "SELECT * FROM `headers` WHERE `community_link`='" . $_SESSION['community_id'] . "' ";
                                            $header_page = $db->RetriveSingle($c);
                                            $hin1 = json_decode($header_page['header1'], true);

                                            $hin2 = json_decode($header_page['header2'], true);
                                            ?>
                                            <div class='row pt-4'>
                                                <div class='col-md-4'>
                                                    <div class='card text-center'>
                                                        <div class='card-body'>
                                                            <img src='<?php echo $root . "images/header1.png"; ?>' style='width:100%' />
                                                            <button class='button mt-2 soft-success' id='header1-select'>Select</button>
                                                            <button id='header1-setting' class='button mt-2 soft-danger'>Setting</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <div class='card text-center'>
                                                        <div class='card-body'>
                                                            <img src='<?php echo $root . "images/header2.png"; ?>' style='width:100%' />
                                                            <button class='button mt-2 soft-success' id='header2-select'>Select</button>
                                                            <button id='header2-setting' class='button mt-2 soft-danger'>Setting</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="<?php URL('/landing-page'); ?>" class="button soft-primary mt-3"><i class="icofont-ui-previous mr-1"></i>Back</a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <div class="popup-wraper" id='header1'>
            <div class="popup">
                <span class="popup-closed"><i class="icofont-close"></i></span>
                <div class="popup-meta">
                    <div class="popup-head">
                        <h5><i class="icofont-envelope"></i> Header 1</h5>
                    </div>
                    <div class="send-message">
                        <form class="c-form" id='edit-header1'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Heading<span class='text-danger'>*</span></label>
                                    <input type='hidden' name='form' value='Header1'>
                                    <input type="text" name='heading' value='<?php echo $hin1['heading']; ?>' placeholder="Enter Heading.." required>
                                </div>
                                <div class='col-md-6'>
                                    <input type='hidden' name='community_id' value='<?php echo $_SESSION['community_id'] ?>' />
                                    <label>Subheading<span class='text-danger'>*</span></label>
                                    <input type="text" name='subheading' value='<?php echo $hin1['subheading']; ?>' placeholder="Enter Subheading.." required>
                                </div>
                            </div>
                            <label>Link 1<span class='text-danger'>*</span></label>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <input type="text" name='link1-label' value='<?php echo $hin1['link1-label']; ?>' placeholder="Enter Link Label.." required>
                                </div>
                                <div class='col-md-6'>
                                    <input type="text" name='link1-url' value='<?php echo $hin1['link1-url']; ?>' placeholder="Enter Link.." required>
                                </div>
                            </div>
                            <label>Link 2<span class='text-danger'>*</span></label>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <input type="text" name='link2-label' value='<?php echo $hin1['link2-label']; ?>' placeholder="Enter Link Label.." required>
                                </div>
                                <div class='col-md-6'>
                                    <input type="text" name='link2-url' value='<?php echo $hin1['link2-url']; ?>' placeholder="Enter Link.." required>
                                </div>
                            </div>
                            <label>Header Image<span class='text-danger'>*</span></label>
                            <input type="file" id='file1' value='<?php echo $hin1['banner']; ?>'>
                            <?php  if(isset($hin1['banner']) && strlen($hin1['banner'])!=0 ){
                                echo '<a style="color:var(--primary-color);"  data-fancybox="" href="'.$hin1['banner'].'">Preview</a>';
                            } ?>
                            
                            <input type='hidden' name='banner' id='banner1' <?php if(isset($hin1['banner']) && strlen($hin1['banner'])!=0 ){ echo "value='".$hin1['banner']."'"; } ?>/> 
                            <label class='loading1 text-danger'  style='display:none'>Loading</label></br>
                            <button type="submit" class="button primary circle mt-2 mb-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- send message popup -->

        <div class="popup-wraper" id='header2'>
            <div class="popup">
                <span class="popup-closed"><i class="icofont-close"></i></span>
                <div class="popup-meta">
                    <div class="popup-head">
                        <h5><i class="icofont-envelope"></i> Header 2</h5>
                    </div>
                    <div class="send-message">
                        <form class="c-form" id='edit-header2'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Heading<span class='text-danger'>*</span></label>
                                    <input type='hidden' name='form' value='Header2'>
                                     <input type='hidden' name='community_id' value='<?php echo $_SESSION['community_id'] ?>' />
                                    <input type="text" name='heading' value='<?php echo $hin2['heading']; ?>' placeholder="Enter Heading.." required>
                                </div>
                                <div class='col-md-6'>
                                    <label>Subheading<span class='text-danger'>*</span></label>
                                    <input type="text" name='subheading' value='<?php echo $hin2['subheading']; ?>' placeholder="Enter Subheading.." required>
                                </div>
                            </div>
                            
                            
                            <label>Link 1<span class='text-danger'>*</span></label>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <input type="text" name='link1-label' value='<?php echo $hin2['link1-label']; ?>' placeholder="Enter Link Label.." required>
                                </div>
                                <div class='col-md-6'>
                                    <input type="text" name='link1-url' value='<?php echo $hin2['link1-url']; ?>' placeholder="Enter Link.." required>
                                </div>
                            </div>
                            <label>Link 2<span class='text-danger'>*</span></label>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <input type="text" name='link2-label' value='<?php echo $hin2['link2-label']; ?>' placeholder="Enter Link Label.." required>
                                </div>
                                <div class='col-md-6'>
                                    <input type="text" name='link2-url' value='<?php echo $hin2['link2-url']; ?>' placeholder="Enter Link.." required>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Video Link<span class='text-danger'>*</span></label>
                                    <input type="text" name='video-url' value='<?php echo $hin2['video-url']; ?>' placeholder="Enter Video Link.." required>
                                </div>
                                <div class='col-md-6'>
                                    <label>Video Thumbnail<span class='text-danger'>*</span></label>
                                    <input type="text" name='video-thumbnail' value='<?php echo $hin2['video-thumbnail']; ?>' placeholder="Enter Video Link.." required>
                                </div>
                            </div>
                            <label>Header Image<span class='text-danger'>*</span></label>
                            <input type="file" id='file2' value='<?php echo $hin2['banner']; ?>' placeholder="Enter Video Link..">
                            <?php  if(isset($hin2['banner']) && strlen($hin2['banner'])!=0 ){
                                echo '<a style="color:var(--primary-color);"  data-fancybox="" href="'.$hin2['banner'].'">Preview</a>';
                            } ?>
                            <input type='hidden' name='banner' id='banner2' <?php if(isset($hin2['banner']) && strlen($hin2['banner'])!=0 ){ echo "value='".$hin2['banner']."'"; } ?>/> 
                            <label class='loading2 text-danger' style='display:none'>Loading</label></br>
                            <button type="submit" class="button primary circle mt-2 mb-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- send message popup -->

        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            selected_theme = '<?php echo $header_page['current_header']; ?>';

            $('#header1-setting').click(function() {
                $('#header1').addClass('active');
            })
            $('#header2-setting').click(function() {
                $('#header2').addClass('active');
            })
            if (selected_theme == 'Header1') {
                $('#header1-select').html('Selected');
                $('#header2-select').html('Select');
            }
            if (selected_theme == 'Header2') {
                $('#header1-select').html('Select');
                $('#header2-select').html('Selected');
            }
            
            $('#file1').on('change', function() {
                thumbnail = $('#file1')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.loading1').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#banner1').val(thumbnail_url);
                        $('.loading1').hide();
                    }
                })
            })
            
            $('#file2').on('change', function() {
                thumbnail = $('#file2')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.loading2').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#banner2').val(thumbnail_url);
                        $('.loading2').hide();
                    }
                })
            })

            //update theme
            $('#header1-select').click(function() {
                $.ajax({
                    url: '<?php echo $url . "api/update_header.php"; ?>',
                    method: 'POST',
                    data: {
                        community_id: '<?php echo $_SESSION['community_id'] ?>',
                        current_header: 'Header1'
                    },
                    success: function(data) {
                        alertify.success(data);
                        $('#header1-select').html('Selected');
                        $('#header2-select').html('Select');
                    }

                })
            })
            $('#header2-select').click(function() {
                $.ajax({
                    url: '<?php echo $url . "api/update_header.php"; ?>',
                    method: 'POST',
                    data: {
                        community_id: '<?php echo $_SESSION['community_id'] ?>',
                        current_header: 'Header2'
                    },
                    success: function(data) {
                        alertify.success(data);
                        $('#header1-select').html('Select');
                        $('#header2-select').html('Selected');
                    }

                })
            });

            $('#edit-header2').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo $url . "api/update_header.php"; ?>',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alertify.success(data);
                        $('#header2').removeClass('active');
                    }

                })
            })
            $('#edit-header1').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo $url . "api/update_header.php"; ?>',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alertify.success(data);
                        $('#header1').removeClass('active');
                    }
                })
            });
        })
    </script>
</body>

</html>