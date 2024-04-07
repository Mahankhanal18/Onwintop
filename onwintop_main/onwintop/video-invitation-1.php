<?php
include "init.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Create Video Invitation
        <?php echo $data['name']; ?> | Videos -
        <?php echo $title; ?>
        <?php
        $preview = false;
        $collect = false;
        $thank=false;
        if ($type == 'preview') {
            $preview = true;
            $id = str_replace("_", "/", $id);
            $data = base64_decode($id);
            $data = json_decode($data, true);
            if ($data['page'] == 3) {
                $collect = true;
            }
            if ($data['page'] == 4) {
                $thank = true;
            }
        } else {

        }
        ?>
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

        b,
        p,
        li {
            font-size: 17px !important;
            text-align: justify;
        }

        body {
            background-color: #ebebeb;
        }

        input[type=checkbox] {
            border-radius: 4px;
            height: 20px;
            width: 20px;
            margin-right: 5px;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 0px;
        }

        #loading {
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            opacity: 0.7;
            background-color: var(--primary-color);
            z-index: 99;
        }

        #loading-image {
            z-index: 100;
        }

        .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 25px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon_ {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon_ {
            color: #000;
        }

        .rating:not(:hover) label input:checked~.icon_,
        .rating:hover label:hover input~.icon_ {
            color: #ffd700;
        }

        .rating label input:focus:not(:checked)~.icon_:last-child {
            color: #000;
            text-shadow: 0 0 5px #ffd700;
        }
    </style>


</head>

<body>
    <div class="theme-layout">
        <div class="container_">
            <div class="row">
                <div class="col-md-4 col-sm-0"></div>
                <!--Intro screen-->
                <div id='intro' class="col-md-4 col-sm-12 border px-2"
                    style="padding-right:0px;background-color:#ffffff;padding-left:0px;display:none">
                    <div class="header px-3 mt-5">
                        <h4 class='text-center mb-5'>
                            <?php echo $data['title']; ?>
                        </h4>
                        <?php
                        //get current community name
                        $community_name = R::findOne("communities", "WHERE link=?", [$_SESSION['community_id']]);
                        if (strlen($brand['logo']) != 0) {
                            echo '<img src="' . $brand['logo'] . '" style="height:35px;width:auto;float:left;margin-right:30px;padding-right:30px;border-right:5px solid #ffffff;"/>';
                        }
                        ?>
                    </div>
                    <?php if ($data['banner_type'] == 'image') { ?>
                        <div class="wall" style="width:100%;left:0px">
                            <img class='mt-4' src="<?php echo $url . 'images/uploads/' . $data['wall']; ?>" id='banner'
                                style="width:100%;height:auto" alt="" srcset="">

                        </div>
                    <?php }
                    ?>

                    <div class="action py-4 px-3 text-center">
                        <a href='#' id='start' class="btn btn-primary btn-lg"
                            style="background-color:var(--primary-color);border:none;width:100%">GET STARTED</a>
                    </div>
                    <div class="content px-3 mb-5 pb-5">
                        <b>How to participate:</b>
                        <p>
                            <?php echo $data['description']; ?>
                        </p>
                        <b>Filming tips:</b>
                        <p>
                        <ul>
                            <li>
                                <?php echo $data['tips']; ?>
                            </li>
                        </ul>
                        </p>
                        <b>Project rules:</b>
                        <p>
                            <?php echo $data['rules']; ?>
                        </p>
                    </div>
                </div>
                <!--Upload Screen-->
                <div id='upload' style="display:none;" class="col-md-4 col-sm-12 border"
                    style="padding-right:0px;background-color:#ffffff;padding-left:0px">
                    <div class="header px-3 mt-5">
                        <h3 class='text-center'>Upload your video</h3>
                        <p class="text-center py-3">
                        <ul>
                            <li>Max video size : <b>160mb</b> </li>
                            <li>Accepted formats : <b>mp4, avi, mov</b> </li>
                        </ul>
                        </p>
                    </div>
                    <div class="action py-4 text-center">
                        <a href="#" class="btn btn-primary btn-lg"
                            style="background-color:#ebebeb;color:#000000;padding:25px;border:3px dotted var(--primary-color);">
                            <u><b>Tab here</b></u> to select from my library
                        </a>
                    </div>
                    <div class="content px-3 mb-5 pb-0">
                        <p class='text-secondary' style="text-align:justify;font-size:8px;padding:10px">
                            By clicking "I confirm" below, I accept the terms set out int the <a href=""
                                class="text-primary">Consent Assignment Agreement</a> and hereby irrevocably assign to
                            absolutely and with full title guarantee, all intellectual property rights and internest and
                            all other rights in and to the Content (regardless of the format such Content is submitted
                            in by me). Furthermone, I hereby confirm and agree that form the date I accept these terms
                            and conditions and those firhter specified in the Content Assignment Agreement, shall be
                            exclusively entitled to exploit the Content in any manner or context, throughout the world,
                            on any and all media whether now know or hereafter invented and in perpetuity. I also
                            confirm that any third party or person who is featured in the Content has agreed to such
                            terms and conditions.
                        </p>
                        <div class="form-check mx-4 text-center" style="font-size:20px">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                I confirm this is my own work and agree with the <a href="#" class='text-primary'>user
                                    terms</a>
                            </label>
                        </div>
                        <div class="mx-3">
                            <a href="#" class="btn btn-primary btn-lg mt-5"
                                style="background-color:var(--primary-color);border:none;width:100%;padding:14px;">SUBMIT</a>
                        </div>
                    </div>
                </div>
                <!--Collect Details-->
                <div id='collect' class="col-md-4 col-sm-12 border px-2"
                    style="padding-right:0px;background-color:#ffffff;padding-left:0px;display:none">
                    <div class="content px-3 mb-5 pb-0 pt-5">
                        <div class="form-group mt-2">
                            <label for="">
                                Your name<span class='text-danger'>*</span>
                            </label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <?php if ($collect == true && $data['collect_email'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    Your email<span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $data['collect_location'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    Your location<span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $data['collect_prompt1'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    <?php if ($collect)
                                        echo $data['prompt1']; ?><span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $data['collect_prompt2'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    <?php if ($collect)
                                        echo $data['prompt2']; ?><span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $data['collect_prompt3'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    <?php if ($collect)
                                        echo $data['prompt3']; ?><span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $data['collect_rating'] == 'on') { ?>
                            <label for="" class="mt-2">
                                <?php if ($collect)
                                    echo $data['rating']; ?><span class='text-danger'>*</span>
                            </label>
                            <div class="rating-holder" style="display:flex;justify-content:center;">
                                <div class="rating">
                                    <label>
                                        <input type="radio" name="stars" value="1" />
                                        <span class="icon_">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="2" />
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="3" />
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="4" />
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="5" />
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                        <span class="icon_">★</span>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>


                        <div class="mx-3">
                            <a href="#" class="btn btn-primary btn-lg mt-5"
                                style="background-color:var(--primary-color);border:none;width:100%;padding:14px;">SUBMIT</a>
                        </div>
                    </div>
                </div>
                <!--Thank you screen-->
                <div id='thank' class="col-md-4 col-sm-12 border px-2"
                    style="display:none;padding-right:0px;background-color:#f7f7f7 !important;padding-left:0px;">
                    <div class="header px-3 mt-5 text-center">
                        <img src="<?php echo $url . "images/check.png"; ?>" style="width:150px" alt="" srcset="">
                        <h3 class='text-center mt-3'><?php if($thank) echo $data['message'];?></h3>
                        <div class="mx-3">
                            <a href="<?php if($thank) echo $data['action_link'];?>" class="btn btn-primary btn-lg mt-5"
                                style="background-color:var(--primary-color);border:none;width:100%;padding:14px;">
                                <?php if($thank) echo $data['action_label'];?>
                            </a>
                        </div>
                    </div>

                    <div class="action py-4 text-center">
                        </br>
                        <h5 class='text-center'>OR</h5></br>
                        <a href="#" class="btn btn-primary btn-lg"
                            style="background-color:#ebebeb;color:#000000;padding:18px;border:3px dotted var(--primary-color);">
                            <b>Upload more clips</b>
                        </a>
                    </div>
                    <footer class='text-center mt-5' style="bottom:0px;margin-bottom:0;padding:10px">
                        <small>Thanks for using the Tellselling platform</small>
                    </footer>
                </div>
                <div class="col-md-4  col-sm-0"></div>
            </div>

        </div>
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

</body>
<div id="loading">
    <img id="loading-image" style="height:50px;width:50px" src="<?php echo $url . "images/loader.gif" ?>"
        alt="Loading..." />
</div>
<script>
    $(document).ready(function () {
        //screening
        var type = '<?php echo $type; ?>';
        if (type == 'preview') {
            page = '<?php echo $data['page']; ?>';
            if (page == 1) {
                $('#intro').show();
            }
            if (page == 2) {
                $('#upload').show();
            }
            if (page == 3) {
                $('#collect').show();
            }
            if (page == 4) {
                $('#thank').show();
            }
        }

        $('#start').click(function () {
            $('#intro').hide();
            $('#upload').show();
        })

        $(':radio').change(function () {
            console.log('New star rating: ' + this.value);
        });
    })
    $(window).load(function () {
        $('#loading').hide();
    });
</script>

</html>