<?php
include "init.php";
$data = R::findOne("videoprojects", "link=?", [$id]);
if (isset($_POST['collect_name'])) {
    $res=json_encode($_POST);
    $branding=R::findOne("videobrandings", "link=?", [$id]);
    $branding['information_json']=$res;
    if(R::store($branding)){
        if($_POST['method']=='next'){
            echo "<script>window.location='".URL_Make("/thank-video-contributor/" . $id)."'</script>";
        }
    }
}
$new = true;
$branding = R::findOne("videobrandings", "link=?", [$id]);
if ($branding['information_json'] != null) {
    $new = false;
    $branding = json_decode($branding['information_json'], true);
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
                                                        <h5> <b>Collect information about your contributors</b> </h5>
                                                        <div class="mt-2" style="height:auto;width:100%;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">
                                                                                        <label for="">Their
                                                                                            name</label>
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <input type="hidden"
                                                                                            id="collect_name"
                                                                                            name="collect_name"
                                                                                            value="on">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">
                                                                                        <label for="">Their
                                                                                            email</label>
                                                                                    </div>
                                                                                    <input type="hidden" name="method" value="save" id='method'>
                                                                                    <div class="col-md-1">
                                                                                        <div
                                                                                            class="custom-control custom-switch">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input"
                                                                                                name="collect_email"
                                                                                                id="collect_email" <?php if(!$new){ if($branding['collect_email']=='on') echo 'checked'; else echo ''; }else{ echo 'checked'; }?>>
                                                                                            <label
                                                                                                class="custom-control-label"
                                                                                                for="collect_email"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group"
                                                                                style="margin-bottom:0rem;">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">
                                                                                        <label for="">Their
                                                                                            location</label>
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <div
                                                                                            class="custom-control custom-switch">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input"
                                                                                                id="collect_location"
                                                                                                name="collect_location"
                                                                                                <?php if(!$new){ if($branding['collect_location']=='on') echo 'checked'; else echo ''; }else{ echo 'checked'; }?>
                                                                                                >
                                                                                            <label
                                                                                                class="custom-control-label"
                                                                                                for="collect_location"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5 class='mt-4'> <b>Ask them custom prompts</b> </h5>
                                                        <div class="card"
                                                            style="background-color:#ffffff00;border:none;">
                                                            <div class="row card-body">
                                                                <div class="col-md-11">
                                                                    <label for="">Prompt 1</label>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="collect_prompt1" name="collect_prompt1" <?php if(!$new){ if($branding['collect_prompt1']=='on') echo 'checked'; else echo ''; }else{ echo 'checked'; }?>>
                                                                        <label class="custom-control-label"
                                                                            for="collect_prompt1"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="text"
                                                                        value="<?php if(!$new){ echo $branding['prompt1']; }else { echo 'Tell us what is happening in this video'; }?>"
                                                                        name="prompt1" id="prompt1"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row card-body">
                                                                <div class="col-md-11">
                                                                    <label for="">Prompt 2</label>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="collect_prompt2" name="collect_prompt2" <?php if(!$new){ if($branding['collect_prompt2']=='on') echo 'checked'; else echo ''; }else{ echo 'checked'; }?>>
                                                                        <label class="custom-control-label"
                                                                            for="collect_prompt2"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="text"
                                                                        name="prompt2" id="prompt2" value="<?php if(!$new){ echo $branding['prompt2']; }else { echo 'Anything else do you want to add?'; }?>"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row card-body">
                                                                <div class="col-md-11">
                                                                    <label for="">Prompt 3</label>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="collect_prompt3" name="collect_prompt3" <?php if(!$new){ if($branding['collect_prompt3']=='on') echo 'checked'; else echo ''; }else{ echo 'checked'; }?>>
                                                                        <label class="custom-control-label"
                                                                            for="collect_prompt3"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="text"
                                                                        name="prompt3" id="prompt3" value="<?php if(!$new){ echo $branding['prompt3']; }else { echo 'What did you like the most about us?'; }?>"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row card-body">
                                                                <div class="col-md-11">
                                                                    <label for="">Ask your contributor for a
                                                                        rating</label>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <div
                                                                        class="custom-control custom-switch custom-switch-adaptive form-switch-md">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="collect_rating" name="collect_rating" <?php if(!$new){ if($branding['collect_rating']=='on') echo 'checked'; else echo ''; }else{ echo 'checked'; }?>>
                                                                        <label class="custom-control-label"
                                                                            for="collect_rating"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="text"  name="rating" value="<?php if(!$new){ echo $branding['rating']; }else { echo "Rate our product from 1 to 5"; }?>" id="rating"
                                                                        class="form-control">
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
            //changes
            var collect_name, collect_email, collect_location, collect_prompt1, collect_prompt2, collect_prompt3, prompt1, prompt2, prompt3, rating, collect_rating = "";
            retrive();
            function retrive() {
                collect_name = $('#collect_name').val();

                collect_email = "off";
                if ($('#collect_email').is(":checked")) {
                    collect_email = "on";
                }

                collect_location = "off";
                if ($('#collect_location').is(":checked")) {
                    collect_location = "on";
                }

                collect_prompt1 = "off";
                if ($('#collect_prompt1').is(":checked")) {
                    collect_prompt1 = "on";
                }

                collect_prompt2 = "off";
                if ($('#collect_prompt2').is(":checked")) {
                    collect_prompt2 = "on";
                }

                collect_prompt3 = "off";
                if ($('#collect_prompt3').is(":checked")) {
                    collect_prompt3 = "on";
                }

                collect_rating = "off";
                if ($('#collect_rating').is(":checked")) {
                    collect_rating = "on";
                }

                prompt1 = $('#prompt1').val();
                prompt2 = $('#prompt2').val();
                prompt3 = $('#prompt3').val();
                rating = $('#rating').val();
                obj = {
                    collect_name, collect_email, collect_location, collect_rating, collect_prompt1, collect_prompt2, collect_prompt3, prompt1, prompt2, prompt3, rating, page: 3
                }
                console.log(JSON.stringify(obj));
                enc = btoa(JSON.stringify(obj));
                enc = enc.replace("/", '_');

                base_url = "<?php URL('/video-invitation/preview/'); ?>" + enc;
                $('#preview_link').attr('href', base_url);
                $('#preview').attr('src', base_url);
            }
            $('.form-control,.custom-control-input').on('change', function () {
                retrive();
            });

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