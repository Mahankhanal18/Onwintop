<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Subscription Plans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="theme-color" content="#f1863b">
    <?php
        if(isset($_POST['plan_name']) && isset($_POST['plan_amount'])){
            if($_POST['plan_name']!='FREE'){
                $str=json_encode($_POST);
                $base=base64_encode($str);
                echo "<script>window.location='".$_ENV['project_url'].$community_id."/pay?data=".$base."';</script>";
            }else{
                $community=R::findOne("communities","link=?",[$community_id]);
                $tenant=R::findOne("tenants","tenant_id=?",[$community['tenant_id']]);
        
                
                $tenant->plan='FREE';
                $tenant->expiry=date('Y-m-d');
                
                if(R::store($tenant)){
                    echo "<script>window.location='".$_ENV['project_url'].$community_id."/signin';</script>";
                }
            }
        }
    ?>
    <style>
        :root {
            --banner-text: #ffffff;
            --primary-color: #29b9ce;
            --secondary-color: #29b9ce;
            --primary-color-transparent: #f1863b73;
            --topnav-color: #d9d9d9;
            --background-color: #ffffff;
            --topbar-color: #021f49;
            --footer-color: #021f49;
            --title-text-color: #000000;
            --body-text-color: #454545;
        }

        .nav-tabs {
            background-color: #ffffff !important;
        }

        .nav-link {
            color: #000000 !important;
            font-size: 14px !important;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-color: #ffffff !important;
            margin-bottom: 0px !important;
            border-bottom: none !important;
        }

        .nav-tabs .inner.active {
            border-color: #efefef !important;
            border-radius: 5px;
            background-color: #efefef;
            border: none !important;
        }

        .card {
            border-radius: 0px !important;
        }

        .card-img-top {
            border-radius: 0px !important;
        }

        .challange {
            color: gray;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-bottom: none !important;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link {
            border-bottom: none !important;
            border-radius: 0px !important;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #fff0 !important;
            color: var(--primary-color) !important;
        }

        .container_ {
            list-style: none;
            column-gap: 0;
            padding: 0;
            column-count: 3;
        }

        .card_ {
            width: 100%;
            height: auto;
            padding: 5px;
            margin: 0;
            box-sizing: border-box;
            break-inside: avoid;
        }

        #myTabContent2 .nav-link.active {
            background-color: #ffffff !important;
            border: none !important;
            color: #000000 !important;
            font-size: 13px;
        }

        #myTabContent2 .nav-link {
            border: none !important;
            font-size: 13px;
        }

        a:hover {
            color: #000000 !important;
        }

        .nav-menu {
            margin: 0px;
            list-style-type: none;
            display: inline;
        }

        .nav-menu li {
            display: inline;
            margin-right: 20px;
            margin-left: 10px;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #000000;
            font-size: 16px;
        }

        .nav-menu li a:hover {
            color: var(--secondary-color) !important;
        }

        .nav-menu li a.active {
            color: var(--secondary-color) !important;
        }

        .card-rec {
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ebebeb;
        }

        .card-body {
            border-radius: 5px;
        }

        .dis-type {
            font-size: 18px;
            text-decoration: none;
            font-weight: 500;
            color: #000000;
        }

        .dis-type:hover,
        .dis-type.active {
            color: var(--primary-color) !important;
            border-bottom: 4px solid var(--primary-color);
        }
    </style>
    <?php
    $titles = array(
        'File without fields', 'Ultimate', 'Final Test', 'Test file'
    );
    $images = array(
        'https://res.cloudinary.com/tellselling/image/upload/v1668443216/uzjhvhdarh8z6c7gw5qm.jpg', 'https://res.cloudinary.com/tellselling/image/upload/v1668462227/gu2s6wonlusm9za5unlt.jpg', 'https://res.cloudinary.com/tellselling/image/upload/v1668455277/ng7j9dsghccce2ds0mra.jpg', 'https://via.placeholder.com/600x400.png?text=Thumbnail+Image'
    );
    ?>
</head>
<div class='data' style='display:none'>

    <body>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
        <title>Discussions</title>
        <div class="navbar navbar-light" id="io3q"> <a href="#" class="navbar-brand">
                <center id="ikc8k">
                    <h4 class="text-white">Onwintop Welcome </h4>
                </center>
            </a></div><a href="#" class="navbar-brand">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 px-0" id="iwq6h"> <img src="https://app-dev.onwintop.com/focus-editor/topbar.png" alt="" srcset="" id="ide1e" />
                        <div id="myTabContent" class="tab-content">
                            <div id="home" class="tab-pane fade show active"> <img src="https://app-dev.onwintop.com/focus-editor/content.png" id="i0ebf" /> <img src="https://app-dev.onwintop.com/focus-editor/leaderboard.png" alt="" srcset="" id="ikq8h" /> </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </body>
</div>

