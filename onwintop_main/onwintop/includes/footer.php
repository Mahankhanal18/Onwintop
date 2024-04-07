
<!-- <footer>
    <div class="gap">
        <div class="bg-image" style="background-image: url(<?php echo URI('images/resources/footer-bg.png'); ?>)"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="web-info">
                        <div class="logo"><span>Tellselling</span></div>
                        <p>Subscribe our newsletter for getting notifications and alerts</p>
                        <div class="contact-little">
                            <span><i class="icofont-phone-circle"></i> +1-235-099-34</span>
                            <span><i class="icofont-email"></i> info@tellselling.tech</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Company</h4>
                        </div>
                        <ul class="quick-links">
                            <li><a href="#" target="_top" title="">About Us</a></li>
                            <li><a href="#" title="">Career</a></li>
                            <li><a href="#" title="">Privacy</a></li>
                            <li><a href="#" title="">Terms</a></li>
                            <li><a href="#" title="">FAQ</a></li>
                            <li><a href="#" title="">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Quick Links</h4>
                        </div>
                        <ul class="quick-links">
                            <li><a href="#" title="">Product</a></li>
                            <li><a href="#" title="">Market</a></li>
                            <li><a href="#" title="">Courses</a></li>
                            <li><a href="#" title="">Services</a></li>
                            <li><a href="#" title="">Enterprise</a></li>
                            <li><a href="#" title="">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Follow Us</h4>
                        </div>
                        <ul class="quick-links">
                            <li><a href="#" title=""><i class="icofont-facebook"></i>facebook</a></li>
                            <li><a href="#" title=""><i class="icofont-twitter"></i>twitter</a></li>
                            <li><a href="#" title=""><i class="icofont-instagram"></i>instagram</a></li>
                            <li><a href="#" title=""><i class="icofont-google-plus"></i>google +</a></li>
                            <li><a href="#" title=""><i class="icofont-whatsapp"></i>whatsapp</a></li>
                            <li><a href="#" title=""><i class="icofont-reddit"></i>reddit</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Newsletter</h4>
                        </div>
                        <div class="news-lettr">
                            <form class="newsletter">
                                <input type="text" placeholder="Email Address">
                                <button type="submit"><i class="icofont-paper-plane"></i></button>
                            </form>
                            <p>
                                it is a long established fact that a reader will be distracted by.
                            </p>
                            <h5>Download App</h5>
                            <a href="#" title=""><img src="<?php echo URI('images/android.png'); ?>" alt=""></a>
                            <a href="#" title=""><img src="<?php echo URI('images/apple.png'); ?>" alt=""></a>
                            <a href="#" title=""><img src="<?php echo URI('images/windows.png'); ?>" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> -->
<!-- 
<div class="bottombar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="">&copy; copyright All rights reserved by Tellselling.tech</span>
            </div>
        </div>
    </div>
</div> -->



<div class="share-wraper" id='auth_warning'>
    <div class="share-options">
        <span class="close-btn"><i class="icofont-close-circled"></i></span>
        <h5>Signin Required</h5>
        <div style="display: block;" class="social-media">
            <p>You need to login/register to this community to continue.</p>
        </div>
        <a class="main-btn text-center" href='<?php URL("/signin"); ?>'>Signin</a>
        <a class="main-btn mt-2 text-center" href='<?php URL("/signup"); ?>'>Signup</a>
    </div>
</div><!-- share post -->

<div id="modal-community" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical" style='width:350px'>

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <form method="post" class="inquiry-about" style='margin-top:0px'>
            <h5>Change Community:</h5></br></br>
            <?php
            $coms = R::findAll("communities", "WHERE tenant_id=?", [$community_name['tenant_id']]);
            foreach ($coms as $com) {
                $check = "";
                if ($com['link'] == $_SESSION['community_id']) {
                    $check = "checked";
                }
                echo "<label onclick='window.location=`".$root. $com['link'] . "/`' style='font-size:18px'><input type='radio' name='hear' " . $check . ">" . $com['name'] . "</label>";
            }
            ?>
            <label><a href="<?php URL('/create-community'); ?>" class='button soft-primary' style='width:100%'>+ Create New</a></label>

        </form>

    </div>
</div>


<?php
foreach ($custom_codes as $custom_code) {
    echo $custom_code['footer'];
}
?>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit-icons.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#sidenav").css("padding-top","280px !important");
        $(window).scroll(function () {
            var position=$(window).scrollTop();
    		if (position > 250) {
    		    //alert('hi')
    			$("#sidenav").css("padding-top","20px !important");
    		} else {
    			$("#sidenav").css("padding-top","280px !important");
    			
    		}
    	});
    	
    })
</script>


