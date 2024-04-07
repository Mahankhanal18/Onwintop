<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sharing | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <style>
        .daywise:hover {
            cursor: pointer;
        }

        .blank-wrapper {
            background: #fafafa00 none repeat scroll 0 0 !important;
            border: 1px solid #e1e8ed00 !important;
            border-radius: 5px;
            display: block;
            margin-bottom: 30px;
            padding: 15px 20px 20px;
            position: relative;
            width: 100%;
            z-index: 9;
        }
        td {
        padding: 10px;
    }

    #logo_upload:hover {
        cursor: pointer;
    }

    #share-buttons img{
        height:30px !important; 
        width: auto;
    }
    </style>
</head>

<body>
    <div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
    </div><!-- page loader -->
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
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Share Community</div>
                                        <div class="row">
                                            <div class="col-md-12">
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

                                                    <!-- Print -->
                                                    <a href="javascript:;" onclick="window.print()">
                                                        <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
                                                    </a>

                                                    <!-- Reddit -->
                                                    <a href="http://reddit.com/submit?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
                                                    </a>

                                                    <!-- StumbleUpon-->
                                                    <a href="http://www.stumbleupon.com/submit?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/stumbleupon.png" alt="StumbleUpon" />
                                                    </a>

                                                    <!-- Tumblr-->
                                                    <a href="http://www.tumblr.com/share/link?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
                                                    </a>

                                                    <!-- Twitter -->
                                                    <a href="https://twitter.com/share?url=<?php echo $u; ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                                                    </a>

                                                    <!-- VK -->
                                                    <a href="http://vkontakte.ru/share.php?url=<?php echo $u; ?>" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
                                                    </a>

                                                    <!-- Yummly -->
                                                    <a href="http://www.yummly.com/urb/verify?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/yummly.png" alt="Yummly" />
                                                    </a>

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
    <script>
        $(document).ready(function() {

        })
    </script>
</body>

</html>