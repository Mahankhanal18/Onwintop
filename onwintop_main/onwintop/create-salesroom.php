<?php
//session_start();

include "init.php";
$edit_mode = false;
$data = array();
$link=UID(5);
$url_parts = URL_Parts();
if (isset($url_parts[7])) {
    $edit_mode = true;
    $con = R::findOne("salesrooms", "WHERE link=?", [$url_parts[7]]);
}

if (isset($_POST['name'])) {
    if ($url_parts[6] == 'create-salesroom') {
        $salesroom = R::dispense("salesrooms");
        $salesroom->link = $_POST['link'];
        $salesroom->type = $_POST['type'];
        $salesroom->welcome_message = $_POST['welcome_message'];
        $salesroom->name = $_POST['name'];
        $salesroom->contents = $_POST['contents'];
        $salesroom->salesperson = $_POST['expert'];
        $salesroom->description = $_POST['description'];
        $salesroom->thumbnail = $_POST['thumbnail'];
        $salesroom->community_id = $_SESSION['community_id'];
        $salesroom->creation_time = date('h:ia');
        $salesroom->creation_date = date('Y-m-d');
        if(R::store($salesroom)){
            echo "<script>window.location='".URL_Make('/view-salesrooms')."';</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Salesroom | <?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .new_section_btn:hover {
            cursor: pointer;
        }

        .soft-dark {
            margin-right: 10px;
        }

        .soft-dark:hover {
            cursor: pointer;
        }

        #share:hover {
            cursor: pointer;
        }

        #share-buttons img {
            height: 30px !important;
            width: auto;
        }

        .new_section_btn:hover {
            cursor: pointer;
        }

        .salesroom-icon {
            font-size: 18px;
        }

        .salesroom-icon:hover {
            cursor: pointer;
        }

        .section-function {
            margin-right: 8px;
            color: gray !important;
        }

        .section-function:hover {
            cursor: pointer;
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
                                        <div class="main-title">Create Salesroom

                                        </div>

                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        </br>
                                                        <input type='hidden' value='<?php echo $link ?>' name='link' id='link'>
                                                        <label>Salesroom Name:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' id='name' value='<?php if ($edit_mode) echo $con['name']; ?>' placeholder="Enter Salesroom Name" required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea name='description' id='description' placeholder="Enter Short Description..."><?php if ($edit_mode) echo $con['description']; ?></textarea>
                                                        <label>Welcome Message:<span class='text-danger'>*</span></label></br>
                                                        <video class='mt-1 mb-1' src='<?php if ($edit_mode) echo $con['welcome_message']; ?>' id='video_holder' style="width:600px;height:auto;display:none" controls></video></br>
                                                        <b class='text-primary loading1' style='display:none'>Loading...</b></br>
                                                        <div class="uploadimage1">
                                                            <label class="fileContainer">
                                                                <input accept='.mp4,.mov' id='file' type="file"><b>+ Upload file</b>
                                                            </label>
                                                        </div></br>
                                                        <input type="hidden" name="welcome_message" id='wm' value='<?php if ($edit_mode) echo $con['welcome_message']; ?>' required>
                                                        <label>Contents:<span class='text-danger'>*</span></label>
                                                        <span class='text-primary new_section_btn' style='float:right'>+ Add new section</span>
                                                        <article class="uk-card-default p-4 rounded">
                                                            <ul class="uk-list-divider uk-list-large uk-accordion" id='contents-holder' uk-accordion>
                                                                <li>
                                                                    No Contents found
                                                                </li>
                                                            </ul>
                                                        </article>

                                                        </br></br>
                                                        <label>Salesroom Link:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='link' value='<?php if ($edit_mode) echo $con['link']; else echo $link; ?>' readonly required>
                                                        <label>Salesperson:<span class='text-danger'>*</span></label>
                                                        <select class="select2" id='salesperson' style="width: 100%;border:none" name="expert">
                                                            <?php
                                                            $s = "SELECT * FROM `members` WHERE `community_id`='" . $_SESSION['community_id'] . "' ORDER BY `first_name` ASC ";
                                                            $e = $db->RetriveArray($s);
                                                            foreach ($e as $d) {
                                                                $selected = '';
                                                                if ($d['first_name'] . " " . $d['last_name'] == $data['salesperson']) {
                                                                    $selected = 'selected="selected"';
                                                                }
                                                                echo "<option value='" . $d['first_name'] . " " . $d['last_name'] . "' " . $selected . ">" . $d['first_name'] . " " . $d['last_name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select></br></br>

                                                        <input type="hidden" name="contents" id='contents_info' value=''>
                                                        <input type="hidden" id='link' value="<?php echo $link; ?>" placeholder="Community Link" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        </br>
                                                        <label>Salesroom Type:<span class='text-danger'>*</span></label>
                                                        <div class='row'>
                                                            <div class='col-md-10'>
                                                                <select name="type" id="type" style='width:100%'>
                                                                    <option value="Public">Public</option>
                                                                    <option value="Private">Private</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        </br>
                                                        <label>Custom Cover Image:</label></br>
                                                        <img src='<?php if ($edit_mode) echo $con['thumbnail'];
                                                                    else echo "https://via.placeholder.com/300x400.png?text=Upload+Thumbnail+Image"; ?>' id='thumbnail_holder' style='height:auto;width:300px;'></br>
                                                        <div class="uploadimage2">
                                                            <i class="icofont-file-jpg"></i>
                                                            <label class="fileContainer">
                                                                <input id='thumbnail' type="file">Attach Thumbnail
                                                                <input id='thumbnail_url' type='hidden' name="thumbnail" required>
                                                            </label>
                                                        </div>
                                                        <b class='text-primary' id='loading2'>Loading...</b></br>
                                                    </div>
                                                </div>
                                                <button type='submit' class="button soft-primary">Save</button>
                                                <span id='share' class='button soft-success'>Share</span>
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

    <!--New Section-->
    <div class="popup-wraper" id='new_section'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-plus"></i> New Section</h5>
                </div>
                <div class="send-message">
                    <form class="c-form" id='edit_channel_details'>
                        <input type="text" id='section_name' name='name' placeholder="Enter Section Name.." autofocus required>
                        <label>Select Icon : <span class='text-danger'>*</span></label>
                        <div class='row mt-2'>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-line-chart'>
                                    <i class='fa fa-line-chart' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-archive'>
                                    <i class='fa fa-archive' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center' data-id='fa-area-chart'>
                                    <i class='fa fa-area-chart' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-building'>
                                    <i class='fa fa-building' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-bar-chart'>
                                    <i class='fa fa-bar-chart' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-bolt'>
                                    <i class='fa fa-bolt' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-bank'>
                                    <i class='fa fa-bank' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-calendar'>
                                    <i class='fa fa-calendar' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-car'>
                                    <i class='fa fa-car' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-camera'>
                                    <i class='fa fa-camera' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-cloud'>
                                    <i class='fa fa-cloud' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-cube'>
                                    <i class='fa fa-cube' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-database'>
                                    <i class='fa fa-database' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-diamond'>
                                    <i class='fa fa-diamond' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-desktop'>
                                    <i class='fa fa-desktop' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-download'>
                                    <i class='fa fa-download' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-envelope'>
                                    <i class='fa fa-envelope' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-film'>
                                    <i class='fa fa-film' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-globe'>
                                    <i class='fa fa-globe' style='font-size:25px'></i>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='salesroom-icon text-center mt-2 mb-2' data-id='fa-folder'>
                                    <i class='fa fa-folder' style='font-size:25px'></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--no contents-->
    <div class="popup-wraper" id='empty_content'>
        <div class="popup" style='width:500px'>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>No Contents Available</h5>
                </div>
                <div class="send-message">
                    <b>It seems you haven't uploaded any content yet. Do you want to proceed with empty content?</b></br></br>
                    <button class='button soft-warning proceed'>Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!--select content-->
    <div class="popup-wraper" id='select_content'>
        <div class="popup" style='width:800px'>
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-plus"></i> Select Content</h5>
                </div>
                <div class="send-message">
                    <table id="example" class="uk-table uk-table-hover uk-table-middle uk-table-divider" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Modification Date</th>
                                <th>Creator</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class='wrapper'>
                            <?php
                            $c = "SELECT * FROM `contents` WHERE `community_id`='" . $_SESSION['community_id'] . "' ";
                            $data = $db->RetriveArray($c);
                            $raw_con = array();
                            $i = 1;
                            foreach ($data as $d) {
                                $obj = array(
                                    "id" => $d['id'],
                                    "name" => $d['name'],
                                    "type" => $d['type'],
                                    "thumbnail" => $d['thumbnail'],
                                    "url" => $d['url'],
                                );
                                array_push($raw_con, $obj);
                                echo "
                                    <tr class='content-item'>
                                        <td>" . $i . "</td>
                                        <td>" . $d['name'] . "</td>
                                        <td>" . $d['type'] . "</td>
                                        <td>" . date_format(date_create($d['modification_date']), 'd M, Y') . "</td>
                                        <td>" . $d['creator'] . "</td>
                                        <td><button content-id='" . $d['id'] . "' content-name='" . $d['name'] . "' content-thumbnail='" . $d['thumbnail'] . "' content-type='" . $d['type'] . "' modification-date='" . $d['modification_date'] . "' content-creator='" . $d['creator'] . "' data-id='" . $d['data_id'] . "' class='select button soft-primary'>Select</button></td>
                                    </tr>
                                    ";
                                $i++;
                            }
                            if (count($data) == 0) {
                                echo "
                                    <tr>
                                        <th colspan='5' style='text-align:center;padding:15px'>No contents available</th>
                                    </tr>
                                    ";
                            }
                            $raw_contents = json_encode($raw_con);
                            ?>
                        </tbody>
                    </table>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-wraper" id='share-popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-share"></i> Share Salesroom</h5>
                </div>
                <div class="send-message">
                    <nav class="responsive-tab style1 mt-2 mb-3">
                        <ul data-submenu-title="compounents" uk-switcher="connect: #picturez ;animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium" class="uk-grid" uk-sticky="offset:50;media : @m">
                            <li><a href="#">Share</a></li>
                            <li><a href="#">Print</a></li>
                        </ul>
                    </nav>
                    <ul class="uk-switcher" id="picturez">
                        <li>
                            <form class="c-form" id='edit_channel_details'>
                                <center><label>Salesroom Link</label></center>
                                <input type="text" name='name' value='<?php $ur = "https://app-dev.tellselling.tech/community/" . $_SESSION['community_id'] . "/salesroom/" . $url_parts[7];
                                                                        echo $ur; ?>' readonly>
                                <center>
                                    </br>
                                    <label>QR Code</label></br>
                                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=<?php echo $ur; ?>' />
                                </center>
                            </form>
                            <center></br></br>
                                <label>Social Links</label></br>
                                <div id="share-buttons">

                                    <!-- Buffer -->
                                    <a href="https://bufferapp.com/add?url=<?php echo $u; ?>&amp;text=Share Community on Social Media" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/buffer.png" alt="Buffer" />
                                    </a>

                                    <!-- Digg -->
                                    <a href="http://www.digg.com/submit?url=<?php echo $u; ?>" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/diggit.png" alt="Digg" />
                                    </a>

                                    <!-- Email -->
                                    <a href="mailto:?Subject=Share Community on Social Media&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo $u; ?>">
                                        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
                                    </a>

                                    <!-- Facebook -->
                                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $u; ?>" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                                    </a>

                                    <!-- Google+ -->
                                    <a href="https://plus.google.com/share?url=<?php echo $u; ?>" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
                                    </a>

                                    <!-- LinkedIn -->
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url<?php echo $u; ?>" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                                    </a>

                                    <!-- Pinterest -->
                                    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                        <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
                                    </a>


                                    <!-- Reddit -->
                                    <a href="http://reddit.com/submit?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
                                    </a>
                                </div>
                                </br></br>

                        </li>
                        <li>
                            <form class="c-form" id='print_form'>
                                <label>Title<span class='text-danger'>*</span></label>
                                <input type="text" id='print_title' name='title' value='' required>
                                <label>Subtitle<span class='text-danger'>*</span></label>
                                <input type="text" id='print_subtitle' name='subtitle' value='' required>
                                <label>Related Members<span class='text-danger'>*</span></label></br>
                                <select id='print_members' style="width: 100%;">
                                    <option>Select Members</option>
                                    <?php
                                    $s = "SELECT * FROM `members` WHERE `community_id`='" . $_SESSION['community_id'] . "' ORDER BY `first_name` ASC ";
                                    $e = $db->RetriveArray($s);
                                    foreach ($e as $d) {
                                        echo "<option value='" . $d['first_name'] . " " . $d['last_name'] . "' >" . $d['first_name'] . " " . $d['last_name'] . "</option>";
                                    }
                                    ?>
                                </select></br></br>
                                <label>Attach Background</label>
                                <input type="file" id='print_background' name='file' value='' required></br>
                                <b class='print_loader' style='display:none'>Loading</b></br>
                                <button class='button soft-success'>Preview/Download</button>
                                </br></br></br>
                            </form>

                        </li>
                    </ul>
                </div>
                </br>


            </div>
        </div><!-- send message popup -->



        <script src="<?php URI("js/main.min.js"); ?>"></script>
        <script src="<?php URI("js/script.js"); ?>"></script>
        <script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js'></script>
        <script>
            $(document).ready(function() {

                $(".wrapper .content-item").slice(10).hide();
                $('#pagination').pagination({
                    items: 10,
                    itemsOnPage: 10,
                    onPageClick: function(noofele) {
                        $(".wrapper .content-item").hide()
                            .slice(12 * (noofele - 1),
                                12 + 12 * (noofele - 1)).show();
                    }
                });


                var contents = [];
                <?php // To place exisint url 
                    if($edit_mode){
                        ?>
                        contents = JSON.parse('<?php echo $con["contents"];?>');
                        <?php
                    }
                                
                ?>
                var selected_section = 0;

                //Welcome Message Handle
                video_url = "<?php // To place exisint url 
                        if($edit_mode) echo $con['welcome_message'];
                                ?>";
                if (video_url.length != 0) {
                    $('#video_holder').attr('src', video_url);
                    $('#video_holder').show();
                }
                $('#share').click(function() {
                    $('#share-popup').addClass('active');
                })
                $('#file').on('change', function() {
                    $('.uploadimage1').hide();
                    $('.loading1').show();
                    file = $('#file')[0].files[0];
                    file_form = new FormData();
                    file_form.append('file', file);
                    $.ajax({
                        url: '<?php echo $url . 'api/upload_file.php'; ?>',
                        method: 'post',
                        data: file_form,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            data = JSON.parse(data);
                            video_url = data.secure_url;
                            $('#video_holder').attr('src', video_url);
                            $('#video_holder').show();
                            $('.uploadimage1').hide();
                            $('#wm').val(video_url);
                            $('.loading1').html('Video Uploaded');
                        }
                    })
                });
                //Thumbnail Handle
                $('#loading2').hide();
                thumbnail_url = '<?php if ($edit_mode) echo $data['thumbnail']; ?>';
                $('#thumbnail').on('change', function() {
                    thumbnail = $('#thumbnail')[0].files[0];
                    thumbnail_form = new FormData();
                    thumbnail_form.append('file', thumbnail);
                    $('#loading2').show();
                    $.ajax({
                        url: '<?php echo $url . '/api/upload_file.php'; ?>',
                        method: 'post',
                        data: thumbnail_form,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            data = JSON.parse(data);
                            thumbnail_url = data.secure_url;
                            $('#thumbnail_holder').attr('src', thumbnail_url);
                            $('#thumbnail_url').val(thumbnail_url);
                            $('#loading2').hide();
                        }
                    })
                })
                //Handle Content Section
                $('.new_section_btn').click(function() {
                    $('#new_section').addClass('active');
                })
                $('.salesroom-icon').click(function() {
                    var section_name = $('#section_name').val();
                    var icon = $(this).attr('data-id');
                    if (section_name.length != 0) {
                        var section = {
                            id: contents.length,
                            name: section_name,
                            icon: icon,
                            contents: []
                        }
                        contents.push(section);
                        $('#section_name').val('');
                        $('#new_section').removeClass('active');
                        RenderData();
                    } else {
                        alertify.error('Please enter a section name');
                    }
                });
                //Render data
                RenderData();

                function RenderData() {
                    ele = "";
                    for (i = 0; i < contents.length; i++) {
                        content = contents[i];
                        selected = '';
                        if (content.id == selected_section) {
                            selected = 'uk-open';
                        }
                        file_elements = "<b style='width:100%;text-align:center;padding-top:10px'><center>No Contents Added</center></b>";
                        files = content.contents;
                        console.log(files);
                        if (files.length != 0) {
                            file_elements = "";
                            for (x = 0; x < files.length; x++) {
                                file_elements += "<div class='col-md-4'><div class='card mt-3'><div class='card-body'><div style='width:100%;height:200px;background-image:url(" + files[x].thumbnail + ");background-position:center;background-size:cover;background-repeat:no-repeat'></div><b class='text-center card-title mt-2'>" + files[x].name + "</b></div></div></div>";
                            }
                        }
                        ele += "<li class='" + selected + "'><a class='uk-accordion-title'><i class='fa " + content.icon + "'></i>&nbsp;&nbsp;" + content.name + "</a></br><span data-id='" + content.id + "' class='button soft-primary section-function soft-dark add-content'><i class='fa fa-plus' aria-hidden='true'></i> Add New Content</span><div class='uk-accordion-content' ><div class='row content_" + selected_section + "'>" + file_elements + "</div></div></li>";
                    }
                    if (contents.length == 0) {
                        ele = "<b style='width:100%;text-align:center'>No Contents found</b>";
                    }
                    $('#contents-holder').html(ele);

                }
                //content handle
                //adding content
                $('#contents-holder').delegate('.add-content', 'click', function() {
                    data_id = $(this).attr('data-id');
                    selected_section = data_id;
                    $('#select_content').addClass('active');
                });
                raw_contents = JSON.parse('<?php echo $raw_contents; ?>');
                if (raw_contents.length == 0) {
                    $('#empty_content').addClass('active');
                }
                $('.proceed').click(function() {
                    $('#empty_content').removeClass('active');
                })

                function getContents(index) {
                    return raw_contents[index];
                }

                $('.select').click(function() {
                    var data_id = $(this).attr('data-id');
                    var content_id = $(this).attr('content-id');
                    var name = $(this).attr('content-name');
                    var thumbnail = $(this).attr('content-thumbnail');
                    var type = $(this).attr('content-type');
                    var modification_date = $(this).attr('modification-date');
                    var creator = $(this).attr('content-creator');
                    var obj = {
                        id: content_id,
                        data_id,
                        name,
                        thumbnail,
                        type,
                        modification_date,
                        creator
                    };
                    contents[selected_section].contents.push(obj);
                    RenderData();
                    $('#select_content').removeClass('active');
                })

                //creating data
                $('#create-data').submit(function(e) {
                    e.preventDefault();
                    var str = JSON.stringify(contents);
                    $('#contents_info').val(str);
                    //alert(str);
                    $('#create-data')[0].submit();
                })

            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>


</body>

</html>