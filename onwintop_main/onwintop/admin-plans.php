<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Billings | Tellselling</title>
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
            <div class="gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-wraper blank-wrapper">
                                <div class="main-title">Recent Billings</div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <!--Payment-->
                                        <style>
                                            .d-widget {
                                                border-radius: 5px;
                                                display: inline-block;
                                                padding: 30px 15px;
                                                width: 100%;
                                                border: 1px solid #e1e8ed;
                                            }

                                            .soft-red {
                                                background: #ffe1e2;
                                            }

                                            .soft-blue {
                                                background: #c2d5ff;
                                            }

                                            .soft-green {
                                                background: #e6ffbf;
                                            }

                                            .d-widget-content>i {
                                                font-size: 81px;
                                                left: 50%;
                                                opacity: 0.1;
                                                position: absolute;
                                                top: 50%;
                                                transform: translate(-50%, -30%);
                                            }
                                        </style>
                                        <div class="text-center">
                                            <div class="mt-2 mb-5 pt-4 ml-5 mr-5">
                                                <div class="container text-center">

                                                    <h2 style='border-right:4px solid red;border-left:4px solid red;'>Your 7 days free trial is activated</h2>
                                                    <div class="row merged20 mt-4 mb-4">
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                            <div class="d-widget soft-red">
                                                                <div class="d-widget-title">
                                                                    <h5>Starter</h5>
                                                                </div>
                                                                <div class="d-widget-content" style='height:100%'>
                                                                    <ul style='list-style-type:none;padding:0px'>
                                                                        <li>Up to 1 community</li>
                                                                        <li>1 team member</li>
                                                                        <li>100 registered users</li>
                                                                        <li>1 Digital salesroom/month</li>
                                                                        <li>1 Event/month</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                    </ul>
                                                                    <p>
                                                                    <h2 style='font-weight:200'>$0 <sub style='font-size:16px'>start fee</sub></h2>
                                                                    + $199<sub>/community/month</sub>
                                                                    </p>

                                                                    <a plan='Starter' style='width:100%' class="iconbox button soft-primary upgrade-btn">Upgrade</a>
                                                                    <i class="icofont-bullseye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                            <div class="d-widget soft-blue">
                                                                <div class="d-widget-title">
                                                                    <h5>Growth</h5>
                                                                </div>
                                                                <div class="d-widget-content">
                                                                    <ul style='list-style-type:none;padding:0px'>
                                                                        <li>Up to 5 community</li>
                                                                        <li>10 team member</li>
                                                                        <li>15,000 registered users</li>
                                                                        <li>5 Digital salesroom/month</li>
                                                                        <li>5 Event/month</li>
                                                                        <li>Email and Live Chat Support</li>
                                                                        <li>Advanced Design Customisation</li>
                                                                        <li>Content Management</li>
                                                                        <li>Premium content wall</li>
                                                                        <li>User management</li>
                                                                        <li>Support Module</li>
                                                                        <li>Blog Module</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                        <li> &nbsp;</li>
                                                                    </ul>
                                                                    <p>
                                                                    <h2 style='font-weight:200'>$1999 <sub style='font-size:16px'>start fee</sub></h2>
                                                                    + $199<sub>/community/month</sub>
                                                                    </p>
                                                                    <a plan='Growth' style='width:100%' class="iconbox button soft-primary upgrade-btn">Upgrade</a>
                                                                    <i class="icofont-diamond"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                            <div class="d-widget soft-green">
                                                                <div class="d-widget-title">
                                                                    <h5>Enterprise</h5>
                                                                </div>
                                                                <div class="d-widget-content">
                                                                    <ul style='list-style-type:none;padding:0px'>
                                                                        <li>Unlimited registered communities</li>
                                                                        <li>Unlimited team membesr</li>
                                                                        <li>Unlimited registered users</li>
                                                                        <li>Unlimited salesrooms</li>
                                                                        <li>Unlimited Events</li>
                                                                        <li>Email and Live Chat Support</li>
                                                                        <li>Dedicated Account Manager</li>
                                                                        <li>In-Person Support</li>
                                                                        <li>Everything in Growth & Plus</li>
                                                                        <li>Fully Custom Design</li>
                                                                        <li>Homepage Editor</li>
                                                                        <li>Custom analytics integration</li>
                                                                        <li>Live Streaming</li>
                                                                        <li>NFTs Advocacy programme</li>
                                                                        <li>Chatbot add-on</li>
                                                                    </ul>
                                                                    <p class='mt-5 pt-4 mb-2'>
                                                                        <br>
                                                                        <b>*Contact Sales to get quote</b>

                                                                    </p>
                                                                    <a plan='Enterprise' style='width:100%' class="iconbox button soft-primary upgrade-btn">Upgrade</a>
                                                                    <i class="icofont-crown"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <script src='assets/js/script.js'></script>

                                        </div>
                                        <!---->

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
        $(document).ready(function() {})
    </script>
</body>

</html>