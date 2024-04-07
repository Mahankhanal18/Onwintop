<?php
include "init.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Go Live | Files </title>
    <?php include "includes/head.php"; ?>
    <style>
        #share-buttons img {
            height: 30px !important;
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
        <?php
        $u = $url . $_SESSION['community_id'] . "/live-stream/" . time();
        ?>
        <section>
            <div class="gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-7">
                                    <div class="main-wraper">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="full-book">

                                                    <div class="prod-stat">
                                                        <div class="container p-4">
                                                            <h4>Go Live</h4>
                                                            <form id='live' class='mt-3' action="">
                                                                <div class="form-group">
                                                                    <label for="">Live Title</label>
                                                                    <input type="text" name="" class='form-control' id="" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Live Description</label>
                                                                    <input type="text" name="" class='form-control' id="" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Stream Link</label>
                                                                    <input type="text" name="" class='form-control' value="<?php echo $u; ?>" id="" readonly>
                                                                </div>
                                                                <div id="share-buttons">

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

                                                                    <!-- Tumblr-->
                                                                    <a href="http://www.tumblr.com/share/link?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                                                        <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
                                                                    </a>

                                                                    <!-- Twitter -->
                                                                    <a href="https://twitter.com/share?url=<?php echo $u; ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
                                                                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                                                                    </a>

                                                                    <!-- Yummly -->
                                                                    <a href="http://www.yummly.com/urb/verify?url=<?php echo $u; ?>&amp;title=Share Community on Social Media" target="_blank">
                                                                        <img src="https://simplesharebuttons.com/images/somacro/yummly.png" alt="Yummly" />
                                                                    </a>

                                                                </div>
                                                                <div class="form-group mt-5">
                                                                    <button type='submit' class='btn btn-success'>Start Live</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="book-description">
											<p>
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
											</p>
										</div>-->

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
    <script src="<?php URI("js/sparkline.js"); ?>"></script>
    <script src="<?php URI("js/chart.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function(){
            $('#live').on('submit',function(e){
                e.preventDefault();
                window.location='<?php echo $u?>';
            })
        })
    </script>

</body>

</html>