<?php
include "init.php";

$project = R::findOne("videoprojects", "link=?", [$id]);
$branding = R::findOne("videobrandings", "link=?", [$id]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php echo $project['name']; ?> |
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

        .slick-next:before,
        .slick-prev:before {
            font-family: slick;
            font-size: 33px;
            line-height: 1;
            opacity: 0.5;
            color: #000000;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .nav-link {
            text-transform: uppercase !important;
            font-weight: 500;
        }

        .slick-next,
        .slick-prev {
            top: 34%;
            text-shadow: 1px 1px 5px #000000;
        }

        .slick-prev {
            left: -14px;
            position: absolute;
            z-index: 30;
        }

        .slick-next {
            right: -14px;
            position: absolute;
            z-index: 30;
        }

        .slick-frame {
            visibility: hidden;
        }

        .slick-frame.slick-initialized {
            visibility: visible;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #5a5a5a;
            background-color: #fff;
            border: none;
            border-bottom: 2px solid #5a5a5a;
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            background-color: #ffffff00;
            padding-left: 15px;
            padding-right: 15px;
            border-top-right-radius: 0.25rem;
            color: #5e5e5e;
        }

        .nav-tabs .nav-link:hover {
            color: #5a5a5a;
            background-color: #fff;
            border: none;
            border-bottom: 2px solid #5a5a5a;
        }

        .featured {
            display: flex;
        }

        @media screen and (max-width: 812px) {
            .featured {
                display: block;
            }
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
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <a href='<?php URL('/video-project'); ?>' class='btn btn-primary mb-2 mt-3 px-3'
                                        style="border-radius:0px;background-color:var(--primary-color);border:none">Generate
                                        More Videos</a>
                                    <p class='text-secondary'>We can help you to generate more branded videos faster</p>
                                    <a class='mb-2' href='<?php URL('/videos'); ?>'>
                                        <b>
                                            << Back to Videos</b>
                                    </a>

                                    <div class="main-wraper px-5 pt-5" style="font-family: 'Roboto', sans-serif;">
                                        <!--Header-->
                                        <div class="featured">
                                            <div>
                                                <img src="<?php echo $branding['team_logo']; ?>"
                                                    style="height:100px;width:100px;border:1px solid #ebebeb;border-radius:50%;object-fit:cover;object-position:center"
                                                    alt="" srcset="">
                                            </div>
                                            <div class="featured-details px-4" style="flex:1">
                                                <h5 style="color:#242424;"><b>
                                                        <?php echo $project['name']; ?>
                                                    </b></h5>
                                                <p style="margin-top:8px;font-size:13px" class='text-secondary'>0
                                                    views <i style="margin-left:5px;margin-right:5px">•</i>
                                                    <?php echo DateAgo($project['date']); ?>
                                                </p>
                                                <p>
                                                    <?php echo $project['description']; ?>
                                                </p>
                                            </div>
                                            <div class="upload px-2 text-center">
                                                <img onclick="window.location='<?php echo URL_Make('/upload-invitation/'.$id);?>'" style="border: 1px solid #ebebeb;border-radius:5px;width:250px;cursor:pointer"
                                                    src='<?php URI('images/video-upload-btn.png') ?>' />
                                            </div>
                                        </div>

                                        <!--Tab Navigation-->
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-home" type="button" role="tab"
                                                    aria-controls="nav-home" aria-selected="true">Home</button>
                                                <button class="nav-link" id="nav-videos-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-videos" type="button" role="tab"
                                                    aria-controls="nav-videos" aria-selected="false">Videos</button>
                                                <button class="nav-link" id="nav-about-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-about" type="button" role="tab"
                                                    aria-controls="nav-about" aria-selected="false">About</button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                                aria-labelledby="nav-home-tab">
                                                <!--Home-->
                                                <div class="featured mt-2 py-3" style="display:flex;">
                                                    <div class="video"
                                                        style="width:350px;border-radius:10px;overflow: hidden;position: relative;">
                                                        <video id="my-video"
                                                            class="video-js vjs-layout-medium vjs-big-play-centered"
                                                            controls preload="auto" fluid="true"
                                                            data-setup='{ "techOrder": ["youtube"], "sources": [{"type": "video/youtube", "src":"https://www.youtube.com/watch?v=G1hKzCkywM8"}] }'>
                                                        </video>
                                                    </div>
                                                    <div class="featured-details px-4" style="width:450px">
                                                        <h5 style="color:#242424;"><b>Beautiful Relaxing Peaceful Music,
                                                                Calm Music 24/7, "Tropical Shores" By Tim Janis</b></h5>
                                                        <p style="margin-top:8px;font-size:13px" class='text-secondary'>
                                                            282,805
                                                            views <i style="margin-left:5px;margin-right:5px">•</i> 1
                                                            month ago
                                                        </p>
                                                        <p>Peaceful Celtic Relaxing Instrumental Music, Meditation Music
                                                            in 4k
                                                            "Celtic Country" by Tim Janis. This is some of my newest
                                                            music of my
                                                            new CD "Celtic Heart." The feeling behind this </p>
                                                    </div>
                                                </div>
                                                <div class="videos py-3 mt-3"
                                                    style="border-top:1px solid #ebebeb;border-bottom:1px solid #ebebeb">
                                                    <h6>
                                                        <b>Videos</b>
                                                        <span class='ml-3' style="cursor:pointer;">
                                                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                                            <b>View all</b>
                                                        </span>
                                                    </h6>
                                                    <div class="playlist mt-2">
                                                        
                                                        <div class="row">
                                                            <?php
                                                            $data=R::findAll("videos","project_id=?",[$id]);
                                                            foreach($data as $d){
                                                                echo '<div class="col-2 mb-3 pt-3">
                                                                <a href="' .URL_Make('/video/'.$id."/".base64_encode($d['id'])) . '" class="m-1">
                                                                    <img style="border-radius:5px;width:100%;height:auto"
                                                                        src="' . $url.$d['thumbnail'] . '" />
                                                                    <b>This is a demo video</b></br>
                                                                    <small class="text-secondary">'.$project['name'].'</small></br>
                                                                    <small>0 views <i
                                                                            style="margin-left:5px;margin-right:5px">•</i> '.DateAgo($d['date']).'</small>
                                                                </a>
                                                                </div>';
                                                            }
                                                            
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--Videos-->
                                            <div class="tab-pane fade" id="nav-videos" role="tabpanel"
                                                aria-labelledby="nav-videos-tab">
                                                <div class="row">
                                                <?php
                                                    $data=R::findAll("videos","project_id=?",[$id]);
                                                    foreach($data as $d){
                                                        echo '<div class="col-2 mb-3 pt-3">
                                                        <a href="' .URL_Make('/video/'.$id."/".base64_encode($d['id'])) . '" class="m-1">
                                                            <img style="border-radius:5px;width:100%;height:auto"
                                                                src="' . $url.$d['thumbnail'] . '" />
                                                            <b>This is a demo video</b></br>
                                                            <small class="text-secondary">'.$project['name'].'</small></br>
                                                            <small>0 views <i
                                                                    style="margin-left:5px;margin-right:5px">•</i> '.DateAgo($d['date']).'</small>
                                                        </a>
                                                        </div>';
                                                    }
                                                    
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-about" role="tabpanel"
                                                aria-labelledby="nav-about-tab py-2">
                                                <div class="row">
                                                    <div class="col-md-9 text-secondary">
                                                        <div class='py-4 border-bottom'>
                                                            <b>Description</b>
                                                            <p><?php echo $project['description'];?></p>
                                                        </div>
                                                        <div class='py-4'>
                                                            <b>Details</b>
                                                            <p>Location : <?php echo $project['location'];?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class='py-4'>
                                                            <p class='border-bottom py-1'><b>Stats</b></p>
                                                            <p class='border-bottom py-1'>Joined <?php echo date_format(date_create($project['date']),'M d Y');?></p>
                                                            <p class='border-bottom py-1'>0 Views</p>
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
    <script>
        var player = videojs('my-video');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.your-class').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                arrows: true,
                lazyLoad: 'ondemand',
                prevArrow: "<img class='slick-prev' style='height:38px;width:38px' src='<?php URI('/images/arrow-left.png'); ?>'/>",
                nextArrow: "<img class='slick-next' style='height:38px;width:38px' src='<?php URI('/images/arrow-right.png'); ?>'/>",
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 1,
                            infinite: true,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            var triggerTabList = [].slice.call(document.querySelectorAll('#Tab a'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        })
    </script>
</body>

</html>