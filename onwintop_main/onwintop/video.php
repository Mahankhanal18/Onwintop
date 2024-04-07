<?php
include "init.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
        <?php
        if (isset($id) && isset($project)) {
            $project_id=$project;
            $id = base64_decode($id);
            $video = R::findOne("videos", "id=?", [$id]);
            $project = R::findOne("videoprojects", "link=?", [$video['project_id']]);
            $branding = R::findOne("videobrandings", "link=?", [$video['project_id']]);
        } else {
            echo "<script>window.location='" . URL('/videos') . "';</script>";
        }
        //REACTION COOKIES
        $email = '#';
        if ((isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) || (isset($_SESSION['community_login']) && $_SESSION['community_login'] == true)) {
            $com = json_decode($_SESSION['community_credentials'], true);
            $email = $com['email'];
        }
        $path = $video['report']; //check this in production
        $report = file_get_contents($path);
        $report = json_decode($report, true);
        $likes = $report['likes'];
        $dislikes = $report['dislikes'];
        $comments = $report['comments'];
        $views = $report['views'];
        $client_ip = get_client_ip();

        //Check if current user liked
        $i_liked = false;
        if (in_array($email, $likes)) {
            $i_liked = true;
        }
        //Check if current user disliked
        $i_disliked = false;
        if (in_array($email, $dislikes)) {
            $i_disliked = true;
        }
        //Check if current user viewed
        $i_viewed = false;
        if (in_array($client_ip, $views)) {
            $i_viewed = true;
        }




        ?>
        <title><?php echo $video['title']; ?> | Videos | <?php echo $title; ?></title>
    
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

        .featured {
            display: flex;
        }

        .video-js .vjs-big-play-button {
            display: none;
        }

        @media screen and (max-width: 640px) {
            .p-4 {
                padding: 0px !important;
            }

            .featured {
                display: block;
            }

            .channel-thumb {
                float: left;
                margin-right: 10px;
                margin-bottom: 15px;
            }

            .ml-4 {
                margin-left: 0px !important;
            }
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
        .featured-btn:hover{
            cursor: pointer;
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
        <?php
        function GetViews($id){
            $report_file=file_get_contents($id);
            $report=json_decode($report_file,true);
            return count($report['views']);
        }
        ?>
        <section>
            <div class="gap mb-5">
                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper p-4"
                                        style="border:none;background-color:#ffffff;font-family: 'Roboto', sans-serif;">

                                        <div class="px-5">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <video id="my-video"
                                                        class="video-js vjs-layout-medium vjs-big-play-centered"
                                                        controls preload="auto" fluid="true"
                                                        poster="<?php echo $url . $video['thumbnail']; ?>"
                                                        data-setup='{}'>
                                                        <?php
                                                        $image = $video['video_layer'];
                                                        $uri = base64_encode($image);
                                                        $template = "l_fetch:" . $uri . "/fl_layer_apply";

                                                        $parts = explode("/", $video['url']);
                                                        $last = $parts[count($parts) - 1];

                                                        $video_url = "https://res.cloudinary.com/tellselling/video/upload/b_blurred:400:15,c_pad,h_445,w_791/" . $template . "/" . $last;
                                                        ?>
                                                        <source src="<?php echo $video_url; ?>" type="video/mp4" />
                                                        <p class="vjs-no-js">
                                                            To view this video please enable JavaScript, and consider
                                                            upgrading to a
                                                            web browser that
                                                            <a href="https://videojs.com/html5-video-support/"
                                                                target="_blank">supports HTML5 video</a>
                                                        </p>
                                                    </video>
                                                    <h4 class='my-2'>
                                                        <b>
                                                            <?php echo $video['title']; ?>
                                                        </b>
                                                    </h4>
                                                    <div class="featured mt-3">
                                                        <div class='channel-thumb'>
                                                            <img src="<?php echo $branding['team_logo']; ?>"
                                                                style="height:45px;width:45px;border-radius:50%;border:1px solid #ebebeb;object-fit:cover;object-position:center"
                                                                alt="" srcset="">
                                                        </div>
                                                        <div class="featured-details px-3" style="flex:1">
                                                            <b style="color:#242424;">
                                                                <?php echo $project['name']; ?>
                                                            </b>
                                                            <p style="font-size:13px" class='text-secondary'><span
                                                                    id='views_count'>1</span> views <i
                                                                    style="margin-left:5px;margin-right:5px">•</i>
                                                                <?php echo DateAgo($video['date']); ?>
                                                            </p>
                                                        </div>
                                                        <?php
                                                        $admin_login=false;
                                                        if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) { $admin_login=true;  ?>
                                                             <div class="upload px-2 text-center">
                                                                <div class='py-2 px-3 featured-btn'
                                                                    style="background-color:#ebebeb;border-radius:25px">
                                                                    <span>Make Featured</span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                       
                                                        <div class="upload px-2 text-center">
                                                            <div class='py-2 px-3'
                                                                style="background-color:#ebebeb;border-radius:25px">
                                                                <span class='like'><a class='mr-2 <?php if ($i_liked)
                                                                    echo "text-primary"; ?> like-btn'>
                                                                        <i class="fa fa-thumbs-up"></i>&nbsp; <span
                                                                            id='likes_count'>1</span>
                                                                    </a></span> |
                                                                <span class='dislike'><a class='ml-2 <?php if ($i_disliked)
                                                                    echo "text-danger"; ?> dislike-btn'>
                                                                        <i class="fa fa-thumbs-down"></i>&nbsp; <span
                                                                            id='dislikes_count'>1</span>
                                                                    </a></span>
                                                            </div>

                                                        </div>
                                                        <a class="upload px-2 text-center">
                                                            <div class='py-2 px-3'
                                                                style="background-color:#ebebeb;border-radius:25px">
                                                                <span href="" class='mr-2 share-btn'>
                                                                    <i class="fa fa-share"></i>&nbsp; Share
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="description p-3"
                                                        style='color:#000000;background-color:#f1f1f1;border-radius:10px'>
                                                        <p>
                                                            <?php echo $video['description']; ?>
                                                        </p>
                                                    </div>

                                                    <div class="comments-section mt-4">
                                                        <h5><span id='comments_count'>0</span> Comments</h5>
                                                        <div class="add-comment" style="display:flex">
                                                            <img src="https://ui-avatars.com/api/?name=Admin&background=random"
                                                                style="height:40px;width:40px;border-radius:50%" alt=""
                                                                sizes="" srcset="">
                                                            <input type="text" name="" style="flex:1;" id="comment"
                                                                class="form-control ml-3">
                                                        </div>
                                                        <button class='badge mt-1 comment-btn'
                                                            style="border-radius:20px;padding:14px;color:#000000;background-color:#ebebeb;float:right;border:none">Comment</button>
                                                        <button class='badge mt-1 cancel-btn'
                                                            style="border-radius:20px;padding:14px;color:#000000;background-color:#ffffff00;float:right;margin-right:5px;border:none;">Cancel</button>


                                                    </div>
                                                    <!--Comments-->
                                                    <div class="all-comments mt-5 mb-5 ml-4">

                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <!--Suggestions-->
                                                    <?php

                                                    $relateds = R::findAll("videos", "project_id=? AND id!=? ORDER BY id DESC LIMIT 10", [$project['link'], $id]);
                                                    foreach ($relateds as $related) {
                                                        echo '
                                                            <a href="' . URL_Make('/video/' . $project['link'] . "/" . base64_encode($related['id'])) . '" class="suggestion mb-3" style="display:flex;">
                                                                <img class="mr-2" style="border-radius:5px;width:180px;height:auto;"
                                                                    src="' . $url . $related['thumbnail'] . '" />
                                                                <div class="suggestion-description" style="flex:1">
                                                                    <b class="single-line">' . $related['title'] . '</b></br>
                                                                    <small class="text-black">' . substr($related['description'], 0, 30) . ' ...</small></br>
                                                                    <small>'.GetViews($related['report']).' views <i
                                                                            style="margin-left:5px;margin-right:5px">•</i> ' . DateAgo($related['date']) . '</small>
                                                                </div>
                                                            </a>
                                                            ';
                                                    }

                                                    if(count($relateds)==0){
                                                        echo '
                                                        <small style="width:100%" class="p-4 text-center text-secondary">No Recommendations Avaialble</small>
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
                    </div>
                </div>
            </div>
        </section>

        <!--Signin-->
        <div class="modal fade" id='signin-popup' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:400px">
                <form action='' method='post' class="modal-content new-modal">
                    <div class="modal-body">
                        <div class="content py-3 px-3" style="display:flex;">
                            <div class="form-group text-center py-3" style="width:100%">
                                <?php
                                if (strlen($brand['logo']) != 0) {
                                    echo '<img src="' . $brand['logo'] . '" style="height:35px;width:auto;"/>';
                                }
                                ?>
                                <h4 class='mt-2 my-3'>Ops! It Seems you haven't logged in to
                                    <?php echo $community_name['name']; ?>
                                </h4>
                                <p>Sign up to continue</p>
                                <div class="container">
                                    <?php
                                    $request_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    ?>
                                    <a class='btn btn-primary mb-2 mt-3 px-3'
                                        href="<?php URL('/signin?q=' . base64_encode($request_url)); ?>"
                                        style="border-radius:0px;width:100%;background-color:var(--primary-color);border:none">Sign
                                        In</a>
                                    <a class='btn btn-primary mb-2 mt-2 px-3'
                                        href="<?php URL('/signup?q=' . base64_encode($request_url)); ?>"
                                        style="border-radius:0px;width:100%;background-color:var(--primary-color);border:none">Sign
                                        Up</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--SHARE-->
        <div class="modal fade" id='share-popup' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:400px">
                <form action='' method='post' class="modal-content new-modal">
                    <div class="modal-body">
                        <div class="content py-3 px-3" style="display:flex;">
                            <div class="form-group text-center py-2" style="width:100%">
                                <h5>Share</h5>
                                <div class="container">
                                    <div class="social-share-holder mt-5">
                                        <?php $video_share=(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
                                        <ul
                                            style="list-style-type:none;display:flex;justify-content:center;padding-left:0px">
                                            <li>
                                                <a target="_blank"
                                                    href="mailto:?subject=Shared Video &amp;body=Check out this video <?php echo $video_share; ?>"
                                                    title="">
                                                    <i style="background-color:#8d8a8a" class="icofont-envelope"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                    href="https://www.facebook.com/sharer.php?t=abc&u=<?php echo $video_share; ?>"
                                                    title="">
                                                    <i style="background-color:#3d60e8" class="icofont-facebook"></i>
                                                </a>
                                            </li>
                                            <li><a href="whatsapp://send?text=<?php echo $video_share; ?>"
                                                    target="_blank" title=""><i style="background-color:#0fab26"
                                                        class="icofont-whatsapp"></i></a>
                                            </li>
                                            <li><a target="_blank"
                                                    href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $video_share; ?>"
                                                    title="">
                                                    <i style="background-color:#055286"
                                                        class="icofont-linkedin"></i></a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="my-3 mt-5">
                                    <div class="input-group mb-3 mt-2 px-5"  style="margin-top:50px">
                                        <input type="text" class="form-control" placeholder="Video Project URL"
                                            aria-label="Video Project URL"
                                            value="<?php echo $video_share; ?>"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-white btn btn-primary copy-url"
                                                id="basic-addon2">Copy
                                                link</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <script>
        var player = videojs('my-video');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            function Copy(copyText,msg) {
                navigator.clipboard.writeText(copyText);
                alertify.success(msg);
            }
            $('.copy-url').click(function(){
                Copy('<?php echo $video_share;?>','Link Copied');
            })
            var login = false;
            var email = '';
            $('.share-btn').click(function(){
                $('#share-popup').modal('show');
            })
            

            var like_count = <?php echo count($likes); ?>;
            var dislike_count = <?php echo count($dislikes); ?>;
            var view_count = <?php echo count($views); ?>;
            var comment_count = 0;

            var i_liked = <?php if ($i_liked) {
                echo 'true';
            } else {
                echo 'false';
            } ?>;
            var i_disliked = <?php if ($i_disliked) {
                echo 'true';
            } else {
                echo 'false';
            } ?>;
            var i_viewed = <?php if ($i_viewed) {
                echo 'true';
            } else {
                echo 'false';
            } ?>;

            if (!i_viewed) {
                view_count = view_count + 1;
                client_ip = '<?php echo $client_ip; ?>';
                RenderStats();
                $.ajax({
                    url: '<?php echo $url; ?>api/video-reaction.php',
                    method: 'POST',
                    data: {
                        video: '<?php echo $id; ?>',
                        'type': 'view', 'ip': client_ip,
                        "path": '<?php echo $path; ?>'
                    },
                    success: function (data) {
                        console.log(data);
                    }
                })
            }
            RenderStats();
            function RenderStats() {
                $('#likes_count').html(like_count);
                $('#dislikes_count').html(dislike_count);
                $('#views_count').html(view_count);
                $('#comment_count').html(comment_count);
            }


            <?php
            if ((isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) || (isset($_SESSION['community_login']) && $_SESSION['community_login'] == true)) {
                $com = json_decode($_SESSION['community_credentials'], true);
                echo "login=true;";
                echo "email='" . $com['email'] . "';";
            }
            ?>

            $('.like').on('click', function () {
                if (email.length != 0) {
                    if (!i_liked) {
                        if (i_disliked) {
                            //remove my dislike
                            $('.dislike-btn').attr('class', 'mr-2 dislike-btn');
                            dislike_count = dislike_count - 1;
                            Reaction('remdislike');
                            RenderStats();
                            i_disliked = false;
                        }
                        $('.like-btn').attr('class', 'mr-2 text-primary like-btn');
                        like_count = like_count + 1;
                        Reaction('like');
                        RenderStats();
                        i_liked = true;
                    } else {
                        $('.like-btn').attr('class', 'mr-2 like-btn');
                        like_count = like_count - 1;
                        Reaction('remlike');
                        RenderStats();
                        i_liked = false;
                    }
                } else {
                    $('#signin-popup').modal('show');
                }
            })

            $('.dislike').on('click', function () {
                if (email.length != 0) {
                    if (!i_disliked) {
                        if (i_liked) {
                            //remove my like
                            $('.like-btn').attr('class', 'mr-2 like-btn');
                            like_count = like_count - 1;
                            Reaction('remlike');
                            RenderStats();
                            i_liked = false;
                        }
                        //add my dislike
                        $('.dislike-btn').attr('class', 'mr-2 text-danger dislike-btn');
                        dislike_count = dislike_count + 1;
                        Reaction('dislike');
                        RenderStats();
                        i_disliked = true;
                    } else {
                        //remove my dislike
                        $('.dislike-btn').attr('class', 'mr-2 dislike-btn');
                        dislike_count = dislike_count - 1;
                        Reaction('remdislike');
                        RenderStats();
                        i_disliked = false;
                    }
                } else {
                    $('#signin-popup').modal('show');
                }
            })


            all_comments = ``;
            $('.comment-btn').on('click', function () {
                comment = $('#comment').val();
                $('#comment').val('');
                all_comments += `
                <div class="comment mt-3" style="display:flex;">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random"
                        style="height:35px;width:35px;border-radius:50%" alt=""
                        sizes="" srcset="">
                    <div class="uploadtext-center ml-3">
                        <div style="color:#000000;margin-bottom:0px">
                            <b>@Demo User</b>&nbsp;<small>Just now</small>
                            <p style="margin-bottom:5px">`+ comment + `</p>
                        </div>
                        <div style="border-radius:25px;color:#434343">
                            <a href="" class="mr-2">
                                <i class="fa fa-thumbs-up"></i>&nbsp;
                            </a> |
                            <a href="" class="ml-2">
                                <i class="fa fa-thumbs-down"></i>&nbsp;
                            </a>
                        </div>
                    </div>
                </div>`;
                setTimeout(function () { $('.all-comments').html(all_comments); comment_count = comment_count + 1; RenderStats(); }, 1000)

            })

            function Reaction(type) {
                if (email.length != 0) {
                    $.ajax({
                        url: '<?php echo $url; ?>api/video-reaction.php',
                        method: 'POST',
                        data: {
                            video: '<?php echo $id; ?>',
                            type, email,
                            "path": '<?php echo $path; ?>'
                        },
                        success: function (data) {
                            console.log(data);
                        }
                    })
                } else {
                    alert('Please login first');
                }
            }

            $('.featured-btn').click(function(){
                $.ajax({
                    url:"<?php echo $url;?>api/featured-video-update.php",
                    method:'POST',
                    data:{
                        'community_id':'<?php echo $community_id;?>',
                        'project_id':'<?php echo $project_id;?>',
                        'video_id':'<?php echo $id;?>',
                    },
                    success:function(data){
                        console.log(data);
                        alertify.success('Video set as featured video');
                    }
                })
            })

        })
    </script>
</body>

</html>