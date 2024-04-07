<?php
include "init.php";
if (isset($_GET['q'])) {
    $q = base64_decode($_GET['q']);
    $q = json_decode($q, true);
    if (isset($q['id']) && isset($q['title']) && isset($q['description'])) {
        $video = R::findOne("videos", "id=?", [$q['id']]);
        $video->status = $q['Status'];
        $video->title = $q['title'];
        $video->description = $q['description'];

        //report file
        $path="report-data/videos/".$video['project_id']."_".$video['community_id']."_".$video['id'].".json";
        $report=array(
            "likes"=>array(),
            "dislikes"=>array(),
            "comments"=>array(),
            "views"=>array()
        );
        file_put_contents($path,json_encode($report));
        $video->report=$path;
        if (R::store($video)) {
            echo "<script>window.location='" . URL_Make('/pending-videos') . "';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pending Videos |
        <?php echo $title; ?>
    </title>
    <?php include "includes/head.php"; ?>
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
        integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .video-js .vjs-big-play-button {
            display: none;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 800px;
                margin: 1.75rem auto;
            }
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #202020;
            background-color: #fff;
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 2px solid #a6a6a6;
            padding-bottom: 3px;
            padding-top: 15px;
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            background-color: #fff;
            color: #202020;
            border-top-right-radius: 0.25rem;
            padding-bottom: 3px;
            border-bottom: 1px solid #dee2e6;
            padding-top: 15px;
        }

        .nav-link:focus {
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            background-color: #fff;
            color: #202020;
            border-top-right-radius: 0.25rem;
            padding-bottom: 3px;
            padding-top: 15px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>

        <?php include "includes/nav.php"; ?>

        <section>
            <div class="gap">
                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id=" page-contents" class="row merged20">
                                <div class=" col-lg-12">
                                    <?php
                                    if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) { ?>
                                        <a href='<?php URL('/videos'); ?>' class='btn btn-primary mb-2 mt-3 px-3'
                                            style="border-radius:0px;background-color:var(--primary-color);border:none">Back
                                            to videos</a>
                                    <?php } ?>

                                    <div class="main-wraper px-5 py-4" style="font-family: 'Roboto', sans-serif;">
                                        <?php
                                        $empty = false;
                                        $c=0;
                                        $projects = R::findAll("videoprojects","community_id=?",[$community_id]);
                                        foreach ($projects as $pro) {
                                            $datas = R::findAll("videos", "project_id=? AND status=?", [$pro['link'], 'Pending']);
                                            if (count($datas) != 0) {
                                                $brand = R::findOne("videobrandings", "link=?", [$pro['link']]);
                                                ?>
                                                <div class="videos py-3 mt-4" style="border-bottom:1px solid #ebebeb">
                                                    <h6 style="border-bottom:1px solid #ebebeb;padding-bottom:10px">
                                                        <b>
                                                            <?php echo $pro['name']; ?>
                                                        </b>
                                                    </h6>
                                                    <div class="playlist mt-2" style="width:100%">
                                                        <div class="row" style="width:100%">
                                                            <?php
                                                            foreach ($datas as $data) {
                                                                echo '
                                                                <a data-branding="' . base64_encode($brand['information_json']) . '" data-layer="' . $data['video_layer'] . '" data-id="' . $data['id'] . '" data-url="' . $data['url'] . '" data-thumbnail="' . $data['thumbnail'] . '" data-collect="' . base64_encode($data['uploader_data']) . '" data-date="' . date_format(date_create($data['date']), 'd M Y') . '" class="video p-3 col-md-3">
                                                                <img style="border-radius:5px;width:100%;height:auto"
                                                                    src="' . $url . $data['thumbnail'] . '" />
                                                                <b style="margin-top:13px">' . $data['uploader'] . '</b></br>
                                                                <small>' . DateAgo($data['date']) . '</small></br>
                                                                <span class="badge badge-warning">Pending</span>
                                                                </a>
                                                                ';
                                                                $c++;
                                                            }

                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else {
                                                $empty = true;
                                            }


                                        } ?>

                                        <?php
                                        if ($c==0) {
                                            echo '
                                                    <div class="col-md-12 p-5 text-center">
                                                        <img src="'.$url.'images/empty-video.png" style="height:140px;margin-bottom:40px;width:auto"/>
                                                        <h5>Opps! It seems you do not have any pending videos</h5>
                                                    </div>
                                                    ';
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" style="font-family: 'Roboto', sans-serif;" id="approve-modal" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content new-modal">

                    <div class="modal-body  px-2 py-1">
                        <div class="content">
                            <div class="row" style="width:100%">
                                <div class="col-md-6">
                                    <div class="card"
                                        style='background-color:#fbfafa !important;border:none;height:100%;display:flex;'>
                                        <div class="card-body text-center">
                                            <h6>Preview</h6>
                                            <video style="width:100%;height:220px" controls>
                                                <source
                                                    id='video-src'
                                                    src=""
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>

                                            <p class='text-center py-2'>
                                                <small class='text-secondary'>Date video posted</small></br>
                                                <b style="font-weight:500;font-size:15px" id='video-date'></b>
                                            </p>
                                            <a href='#' target='_blank' class='btn btn-primary btn-sm mb-2 mt-3 px-3 video-download'
                                                style="border-radius:0px;background-color:var(--primary-color);border:none">Download
                                                Video
                                                <i class="fa fa-cloud-download ml-2 text-white" aria-hidden="true"></i>
                                            </a>

                                            <div class="row"
                                                style="position: absolute;bottom: 20px;align-items: center !important;width: 100%;">
                                                <div class="col-md-12">
                                                    <button class="btn btn-secondary disapprove">Disapprove</button>
                                                    <button class="btn btn-primary ml-3 approve">Approve</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card" style="border:none">
                                        <div class="card-body">
                                            <h6>Clip Informations</h6>
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                        data-bs-target="#home" type="button" role="tab"
                                                        aria-controls="home" aria-selected="true"
                                                        style="font-size:13px">Contributors inputs</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" style="font-size:13px" id="profile-tab"
                                                        data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                                        role="tab" aria-controls="profile"
                                                        aria-selected="false">Additional informations</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                    aria-labelledby="home-tab">
                                                    <div class="row pb-3" id="user-inp"
                                                        style="margin-top:10px;height: 400px;overflow-y: scroll;margin-bottom: 80px;">
                                                    </div>
                                                    <div class="row"
                                                        style="position: absolute;bottom: 20px;align-items: center !important;width: 100%;">
                                                        <div class="col-md-12 text-center">
                                                            <button class="btn btn-secondary close-modal">Close</button>
                                                            <button class="btn btn-primary ml-3 update">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                                    aria-labelledby="profile-tab">
                                                    <div class="row pb-3"
                                                        style="margin-top:10px;height: 250px;overflow-y: scroll;margin-bottom: 200px;">
                                                        <div class="form-group mt-2 col-md-12">
                                                            <label>Video Title</label>
                                                            <input type="text" name="title" id="title"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group mt-1 col-md-12">
                                                            <label>Video Description</label>
                                                            <textarea type="text" name="description" id="description"
                                                                class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row"
                                                        style="position: absolute;bottom: 20px;align-items: center !important;width: 100%;">
                                                        <div class="col-md-12 text-center">
                                                            <button class="btn btn-secondary close-modal">Close</button>
                                                            <button class="btn btn-primary ml-3 update">Update</button>
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


        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })

            $('.close-modal').click(function () {
                $('#approve-modal').modal('hide');
            })
            var collect = [];
            var id = '';
            var url='';

            $('.video-download').click(function(){
                $('.video-download').attr('href',url);
            })

            $('.video').click(function () {
                id = $(this).attr('data-id');
                collect = $(this).attr('data-collect');

                url=$(this).attr('data-url');
                
                layer=$(this).attr('data-layer');

                layer=btoa(layer);
                template="l_fetch:"+layer+"/fl_layer_apply";
                parts=url.split("/");
                last=parts[parts.length-1];
                video_url="https://res.cloudinary.com/tellselling/video/upload/b_blurred:400:15,c_pad,h_445,w_791/"+template+"/"+last;
                url=video_url;
                $('#video-src').attr('src',video_url);


                $("video")[0].load();

                date=$(this).attr('data-date');
                $('#video-date').html(date);

                collect = atob(collect);
                $('#approve-modal').modal('show');
                collect = JSON.parse(collect);
                brand = $(this).attr('data-branding');;
                brand = atob(brand);
                brand = JSON.parse(brand);
                forms = ``;
                var description = '';
                for (i = 0; i < collect.length; i++) {
                    obj = collect[i];
                    if (obj.label == 'name') {
                        forms += `
                        <div class='col-md-6 mt-3'>
                            <div class='form-group'>
                                <label style="text-transform:capitalize">`+ obj.label + `</label>
                                <input type='text' class='form-control collect-info' data-name='`+ obj.label + `' value='` + obj.value + `'>
                            </div>
                        </div>
                        `;
                        $('#title').val(obj.value);
                    }
                    if (obj.label == 'email') {
                        forms += `
                        <div class='col-md-6 mt-3'>
                            <div class='form-group'>
                                <label style="text-transform:capitalize">`+ obj.label + `</label>
                                <input type='text' class='form-control collect-info' data-name='`+ obj.label + `' value='` + obj.value + `'>
                            </div>
                        </div>
                        `;
                    } if (obj.label == 'location') {
                        forms += `
                        <div class='col-md-12 mt-1'>
                            <div class='form-group'>
                                <label style="text-transform:capitalize">`+ obj.label + `</label>
                                <input type='text' class='form-control collect-info' data-name='`+ obj.label + `' value='` + obj.value + `'>
                            </div>
                        </div>
                        `;

                    } if (obj.label == 'prompt1') {
                        forms += `
                        <div class='col-md-12 mt-1'>
                            <div class='form-group'>
                                <label style="text-transform:capitalize">`+ brand.prompt1 + `</label>
                                <input type='text' class='form-control collect-info' data-name='`+ obj.label + `' value='` + obj.value + `'>
                            </div>
                        </div>
                        `;
                        description += ' ' + obj.value;
                    } if (obj.label == 'prompt2') {
                        forms += `
                        <div class='col-md-12 mt-1'>
                            <div class='form-group'>
                                <label style="text-transform:capitalize">`+ brand.prompt2 + `</label>
                                <input type='text' class='form-control collect-info' data-name='`+ obj.label + `' value='` + obj.value + `'>
                            </div>
                        </div>
                        `;
                        description += ' ' + obj.value;
                    } if (obj.label == 'prompt3') {
                        forms += `
                        <div class='col-md-12 mt-1'>
                            <div class='form-group'>
                                <label style="text-transform:capitalize">`+ brand.prompt3 + `</label>
                                <input type='text' class='form-control collect-info' data-name='`+ obj.label + `' value='` + obj.value + `'>
                            </div>
                        </div>
                        `;
                        description += ' ' + obj.value;
                    }
                }
                $('#description').html(description);
                $('#user-inp').html(forms);

            })
            var description = '';
            var title = '';
            $('#user-inp').delegate('.collect-info', 'change', function () {
                label = $(this).attr('data-name');
                value = $(this).val();
                var obj = { label, value };
                for (i = 0; i < collect.length; i++) {
                    if (collect[i].label == label) {
                        collect[i].value = value;
                    }
                }
                title = $('#title').val();
                description = $('#title').html();
            });

            $('.update').click(function () {
                title = $('#title').val();
                description = $('#title').html();
            })

            $('.approve').click(function () {
                title = $('#title').val();
                description = $('#description').html();
                if (title.length != 0 && title.length != 0) {
                    var req = {
                        id, title, description, 'Status': 'Active'
                    }
                    req = JSON.stringify(req);
                    req = btoa(req);
                    window.location = '<?php URL('/pending-videos?q='); ?>' + req;
                } else {
                    $('#profile-tab').click();
                    alert('Please enter video title and description!');
                }
            })



        })
    </script>
</body>

</html>