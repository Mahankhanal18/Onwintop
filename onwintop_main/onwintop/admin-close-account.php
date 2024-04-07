<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Close Account | Tellselling</title>
    <?php include "includes/head_admin.php"; ?>
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
    </style>
</head>

<body>

    <div class="theme-layout">
        <?php include "includes/header_admin.php"; ?>
        <?php include "includes/nav_admin.php"; ?>
        <section>
            <div class="gap" style='padding-left:300px'>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Close Account</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="button soft-danger">
                                                    This will immediately delete all of your communities, along with all of blogs, videos, files, solutions, salesrooms, events. You will no longer be billed, and your tenantship will be permanently removed.
                                                    </br>
                                                    <button class="button danger mt-2" id='close'>Close my account</button>
                                                </p>
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
    <!--New Session Popup-->
    <div class="popup-wraper" id='confirm'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Accout Closing Confirmation</h5>
                </div>
                <div class="send-message c-form">
                    <p>Are you sure want to close your account?</p>
                    <button class="button soft-danger yes">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#close').click(function(){
                $('#confirm').addClass('active');
            })
            $('.yes').click(function(){
                alert('Sorry! you can not remove your account at this moment');
            })
        })
    </script>
</body>

</html>