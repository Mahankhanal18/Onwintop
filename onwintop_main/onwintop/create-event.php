<?php
include "init.php";
$method = 'create-event';
$parts=URL_Parts();
$link=time();
if(in_array('edit-event',$parts)){
    $method='edit-event';
}
if($method=='create-event'){
    if(isset($_POST['name'])){
        $event=R::dispense("events");
        $event->name=$_POST['name'];
        $event->cover=$_POST['cover_image'];
        $event->registration_type='';
        $event->community_id=$_SESSION['community_id'];
        $event->description=$_POST['description'];
        $event->sessions=$_POST['sessions'];
        $event->url=$_POST['link'];
        $event->email=$_POST['email'];
        $event->questions='[]';
        if(R::store($event)){
            echo "<script>window.location='".URL_Make('/view-events')."'</script>";
        }
    }
}else if($method=='edit-event'){
    $event_id=$id;
    $edit_mode=true;
    $con=R::findOne("events","WHERE url=?",[$event_id]);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if ($edit_mode) echo "Edit Event";
            else echo "Create Event"; ?> | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #category_chosen {
            display: none;
        }

        .file_btn:hover {
            cursor: pointer;
        }

        .select2-container--default .select2-selection--single {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            height: 40px;
            padding-top: 5px;
            position: relative;
        }

        #tag_btn:hover {
            cursor: pointer;
        }

        .new_session:hover {
            cursor: pointer;
        }

        .post {
            display: none;
        }

        #cover_btn {
            margin-top: -50px !important;
            position: absolute;
            margin-left: 15px;
        }

        #cover_btn:hover {
            cursor: pointer;
        }

        .uk-card-default {
            color: #666;
            box-shadow: 0 1px 5px rgb(0 0 0 / 8%);
        }

        .uk-card-default {
            display: inline-block;
            margin-bottom: 15px !important;
            margin-top: 0px;
            width: 100%;
            background-color: #ffffff8f;
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
                                        <div class="main-title"><?php if ($edit_mode) echo "Edit Event";
                                                                else echo "Create Event"; ?>
                                        </div>
                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <img src='<?php if ($edit_mode) echo $con['cover'];
                                                                    else echo "https://via.placeholder.com/600x400.png?text=Upload+Cover+Image"; ?>' id='thumbnail_holder' style='height:320px;width:100%;object-fit:cover;object-position:center'></br>
                                                        <div class="uploadCover">
                                                            <span id='cover_btn' class="button soft-primary mt-2">+ Upload Cover</span>
                                                            <input type='file' accept='.jpg,.jpeg,.png,.gif' style='display:none' id='cover' />
                                                            <input type='hidden' name='cover_image' id='cover_url' required />
                                                        </div>
                                                        <div class="loading-upload" style='display:none'>
                                                            <img src='<?php echo $url . "images/loading.webp"; ?>' style='height:30px;width:30px'>
                                                            <b>Uploading...</b>
                                                        </div>
                                                        <b class='text-primary' id='loading2' style='display:none'>Loading...</b></br>
                                                        </br>
                                                        <label>Event Title:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $con['name']; ?>' placeholder="Enter Event Name" required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' class='editor' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $con['description']; ?></textarea></br>
                                                        <!--Sessions-->
                                                        <label>Sessions:<span class='text-danger'>*</span></label>
                                                        <article class="uk-card-default p-4 rounded">
                                                            <ul class="uk-list-divider uk-list-large uk-accordion" id='sessions' uk-accordion>

                                                            </ul>
                                                            <span class="new_session button soft-dark">+ Add Sessions</span>
                                                        </article>
                                                        <input type='hidden' name='sessions' id='sessions_data' value='' />
                                                        <!--End Sessions-->
                                                        <label>Event ID:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='link' value='<?php if ($edit_mode) echo $con['url'];
                                                                                                else echo $link; ?>' placeholder="Enter Event Name" readonly>
                                                                                                
                                                        <label>Support Email:<span class='text-danger'>*</span></label>
                                                        <input type="email" name='email' placeholder="Enter Support Email" required>
                                                                                                
                                                        <label>Categories:<span class='text-danger'>*</span></label>
                                                        <select class='select2' id='category' value='[]' style="width: 100%;border:none" name="category">
                                                        </select></br>
                                                        <input type='hidden' name='categories' id='categories' />
                                                        <label class='text-primary' id='tag_btn'>Manage Categories</label>
                                                        </br></br>

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
    <div class="popup-wraper" id='popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Categories</h5>
                </div>
                <div class="send-message">
                    <table class='table' style='margin:0px'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='available_categories'></tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <form class="col-md-12" id='category_form'>
                            <b class="inc-cat">Insert new category</b>
                            <input type="text" placeholder style='width:100%;background-color: #f8fafa;border: 2px solid #f2f3f3;padding:10px;border-radius:10px' name="category_name" id="">
                            <button class="button soft-success mt-1">Insert</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--New Session Popup-->
    <div class="popup-wraper" id='add_session'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="icofont-clock-time"></i> Add Session</h5>
                </div>
                <div class="send-message">
                    <ul uk-tab>
                        <li><a href="#">Physical</a></li>
                        <li><a href="#">Streaming</a></li>
                        <li><a href="#">Webinar</a></li>
                    </ul>

                    <ul class="uk-switcher uk-margin">
                        <li>
                            <form action="" id='physical_session' class='c-form pt-2'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type='hidden' name='type' value='Physical' />
                                        <label>Location:<span class='text-danger'>*</span></label>
                                        <input type="text" name='location' placeholder="Enter Session Location" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Latitude:</label>
                                        <input type="text" name='latitude' placeholder="Enter Location Latitude">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Longitude:</label>
                                        <input type="text" name='longitude' placeholder="Enter Location Longitude">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Date:<span class='text-danger'>*</span></label>
                                        <input type="date" name='date' placeholder="Enter Session Date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Time:<span class='text-danger'>*</span></label>
                                        <input type="time" name='time' placeholder="Enter Session Time" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Duration:<span class='text-danger'>*</span></label>
                                        <input type="text" name='duration' placeholder="Enter Session Duration" required>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="button soft-success">Save</button>
                                    </div>

                                </div>
                            </form>
                        </li>
                        <li>
                            <form action="" id='virtual_session' class='c-form pt-2'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Platform:<span class='text-danger'>*</span></label>
                                        <input type='hidden' name='type' value='Virtual' />
                                        <select name="platform" id="">
                                            <option>Youtube</option>
                                            <option disabled>Wistia</option>
                                            <option disabled>Vimeo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label>URL:<span class='text-danger'>*</span></label>
                                        <input type="text" name='url' placeholder="Enter Straming URL">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Date:<span class='text-danger'>*</span></label>
                                        <input type="date" name='date' placeholder="Enter Session Date">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Time:<span class='text-danger'>*</span></label>
                                        <input type="time" name='time' placeholder="Enter Session Time">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Duration:<span class='text-danger'>*</span></label>
                                        <input type="text" name='duration' placeholder="Enter Session Duration" required>
                                    </div>
                                    <div class="col-md-12">
                                        <button type='submit' class="button soft-success">Save</button>
                                    </div>

                                </div>
                            </form>
                        </li>
                        <li>
                            <form action="" id='webinar' class='c-form pt-2'>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <label>Webinar URL:<span class='text-danger'>*</span></label>
                                        <input type="text" name='url' placeholder="Enter Webinar URL">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Webinar Password:</label>
                                        <input type="text" name='password' placeholder="Enter webinar password if any">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Date:<span class='text-danger'>*</span></label>
                                        <input type="date" name='date' placeholder="Enter Session Date">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Time:<span class='text-danger'>*</span></label>
                                        <input type="time" name='time' placeholder="Enter Session Time">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Duration:<span class='text-danger'>*</span></label>
                                        <input type="text" name='duration' placeholder="Enter Session Duration" required>
                                    </div>
                                    <div class="col-md-12">
                                        <button type='submit' class="button soft-success">Save</button>
                                    </div>

                                </div>
                            </form>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            var sessions = <?php if($edit_mode) echo $con['sessions']; else echo "[]";?>;

            //sessions handle
            $('.new_session').click(function() {
                $('#add_session').addClass('active');
            })
            RenderSessions();
            //webinar
            $('#webinar').on('submit', function(e) {
                e.preventDefault();
                var x = $(this).serializeArray();
                obj = {};
                $.each(x, function(i, field) {
                    obj[field.name] = field.value;
                })
                $('#webinar')[0].reset();
                sessions.push(obj);
                $('#add_session').removeClass('active');
                RenderSessions();
            })
            //new virtual session
            $('#virtual_session').on('submit', function(e) {
                e.preventDefault();
                var x = $(this).serializeArray();
                obj = {};
                $.each(x, function(i, field) {
                    obj[field.name] = field.value;
                })
                $('#virtual_session')[0].reset();
                sessions.push(obj);
                $('#add_session').removeClass('active');
                RenderSessions();
            })
            //new physical session
            $('#physical_session').on('submit', function(e) {
                e.preventDefault();
                var x = $(this).serializeArray();
                obj = {};
                $.each(x, function(i, field) {
                    obj[field.name] = field.value;
                })
                $('#physical_session')[0].reset();
                sessions.push(obj);
                $('#add_session').removeClass('active');
                RenderSessions();
            })

            function RenderSessions() {
                $('.empty-sessions').hide();
                var elements = "";
                for (i = 0; i < sessions.length; i++) {
                    session = sessions[i];
                    if (session['type'] == 'Virtual') {
                        var date = session['date'];
                        var time = session['time'];
                        var date_time = date + " " + time;
                        elements += "<li><a class='uk-accordion-title' href='#'><h6 class='text-primary'><i class='icofont-calendar'></i> Date: " + date + ", Time :" + time + " </h6> <small>" + session['type'] + " Session</small></a><div class='uk-accordion-content'><div class='row'><div class='col-md-2'><label>Platform</label><input type='text' value='" + session['platform'] + "' readonly></div><div class='col-md-3'><label>Streaming URL</label><input type='text' value='" + session['url'] + "'></div><div class='col-md-4'><label>Date & Time</label><input type='text' value='" + date_time + "' readonly></div><div class='col-md-2'><label>Duration</label><input type='text' value='" + session['duration'] + "' readonly></div><div class='col-md-1'><label>Action</label><span class='button soft-danger mt-1 remove-session' content-id='" + i + "'><i class='icofont-ui-delete'></i></span></div></div></div></li>";
                    }
                    if (session['type'] == 'Physical') {
                        var date = session['date'];
                        var time = session['time'];
                        var date_time = date + " " + time;
                        elements += "<li><a class='uk-accordion-title' href='#'><h6 class='text-primary'><i class='icofont-calendar'></i> Date: " + date + ", Time :" + time + " </h6> <small>" + session['type'] + " Session</small></a><div class='uk-accordion-content'><div class='row'><div class='col-md-3'><label>Location</label><input type='text' value='" + session['location'] + "'></div><div class='col-md-2'><label>Latutude</label><input type='text' value='" + session['latitude'] + "' readonly></div><div class='col-md-2'><label>Longitude</label><input type='text' value='" + session['longitude'] + "' readonly></div><div class='col-md-4'><label>Date & Time</label><input type='text' value='" + date_time + "' readonly></div><div class='col-md-1'><label>Action</label><span class='button soft-danger mt-1 remove-session' content-id='" + i + "'><i class='icofont-ui-delete'></i></span></div></div></div></li>";
                    }
                }
                if (sessions.length == 0) {
                    $('.empty-sessions').show();
                } else {
                    $('.empty-sessions').hide();
                }
                $('#sessions').html(elements);
            }

            //handle thumbnail
            $('.loading-upload').hide();
            cover_url = '<?php if ($edit_mode) echo $con['cover']; ?>';
            $('#cover_btn').on('click', function() {
                $('#cover').click();
            })
            $('#cover').on('change', function() {
                thumbnail = $('#cover')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.loading-upload').show();
                $('.uploadCover').hide();
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
                        $('#cover_url').val(thumbnail_url);
                        $('.loading-upload').hide();
                        $('.uploadCover').show();
                    }
                })
            })
            $('#tag_btn').click(function() {
                $('#popup').addClass('active');
            });
            LoadCategories();
            //load available categories
            function LoadCategories() {
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'post',
                    data: {
                        method: 'GET_EVENT_CATEGORY',
                        community_id: '<?php echo $_SESSION['community_id']; ?>'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        ele = "";
                        cat = "";
                        cats = []
                        for (i = 0; i < data.length; i++) {
                            sl = i + 1;
                            ele += "<tr><td>" + sl + "</td><td>" + data[i].name + "</td><td><div class='actions-btn'><i data-name='" + data[i].name + "' class='icofont-trash remove-category'></i></div></td></tr>"
                            cat += "<option>" + data[i].name + "</option>"
                            cats.push({
                                id: data[i].id,
                                value: data[i].id,
                                text: data[i].name
                            });
                        }
                        $('#available_categories').html(ele);
                        $("#category").select2({
                            data: cats
                        });
                        <?php
                        if ($edit_mode == true) {
                            $av_cat = explode(",", $con['category']);
                            $av_cats = array();
                            foreach ($av_cat as $av) {
                                array_push($av_cats, "'" . $av . "'");
                            }
                            $selected_cat = implode(",", $av_cats);
                            echo "$('#category').val([" . $selected_cat . "]).trigger('change');";
                        }

                        ?>
                    }
                })
            }
            //Remove Category
            $('#available_categories').delegate('.remove-category', 'click', function() {
                name = $(this).attr('data-name');
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        name: name,
                        community_id: '<?php echo $_SESSION['community_id']; ?>',
                        method: 'REMOVE_EVENT_CATEGORY'
                    },
                    success: function(data) {
                        $('#popup').removeClass('active');
                        LoadCategories();
                        alertify.success(data);
                    }
                })
            })

            //New Category
            $('#category_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo $url; ?>/api/filter_management.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        name: $('[name="category_name"]').val(),
                        community_id: '<?php echo $_SESSION['community_id']; ?>',
                        method: 'SAVE_EVENT_CATEGORY'
                    },
                    success: function(data) {
                        $('#category_form')[0].reset();
                        LoadCategories();
                        $('#popup').removeClass('active');
                        alertify.success(data);
                    }
                })
            })
            //submit file
            $('#create-data').on('submit', function(e) {
                e.preventDefault();
                categories = $('#category').val();
                session_data = JSON.stringify(sessions);
                $('#sessions_data').val(session_data);
                $('#create-data')[0].submit();
            })

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>