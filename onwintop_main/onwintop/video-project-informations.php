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

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <?php

    //get saved or default data
    if (isset($_POST['image']) && isset($_POST['data'])) {
        $vb = R::findOne("videobrandings", "community_id=? AND link=?", [$community_id, $id]);
        $vb->branding_image = $url . "images/video-invitation-layers/" . $_POST['image'];
        $vb->branding_json = $_POST['data'];
        R::store($vb);
    }
    $vb = R::findOne("videobrandings", "community_id=? AND link=?", [$community_id, $id]);
    ?>
    <script src="https://unpkg.com/konva@^2/konva.min.js"></script>
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

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn:hover {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .btn:active {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .btn:focus {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .social-share-holder ul li a {
            margin: 20px;
        }

        .social-share-holder ul li a i {
            background-color: #000000;
            color: #ffffff;
            border-radius: 50%;
            padding: 10px;
            font-size: 18px;
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

                                    <h4 class='text-secondary'>Edit Video Projects</h4></br>
                                    <a class='mb-2 mt-2' href='<?php URL('/video-branding/' . $id); ?>'>
                                        <b>
                                            << Back to Videos</b>
                                    </a>
                                    <?php
                                    if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] != true) {
                                        echo '<script>window.location="' . URL_Make('/videos') . '";</script>';
                                    }
                                    ?>
                                    <div class="main-wraper px-0"
                                        style="background-color:#ebebeb !important;font-family: 'Roboto', sans-serif;padding:0px">
                                        <div class="header wrapper" style="width:100%;background-color:#ffffff;">
                                            <div class="container px-5 py-3">
                                                <div class="row">
                                                    <div class="col-md-6" style="display:flex;align-items:center">
                                                        <h5>
                                                            <?php echo $data['name']; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <a href='<?php URL('/video-projects'); ?>'
                                                            style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-secondary px-3">Close</a>
                                                        <button id='next' onclick="window.open('<?php URL('/upload-invitation/'.$id);?>');"
                                                            style="float:right;margin-right:15px;background-color:var(--primary-color);border:none;"
                                                            class="btn btn-secondary px-3">Upload your first video</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="wrapper">
                                            <div class="container px-5 py-2">
                                                <div class="row mt-0">
                                                    <div class="col-md-12">
                                                        <div class="mt-0" style="height:auto;width:100%;">
                                                            <div class="row p-2">
                                                                <div class="col-md-8 p-3">
                                                                    <h5 style="color:#000000">Invite your community</h5>
                                                                    <div class="card mt-2">
                                                                        <div class="card-body p-5 text-center">
                                                                            <p style="font-size:12px"
                                                                                class="text-secondary">Copy this link
                                                                                below and share it with your community
                                                                                to get them to contribute to your video
                                                                                project.</p>
                                                                            <div class="px-5 mt-3">
                                                                                <div class="input-group mb-3 mt-2 px-5">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Video Project URL"
                                                                                        aria-label="Video Project URL"
                                                                                        value="<?php URL("/upload-invitation/".$id);?>"
                                                                                        aria-describedby="basic-addon2">
                                                                                    <div class="input-group-append">
                                                                                        <span
                                                                                            class="input-group-text text-white btn btn-primary copy-url"
                                                                                            id="basic-addon2">Copy
                                                                                            link</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="social-share-holder text-center mt-5">
                                                                                <ul
                                                                                    style="list-style-type:none;display:flex;justify-content:center">
                                                                                    <li>
                                                                                        <a target="_blank" href="mailto:?subject=Invitation to upload video &amp;body=Check out this site <?php URL("/upload-invitation/".$id);?>" title="">
                                                                                            <i style="background-color:#8d8a8a"
                                                                                                class="icofont-envelope"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a target="_blank" href="https://www.facebook.com/sharer.php?t=abc&u=<?php URL("/upload-invitation/".$id);?>" title="">
                                                                                            <i style="background-color:#3d60e8"
                                                                                                class="icofont-facebook"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li><a href="whatsapp://send?text=<?php URL("/upload-invitation/".$id);?>" target="_blank" title=""><i
                                                                                                style="background-color:#0fab26"
                                                                                                class="icofont-whatsapp"></i></a>
                                                                                    </li>
                                                                                    <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php URL("/upload-invitation/".$id);?>" title="">
                                                                                            <i style="background-color:#055286"
                                                                                                class="icofont-linkedin"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <div class="col-md-6">
                                                                            <h5>Physical Event</h5>
                                                                            <div class="card mt-2">
                                                                                <div class="card-body row"
                                                                                    style="display:flex;align-items:center">
                                                                                    <div class="col-md-12 text-center">
                                                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php URL("/upload-invitation/".$id);?>"
                                                                                            style="height:auto;width:47%"
                                                                                            alt="" srcset="">
                                                                                        <a target='_blank' href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php URL("/upload-invitation/".$id);?>" style="font-size:12px"
                                                                                            class="btn btn-primary mt-3">Download
                                                                                            QR Code</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h5>Embed on your website</h5>
                                                                            <div class="card mt-2">
                                                                                <div class="card-body text-center py-4">
                                                                                    <small class="text-secondary">
                                                                                        Copy this code snippet directly
                                                                                        on your landing page or micro
                                                                                        site to allow your audience to
                                                                                        contribute their videos directly
                                                                                        from your website.
                                                                                    </small>
                                                                                    <div
                                                                                        class="input-group mb-3 mt-2 px-5">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="<iframe src='<?php URL("/upload-invitation/".$id);?>'></iframe>"
                                                                                            placeholder="Video Project URL"
                                                                                            aria-label="Video Project URL"
                                                                                            aria-describedby="basic-addon2">
                                                                                        <div class="input-group-append">
                                                                                            <span
                                                                                                class="input-group-text text-white btn btn-primary copy-code"
                                                                                                id="basic-addon2">Copy</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 p-3">
                                                                    <h5>Need some help?</h5>
                                                                    <div class="card mt-2">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-7">
                                                                                    <b>Lauren Hudson</b>
                                                                                    <small
                                                                                        class="text-secondary">Customer
                                                                                        success manager</small>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <img src="<?php echo $url."images/demo_support.jpeg";?>" style="height:70px;width:auto;border-radius:50%" alt="" srcset="">
                                                                                </div>
                                                                                <div class="col-md-12 mt-3">
                                                                                    <p style="text-align:justify">Book a <b>15 mins Onboarding session</b> with me to learn more about the Vloggi platform and to maximize the value of your campaigns. </p>
                                                                                    <button class="btn btn-outline-primary" style="width:100%">Book Now</button>
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
            </div>
        </section>
        <!--POPUPS-->
        <?php include "includes/footer.php"; ?>
    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function(){
            function Copy(copyText,msg) {
                navigator.clipboard.writeText(copyText);
                alertify.success(msg);
            }
            code="<iframe src='<?php URL("/upload-invitation/".$id);?>'></iframe>";
            url="<?php URL("/upload-invitation/".$id);?>";
            $('.copy-code').click(function(){
                Copy(code,'Code Copied');
            })
            $('.copy-url').click(function(){
                Copy(url,'Link Copied');
            })
            
        })

    </script>
    <script src="<?php URI("js/video-editor.js"); ?>"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
</body>

</html>