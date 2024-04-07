<?php
include "init.php";
//include "includes/parser.php";
    //get html
    $s = "SELECT * FROM `communities` WHERE `link`='" . $community_id . "' ";
    $data = $db->RetriveSingle($s);
    if($data['landing_page']!='Enabled'){
      echo "<script>window.location='".URL_Make('/explore')."';</script>";
    }
    //get homepage type
    $type=R::findOne("homepage_type","id=?",[1]);
    if($type['type']=='challange-based'){
        echo "<script>window.location='".URL_Make('/challange-focus')."';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    <?php 
    if(strlen($data['landingpage_title'])!=0){
        echo $data['landingpage_title'];
    }else{
        echo $data['name']; 
    }
    ?>
  </title>
  <?php include "includes/head.php"; ?>
  <style>
    #view-all-channel:hover {
      cursor: pointer;
    }
    #view-all-event:hover {
      cursor: pointer;
    }
    .white-bg {
        background: #fff;
        position: relative;
        z-index: 99;
        display: none;
    }
    .side-image>img {
        display: inline-block;
        width: 100%;
        border:none !important;
        padding:0px !important;
    }
    .welcome-parallax .main-btn {
        padding: 10px 20px;
        margin-right: 5px;
        margin-left: 5px;
    }
    .play-btn:hover{
        cursor:pointer;
    }
    @media screen and (max-width: 990px){
        .feature-meta .main-btn {
            padding: 7px 30px;
            margin-top: 10px;
        }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="theme-layout">
    <?php include "includes/header2.php"; ?>
    <?php include "includes/nav.php"; ?>
    <?php

    //get header type
    $h = "SELECT * FROM `headers` WHERE `community_link`='" . $community_id . "'  ";
    $header = $db->RetriveSingle($h);
    
    if ($header['current_header'] == 'Header1') {
        $banner = json_decode($header['header1'], true);
    }else{
        $banner = json_decode($header['header2'], true);
    }
    $ban=$root.'images/banner.jpg';
    if(isset($banner['banner'])){
        $ban=$banner['banner'];
    }
    
    
    ?>
    <section class='home-content'>
      <div class="head-home overlap nogap mate-black low-opacity" style='margin-top:0px;padding:0px'>
        <div class="bg-image" style="background-image: url('<?php echo $ban;?>');background-size:cover;background-repeat:none;background-position:center;padding-bottom:60px;background-attachment: fixed;"></div>
        <?php
        if ($header['current_header'] == 'Header1') {
          $header1 = json_decode($header['header1'], true);
        ?>
          <div class="feature-meta" style="padding:180px 60px">
            <h1 style='font-size:45px'><?php echo $header1['heading']; ?></h1>
            <h3><?php echo $header1['subheading']; ?></h3>
            <a href="<?php echo $header1['link1-url']; ?>" title="" class="main-btn mr-1" data-ripple=""><?php echo $header1['link1-label']; ?></a>
            <a href="<?php echo $header1['link2-url']; ?>" title="" class="main-btn ml-1" data-ripple=""><?php echo $header1['link2-label']; ?></a>
          </div>
        <?php } else {
          $header2 = json_decode($header['header2'], true);
        ?>
          <div class="container" style='width:90%'>
            <div class="row">
              <div class="col-lg-7 col-md-7">
                <div class="verticle-center feature-meta" style="padding:100px 0px">
                  <h1 style='font-size:45px'><?php echo $header2['heading']; ?></h1>
                  <h3><?php echo $header2['subheading']; ?></h3>
                  <a href="<?php echo $header2['link1-url']; ?>" title="" class="main-btn mr-1" data-ripple=""><?php echo $header2['link1-label']; ?></a>
                  <a href="<?php echo $header2['link2-url']; ?>" title="" class="main-btn ml-1" data-ripple=""><?php echo $header2['link2-label']; ?></a>
                </div>
              </div>
              <div class="col-lg-5 col-md-5">
                 <div class="course-video">
                    <figure class="side-image feature-meta">
                       <a  data-fancybox="" href="<?php echo $header2['video-url']; ?>">
                        <img  src="<?php echo $header2['video-thumbnail']; ?>" style='object-fit:cover;object-position:center' alt="">
                       </a>
                    </figure>
                </div>
              </div>
            </div>
          </div>
        <?php }
        ?>
      </div>

    </section>
    <?php
    $home=R::findOne("homepages","WHERE community_link=?",[$community_id]);
    //print_r($home);
    $document = str_get_html($home['code']);
    //get channel containers
    $channels = $document->find('div[id=channel-container]');
    if (count($channels) != 0) {
      $channel = $channels[0];
      $s = "SELECT * FROM `channels` WHERE `community_link`='" . $community_id . "' ORDER BY id DESC LIMIT 10";
      $data = $db->RetriveArray($s);
      $html = '<div class="books-caro owl-carousel owl-theme owl-loaded owl-responsive-1000">';
      foreach ($data as $ch) {
        $html .= "
        <div class='book-post'>
            <figure><a href='" . URL_Make('/channel/' . $ch['link']) . "'><img src='" . $ch['thumbnail'] . "' class='thumbnail1' alt=''></a></figure>
            <a href='" . URL_Make('/channel/' . $ch['link']) . "' >" . $ch['name'] . "</a>
        </div>
        ";
      }
      $html .= "</div>";
      $channel->outertext = $html;
    }
    //get event containers
    $events = $document->find('div[id=events-container]');
    if (count($events) != 0) {
      $event = $events[0];
      $s = "SELECT * FROM `events` WHERE `community_id`='" . $community_id . "' ORDER BY id DESC LIMIT 10 ";
      $data = $db->RetriveArray($s);
      $html = '<div class="books-caro owl-carousel owl-theme owl-loaded owl-responsive-1000">';
      foreach ($data as $ch) {
        $html .= "
        <div class='book-post'>
            <figure><a href='" . URL_Make('/event/' . $ch['url']) . "'><img src='" . $ch['cover'] . "' class='thumbnail1' alt=''></a></figure>
            <a href='" . URL_Make('/event/' . $ch['url']) . "' >" . $ch['name'] . "</a>
        </div>
        ";
      }
      $html .= "</div>";
      $event->outertext = $html;
    }
    echo $document;
    ?>
    <?php include "includes/footer.php"; ?>
  </div>
  <script src="<?php echo URI('js/main.min.js'); ?>"></script>
  <script src="<?php echo URI('js/counterup.min.js'); ?>"></script>
  <script src="<?php echo URI('js/counterup-t-waypoint.js'); ?>"></script>
  <script src="<?php echo URI('js/typed.js'); ?>"></script>
  <script src="<?php echo URI('js/script.js'); ?>"></script>
  <script src="<?php echo URI('js/search.js'); ?>"></script>
</body>
<script>
  $(document).ready(function() {
    $("#sidenav").removeClass('hide');
    var nav_open = false;
    $('#nav_btn').click(function() {
      if (nav_open==true) {
        $(".sidebar").addClass('hide');  
        nav_open = false;
      } else {
        $("nav.sidebar").removeClass('hide');
        nav_open = true;
      }
    })
  });
  $('#view-all-event').on('click', function() {
    loc = '<?php URL('/events'); ?>';
    window.location = loc;
  })
  $('#view-all-channel').on('click', function() {
    loc = '<?php URL('/channels'); ?>';
    window.location = loc;
  })
</script>

</html>