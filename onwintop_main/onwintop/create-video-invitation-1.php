<?php
include "init.php";
$data = R::findOne("videoprojects", "link=?", [$id]);
if (isset($_POST['title']) && isset($_POST['banner']) && isset($_POST['expiry'])) {
    $_POST['banner_url']=$url .'images/uploads/'.$_POST['banner'];
    $obj=json_encode($_POST);
    $branding=R::findOne("videobrandings", "link=?", [$id]);
    $branding['welcome_json']=$obj;
    if(R::store($branding)){
        if($_POST['method']=='next'){
            echo "<script>window.location='".URL_Make("/collect-video-information/" . $id)."'</script>";
        }
    }
}
$new=true;
$branding=R::findOne("videobrandings", "link=?", [$id]);
if($branding['welcome_json']!=null){
    $new=false;
    $branding=json_decode($branding['welcome_json'],true);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Create Video Invitation -
        <?php echo $data['name']; ?> | Videos -
        <?php echo $title; ?>
    </title>
    <?php include "includes/head.php"; ?>
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .new-comment form button i {
            transform: rotate(1deg) !important;
        }

        .vjs-big-play-centered .vjs-big-play-button {
            top: 50%;
            left: 50%;
            border-radius: 50%;
            margin-top: -0.81666em;
            margin-left: -1.5em;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .modal-dialog {
            max-width: 750px;
            margin: 1.75rem auto;
        }

        .modal {
            top: 20% !important;
        }

        .wrapper {
            padding-left: 130px;
            padding-right: 130px;
        }

        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            background-color: #19dd3e !important;
            border-color: #19dd3e !important;
        }

        .form-control {
            color: #000000;
        }

        ::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #c4c4c4 !important;
            opacity: 1;
            /* Firefox */
        }
    </style>

    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />
    <script
        src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        type="text/css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        #map {
            position: relative;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>

        <?php include "includes/nav.php"; ?>

        <section style="background-color:#f0f1f2b5">
            <div class="gap">
                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12 px-5">
                            <div id="page-contents px-5" class="row merged20">
                                <div class="col-lg-12 py-3">

                                    <h4 class='text-secondary'>Manage Video Projects</h4></br>
                                    <a class='mb-2 mt-2' href='<?php URL('/video-projects'); ?>'>
                                        <b>
                                            << Back to Videos</b>
                                    </a>
                                    <?php
                                    if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] != true) {
                                        echo '<script>window.location="' . URL_Make('/videos') . '";</script>';
                                    }
                                    ?>
                                    <div class="main-wraper px-0"
                                        style="background-color:#F0F1F2 !important;font-family: 'Roboto', sans-serif;padding:0px">
                                        <div class="header wrapper" style="width:100%;background-color:#ffffff;">
                                            <div class="container px-5 py-3">
                                                <div class="row" style="display:flex;align-items:center;">
                                                    <div class="col-md-8">
                                                        <h5 id='name'><?php echo $data['name']; ?></h5>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <a href='<?php URL("/video-project/" . $id) ?>'
                                                            style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-secondary px-3">Close</a>
                                                        <button id='next'
                                                            style="float:right;margin-right:15px;background-color:var(--primary-color);border:none;"
                                                            class="btn btn-secondary px-3">Next</button>
                                                        <button id='save'
                                                            style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-dark px-3">Save</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="wrapper">
                                            <div class="container px-0 py-5">
                                                <div class="row mt-0">
                                                    <form id='save_form' action='' method='post' class="col-md-8">
                                                        <h6> <b>Brief your contribution</b> </h6>
                                                        <div class="form-group mt-4 text-center">
                                                            <label for="">Hero video/image</label>
                                                            <div
                                                                style="display:flex;align-items:center;justify-content:center">
                                                                <div id='banner' banner-url="<?php if(!$new){ echo $branding['banner'];}else{ echo "demo-wall.png"; } ?>"
                                                                    style="height:200px;display:flex;align-items:center;justify-content:center;width:400px;background-image:url(<?php if(!$new){  echo $url."images/uploads/".$branding['banner'];}else{ URI('/images/demo-wall.png'); }; ?>);background-size:cover;background-position:center">
                                                                    <div class="btn-group" id='actions' role="group"
                                                                        aria-label="Basic example">
                                                                        <button type="button"
                                                                            class="btn btn-secondary px-4"
                                                                            id='video-btn'
                                                                            style="background-color:#00000050;color:#ffffff;border:1px solid #ffffff;"><i
                                                                                class="fa fa-video-camera"
                                                                                aria-hidden="true"></i></button>
                                                                        <button type="button" id='photo-btn'
                                                                            class="btn btn-secondary px-4"
                                                                            style="background-color:#00000050;color:#ffffff;border:1px solid #ffffff;"><i
                                                                                class="fa fa-file-image"
                                                                                aria-hidden="true"></i></button>

                                                                    </div>

                                                                    <input type='file' style="display:none"
                                                                        accept=".mp4,.mov" id='video-file' />
                                                                    <input type='file' style="display:none"
                                                                        accept=".jpg,.png,.gif" id='photo-file' />
                                                                    <div class="btn-group text-white" id='loading'
                                                                        style='display:none' role="group"
                                                                        aria-label="Basic example">
                                                                        <button type="button"
                                                                            class="btn btn-secondary px-4"
                                                                            id='video-btn'
                                                                            style="background-color:#00000050;color:#ffffff;border:1px solid #ffffff;">
                                                                            <b>Loading...</b></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-5" style="height:auto;width:100%;">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="">Give your page a title <span
                                                                                class="text-danger">*</span> </label>
                                                                        <input type="text"
                                                                            value="<?php if(!$new){ echo $branding['title'];} else echo 'B2B Testimonial - 2023 June - 2024 May';?>"
                                                                            name="title" id="title" class="form-control"
                                                                            required>
                                                                        <input type="hidden" name="banner"
                                                                            id='banner_url'>
                                                                        <input type="hidden" name="type"
                                                                            id='banner_type'>
                                                                        <input type="hidden" name="method" value="save" id="method"/>                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Expiry date<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="date" name="expiry"
                                                                            id="expiry_date" class="form-control" value="<?php if(!$new){ echo $branding['expiry'];} else { $date = date('Y-m-d');
                                                                            $date = strtotime($date);
                                                                            $date = strtotime("+7 day", $date);
                                                                            echo date('Y-m-d', $date); } ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Add an incentive to encourage your
                                                                            contributors</label>
                                                                        <input type="text" placeholder="Type here..."
                                                                            name="incentive" id="incentive" value="<?php if(!$new){ echo $branding['incentive'];}?>"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Tell your contributors how to
                                                                            participate<span
                                                                                class="text-danger">*</span></label>
                                                                        <textarea type="text"
                                                                            placeholder="Contribute to the project 'B2B Testimonial' by uploading your 10-15 second clip here. "
                                                                            name="description" rows="3" id="description"
                                                                            class="form-control"
                                                                            required><?php if(!$new){ echo $branding['description'];} else echo 'Contribute to the project B2B Testimonial - 2023 June - 2024 May by uploading your 10-15 second clip here.';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Set your project rules<span
                                                                                class="text-danger">*</span> </label>
                                                                        <textarea type="text"
                                                                            placeholder="By uploading your video clip, you are granting permissions to re-use. See T&Cs for more details."
                                                                            name="rules" rows="3" id="rules"
                                                                            class="form-control"
                                                                            required><?php if(!$new){ echo $branding['rules'];} else {echo 'By uploading your video clip, you are granting permissions to re-use. See T&Cs for more details.'; } ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Share some tips to get the better
                                                                            video contributions</label>
                                                                        <textarea type="text" name="tips" rows="2"
                                                                            placeholder="Prop up your phone so the video is stead - Ensure the video is horizontal - Use good/natural lighting and show us your personality! - This video is all about YOU!"
                                                                            id="tips"
                                                                            class="form-control"><?php if(!$new){ echo $branding['tips'];} else echo 'Prop up your phone so the video is stead - Ensure the video is horizontal - Use good/natural lighting and show us your personality! - This video is all about YOU!';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Link to your own terms and
                                                                            conditions<span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text"
                                                                            placeholder="https://mydoamin.com/terms-and-conditions"
                                                                            name="terms_conditions"
                                                                            id="terms_conditions" value="<?php if(!$new){ echo $branding['terms_conditions'];}?>" class="form-control"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="col-md-4">
                                                        <h6><b>Preview</b>
                                                            <small><a href="#" id='preview_link' target="_blank"
                                                                    class='text-primary'>( View Live )</a></small>
                                                        </h6>
                                                        <div class="phone mt-2"
                                                            style="height:auto;width:auto;border:10px solid #000000;border-radius:20px;">
                                                            <iframe id='preview'
                                                                src="<?php URL('/video-invitation/preview/123'); ?>"
                                                                style="height:530px;width:100%;border-radius:10px;"
                                                                frameborder="0"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
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
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.1/Youtube.min.js"
        integrity="sha512-W11MwS4c4ZsiIeMchCx7OtlWx7yQccsPpw2dE94AEsZOa3pmSMbrcFjJ2J7qBSHjnYKe6yRuROHCUHsx8mGmhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#video-btn').click(function () {
                $('#video-file').click();
            })
            $('#photo-btn').click(function () {
                $('#photo-file').click();
            })

            function loading() {
                $('#actions').hide();
                $('#loading').show();
            }

            function done() {
                $('#actions').show();
                $('#loading').hide();
            }

            //changes
            var title, incentive, description, rules, tips, terms_conditions, banner = "";
            var banner_type = "image";
            retrive();
            function retrive() {
                title = $('#title').val();
                incentive = $('#incentive').val();
                description = $('#description').val();
                logo = '<?php echo $brand['logo']; ?>';
                rules = $('#rules').val();
                tips = $('#tips').val();
                terms_conditions = $('#terms_conditions').val();
                banner = $('#banner').attr('banner-url');
                $('#banner_type').val(banner_type);
                $('#banner_url').val(banner);
                var obj = {
                    title, logo, incentive, description, rules, tips, terms_conditions, banner_type, page: 1, wall: banner
                }
                enc = btoa(JSON.stringify(obj));
                enc = enc.replace("/", '_');
                base_url = "<?php URL('/video-invitation/preview/'); ?>" + enc;
                $('#preview_link').attr('href', base_url);
                $('#preview').attr('src', base_url);
            }
            $('.form-control').on('change', function () {
                retrive();
            });
            $('#photo-file').on('change', function () {
                thumbnail = $('#photo-file')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                loading();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_local_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        banner = '<?php echo $url .'images/uploads/'; ?>' + data.secure_url;
                        console.log(banner)
                        banner_type = 'image';
                        $('#banner_type').val(banner_type);
                        $('#banner_url').val(banner);
                        $('#banner').css('background-image', 'url("' + banner + '")');
                        $('#banner').attr('banner-url', data.secure_url);
                        done();
                        retrive();
                    }
                })
            })

            //saving data
            $('#save').click(function () {
                $('#save_form')[0].submit();
            })
            $('#next').click(function () {
                $('#method').val('next');
                $('#save_form')[0].submit();
            })
        })
    </script>
</body>

</html>