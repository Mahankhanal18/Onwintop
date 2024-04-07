<?php include "init.php"; 
$parts=URL_Parts();
if(isset($community_id)){
    $_SESSION['last_visited_community']=$parts[7];
}
$credentials=json_decode($_SESSION['community_credentials'],true);?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Admin | Tellselling</title>
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
    <!-- <div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
    </div> -->
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
                                        <div class="main-title">Admin Account</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <?php
                                                           $tenant_id=$credentials['tenant_id'];
                                                           $tenant=R::findOne("tenants","WHERE tenant_id=?",[$tenant_id]);
                                                        ?>
                                                        <p>Your active plan is : <?php echo $tenant['plan'];?></br>
                                                        Your plan is valid till : <?php echo date_format(date_create($tenant['expiry']),'d M Y');?></p>
                                                        <a href='<?php echo $_ENV['project_url'].$community_id."/choose-subscription";?>' class="button soft-success">Upgrade Membership</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Recent Billings</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Email</th>
                                                                    <th>Member Since</th>
                                                                    <th>Bill Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='7' style='text-align:center;padding:35px'>
                                                                        <b>No Billing Details Available</b>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
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
        <?php include "includes/plans.php"; ?>
    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#upgrade').click(function(){
                $('#plans').addClass('active');
            })
            $('.upgrade-btn').click(function(){
                $('#checkout').addClass('active');
            })
            
            
        })
    </script>
</body>

</html>