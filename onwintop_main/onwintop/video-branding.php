<?php
include "init.php";
$data = R::findOne("videoprojects", "link=?", [$id]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Configure Video Branding -
        <?php echo $data['name']; ?> | Videos -
        <?php echo $title; ?>
    </title>
    <?php include "includes/head.php"; ?>
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <?php


    //get saved or default data
    $vb = R::findOne("videobrandings", "community_id=? AND link=?", [$community_id, $id]);

    if (isset($_POST['team_logo']) && isset($_POST['video_logo']) && isset($_POST['type']) && isset($_POST['primary_color'])) {
        if (empty($vb)) {
            $vb = R::dispense("videobrandings");
            $vb->community_id = $community_id;
            $vb->link = $id;
            $vb->font = $_POST['font'];
            $vb->team_logo = $_POST['team_logo'];
            $vb->video_logo = $_POST['video_logo'];
            $vb->secondary_color = $_POST['secondary_color'];
            $vb->primary_color = $_POST['primary_color'];
        }else{
            $vb->font = $_POST['font'];
            $vb->team_logo = $_POST['team_logo'];
            $vb->video_logo = $_POST['video_logo'];
            $vb->secondary_color = $_POST['secondary_color'];
            $vb->primary_color = $_POST['primary_color'];
        }
        if (R::store($vb)) {
            if ($_POST['type'] == 'next') {
                echo "<script>window.location='".URL_Make('/video-editor/'.$id)."';</script>";
            }
        }
    }


    if ($vb['font']==null) {
        $vb['font'] = 'Roboto';
    }
    if ($vb['team_logo']==null) {
        $vb['team_logo'] = URI_Make('/images/team-logo.png');
    }
    if ($vb['video_logo']==null) {
        $vb['video_logo'] = URI_Make('/images/video-logo.png');
    }
    if ($vb['secondary_color']==null) {
        $vb['secondary_color'] = $colors['post_text'];
    }
    if ($vb['primary_color']==null) {
        $vb['primary_color'] = $colors['post_background'];
    }

    ?>
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

        .chosen-container-single .chosen-single {
            display: none !important;
        }

        .chosen-drop {
            display: none;
        }

        #video-logo-btn:hover,
        #team-logo-btn:hover {
            cursor: pointer;
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
                                        style="background-color:#ffffff !important;font-family: 'Roboto', sans-serif;padding:0px">
                                        <div class="header wrapper border-bottom" style="width:100%;background-color:#ffffff;">
                                            <div class="container px-5 py-3">
                                                <div class="row">
                                                    <div class="col-md-8" style="display:flex;align-items:center">
                                                        <h5>
                                                            <?php echo $data['name']; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <a href='<?php URL('/video-project/' . $id); ?>'
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
                                            <div class="container px-5 py-5">
                                                <div class="row mt-0">
                                                    <div class="col-md-12">
                                                        <div class="mt-0" style="height:auto;width:100%;">
                                                            <div class="row border-bottom p-2">
                                                                <div class="col-md-9 p-3">
                                                                    <h5 style="color:#424141">Team Logo</h5>
                                                                    <p class='text-secondary'>Your team logo will be
                                                                        used on your landing pages and as your profile
                                                                        picture (recommended 225x225px).</p>
                                                                    <label class='text-info loading1'
                                                                        style="display:none">Loading...</label>
                                                                </div>
                                                                <div class="col-md-3"
                                                                    style="display:flex;align-items:center;justify-content:center">
                                                                    <img src="<?php echo $vb['team_logo']; ?>"
                                                                        id='team-logo-btn' style="width:120px;height:120px;object-fit:cover;object-position:center"
                                                                        alt="" sizes="" srcset="">
                                                                    <input type="file" class='logo' id="team-logo"
                                                                        accept=".png,.jpg,.jpeg" style="display:none">
                                                                </div>
                                                            </div>
                                                            <div class="row border-bottom p-2">
                                                                <div class="col-md-9 p-3">
                                                                    <h5 style="color:#424141">Video Logo</h5>
                                                                    <p class='text-secondary'>Your video logo is the
                                                                        core part of your video. It will be displayed
                                                                        throughout your video stories and should be
                                                                        defined as a transparent png, and white in color
                                                                        (recommended 400 x 225px).</p>
                                                                    <label class='text-info loading2'
                                                                        style="display:none">Loading...</label>
                                                                </div>
                                                                <div class="col-md-3"
                                                                    style="display:flex;align-items:center;justify-content:center">
                                                                    <img id='video-logo-btn'
                                                                        src="<?php echo $vb['video_logo']; ?>"
                                                                        style="width:230px;height:120px;object-fit:cover;object-position:center" alt="" sizes=""
                                                                        srcset="">
                                                                    <input type="file" class='logo' id="video-logo"
                                                                        accept=".png,.jpg,.jpeg" style="display:none">
                                                                </div>
                                                            </div>
                                                            <div class="row border-bottom p-2">
                                                                <div class="col-md-9 p-3">
                                                                    <h5 style="color:#424141">Primary font</h5>
                                                                    <p class='text-secondary'>Your primary font will
                                                                        apply to your landing pages and by default, will
                                                                        be used for any text overlays on your video
                                                                        stories.</p>
                                                                </div>
                                                                <div class="col-md-3"
                                                                    style="display:flex;align-items:center;justify-content:center">
                                                                    <div class="form-group">
                                                                        <select class='form-control' id="font">
                                                                            <?php
                                                                            if ($vb['font'] != 'Roboto') {
                                                                                echo "<option value='" . $vb['font'] . "'>" . $vb['font'] . "</option>";
                                                                            }
                                                                            ?>
                                                                            <option value='Roboto'>Roboto</option>
                                                                            <option value='Alegreya'>Alegreya</option>
                                                                            <option value='Alegreya+Sans'>Alegreya Sans
                                                                            </option>
                                                                            <option value='Archivo+Narrow'>Archivo
                                                                                Narrow</option>
                                                                            <option value='BioRhyme'>BioRhyme</option>
                                                                            <option value='Cardo'>Cardo</option>
                                                                            <option value='Chivo'>Chivo</option>
                                                                            <option value='Fira+Sans'>Fira Sans</option>
                                                                            <option value='IBM+Plex+Sans'>IBM Plex Sans
                                                                            </option>
                                                                            <option value='Inconsolata'>Inconsolata
                                                                            </option>
                                                                            <option value='Inknut+Antiqua'>Inknut
                                                                                Antiqua</option>
                                                                            <option value='Inter'>Inter</option>
                                                                            <option value='Karla'>Karla</option>
                                                                            <option value='Lato'>Lato</option>
                                                                            <option value='Libre+Baskerville'>Libre
                                                                                Baskerville</option>
                                                                            <option value='Libre+Franklin'>Libre
                                                                                Franklin</option>
                                                                            <option value='Lora'>Lora</option>
                                                                            <option value='Manrope'>Manrope</option>
                                                                            <option value='Merriweather'>Merriweather
                                                                            </option>
                                                                            <option value='Montserrat'>Montserrat
                                                                            </option>
                                                                            <option value='Neuton'>Neuton</option>
                                                                            <option value='Open+Sans'>Open Sans</option>
                                                                            <option value='Playfair+Display'>Playfair
                                                                                Display</option>
                                                                            <option value='Poppins'>Poppins</option>
                                                                            <option value='Proza+Libre'>Proza Libre
                                                                            </option>
                                                                            <option value='PT+Sans'>PT Sans</option>
                                                                            <option value='PT+Serif'>PT Serif</option>
                                                                            <option value='Raleway'>Raleway</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row border-bottom p-2">
                                                                <div class="col-md-9 p-3">
                                                                    <h5 style="color:#424141">Brand colors</h5>
                                                                    <p class='text-secondary'>Your brand colors will be
                                                                        used to customise your landing pages and your
                                                                        video templates.</p>
                                                                </div>
                                                                <div class="col-md-3"
                                                                    style="display:flex;align-items:center;justify-content:center">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group text-center">
                                                                                <label for="">Vibrant</label>
                                                                                <button id='color-vibrant-btn'
                                                                                    style="background-color:<?php echo $vb['secondary_color']; ?>;border:0.5px solid #000000;"
                                                                                    class="form-control btn btn-primary">&nbsp;</button>
                                                                                <input type="color" name=""
                                                                                    id="color-vibrant"
                                                                                    style="visibility:hidden">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group text-center">
                                                                                <label for="">Dark</label>
                                                                                <button id='color-dark-btn'
                                                                                    style="background-color:<?php echo $vb['primary_color']; ?>;border:0.5px solid #000000;"
                                                                                    class="form-control btn btn-primary">&nbsp;</button>
                                                                                <input type="color" name=""
                                                                                    id="color-dark"
                                                                                    style="visibility:hidden">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <form id='form' action="" method='post'>
            <input type="hidden" name="team_logo" value="<?php echo $vb['team_logo'] ?>" id='team_logo'>
            <input type="hidden" name="video_logo" value="<?php echo $vb['video_logo']; ?>" id='video_logo'>
            <input type="hidden" name="font" value="<?php echo $vb['font']; ?>" id='font-val'>
            <input type="hidden" name="type" value="save" id='type'>
            <input type="hidden" name="secondary_color" value="<?php echo $vb['secondary_color']; ?>"
                id='secondary-color'>
            <input type="hidden" name="primary_color" value="<?php echo $vb['primary_color']; ?>" id='primary-color'>
        </form>

        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function () {
            //color handle
            $('#color-vibrant-btn').click(function () {
                $('#color-vibrant').click();
            })
            $('#color-dark-btn').click(function () {
                $('#color-dark').click();
            })
            $('#color-vibrant').on('change', function () {
                var color = $(this).val();
                $('#color-vibrant-btn').css('background-color', color);
                $('#secondary-color').val(color);
            })
            $('#color-dark').on('change', function () {
                var color = $(this).val();
                $('#color-dark-btn').css('background-color', color);
                $('#primary-color').val(color);
            })


            //save
            $('#save').on('click', function () {
                $('#type').val('save');
                $('#form')[0].submit();
            })
            $('#next').on('click', function () {
                $('#type').val('next');
                $('#form')[0].submit();
            })

            //font handle
            $('#font').on('change', function () {
                var font = $('#font').val();
                $('#font-val').val(font);
            })

            //logo handle
            $('.loading1').hide();
            $('.loading2').hide();

            $('#team-logo-btn').click(function () {
                $('#team-logo').click();
            })

            $('#video-logo-btn').click(function () {
                $('#video-logo').click();
            })

            thumbnail_url = '';
            $('.logo').on('change', function () {

                thumbnail_form = new FormData();

                type = $(this).attr('id');
                $('.loading1').hide();
                $('.loading2').hide();
                if (type == 'team-logo') {
                    $('.loading1').show();
                    thumbnail = $('#team-logo')[0].files[0];
                    thumbnail_form.append('file', thumbnail);
                } else {
                    thumbnail = $('#video-logo')[0].files[0];
                    thumbnail_form.append('file', thumbnail);
                    $('.loading2').show();
                }
                $.ajax({
                    url: '<?php echo $_ENV['project_url']; ?>api/upload_file.php',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        url = data.secure_url;
                        if (type == 'team-logo') {
                            $('#team-logo-btn').attr('src', url);
                            $('#team_logo').val(url);
                            $('.loading1').hide();
                        } else {
                            $('#video-logo-btn').attr('src', url);
                            $('#video_logo').val(url);
                            $('.loading2').hide();
                        }

                    }
                })
            })
            $('select').show();
        })
    </script>
</body>

</html>