<?php
include "init.php";
$error = '';
$success = '';
if (isset($_POST['community'])) {
    if ($_POST['password'] == $_POST['confirm_password']) {
        $user = R::findOne("users", "WHERE email=?", [$_POST['email']]);
        $member = R::findOne("members", "WHERE email=?", [$_POST['email']]);
        if (strlen($user['id']) == 0 && strlen($member['id']) == 0) {
            //Creating Tenant
            $id = time();
            $community_id = UID(5);
            $tenant = R::dispense("tenants");
            $tenant->tenant_id = $id;
            $tenant->plan = 'FREE';
            $seven_days = strtotime("+7 day");
            $tenant->expiry = date('Y-m-d', $seven_days);
            $tenant->creation_date = date('Y-m-d');
            if (R::store($tenant)) {
                //Creating User
                $data = R::dispense("users");
                $data->role = 'Admin';
                $data->email = $_POST['email'];
                $data->first_name = $_POST['first_name'];
                $data->last_name = $_POST['last_name'];
                $data->password = $_POST['password'];
                $data->tenant_id = $id;
                $data->photo = 'https://ui-avatars.com/api/?name=' . $_POST['first_name'] . ' ' . $_POST['last_name'] . '&background=random';
                $data->creation_time = date('d M Y h:ia');
                $data->plan = 'FREE';
                $data->status = 'Active';
                //Creating Community
                $community = R::dispense("communities");
                $community->link = $community_id;
                $community->tenant_id = $id;
                $community->name = $_POST['community'];
                $community->description = '';
                $community->thumbnail = '';
                $community->creation_date = date('Y-m-d');
                $community->creation_time = date('h:ia');
                $community->title = $_POST['title'];
                //Creating Branding
                $branding = R::dispense("branding");
                $branding->community_id = $community_id;
                $branding->colors = '{"post_background": "#4d92c7","post_text": "#f5f5f5","topnav_text":"#000000","background_color": "#ffffff","header_text_color": "#000000","body_text_color": "#454545"}';
                //landing pages
                $default_code = '<body><link rel="stylesheet" href="assets/main.css"/><link rel="stylesheet" href="assets/style.css"/><link rel="stylesheet" href="assets/color.css"/><link rel="stylesheet" href="assets/responsive.css"/><img src="assets/images/header.png" id="hero-banner" alt=""/><section id="research-widget" class="mt-4 mb-3"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"><div class="welcome-parallax info-sec"><h4 class="main-title">Advance your research</h4><p>Join our community of scientists.</p><a href="signup" title="" data-ripple="" class="main-btn">Join Free Now</a><a href="signin" title="" data-ripple="" class="main-btn">Join Free Now</a></div></div></div></div></div></section><section id="info-widget" class="mt-3 mb-3"><div class="mt-2 mb-2 no-bottom grey-bg nogap"><div class="container"><div class="row"><div class="col-lg-4 col-md-6"><div class="info-sec"><i class="icofont-checked"></i><div><h6>Get started</h6><p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p></div></div></div><div class="col-lg-4 col-md-6"><div class="info-sec"><i class="icofont-play-alt-1"></i><div><h6>Assistance</h6><p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p></div></div></div><div class="col-lg-4 col-md-6"><div class="info-sec"><i class="icofont-clock-time"></i><div><h6>Start exploring</h6><p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p></div></div></div></div></div></div></section><section id="channel-widget-2" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"><div class="main-wraper"><h4 class="main-title">Discover Your Channel <a id="view-all-channel" title="" class="view-all">view all</a></h4><div id="channel-container" class="books-caro"><img src="assets/images/list.png"/></div></div></div></div></div></div></section><section id="events-widget-2" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"><div class="main-wraper"><h4 class="main-title">Recent Events<a id="view-all-event" title="" class="view-all">view all</a></h4><div id="events-container" class="books-caro"><img src="assets/images/list.png"/></div></div></div></div></div></div></section><section id="channel-widget" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"></div></div></div></div></section><section id="events-widget" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"></div></div></div></div></section></body>';
                $default_data = '{"assets":[],"styles":[{"selectors":["#hero-banner"],"style":{"width":"100%","height":"auto"}}],"pages":[{"frames":[{"component":{"type":"wrapper","stylable":["background","background-color","background-image","background-repeat","background-attachment","background-position","background-size"],"components":[{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/main.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/style.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/color.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/responsive.css"}},{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/header.png","id":"hero-banner","alt":""}},{"tagName":"section","classes":["mt-4","mb-3"],"attributes":{"id":"research-widget"},"components":[{"classes":["no-bottom"],"components":[{"classes":["container"],"components":[{"classes":["row"],"components":[{"classes":["col-lg-12"],"components":[{"classes":["welcome-parallax","info-sec"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Advance your research"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Join our community of scientists."}]},{"type":"link","classes":["main-btn"],"attributes":{"href":"signup","title":"","data-ripple":""},"components":[{"type":"textnode","content":"Join Free Now"}]},{"type":"link","classes":["main-btn"],"attributes":{"href":"signin","title":"","data-ripple":""},"components":[{"type":"textnode","content":"Join Free Now"}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-3","mb-3"],"attributes":{"id":"info-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["mt-2","mb-2","no-bottom","grey-bg","nogap"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"classes":["info-sec"],"components":[{"tagName":"i","highlightable":false,"classes":["icofont-checked"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Get started"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]},{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"droppable":false,"classes":["info-sec"],"components":[{"tagName":"i","droppable":false,"highlightable":false,"classes":["icofont-play-alt-1"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Assistance"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]},{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"droppable":false,"classes":["info-sec"],"components":[{"tagName":"i","highlightable":false,"classes":["icofont-clock-time"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Start exploring"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"channel-widget-2"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"],"components":[{"droppable":false,"highlightable":false,"classes":["main-wraper"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Discover Your Channel "},{"type":"link","editable":false,"classes":["view-all"],"attributes":{"id":"view-all-channel","title":""},"components":[{"type":"textnode","content":"view all"}]}]},{"droppable":false,"highlightable":false,"classes":["books-caro"],"attributes":{"id":"channel-container"},"components":[{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/list.png"}}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"events-widget-2"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"],"components":[{"droppable":false,"highlightable":false,"classes":["main-wraper"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Recent Events"},{"type":"link","editable":false,"classes":["view-all"],"attributes":{"id":"view-all-event","title":""},"components":[{"type":"textnode","content":"view all"}]}]},{"droppable":false,"highlightable":false,"classes":["books-caro"],"attributes":{"id":"events-container"},"components":[{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/list.png"}}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"channel-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"events-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"]}]}]}]}]}]}}],"id":"laQ1G4ovWLpkO7Zy"}]}';
                $homepage = R::dispense("homepages");
                $homepage->community_link = $community_id;
                $homepage->code = $default_code;
                $homepage->data = $default_data;
                $homepage->version1_code = $default_code;
                $homepage->version1_data = $default_data;
                $homepage->version2_code = $default_code;
                $homepage->version2_data = $default_data;
                $homepage->version3_code = $default_code;
                $homepage->version3_data = $default_data;
                //create headers
                $header = R::dispense("headers");
                $header->community_link = $community_id;
                $header->current_header = 'Header1';
                $header->header1 = '{"heading":"Welcome to your Community ","subheading":"This is community of Managers","link1-label":"Label 1","link1-url":"#","link2-label":"Label 2","link2-url":"#"}';
                $header->header2 = '{"heading":"Welcome to the full featured community","subheading":"This is a full featured community","link1-label":"External Link","link1-url":"#","link2-label":"External Link","link2-url":"#","video-url":"#","video-thumbnail":"https://images.unsplash.com/photo-1505920454785-b998580225f2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=873&q=80"}';
                
                //create default member
                $member=R::dispense("members");
                $member->community_id=$community_id;
                $member->first_name=$_POST['first_name'];
                $member->last_name=$_POST['last_name'];
                $member->email = $_POST['email'];
                $member->role = 'Community Admin';
                $member->password = $_POST['password'];
                $member->designation = 'Community Admin';
                $member->registration_date = date('Y-m-d');
                $member->status = 'Active';
                if (R::store($data) && R::store($community) && R::store($branding)  && R::store($homepage) && R::store($header) && R::store($member)) {
                    $success = 'Your account has been successfully created. You will be automatically redirected to the login page...';
                    echo "<script>setTimeout(function(){ window.location='signin'; }, 3000);</script>";
                }
            }
        } else {
            $error = "This email is already associated with another account";
        }
    } else {
        $error = "Password doesn't matched";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup | <?php echo $_ENV['app_name'];?> </title>
    <?php include "includes/head.php"; ?>
</head>
<body>
    <div class="theme-layout">
        <div class="authtication high-opacity" style='background-image:url(https://onwintop.com/assets/images/banner/page-banner.jpg);background-size:cover;background-position:left'>
            <div class="verticle-center">
                <div class="welcome-note">
                    <img src='<?php URI('images/logo.png') ?>' /></br>
                    <div class="logo"><span>Signup to the community</span></div>
                    <h1 style='color:#ae3793'>We turn digital channels into growth engines</h1>
                    <p style='color:#ae3793'>
                        The future of growth in a technology driven world
                    </p>
                </div>
                <div class="bg-image" style="https://source.unsplash.com/random/2109x1974/?nature"></div>
            </div>
        </div>
        <div class="auth-login">
            <div class="verticle-center">
                <div class="signup-form">
                    <h4><i class="fa fa-lock" aria-hidden="true"></i> Singup</h4>
                    <form method="post" action="" class="c-form">
                        <div class="row merged-10">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <span class='text-danger error'></span>
                                <span class='text-success success'></span>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="text" name='first_name' placeholder="First Name" required>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="text" name='last_name' placeholder="Last Name" required>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="email" name='email' placeholder="Email@" required>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="text" name='community' placeholder="Community Name" required>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="password" maxlength="16" minlength="6" name='password' placeholder="Password" required>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <input type="password" maxlength="16" minlength="6" name='confirm_password' placeholder="Confirm Password" required>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <b class="text-danger"><?php echo $error; ?></b>
                                <b class="text-success"><?php echo $success; ?></b>
                            </div>
                            <div class='col-lg-12'>
                                <label><small>By clicking <b>Signup</b> I agree that I have read and accepted the <a target='_blank' style='color:var(--primary-color)' href='https://onwintop.com/policy'>Privacy & Policy</a></small></label>
                            </div>
                            <div class="col-lg-12">
                                <div class="uk-margin">
                                    <button class="main-btn button soft-success py-3">Signup</button>
                                    <button onclick="window.location='signin';" class="main-btn button soft-primary py-3 mt-3" type="submit"><i class="fa fa-key" aria-hidden="true"></i> Already have an account?</button>
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
</body>

</html>