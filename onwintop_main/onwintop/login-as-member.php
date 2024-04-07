<?php
include "init.php";
if ($_SESSION['user_login'] == true) {
    //getting existing credentials
    $user_credentials = json_decode($_SESSION['user_credentials'], true);
    //logout of community
    $_SESSION["user_login"]='false';
    $_SESSION["community_login"]= 'false';
    $_SESSION["role"]='';
    $_SESSION["community_credentials"]= '[]';

    //login as member
    $user=R::findOne("members","WHERE email=?",[$user_credentials['email']]);
    $_SESSION["community_login"]='true';
    $_SESSION["role"]=$user['role'];
    $_SESSION["community_credentials"]=json_encode($user);
    $success = 'Signin successful. Redirecting...';
    echo "<script>setTimeout(function(){ window.location='" . $root . $community_id . "'; }, 4000);</script>";
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?> </title>
    <?php include "includes/head.php"; ?>
    <style>
        #share-buttons img {
            height: 30px !important;
            width: auto;
        }
    </style>
</head>

<body>
    <div class="theme-layout">
        <section>
            <div class="container mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">

                                <div class="col-lg-12">


                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="content">

                                            <div class="main-wraper text-center" class='py-5' style="padding-top:200px;padding-bottom:200px">
                                                <img src='<?php echo $root;?>images/loader.gif'  style='height:100px;width:auto;margin-bottom:50px'>
                                                <h5 class='text-success' id='text'>Signing out of account</h5>
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
    <script src="<?php URI("js/sparkline.js"); ?>"></script>
    <script src="<?php URI("js/chart.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        setTimeout(function(){ document.getElementById('text').innerHTML="Signing as member"; }, 1200);
    </script>

</body>

</html>