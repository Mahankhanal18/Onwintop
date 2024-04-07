<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Events | <?php echo $title; ?></title>
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
    </style>
</head>

<body>
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
                                        <div class="main-title">Custom Code
                                            <button class="button soft-primary add-code" style='float:right'>+ Add Code</button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b style='padding:30px;text-align:center'>No Custom Code Exists</b>
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
            $('.add-code').click(function() {
                $('#code-entry').addClass('active');
            })
        })
    </script>
</body>

</html>