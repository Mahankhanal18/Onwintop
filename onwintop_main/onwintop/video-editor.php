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
    if(isset($_POST['image']) && isset($_POST['data'])){
        $vb = R::findOne("videobrandings", "community_id=? AND link=?", [$community_id, $id]);
        $vb->branding_image=$_POST['image'];
        $vb->branding_json=$_POST['data'];
        R::store($vb);
        if($_POST['method']=='next'){
            $next=URL_Make("/video-project-informations/".$id);
            echo "<script>window.location='".$next."';</script>";
        }
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

        .dropdown-menu-right {
            right: 0 !important;
            left: 273px !important;
            padding: 15px;
            top: 387px !important;
            font-size: 12px;
            width: 260px;
            box-shadow: 2px 0px 5px #1b1a1a59;
            transform: translate3d(-206px, -391px, 0px) !important;
        }

        .item {
            padding: 8px;
        }

        .item span {
            margin-left: 8px;
        }

        .item a {
            font-weight: 500;
        }

        .item:hover {
            color: var(--primary-color);
            cursor: pointer;
        }

        #delete:hover {
            background-color: #dc3545 !important;
            border: none !important;
        }

        #undo:active {
            color: #ffffff;
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
                                                    <div class="col-md-8" style="display:flex;align-items:center">
                                                        <h5>
                                                            <?php echo $data['name']; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <a href='<?php URL('/video-branding/' . $id); ?>'
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
                                            <div class="container px-5 py-2">
                                                <div class="row mt-0">
                                                    <div class="col-md-12">
                                                        <div class="mt-0" style="height:auto;width:100%;">
                                                            <div class="row border-bottom p-2">
                                                                <div class="col-md-12 p-3">
                                                                    <h5 style="color:#424141">Design how your
                                                                        contributor's video will look</h5>
                                                                    <section style="width:800px">
                                                                        <div class="row mt-4">
                                                                            <div class="col-md-1" style="display:block">
                                                                                <!--Tools-->
                                                                                <button id='main-btn'
                                                                                    class="btn btn-primary dropdown-toggle"
                                                                                    data-toggle="dropdown"
                                                                                    style="width:100%">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </button>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <b style="text-transform:uppercase">Static
                                                                                        Elements</b>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_logo'>
                                                                                            <i class="fa fa-at"></i>
                                                                                            <span>Logo</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_textbox'>
                                                                                            <i
                                                                                                class="fa fa-text-width"></i>
                                                                                            <span>Text Box</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='item'>
                                                                                        <a id='add_image'>
                                                                                            <i class="fa fa-camera"></i>
                                                                                            <span>Image</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='item'>
                                                                                        <a id='add_rectangle'>
                                                                                            <i class="fa fa-square"></i>
                                                                                            <span>Rectangle</span>
                                                                                        </a>
                                                                                    </li></br>
                                                                                    <b style="text-transform:uppercase">Clip
                                                                                        Smart Fields</b>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_place_name'>
                                                                                            <i
                                                                                                class="fa fa-map-pin"></i>
                                                                                            <span>Place Name</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_location'>
                                                                                            <i
                                                                                                class="fa fa-location-arrow"></i>
                                                                                            <span>Location</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_contributor_name'>
                                                                                            <i class="fa fa-user"></i>
                                                                                            <span>Contributor
                                                                                                Name</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_clip_date_time'>
                                                                                            <i
                                                                                                class="fa fa-calendar"></i>
                                                                                            <span>Clip Date &
                                                                                                Time</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_prompt_ans1'>
                                                                                            <i
                                                                                                class="fa fa-podcast"></i>
                                                                                            <span>Prompt 1 Answer</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_prompt_ans2'>
                                                                                            <i
                                                                                                class="fa fa-podcast"></i>
                                                                                            <span>Prompt 2 Answer</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='border-bottom item'>
                                                                                        <a id='add_prompt_ans3'>
                                                                                            <i
                                                                                                class="fa fa-podcast"></i>
                                                                                            <span>Prompt 3 Answer</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class='item'>
                                                                                        <a id='add_rating'>
                                                                                            <i class="fa fa-star"></i>
                                                                                            <span>Rating</span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                                <button id='undo' onclick="Undo()"
                                                                                    class="btn btn-outline-primary mt-4"
                                                                                    style="width:100%">
                                                                                    <i class="fa fa-undo"></i>
                                                                                </button>
                                                                                <button id='duplicate'
                                                                                    class="btn btn-outline-primary mt-4"
                                                                                    style="width:100%">
                                                                                    <i class="fa fa-clone"
                                                                                        aria-hidden="true"></i>
                                                                                </button>
                                                                                <button id='delete'
                                                                                    class="btn btn-outline-danger mt-4"
                                                                                    style="width:100%">
                                                                                    <i class="fa fa-trash"
                                                                                        aria-hidden="true"></i>
                                                                                </button>
                                                                            </div>
                                                                            <!--
                                                                                    src=""-->
                                                                            <div class="col-md-11 pb-5 mb-5"
                                                                                style="padding-left:0px;width:800px;height:450px;background-image:url(<?php URI('/images/video-holder.jpg'); ?>)">
                                                                                <div id='container'>
                                                                                </div>
                                                                            </div>
                                                                    </section>
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

        <!--TextBox Start-->
        <div class="modal fade" id='textbox-popup' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:500px">
                <form action='' id='text-form' method='post' class="modal-content new-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:23px;font-weight:300">Text box
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="content py-1 px-1" style="display:flex;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="width:100%">
                                        <label>Text</label>
                                        <input id='text' value="Simple Text" type="text" name="name"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="width:100%">
                                        <label>Font</label>
                                        <select id='text-font' class="form-control" required>
                                            <option value="Calibri">Calibri</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Verdana">Verdana</option>
                                            <option value="Tahoma">Tahoma</option>
                                            <option value="Trebuchet MS">Trebuchet MS</option>
                                            <option value="Times New Roman">Times New Roman</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Garamond">Garamond</option>
                                            <option value="Courier New">Courier New</option>
                                            <option value="Brush Script MT">Brush Script MT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="width:100%">
                                        <label>Font Size</label>
                                        <input type="number" value="30" id='text-size' class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="width:100%">
                                        <label>Color</label>
                                        <input type="color" value="#ffffff" id='text-color' class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="btn btn-secondary" data-dismiss="modal">Close</span>
                        <button type="submit" class="btn btn-primary">Add Text box</button>
                    </div>
                </form>
            </div>
        </div>
        <!--TextBox End-->

        <!--Image Insert Start-->
        <div class="modal fade" id='image-popup' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:500px">
                <form action='' id='image-form' method='post' class="modal-content new-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:23px;font-weight:300">Image
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="content py-1 px-1" style="display:flex;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="width:100%">
                                        <label>Image</label>
                                        <input id='image' type="file" accept=".jpg,.png,.jpeg,.gif" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="text-primary loading" style="display:none">Loading...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="btn btn-secondary action-btn" data-dismiss="modal">Close</span>
                        <button type="submit action-btn" class="btn btn-primary">Add Image</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Image Insert End-->

        <!--Rectangle Insert Start-->
        <div class="modal fade" id='rectangle-popup' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:500px">
                <form action='' id='rectangle-form' method='post' class="modal-content new-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:23px;font-weight:300">Rectangle
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="content py-1 px-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" style="width:100%">
                                        <label>Color</label>
                                        <input id='rectangle-color' type="color" value='#ffffff' class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="btn btn-secondary action-btn" data-dismiss="modal">Close</span>
                        <button type="submit action-btn" class="btn btn-primary">Add Image</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Image Insert End-->

        <?php include "includes/footer.php"; ?>
        <form id='editor-form' action='' method='post'>
            <input type="hidden" name="image" value="" id='image_file'/>
            <input type="hidden" name="data" value="" id='export_data'/>
            <input type="hidden" name="method" value="save" id='method'/>
        </form>

    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script id="jsbin-javascript">
        var appHistories = [];
        var appHistory = null;
        /***
         * Info:
         * Stage is the work space for editing 
         * total 3 types of elements are used here Text, Image, Rectangle
         * The root function here is the Render() which call 2 sub functions
         * 1. ExportData : This function takes the present stage and looks for all available componenets and export the JSON data
         * 2. DisplayData() : This function extracts data taken from ExportData() and load into the canvas
         * All the element adding code is present in video-editor.js
         */


        var upload_api = '<?php echo $_ENV['project_url']; ?>api/upload_file.php';
        var team_logo = '<?php echo $vb['team_logo']; ?>';
        var video_logo = '<?php echo $vb['video_logo']; ?>';

        function downloadURI(uri, name) {
            var link = document.createElement('a');
            link.download = name;
            link.href = uri;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
        }

        function CreateImageFile() {
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
                    $('#canvas_file').attr('src',data);
                    return data;
                }
            })
        }

        document.getElementById('save').addEventListener('click', function () {
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
                    console.log(data);
                    var image_url = data;
                    var export_data = ExportData();
                    $('#method').val('save');
                    $('#image_file').val(image_url);
                    $('#export_data').val(JSON.stringify(export_data));
                    //console.log(image_url);
                    $('#editor-form')[0].submit();
                }
            })
        })

        document.getElementById('next').addEventListener('click', function () {
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
                    var image_url = data;
                    var export_data = ExportData();
                    $('#method').val('next');
                    $('#image_file').val(image_url);
                    $('#export_data').val(JSON.stringify(export_data));
                    $('#editor-form')[0].submit();
                }
            })
        })

        var stage = new Konva.Stage({
            container: "container", // id of container <div>
            width: 761,
            height: 450,
        });

        const layer = new Konva.Layer();
        stage.add(layer);
        <?php
        if(strlen($vb['branding_image'])!=0){
            $img_data=json_decode($vb['branding_json'],true);
            echo "
            var test=".json_encode($img_data).";
            DisplayData(test);
            ";
        }
        ?>
        var test = '[{"type":"Rect","x":60,"y":60,"width":100,"scaleX":3.170504150390625,"scaleY":1,"height":90,"fill":"red"},{"type":"Rect","x":114.39544677734375,"y":218.4110107421875,"width":150,"scaleX":2.8799938964843754,"scaleY":1,"height":90,"fill":"green"}]';
        //DisplayData(test);

        function Undo() {
            if (appHistories.length >= 0) {
                appHistories.pop();
                last_index = appHistories.length - 1;
                appHistory = appHistories[last_index];
                if (appHistory != undefined) {
                    DisplayData(appHistory);
                    console.log(appHistory);
                }

            } else {
                alert('Empty Stage');
            }
        }

        function Render() {
            var data = ExportData();
            //if app history is empty
            if (appHistories.length == 0) {
                appHistories.push(data);
            }
            last_index = appHistories.length - 1;
            appHistory = appHistories[last_index];
            if (appHistory != data) {
                appHistory = data;
                appHistories.push(appHistory);
                if (appHistories > 5) {
                    appHistories.shift();
                }
                DisplayData(data);
            }
        }

        item_selected = false;
        element = null;
        stage.on('click tap', function (e) {
            stage.find('Transformer').destroy();
            if (e.target === stage) {
                stage.find('Transformer').destroy();
                layer.draw();
                item_selected = false;
                element = null;
                Render();
                return;
            }
            stage.find('Transformer').destroy();
            var tr = new Konva.Transformer();
            layer.add(tr);
            tr.attachTo(e.target);
            e.target.on('transform', function () {
                e.target.width(Math.max(5, e.target.width() * e.target.scaleX()));
                e.target.height(Math.max(5, e.target.height() * e.target.scaleY()));
                // reset scale to 1
                e.target.scaleX(1);
                e.target.scaleY(1);
                //
            });
            item_selected = true;
            element = e.target;
            layer.draw();
        });

        //Action Delete
        document.getElementById('delete').addEventListener('click', function () {
            if (element != stage && item_selected && element != null) {
                if (!element.hasName('element')) {
                    return;
                }
                element.destroy();
                stage.find('Transformer').destroy();
                layer.draw();
                Render();
            }
        })

        //Handle Duplicate Button
        document.getElementById('duplicate').addEventListener('click', function () {
            if (element != stage && item_selected && element != null) {
                if (!element.hasName('element')) {
                    return;
                }
                Duplicate(element);
            }
        })

        //Export the data of current stage
        function ExportData() {
            var data = [];
            var elements = stage.find('.element');
            elements.forEach((element, i) => {
                type = element.className;
                if (type == 'Rect') {
                    var obj = {
                        type, x: element.attrs.x,
                        y: element.attrs.y,
                        width: element.attrs.width,
                        scaleX: element.attrs.scaleX,
                        scaleY: element.attrs.scaleY,
                        height: element.attrs.height,
                        fill: element.attrs.fill
                    }
                    data.push(obj);
                }
                if (type == 'Text') {
                    var obj = {
                        type, x: element.attrs.x,
                        y: element.attrs.y,
                        text: element.attrs.text,
                        fontSize: element.attrs.fontSize,
                        fontFamily: element.attrs.fontFamily,
                        fill: element.attrs.fill
                    }
                    data.push(obj);
                }
                if (type == 'Image') {
                    var obj = {
                        type,
                        url: element.attrs.image.currentSrc,
                        x: element.attrs.x,
                        y: element.attrs.y,
                        height: element.attrs.height,
                        width: element.attrs.width,
                    }
                    data.push(obj);
                }
            })
            data = JSON.stringify(data);
            return data;

        }

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

        //Action Duplicate
        var last_duplicated = null;
        function Duplicate(element) {
            type = element.className;

            //Text duplicate
            if (type == 'Text' && last_duplicated != element) {
                var simpleText = new Konva.Text({
                    x: element.attrs.x + 20,
                    y: element.attrs.y + 20,
                    text: element.attrs.text,
                    fontSize: element.attrs.fontSize,
                    fontFamily: element.attrs.fontFamily,
                    fill: element.attrs.fill,
                    name: "element",
                    draggable: true,
                });
                layer.add(simpleText);
                layer.draw();
                Render();
                last_duplicated = element;
            }

            //Image duplicate
            if (type == 'Image' && last_duplicated != element) {
                Konva.Image.fromURL(
                    element.attrs.image.currentSrc,
                    function (darthNode) {
                        darthNode.setAttrs({
                            x: element.attrs.x + 20,
                            y: element.attrs.y + 20,
                            height: element.attrs.height,
                            width: element.attrs.width,
                            name: "element",
                        });
                        darthNode.draggable(true);
                        layer.add(darthNode);
                        layer.draw();
                        Render();
                    }
                );
                last_duplicated = element;
            }

            //Rectangle duplicate
            if (type == 'Rect' && last_duplicated != element) {
                var rect = new Konva.Rect({
                    x: element.attrs.x + 20,
                    y: element.attrs.y + 20,
                    width: element.attrs.width,
                    height: element.attrs.height,
                    fill: element.attrs.fill,
                    name: "element"
                });
                // add the shape to the layer
                rect.draggable(true);
                layer.add(rect);
                layer.draw();
                Render();
                last_duplicated = element;
            }
        }

        Render();


        //Saving data


    </script>
    <script src="<?php URI("js/video-editor.js"); ?>"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
</body>

</html>