<body style='background-color:#eff2f9;'>
    <div style="background-color: #eff2f9;padding:20px">
        <div class='container'>
            <div class='row px-5' style='background-color:#eff2f9;'>
                <div class='col-md-8' style='padding-right:20px;align-items: center;display: flex;'>
                    <ul class="nav-menu p-2">
                        <li><a href="discussions.php">Discussion</a></li>
                        <li><a href="challenges.php">Challenges</a></li>
                        <li><a href="#">Rewards</a></li>
                        <li><a href="#">Contents</a></li>
                    </ul>
                </div>
                <div class='col-md-4' style='display:flex;align-items:center;justify-content:right;'>
                    <b style='color:#929090;'><i class='fa fa-coins'></i>&nbsp; 80 &nbsp;&nbsp;</b>
                    <a href='https://app-dev.onwintop.com/4e2uq/profile'><img src='https://ui-avatars.com/api/?name=Test Test&background=random' style='height:35px;width:35px;border-radius:50%;' /></a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light px-2 py-5" style="background-color:var(--secondary-color) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 px-5">
                    <h2 class='text-white'><img src='https://res.cloudinary.com/tellselling/image/upload/v1668638032/nq2xe7pdbdkmcfwzbsqz.png' style='max-width: 180px !important;padding-right:20px;border-right:3px solid #ffffff;margin-right:20px' alt='Logo'><b id='header'></b></h2>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2 style="color:var(--secondary-color)">Web 3.0 Gamified Marketing for Companies</h2>
    </div>
    <img src="<?php echo $_ENV['project_url'];?>provision/banner.jpg" style="width:100%;height:auto" alt="" srcset="">
    <div class="container">
        <form action="" id='plan' method="post">
            <input type="hidden" id="plan_name" name="plan_name" value="">
            <input type="hidden" id="plan_amount" name="plan_amount" value="">
            <input type="hidden" id="plan_id" name="plan_id" value="">
        </form>
        <div class="row">
            <div class="col-md-12 px-5">
                <div class='row'>
                    <div class="col-md-12 py-4">
                        <div class="row">
                            <div class="col-md-3 p-2">
                                <div class="card p-2" style="border:none;">
                                    <div class="card-body">
                                        <h4>€ 9.90</h4>
                                        <small>7-day trial subscription</small>
                                        <ul class='my-4' style='margin-left:0px;padding-left:15px;margin-top:10px' class='mt-2'>
                                            <li>1 Space</li>
                                            <li>5 Challenges</li>
                                            <li>Limited access to gamification functionalities</li>
                                            <li>After 7 days, auto-renews to €24.00 billed every 7 days.</li>
                                        </ul>
                                        
                                        </br></br></br></br>
                                        <button style="width:100%;background-color:var(--secondary-color);border:none;" data-id='1' data-name="7 Days" data-amount="9.90" class="subscribe btn btn-primary">Start Gamify</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 p-2">
                                <div class="card p-2" style="border:none;">
                                    <div class="card-body">
                                        <h4>€ 599.00</h4>
                                        <small>6 months</small>
                                        <ul class='my-4' style='margin-left:0px;padding-left:15px;margin-top:10px' class='mt-2'>
                                            <li>1 Space</li>
                                            <li>Unlimited Challenges</li>
                                            <li>Limited access to gamification functionalities</li>
                                            <li>Limited NFT, Gift Card support</li>
                                            <li>One-time payment, no need to cancel</li>
                                        </ul>
                                        </br></br></br>
                                        
                                        <button style="width:100%;background-color:var(--secondary-color);border:none;" data-id='2' data-name="6 Months" data-amount="599.00" class="subscribe btn btn-primary">Start Gamify</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 p-2">
                                <div class="card p-2" style="border:none;">
                                    <div class="card-body">
                                        <h4>€ 1199.00</h4>
                                        <small>12 months</small>
                                        <ul class='my-4' style='margin-left:0px;padding-left:15px;margin-top:10px' class='mt-2'>
                                            <li>Unlimited Space</li>
                                            <li>Unlimited Challenges</li>
                                            <li>Unlimited access to gamification functionalities</li>
                                            <li>Full NFT, Gift Card support</li>
                                            <li>Built-in Analytics</li>
                                            <li>Custom Branding</li>
                                            <li>Integration Capabilities</li>
                                            <li>One-time payment, no need to cancel</li>
                                        </ul>
                                        <button style="width:100%;background-color:var(--secondary-color);border:none;" data-id='3'  data-name="12 Months" data-amount="1199.00" class="subscribe btn btn-primary">Start Gamify</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 p-2">
                                <div class="card p-2" style="border:none;">
                                    <div class="card-body">
                                        <h4>€ 0.00</h4>
                                        <small>free plan</small>
                                        <ul class='my-4' style='margin-left:0px;padding-left:15px;margin-top:10px' class='mt-2'>
                                            <li>1 Space</li>
                                            <li>1 Challenges</li>
                                            <li>Unlimited logins to space</li>
                                        </ul>
                                        </br></br></br></br></br></br></br>
                                        <button style="width:100%;background-color:#ffffff00;border:1px solid var(--secondary-color);color:var(--secondary-color);" data-name="FREE" data-id='4' data-amount="0" class="subscribe btn btn-primary">Start Gamify</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center my-5">
        <img src="<?php echo $_ENV['project_url'];?>provision/supported.png" style="height:25px;width:auto;" alt="" srcset=""></br></br>
        <small class="text-secondary">We accept all major payment methods and procedd payments </br> with Stripe SSL Secure /256-bit SSL secure checkout. 7-Day Money Back Guarantee.</small>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.subscribe').on('click',function(){
            name=$(this).attr('data-name');
            amount=$(this).attr('data-amount');
            id=$(this).attr('data-id');
            $('#plan_name').val(name);
            $('#plan_id').val(id);
            $('#plan_amount').val(amount);
            $('#plan')[0].submit();
        })
    });
</script>

</html>