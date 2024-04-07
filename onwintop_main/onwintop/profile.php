<?php
include "init.php";
$db = new Database();
$url_parts=URL_Parts();
$edit_profile=false;
$credentials=array();
if(count($url_parts)==7){
    //view profile

}else{
    //edit profile
    $edit_profile=true;
    if($user_login==true){
        $credentials=$user_credentials;
    }elseif($member_login==true){
        $credentials=$member_credentials;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $credentials['first_name']." ".$credentials['last_name'];?> | <?php echo $title;?> </title>
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
        <?php include "includes/header2.php"; ?>
        <?php include "includes/nav.php"; ?>
        <div class="gap no-gap" style='margin-top:0px;padding-left:300px'>
            <div class="top-area mate-black low-opacity">
                <div class="bg-image" style="background-image: url(<?php echo $root;?>/images/banner.jpg)"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="post-subject">
                                <div class="university-tag">

                                    <figure><img src="https://ui-avatars.com/api/?name=<?php echo $credentials['first_name'] . " " . $credentials['last_name']; ?>&background=random" alt=""></figure>
                                    <div class="uni-name">
                                        <h4><?php echo $credentials['first_name'] . " " . $credentials['last_name']; ?></h4>
                                        <span>@<?php echo strtolower($credentials['first_name'] . $credentials['last_name']); ?></span>
                                    </div>
                                    <ul class="sharing-options">
                                        <li><a title="Settings" href="<?php URL('/settings');?>" data-toggle="tooltip"><i class="icofont-ui-edit"></i></a> </li>
                                        <li><a title="Share" href="#" data-toggle="tooltip"><i class="icofont-share-alt"></i></a> </li>
                                        <li><a title="Follow" href="#" data-toggle="tooltip"><i class="icofont-star"></i></a> </li>
                                    </ul>
                                </div>
                                <ul class="nav nav-tabs post-detail-btn">
                                    <li class="nav-item"><a class="active" href="#content" data-toggle="tab">Content</a></li>
                                    <li class="nav-item"><a class="" href="#bookameeting" data-toggle="tab">Book a meeting</li>
                                    <li class="nav-item"><a class="" href="#about" data-toggle="tab">About</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- top Head -->



        <section>
            <div class="gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">

                                <div class="col-lg-12">


                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="content">

                                            <div class="main-wraper">

                                                <div class="row">

                                                    <?php
                                                    $contents=$db->RetriveArray("SELECT * FROM `contents` WHERE `comments` LIKE '%".$credentials['first_name']." ".$credentials['last_name']."%' ");
                                                    foreach($contents as $content){
                                                        $c="SELECT * FROM `files` WHERE `id`='".$content['data_id']."' ";
                                                        if($content['type']=='Video'){
                                                            $c="SELECT * FROM `videos` WHERE `id`='".$content['data_id']."' ";
                                                        }
                                                        if($content['type']=='File'){
                                                            $c="SELECT * FROM `files` WHERE `id`='".$content['data_id']."' ";
                                                        }
                                                        $data=$db->RetriveSingle($c);
                                                    ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div class="event-post mb-3">
                                                            <figure><a href="file/<?php echo $data['id'];?>" title=""><img src="<?php echo $data['thumbnail'];?>" alt=""></a></figure>
                                                            <div class="event-meta">
                                                                <span><?php echo date_format(date_create($content['modification_date']),'D M Y')?></span>
                                                                <h6><a href="event-detail.html" title=""><?php echo $content['name'];?></a></h6>
                                                                <p><?php echo $data['description'];?></p>
                                                                <div class="share-info">
                                                                    <span>0 shares</span>
                                                                    <span>0 Likes</span>
                                                                </div>
                                                                <div class="stat-tools">
                                                                    <div class="box">
                                                                        <div class="Like"><a class="Like__link"><i class="icofont-like"></i> Like</a>
                                                                            <div class="Emojis">
                                                                                <div class="Emoji Emoji--like">
                                                                                    <div class="icon icon--like"></div>
                                                                                </div>
                                                                                <div class="Emoji Emoji--love">
                                                                                    <div class="icon icon--heart"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="box">
                                                                        <div class="Emojis">
                                                                            <div class="Emoji Emoji--like">
                                                                                <div class="icon icon--like"></div>
                                                                            </div>
                                                                            <div class="Emoji Emoji--love">
                                                                                <div class="icon icon--heart"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <a title="" href="#" class="share-to"><i class="icofont-share-alt"></i> Share</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    if(count($contents)==0){
                                                        echo '<div class="p-4"><h4>No Contents Found!</h4></div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bookameeting">
                                            <div class="row col-xs-6 merged-10">
                                                <div class="main-wraper">
                                                    <div class="grp-about">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div style="min-width: 320px; height: 880px;">
                                                                    <?php 
                                                                        if(strlen($credentials['meeting_url'])!=0){
                                                                    ?>
                                                                    <iframe src="https://calendly.com/<?php echo $credentials['meeting_url'];?>" width="100%" height="100%" frameborder="0"></iframe>
                                                                    <?php
                                                                        }
                                                                        else{
            
                                                                            echo '<div class="p-4"><h4>No Meeting Information!</h4></div>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="tab-pane fade " id="about">
                                            <div class="main-wraper">
                                                <h3 class="main-title">About</h3>
                                                <div class="lang">
                                                    <?php
                                                        if(strlen($credentials['bio'])!=0){
                                                            echo '<span>'.$credentials['bio'].'</span>';
                                                        }else{
                                                            echo '<div class="p-4"><h4>No Profile Information!</h4></div>';
                                                        }
                                                    ?>
                                                    
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
    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/sparkline.js"); ?>"></script>
    <script src="<?php URI("js/chart.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
    </script>

</body>

</html>