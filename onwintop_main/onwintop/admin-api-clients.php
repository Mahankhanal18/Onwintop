<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>API Clients | Tellselling</title>
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
                                        <div class="main-title">API Clients
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b style='padding:30px;text-align:center'>Coming Soon</b>
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
    <div class="popup-wraper" id='code-entry'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Custom Code</h5>
                </div>
                <div class="send-message c-form">
                    <textarea name="" id="" cols="30" rows="2" placeholder="Header Code"></textarea>
                    <textarea name="" id="" cols="30" rows="2" placeholder="Body Code"></textarea>
                    <textarea name="" id="" cols="30" rows="2" placeholder="Footer Code"></textarea>
                    <button class="button soft-success">Send</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
        })
    </script>
</body>

</html>