<?php
include "init.php";
$error = '';
$success = '';
if (isset($_POST['community'])) {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Community | <?php echo $_ENV['app_name'];?> </title>
    <?php include "includes/head.php"; ?>
</head>
<body>
    <div class="theme-layout">
        <div class="authtication high-opacity" style='background-image:url(https://onwintop.com/assets/images/banner/page-banner.jpg);background-size:cover;background-position:left'>
            <div class="verticle-center">
                <div class="welcome-note">
                    <img src='<?php URI('images/logo.png') ?>' /></br>
                    <div class="logo"><span>Create community</span></div>
                    <h1 style='color:#ae3793'>We turn digital channels into growth engines</h1>
                    <p style='color:#ae3793'>
                        The future of growth in a technology driven world
                    </p>
                </div>
                <div class="bg-image" style="https://source.unsplash.com/random/2109x1974/?nature"></div>
            </div>
        </div>
        
        <div id='info' class="auth-login" style='display:none'>
            <div class="verticle-center">
                <div class="signup-form">
                    <h4><i class="fa fa-lock" aria-hidden="true"></i> Setup Community</h4>
                    <form method="post" action="" class="c-form">
                        <div class="row merged-10">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label>Select Primary Color:</label>
                                <input type="text" name='first_name' placeholder="Community Name" required>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label>Select Font:</label>
                                <input type="text" name='first_name' placeholder="Community Name" required>
                            </div>
                            <div class="col-lg-12">
                                <div class="uk-margin">
                                    <button class="main-btn button soft-success py-3">Continue</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id='setting' class="auth-login">
            <div class="verticle-center">
                <div class="signup-form">
                    <h4><i class="fa fa-lock" aria-hidden="true"></i> Create a community</h4>
                    <form method="post" action="" class="c-form">
                        <div class="row merged-10">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <span class='text-danger error'></span>
                                <span class='text-success success'></span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <input type="text" name='community_name' placeholder="Community Name" required>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <input type="text" name='community_description' placeholder="Community Description" required>
                            </div>

                            
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <input type="email" name='email' placeholder="Support Email@" required>
                            </div>
                            
                            <div class="col-md-6 mt-2">
                                <div class='row'>
                                    <div class='col-md-6' style="display:flex;">
                                        <label>Primary Color:</label>
                                    </div>
                                    <div class='col-md-4'>
                                        <div id='primary-holder' style='background-color:#ff0000;padding:10px;border-radius:50%;height:20px;width:20px;border:5px solid #ebebeb;'></div>
                                        <input type="color" style="visibility:hidden;height:5px;padding:0px;" id='primary' value="#f1863b" name='primary_color' required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class='row'>
                                    <div class='col-md-6' style="display:flex;">
                                        <label>Secondary Color:</label>
                                    </div>
                                    <div class='col-md-4'>
                                        <div id='secondary-holder' style='background-color:#ff0000;padding:10px;border-radius:50%;height:20px;width:20px;border:5px solid #ebebeb;'></div>
                                        <input type="color" style="visibility:hidden;height:5px;padding:0px;" id='secondry' value="#f1863b" name='secondary_color' required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="uk-margin">
                                    <button class="main-btn button soft-success py-3">Continue</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function(){
            $('#primary').on('change',function(){
                var primary=$('#primary').val();
                $('#primary-holder').css('background-color',primary);
            })
            $('#secondry').on('change',function(){
                var secondary=$('#secondry').val();
                $('#secondary-holder').css('background-color',secondary);
            })
            $('#primary-holder').click(function(){
                $('#primary').click();
            })
            $('#secondary-holder').click(function(){
                $('#secondry').click();
            })
        })
    </script>
</body>

</html>