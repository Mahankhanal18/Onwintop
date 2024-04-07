<?php
include "init.php";
$custom_codes = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $preview = false;
    $collect = true;
    $thank = false;
    $preview = true;
    $id = str_replace("_", "/", $id);
    $data = R::findOne("videobrandings", "link=?", [$id]);
    $brand = $data;
    $welcome = json_decode($brand['welcome_json'], true);
    $collect_info = json_decode($data['information_json'], true);
    $thank = json_decode($data['thank_json'], true);

    $vb = $brand;
    ?>
    <title>Create Video Invitation</title>
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
    <script src="https://unpkg.com/konva@^2/konva.min.js"></script>


</head>

<body>
    <div class="theme-layout">
        <div class="container_">
            <div id='container' style='display:none'></div>
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
                    <div class="wall" style="width:100%;left:0px">
                        <img class='mt-4' src="<?php echo $welcome['banner_url']; ?>" id='banner'
                            style="width:100%;height:auto" alt="" srcset="">

                    </div>

                    <div class="action py-4 px-3 text-center">
                        <a id='start' class="btn btn-primary btn-lg text-white"
                            style="background-color:var(--primary-color);border:none;width:100%">GET STARTED</a>
                    </div>
                    <div class="content px-3 mb-5 pb-5">
                        <b>How to participate:</b>
                        <p>
                            <?php echo $welcome['description']; ?>
                        </p>
                        <b>Filming tips:</b>
                        <p>
                        <ul>
                            <li>
                                <?php echo $welcome['tips']; ?>
                            </li>
                        </ul>
                        </p>
                        <b>Project rules:</b>
                        <p>
                            <?php echo $welcome['rules']; ?>
                        </p>
                    </div>
                </div>
                <!--Upload Screen-->
                <div id='upload' style="display:none;" class="col-md-4 col-sm-12 border"
                    style="padding-right:0px;background-color:#ffffff;padding-left:0px">
                    <div class="header px-3 mt-5">



                        <h3 class='text-center'>Upload your video</h3>

                        <video style="width:100%;height:250px;margin-top:15px;display:none" controls>
                            <source id='video-src' src="https://res.cloudinary.com/demo/video/upload/dog.mp4"
                                type="video/mp4">
                        </video>

                        <p class="text-center py-3">
                        <ul>
                            <li>Max video size : <b>160mb</b> </li>
                            <li>Accepted formats : <b>mp4, avi, mov</b> </li>
                        </ul>
                        </p>
                    </div>

                    <div class="action py-4 text-center">
                        <div class='loading' style="display:none">
                            <div class="text-center"
                                style="width:100%;display: flex;align-items: center;justify-content: center;">
                                <img src='<?php echo $url . "images/loader.gif" ?>'
                                    style="display:block;width:20%;height:auto;" />
                            </div>
                        </div>

                        <a id='upload-btn' class="btn btn-primary btn-lg"
                            style="background-color:#ebebeb;color:#000000;padding:25px;border:3px dotted var(--primary-color);">
                            <u><b>Tab here</b></u> to select from my library
                        </a>
                    </div>
                    <form action='' method='post' id='upload-form' class="content px-3 mb-5 pb-0">
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
                            <input class="form-check-input" type="checkbox" value="" id="agree">
                            <input type="file" accept=".mp4,.mov" id="upload-video" style='display:none'>
                            <label class="form-check-label" for="agree">
                                I confirm this is my own work and agree with the <a href="#" class='text-primary'>user
                                    terms</a>
                            </label>
                        </div>
                        <div class="mx-3">
                            <button type='submit' id='upload-submit' class="btn btn-primary btn-lg mt-5"
                                style="background-color:var(--primary-color);border:none;width:100%;padding:14px;margin-bottom:150px">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <!--Collect Details-->
                <div id='collect' class="col-md-4 col-sm-12 border px-2"
                    style="padding-right:0px;background-color:#ffffff;padding-left:0px;display:none">
                    <form action='' method='post' id='collect-form' class="content px-3 mb-5 pb-0 pt-5">
                        <div class="form-group mt-2">
                            <label for="">
                                Your name<span class='text-danger'>*</span>
                            </label>
                            <input type="text" name="" data-label="name" class="form-control collect-input" required>
                        </div>
                        <?php if ($collect == true && $collect_info['collect_email'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    Your email<span class='text-danger'>*</span>
                                </label>
                                <input type="email" name="" id="" data-label="email" class="form-control collect-input"
                                    required>
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $collect_info['collect_location'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    Your location<span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" data-label="location" class="form-control collect-input"
                                    required>
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $collect_info['collect_prompt1'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    <?php if ($collect)
                                        echo $collect_info['prompt1']; ?><span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" data-label="prompt1" class="form-control collect-input"
                                    required>
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $collect_info['collect_prompt2'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    <?php if ($collect)
                                        echo $collect_info['prompt2']; ?><span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" data-label="prompt2" class="form-control collect-input"
                                    required>
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $collect_info['collect_prompt3'] == 'on') { ?>
                            <div class="form-group mt-2">
                                <label for="">
                                    <?php if ($collect)
                                        echo $collect_info['prompt3']; ?><span class='text-danger'>*</span>
                                </label>
                                <input type="text" name="" id="" data-label="prompt3" class="form-control collect-input"
                                    required>
                            </div>
                        <?php } ?>

                        <?php if ($collect == true && $data['collect_rating'] == 'on') { ?>
                            <label for="" class="mt-2">
                                <?php if ($collect)
                                    echo $collect_info['rating']; ?><span class='text-danger'>*</span>
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
                            <button type="submit" class="btn btn-primary btn-lg mt-5"
                                style="background-color:var(--primary-color);border:none;width:100%;padding:14px;margin-bottom:150px">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <!--Thank you screen-->
                <div id='thank' class="col-md-4 col-sm-12 border px-2"
                    style="display:none;padding-right:0px;background-color:#f7f7f7 !important;padding-left:0px;">
                    <div class="header px-3 mt-5 text-center">
                        <img src="<?php echo $url . "images/check.png"; ?>" style="width:150px" alt="" srcset="">
                        <h3 class='text-center mt-3'>
                            <?php echo $thank['message']; ?>
                        </h3>
                        <div class="mx-3">
                            <a href="<?php
                            echo $thank['action_link']; ?>" class="btn btn-primary btn-lg mt-5"
                                style="background-color:var(--primary-color);border:none;width:100%;padding:14px;">
                                <?php
                                echo $thank['action_label']; ?>
                            </a>
                        </div>
                    </div>

                    <div class="action py-4 text-center">
                        </br>
                        <h5 class='text-center'>OR</h5></br>
                        <a onclick="location.reload();" class="btn btn-primary btn-lg"
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
    var layer_url = '';
    $(document).ready(function () {

        //Video Upload Section
        var video_url = '';
        var thumbnail = '';
        //agree or not
        $('#upload-submit').prop('disabled', true);
        $('#agree').on('change', function () {
            if ($('#agree').is(':checked')) {
                $('#upload-submit').prop('disabled', false);
            } else {
                $('#upload-submit').prop('disabled', true);
            }
        })
        $('#upload-btn').click(function () {
            $('#upload-video').click();
        })
        $('#upload-video').on('change', function () {
            thumbnail_form = new FormData();
            type = $(this).attr('id');
            thumbnail = $('#upload-video')[0].files[0];
            thumbnail_form.append('file', thumbnail);
            //loading
            $('#upload-btn').hide();
            $('.loading').show();
            $.ajax({
                url: '<?php echo $_ENV['project_url']; ?>api/upload_file.php',
                method: 'post',
                data: thumbnail_form,
                contentType: false,
                processData: false,
                success: function (data) {
                    data = JSON.parse(data);
                    url = data.secure_url;
                    video_url = url;
                    $('#video-src').attr('src', url);
                    $('video')[0].load();
                    MakeThumbnail(video_url);
                }
            })
        })

        function MakeThumbnail(url) {
            $.ajax({
                url: '<?php echo $_ENV['project_url']; ?>api/video-thumbnail.php',
                method: 'post',
                data: {
                    'url': url
                },
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    url = data.url;
                    thumbnail = url;
                    console.log(thumbnail);
                    $('.loading').hide();
                    $('#upload-btn').show();
                    $('video').show();
                }
            })
        }

        $('#upload-form').on('submit', function (e) {
            e.preventDefault();
            if (video_url.length != 0) {
                $('#upload').hide();
                $('#collect').show();
            } else {
                alert('Please select the video first!');
            }
        })


        //Collect informations
        var rating = -1;
        var collect = [];
        $('#collect-form').on('submit', function (e) {
            e.preventDefault();
            $('#loading').show();
            inputs = document.querySelectorAll('.collect-input');
            for (i = 0; i < inputs.length; i++) {
                input = inputs[i];
                label = input.getAttribute('data-label');
                value = input.value;
                dat = { 'label': label, 'value': value };
                collect.push(dat);
            }
            if (rating != -1) {
                dat = { 'label': 'rating', 'value': rating };
                collect.push(dat);
            }


            $('#upload-submit').prop('disabled', true);
            var test = '[]';
            <?php
            if (strlen($vb['branding_image']) != 0) {
                $img_data = json_decode($vb['branding_json'], true);
                echo "
                test=" . json_encode($img_data) . ";
                ";
            }
            ?>

            for (i = 0; i < collect.length; i++) {
                obj = collect[i];
                label = obj.label;
                value = obj.value;
                if (label == 'location') {
                    test = test.replace('{{ Place Name }}', value);
                }
                if (label == 'name') {
                    test = test.replace('{{ Contributor Name }}', value);
                }
                if (label == 'prompt1') {
                    test = test.replace('{{ Prompt 1 answer will appear here }}', value);
                }
                if (label == 'prompt2') {
                    test = test.replace('{{ Prompt 2 answer will appear here }}', value);
                }
                if (label == 'prompt3') {
                    test = test.replace('{{ Prompt 3 answer will appear here }}', value);
                }
                test = test.replace('{{ Date & Time }}', '<?php echo date('d M Y h:ia'); ?>');
            }
            DisplayData(test);
            setTimeout(function () {
                var dataURL = stage.toDataURL({ pixelRatio: 1 });
                var id = '<?php echo $id; ?>';
                $.ajax({
                    url: '<?php echo $url . "api/base64_image_store.php"; ?>',
                    method: 'POST',
                    data: {
                        name: id,
                        code: dataURL
                    },
                    success: function (data) {
                        layer_url = data;
                        var form = {
                            collectables: JSON.stringify(collect),
                            community_id: '<?php echo $community_id; ?>',
                            project_id: '<?php echo $id; ?>',
                            layer_url,
                            url,thumbnail
                        };
                        $.ajax({
                            url: '<?php echo $_ENV['project_url']; ?>api/new-video.php',
                            method: 'post',
                            data: form,
                            success: function (data) {
                                data = JSON.parse(data)
                                if (data.status == 'Successful') {
                                    $('#loading').hide();
                                    $('#collect').hide();
                                    $('#thank').show();
                                    $('#upload-submit').prop('disabled', false);
                                }
                            }
                        })
                    }
                })

            }, 2000);


        })

        $('#intro').show();

        $('#start').click(function () {
            $('#intro').hide();
            $('#upload').show();
        })

        $(':radio').change(function () {
            rating = this.value;
        });
    })
    $(window).load(function () {
        $('#loading').hide();
    });
</script>
<script id="jsbin-javascript">
    var appHistories = [];
    var appHistory = null;

    var upload_api = '<?php echo $_ENV['project_url']; ?>api/upload_file.php';
    var team_logo = '<?php echo $vb['team_logo']; ?>';
    var video_logo = '<?php echo $vb['video_logo']; ?>';

    function SaveData() {
        var dataURL = stage.toDataURL({ pixelRatio: 1 });
        var id = '<?php echo $id; ?>';
        $.ajax({
            url: '<?php echo $url . "api/base64_image_store.php"; ?>',
            method: 'POST',
            data: {
                name: id,
                code: dataURL
            },
            success: function (data) {
                layer_url = data;
                return data;
            }
        })
    }

    var stage = new Konva.Stage({
        container: "container", // id of container <div>
        width: 761,
        height: 450,
    });

    const layer = new Konva.Layer();
    stage.add(layer);


    item_selected = false;
    element = null;

    var already_exported = false;

    function DisplayData(data) {
        stage.find('.element').destroy();
        layer.draw();
        data = JSON.parse(data);
        console.log('display request');
        data.forEach((element, i) => {
            type = element.type;
            if (type == 'Text') {
                var simpleText = new Konva.Text({
                    x: element.x,
                    y: element.y,
                    text: element.text,
                    fontSize: element.fontSize,
                    fontFamily: element.fontFamily,
                    fill: element.fill,
                    name: "element",
                    draggable: true,
                });
                layer.add(simpleText);
                layer.draw();
            }
            if (type == 'Rect') {
                var rect = new Konva.Rect({
                    x: element.x,
                    y: element.y,
                    width: element.width,
                    height: element.height,
                    fill: element.fill,
                    name: "element"
                });
                // add the shape to the layer
                rect.draggable(true);
                layer.add(rect);
                layer.draw();
            }
            if (type == 'Image') {
                Konva.Image.fromURL(
                    element.url,
                    function (darthNode) {
                        darthNode.setAttrs({
                            x: element.x,
                            y: element.y,
                            height: element.height,
                            width: element.width,
                            name: "element",
                        });
                        darthNode.draggable(true);
                        layer.add(darthNode);
                        layer.draw();
                    }
                );
            }
        })
    }

        //Saving data
</script>
<script src="<?php URI("js/video-editor.js"); ?>"></script>

</html>