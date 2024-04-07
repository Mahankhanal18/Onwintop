<?php
//session_start();


include "init.php";
$edit_mode=false;
$channel=array();
if(isset($_POST['name'])){
    
    $link=UID(5);
    
    //create community
    $community=R::dispense("communities");
    $community->name=$_POST['name'];
    $community->description=$_POST['description'];
    $community->thumbnail=$_POST['thumbnail'];
    $community->tenant_id=$user_credentials['tenant_id'];
    $community->link=$link;
    $community->creation_date=date('Y-m-d');
    $community->creation_time=date('h:ia');
    $community->title=$_POST['name'];
    //create branding
    $branding=R::dispense("branding");
    $branding->community_id=$link;
    $branding->colors='{"post_background": "#4d92c7","post_text": "#f5f5f5","topnav_text":"#000000",background_color": "#ffffff","header_text_color": "#000000","body_text_color": "#454545"}';
    
    //content based landing pages
    $default_code='<body><link rel="stylesheet" href="assets/main.css"/><link rel="stylesheet" href="assets/style.css"/><link rel="stylesheet" href="assets/color.css"/><link rel="stylesheet" href="assets/responsive.css"/><img src="assets/images/header.png" id="hero-banner" alt=""/><section id="research-widget" class="mt-4 mb-3"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"><div class="welcome-parallax info-sec"><h4 class="main-title">Advance your research</h4><p>Join our community of scientists.</p><a href="signup" title="" data-ripple="" class="main-btn">Join Free Now</a><a href="signin" title="" data-ripple="" class="main-btn">Join Free Now</a></div></div></div></div></div></section><section id="info-widget" class="mt-3 mb-3"><div class="mt-2 mb-2 no-bottom grey-bg nogap"><div class="container"><div class="row"><div class="col-lg-4 col-md-6"><div class="info-sec"><i class="icofont-checked"></i><div><h6>Get started</h6><p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p></div></div></div><div class="col-lg-4 col-md-6"><div class="info-sec"><i class="icofont-play-alt-1"></i><div><h6>Assistance</h6><p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p></div></div></div><div class="col-lg-4 col-md-6"><div class="info-sec"><i class="icofont-clock-time"></i><div><h6>Start exploring</h6><p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p></div></div></div></div></div></div></section><section id="channel-widget-2" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"><div class="main-wraper"><h4 class="main-title">Discover Your Channel <a id="view-all-channel" title="" class="view-all">view all</a></h4><div id="channel-container" class="books-caro"><img src="assets/images/list.png"/></div></div></div></div></div></div></section><section id="events-widget-2" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"><div class="main-wraper"><h4 class="main-title">Recent Events<a id="view-all-event" title="" class="view-all">view all</a></h4><div id="events-container" class="books-caro"><img src="assets/images/list.png"/></div></div></div></div></div></div></section><section id="channel-widget" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"></div></div></div></div></section><section id="events-widget" class="mt-2 mb-2"><div class="no-bottom"><div class="container"><div class="row"><div class="col-lg-12"></div></div></div></div></section></body>';
    $default_data='{"assets":[],"styles":[{"selectors":["#hero-banner"],"style":{"width":"100%","height":"auto"}}],"pages":[{"frames":[{"component":{"type":"wrapper","stylable":["background","background-color","background-image","background-repeat","background-attachment","background-position","background-size"],"components":[{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/main.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/style.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/color.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/responsive.css"}},{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/header.png","id":"hero-banner","alt":""}},{"tagName":"section","classes":["mt-4","mb-3"],"attributes":{"id":"research-widget"},"components":[{"classes":["no-bottom"],"components":[{"classes":["container"],"components":[{"classes":["row"],"components":[{"classes":["col-lg-12"],"components":[{"classes":["welcome-parallax","info-sec"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Advance your research"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Join our community of scientists."}]},{"type":"link","classes":["main-btn"],"attributes":{"href":"signup","title":"","data-ripple":""},"components":[{"type":"textnode","content":"Join Free Now"}]},{"type":"link","classes":["main-btn"],"attributes":{"href":"signin","title":"","data-ripple":""},"components":[{"type":"textnode","content":"Join Free Now"}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-3","mb-3"],"attributes":{"id":"info-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["mt-2","mb-2","no-bottom","grey-bg","nogap"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"classes":["info-sec"],"components":[{"tagName":"i","highlightable":false,"classes":["icofont-checked"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Get started"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]},{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"droppable":false,"classes":["info-sec"],"components":[{"tagName":"i","droppable":false,"highlightable":false,"classes":["icofont-play-alt-1"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Assistance"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]},{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"droppable":false,"classes":["info-sec"],"components":[{"tagName":"i","highlightable":false,"classes":["icofont-clock-time"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Start exploring"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"channel-widget-2"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"],"components":[{"droppable":false,"highlightable":false,"classes":["main-wraper"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Discover Your Channel "},{"type":"link","editable":false,"classes":["view-all"],"attributes":{"id":"view-all-channel","title":""},"components":[{"type":"textnode","content":"view all"}]}]},{"droppable":false,"highlightable":false,"classes":["books-caro"],"attributes":{"id":"channel-container"},"components":[{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/list.png"}}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"events-widget-2"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"],"components":[{"droppable":false,"highlightable":false,"classes":["main-wraper"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Recent Events"},{"type":"link","editable":false,"classes":["view-all"],"attributes":{"id":"view-all-event","title":""},"components":[{"type":"textnode","content":"view all"}]}]},{"droppable":false,"highlightable":false,"classes":["books-caro"],"attributes":{"id":"events-container"},"components":[{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/list.png"}}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"channel-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"events-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"]}]}]}]}]}]}}],"id":"laQ1G4ovWLpkO7Zy"}]}';
    $homepage=R::dispense("homepages");
    $homepage->community_link=$link;
    $homepage->code=$default_code;
    $homepage->data=$default_data;
    $homepage->version1_code=$default_code;
    $homepage->version1_data=$default_data;
    $homepage->version2_code=$default_code;
    $homepage->version2_data=$default_data;
    $homepage->version3_code=$default_code;
    $homepage->version3_data=$default_data;
    
    //challenge focus landing pages
    $default_code='<body> <meta charset="UTF-8"/> <meta http-equiv="X-UA-Compatible" content="IE=edge"/> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/> <title>Challange Focus </title> <div class="navbar navbar-light" id="ivqx"> <a href="#" class="navbar-brand"> <center> <h4 class="text-white">Onwintop - Champions </h4> </center> </a> </div> <a href="#" class="navbar-brand"> <div class="container"> <div class="row"> <div class="col-md-12 px-0" id="i4it2"> <img src="https://app-dev.onwintop.com/focus-editor/topbar.png" alt="" srcset="" id="i4ny7"/> <div id="myTabContent" class="tab-content"> <div id="home" class="tab-pane fade show active"> <img src="https://app-dev.onwintop.com/focus-editor/content.png" id="i78vg"/> <img src="https://app-dev.onwintop.com/focus-editor/leaderboard.png" alt="" srcset="" id="i1nhg"/> </div> </div> </div> </div> </div> </a></body>';
    $default_data='{"assets":[],"styles":[{"selectors":["nav-tabs"],"style":{"background-color":"rgb(255, 255, 255) !important"}},{"selectors":["nav-link"],"style":{"color":"rgb(161, 161, 161) !important"}},{"selectors":[],"selectorsAdd":".nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active","style":{"border-top-color":"rgb(255, 255, 255) !important","border-right-color":"rgb(255, 255, 255) !important","border-left-color":"rgb(255, 255, 255) !important","border-bottom-width":"4px !important","border-bottom-style":"solid !important","border-bottom-color":"rgb(7, 160, 7) !important"}},{"selectors":[],"selectorsAdd":".nav-tabs .inner.active","style":{"border-top-left-radius":"5px","border-top-right-radius":"5px","border-bottom-right-radius":"5px","border-bottom-left-radius":"5px","background-color":"rgb(239, 239, 239)","border-bottom-color":"rgb(239, 239, 239) !important","border-top-width":"4px !important","border-top-style":"solid !important","border-top-color":"rgb(7, 160, 7) !important","border-right-width":"1px !important","border-right-style":"solid !important","border-right-color":"rgb(223, 226, 230) !important","border-left-width":"1px !important","border-left-style":"solid !important","border-left-color":"rgb(223, 226, 230) !important"}},{"selectors":["card"],"style":{"border-top-left-radius":"0px !important","border-top-right-radius":"0px !important","border-bottom-right-radius":"0px !important","border-bottom-left-radius":"0px !important"}},{"selectors":["card-img-top"],"style":{"border-top-left-radius":"0px !important","border-top-right-radius":"0px !important","border-bottom-right-radius":"0px !important","border-bottom-left-radius":"0px !important"}},{"selectors":["challange"],"style":{"color":"rgb(161, 161, 161)"},"state":"hover"},{"selectors":["challange"],"style":{"color":"gray"}},{"selectors":["#ich4"],"style":{"background-color":"#59585d !important","padding-left":"150px"}},{"selectors":["#itiq9"],"style":{"background-color":"#efefef"}},{"selectors":["#i35eu"],"style":{"float":"left","width":"100%","height":"auto"}},{"selectors":["#myTabContent"],"style":{"background-color":"#efefef","border-bottom":"1px solid #dfe2e6"}},{"selectors":["#iz3i9"],"style":{"width":"70%","height":"auto","float":"left"}},{"selectors":["#i747w"],"style":{"float":"left","width":"30%","border-left":"1px solid #dfe2e6","border-right":"1px solid #dfe2e6"}}],"pages":[{"frames":[{"component":{"type":"wrapper","stylable":["background","background-color","background-image","background-repeat","background-attachment","background-position","background-size"],"components":[{"type":"textnode","content":" "},{"tagName":"meta","void":true,"attributes":{"charset":"UTF-8"}},{"tagName":"meta","void":true,"attributes":{"http-equiv":"X-UA-Compatible","content":"IE=edge"}},{"tagName":"meta","void":true,"attributes":{"name":"viewport","content":"width=device-width, initial-scale=1.0"}},{"tagName":"link","void":true,"attributes":{"href":"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css","rel":"stylesheet","integrity":"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65","crossorigin":"anonymous"}},{"tagName":"title","type":"text","components":[{"type":"textnode","content":"Challange Focus"}]},{"type":"text","classes":["navbar","navbar-light"],"attributes":{"id":"ich4"},"components":[{"type":"textnode","content":" "},{"type":"link","editable":false,"classes":["navbar-brand"],"attributes":{"href":"#"},"components":[{"type":"textnode","content":" "},{"tagName":"center","type":"text","components":[{"type":"textnode","content":" "},{"tagName":"h4","type":"text","classes":["text-white"],"components":[{"type":"textnode","content":"Onwintop - Champions"}]},{"type":"textnode","content":" "}]},{"type":"textnode","content":" "}]}]},{"type":"link","editable":false,"classes":["navbar-brand"],"attributes":{"href":"#"},"components":[{"type":"textnode","content":" "},{"classes":["container"],"components":[{"type":"textnode","content":" "},{"classes":["row"],"components":[{"type":"textnode","content":" "},{"classes":["col-md-12","px-0"],"attributes":{"id":"itiq9"},"components":[{"type":"textnode","content":" "},{"type":"image","removable":false,"droppable":false,"highlightable":false,"editable":false,"attributes":{"src":"https://app-dev.onwintop.com/focus-editor/topbar.png","alt":"","srcset":"","id":"i35eu"}},{"type":"textnode","content":" "},{"removable":false,"classes":["tab-content"],"attributes":{"id":"myTabContent"},"components":[{"type":"textnode","content":" "},{"classes":["tab-pane","fade","show","active"],"attributes":{"id":"home"},"components":[{"type":"textnode","content":" "},{"type":"image","attributes":{"src":"https://app-dev.onwintop.com/focus-editor/content.png","id":"iz3i9"}},{"type":"textnode","content":" "},{"type":"image","attributes":{"src":"https://app-dev.onwintop.com/focus-editor/leaderboard.png","alt":"","srcset":"","id":"i747w"}},{"type":"textnode","content":" "}]},{"type":"textnode","content":" "}]},{"type":"textnode","content":" "}]},{"type":"textnode","content":" "}]},{"type":"textnode","content":" "}]},{"type":"textnode","content":" "}]}]}}],"id":"7lO3siuv58tyBooH"}]}';
    $homepage=R::dispense("challengefocushomepage");
    $homepage->community_link=$link;
    $homepage->code=$default_code;
    $homepage->data=$default_data;
    $homepage->version1_code=$default_code;
    $homepage->version1_data=$default_data;
    $homepage->version2_code=$default_code;
    $homepage->version2_data=$default_data;
    $homepage->version3_code=$default_code;
    $homepage->version3_data=$default_data;
    
    //create headers
    $header=R::dispense("headers");
    $header->community_link=$link;
    $header->current_header='Header1';
    $header->header1='{"heading":"Welcome to your Community ","subheading":"This is community of Managers","link1-label":"Label 1","link1-url":"#","link2-label":"Label 2","link2-url":"#"}';
    $header->header2='{"heading":"Welcome to the full featured community","subheading":"This is a full featured community","link1-label":"External Link","link1-url":"#","link2-label":"External Link","link2-url":"#","video-url":"#","video-thumbnail":"https://images.unsplash.com/photo-1505920454785-b998580225f2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=873&q=80"}';
    
    //create members from existing tenant users
    $users=R::findAll("users","WHERE tenant_id=?",[$user_credentials['tenant_id']]);
    foreach($users as $user){
        $member=R::dispense("members");
        $member->community_id=$link;
        $member->first_name=$user['first_name'];
        $member->last_name=$user['last_name'];
        $member->email = $user['email'];
        if($user['role']=='Admin'){
            $member->role = 'Community Admin';
            $member->designation = 'Community Admin';
        }else{
            $member->role = 'Community Manager';
            $member->designation = 'Community Manager';
        }
        $member->password = $user['password'];
        $member->registration_date = date('Y-m-d');
        $member->status = 'Active';
        R::store($member);
    }
    
    if(R::store($community) && R::store($branding) && R::store($homepage) && R::store($header)){
        echo "<script>window.location='".$root.$link."';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Community | <?php echo $title; ?></title>

    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <div class="main-wraper">
                                        <div class="main-title">Create Community
                                        </div>
                                        <div class="d-widget-content">
                                            <form id='create-data' action='' method='POST' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        </br>
                                                        <label>Title:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $data['name']; ?>' placeholder="Enter Community Title" required>
                                                        <label>Description:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' class='editor' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $data['description']; ?></textarea></br>
                                                        </br></br>
                                                    </div>
                                                    <div class="col-md-4">
                                                        </br>
                                                        <label>Cover Image:<span class='text-danger'>*</span></label></br>
                                                        <img src='<?php if ($edit_mode) echo $data['thumbnail'];
                                                                    else echo "https://via.placeholder.com/600x400.png?text=Upload+Thumbnail+Image"; ?>' id='thumbnail_holder' style='height:auto;width:100%;'></br>
                                                        <div class="uploadimage2">
                                                            <i class="icofont-file-jpg"></i>
                                                            <label class="fileContainer">
                                                                <input id='thumbnail' type="file">Attach Thumbnail
                                                                <input type="hidden" name="method" value='<?php if ($edit_mode) echo "EDIT"; else echo "NEW"; ?>'>
                                                                <input type="hidden" value='<?php if ($edit_mode) echo $channel['thumbnail']; ?>' name="thumbnail" id='thumbnail_url' required>
                                                            </label>
                                                        </div>
                                                        <b class='text-primary' id='loading2' style='display:none'>Loading...</b></br>
                                                    </div>
                                                </div>
                                                <button type='submit' class="button primary circle">Save</button>
                                            </form>
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
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#loading2').hide();
            thumbnail_url = '<?php if ($edit_mode) echo $data['thumbnail']; ?>';
            $('#thumbnail_url').val('');
            $('#thumbnail').on('change', function() {
                thumbnail = $('#thumbnail')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('#loading2').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#thumbnail_holder').attr('src', thumbnail_url);
                        $('#thumbnail_url').val(thumbnail_url);
                        $('#loading2').hide();
                    }
                })
            })

        })
    </script>

</body>

</html>