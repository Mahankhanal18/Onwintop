<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once("../vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable("../");
$dotenv->load();
require_once("../conf/controllers.php");
require_once("../conf/conf.php");
require_once("../conf/redbean.php");
require_once("../conf/cookie.php");
require_once("../conf/db.php");
require_once("../api/email.php");
$db=new Database();
$login=false;
$credentials=array();
R::setup('mysql:host='.$_ENV['db_host'].';dbname='.$_ENV['db_name'],$_ENV['db_user'], $_ENV['db_password'] );


$community_id=$_GET['community_id'];

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Editor</title>
  <link rel="stylesheet" href="dist/css/grapes.min.css">
  <script src="dist/grapes.min.js"></script>

  <style>
    body,
    html {
      height: 100%;
      margin: 0;
    }

    .gjs-sm-header {
      display: none !important;
    }

    .gjs-two-color {
      color: #737373;
    }

    .gjs-one-bg {
      background-color: #fff;
    }
  </style>
</head>

<body>
  <div id="gjs" style="height:0px; overflow:hidden;">
    <link rel='stylesheet' href='assets/main.css' />
    <link rel='stylesheet' href='assets/style.css' />
    <link rel='stylesheet' href='assets/color.css' />
    <link rel='stylesheet' href='assets/responsive.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <img src="assets/images/header.png" id='hero-banner' style='width:100%;height:auto' alt="" data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-draggable="false" data-gjs-removable="false" data-gjs-resizable="false" data-gjs-copyable="false" data-gjs-badgable="false" data-gjs-stylable="false">
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var editor = grapesjs.init({
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        height: '100%',
        fromElement: true,
        storageManager: {
          autoload: 0
        }
      });
      //Info Widget
      editor.BlockManager.add('info', {
        label: 'Info Widget',
        attributes: {
          class: 'fa fa-eye'
        },
        content: `
        <!--Info Widget-->
        <section id='info-widget' class='mt-3 mb-3' data-gjs-highlightable="false" data-gjs-droppable="false">
          <div class="mt-2 mb-2 no-bottom grey-bg nogap" data-gjs-highlightable="false" data-gjs-droppable="false">
            <div class="container" data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
              <div class="row" data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
                <div class="col-lg-4 col-md-6" data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
                  <div class="info-sec" data-gjs-editable="false">
                    <i class="icofont-checked" data-gjs-highlightable="false"></i>
                    <div data-gjs-highlightable="false" data-gjs-droppable="false">
                      <h6 data-gjs-editable="true">Get started</h6>
                      <p data-gjs-editable="true">Share your research, collaborate with your peers, and get the support you need to advance your career.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6" data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
                  <div class="info-sec" data-gjs-editable="false" data-gjs-droppable="false">
                    <i class="icofont-play-alt-1" data-gjs-highlightable="false" data-gjs-droppable="false"></i>
                    <div data-gjs-highlightable="false" data-gjs-droppable="false">
                      <h6 data-gjs-editable="true">Assistance</h6>
                      <p data-gjs-editable="true">Share your research, collaborate with your peers, and get the support you need to advance your career.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6" data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
                  <div class="info-sec" data-gjs-editable="false" data-gjs-droppable="false">
                    <i class="icofont-clock-time" data-gjs-highlightable="false"></i>
                    <div data-gjs-highlightable="false" data-gjs-droppable="false">
                      <h6 data-gjs-editable="true">Start exploring</h6>
                      <p data-gjs-editable="true">Share your research, collaborate with your peers, and get the support you need to advance your career.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        `
      })
      //Channel Lists
      editor.BlockManager.add('channels', {
        label: 'Channels List',
        attributes: {
          class: 'fa fa-folder-open'
        },
        content: `
        <section id='channel-widget' class="mt-2 mb-2" data-gjs-highlightable="false" data-gjs-droppable="false">
          <div class="no-bottom" data-gjs-highlightable="false" data-gjs-droppable="false">
            <div class="container" data-gjs-highlightable="false" data-gjs-droppable="false">
              <div class="row" data-gjs-highlightable="false" data-gjs-droppable="false">
                <div class="col-lg-12" data-gjs-highlightable="false" data-gjs-droppable="false">
                  <div class="main-wraper" data-gjs-highlightable="false" data-gjs-droppable="false">
                    <h4 class="main-title" data-gjs-editable="true" data-gjs-droppable="false">Discover Your Channel <a class="view-all" id='view-all-channel' data-gjs-editable="false" title="">view all</a></h4>
                    <div class="books-caro" id='channel-container' data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
                      <img src='assets/images/list.png' data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-draggable="false" data-gjs-removable="false" data-gjs-resizable="false" data-gjs-copyable="false" data-gjs-badgable="false" data-gjs-stylable="false"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        `
      })
      //Recent Events
      editor.BlockManager.add('events', {
        label: 'Recent Events',
        attributes: {
          class: 'fa fa-television '
        },
        content: `
        <section id='events-widget' class="mt-2 mb-2" data-gjs-highlightable="false" data-gjs-droppable="false">
          <div class="no-bottom" data-gjs-highlightable="false" data-gjs-droppable="false">
            <div class="container" data-gjs-highlightable="false" data-gjs-droppable="false">
              <div class="row" data-gjs-highlightable="false" data-gjs-droppable="false">
                <div class="col-lg-12" data-gjs-highlightable="false" data-gjs-droppable="false">
                  <div class="main-wraper" data-gjs-highlightable="false" data-gjs-droppable="false">
                    <h4 class="main-title" data-gjs-editable="true" data-gjs-droppable="false">Recent Events<a class="view-all" id='view-all-event' data-gjs-editable="false" title="">view all</a></h4>
                    <div class="books-caro" id='events-container' data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-droppable="false">
                      <img src='assets/images/list.png' data-gjs-editable="false" data-gjs-highlightable="false" data-gjs-draggable="false" data-gjs-removable="false" data-gjs-resizable="false" data-gjs-copyable="false" data-gjs-badgable="false" data-gjs-stylable="false"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        `
      })
      //Research 
      editor.BlockManager.add('research', {
        label: 'Research Info',
        attributes: {
          class: 'fa fa-search '
        },
        content: `
        <section class='mt-4 mb-3' id='research-widget' data-gjs-editable="false">
          <div class="no-bottom">
            <div class="container" data-gjs-editable="false">
              <div class="row" data-gjs-editable="false">
                <div class="col-lg-12" data-gjs-editable="false">
                  <div class="welcome-parallax info-sec" data-gjs-editable="false">
                    <h4 class="main-title" data-gjs-editable="true">Advance your research</h4>
                    <p data-gjs-editable="true">Join our community of scientists.</p>
                    <a href="signup" title="" class="main-btn" data-ripple="">Join Free Now</a>
                      <a href="signin" title="" class="main-btn" data-ripple="">Join Free Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        `
      })
      //Header Widget with Video
      editor.BlockManager.add('header_widget', {
        label: 'Header Layout 1',
        attributes: {
          class: 'fa fa-folder-open'
        },
        content: `
        <div class="container ">
				  <div class="row">
          </div>
        </div>
        `
      })
      //Header Widget 
      editor.BlockManager.add('header_widget', {
        label: 'Header Layout 2',
        attributes: {
          class: 'fa fa-folder-open'
        },
        content: `
        <div class="container ">
				  <div class="row">
          </div>
        </div>
        `
      })



      editor.Panels.addButton('options', [{
        id: 'save',
        label: ' Save',
        className: 'fa fa-floppy-o icon-blank',
        command: function(editor1, sender) {
          getCode();
        },
        attributes: {
          title: 'Save Template'
        }
      }, ]);

      editor.on('load', () => {
        editor.runCommand('open-blocks')
      })
      //custom code
      //hide tab selector
      //$('.gjs-sm-header').html('');


      <?php
      //load data
      //editor.loadProjectData(projectData);
      $s = "SELECT * FROM `homepages` WHERE `community_link`='" . $community_id . "' ";
      if ($db->CountRows($s)) {
        $data = $db->RetriveSingle($s);
        $code_data=$data['data'];
        if(isset($_GET['version'])){
            if($_GET['version']=='version1'){
                $code_data=$data['version1_data'];
            }
            if($_GET['version']=='version2'){
                $code_data=$data['version2_data'];
            }
            if($_GET['version']=='version3'){
                $code_data=$data['version3_data'];
            }
        }
        echo "editor.loadProjectData(JSON.parse('" . $code_data . "'))";
      } else {
        $str = '{"assets":[],"styles":[{"selectors":["#hero-banner"],"style":{"width":"100%","height":"auto"}}],"pages":[{"frames":[{"component":{"type":"wrapper","stylable":["background","background-color","background-image","background-repeat","background-attachment","background-position","background-size"],"components":[{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/main.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/style.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/color.css"}},{"tagName":"link","void":true,"attributes":{"rel":"stylesheet","href":"assets/responsive.css"}},{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/header.png","id":"hero-banner","alt":""}},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-3","mb-3"],"attributes":{"id":"info-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["mt-2","mb-2","no-bottom","grey-bg","nogap"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"classes":["info-sec"],"components":[{"tagName":"i","highlightable":false,"classes":["icofont-checked"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Get started"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]},{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"droppable":false,"classes":["info-sec"],"components":[{"tagName":"i","droppable":false,"highlightable":false,"classes":["icofont-play-alt-1"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Assistance"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]},{"droppable":false,"highlightable":false,"classes":["col-lg-4","col-md-6"],"components":[{"droppable":false,"classes":["info-sec"],"components":[{"tagName":"i","highlightable":false,"classes":["icofont-clock-time"]},{"droppable":false,"highlightable":false,"components":[{"tagName":"h6","type":"text","components":[{"type":"textnode","content":"Start exploring"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Share your research, collaborate with your peers, and get the support you need to advance your career."}]}]}]}]}]}]}]}]},{"tagName":"section","classes":["mt-3","mb-3"],"attributes":{"id":"research-widget"},"components":[{"classes":["no-bottom"],"components":[{"classes":["container"],"components":[{"classes":["row"],"components":[{"classes":["col-lg-12"],"components":[{"classes":["welcome-parallax","info-sec"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Advance your research"}]},{"tagName":"p","type":"text","components":[{"type":"textnode","content":"Join our community of scientists."}]},{"type":"link","classes":["main-btn"],"attributes":{"href":"signup","title":"","data-ripple":""},"components":[{"type":"textnode","content":"Join Free Now"}]},{"type":"link","classes":["main-btn"],"attributes":{"href":"signin","title":"","data-ripple":""},"components":[{"type":"textnode","content":"Join Free Now"}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"channel-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"],"components":[{"droppable":false,"highlightable":false,"classes":["main-wraper"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Discover Your Channel "},{"type":"link","editable":false,"classes":["view-all"],"attributes":{"href":"channels.html","title":""},"components":[{"type":"textnode","content":"view all"}]}]},{"droppable":false,"highlightable":false,"classes":["books-caro"],"components":[{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/list.png"}}]}]}]}]}]}]}]},{"tagName":"section","droppable":false,"highlightable":false,"classes":["mt-2","mb-2"],"attributes":{"id":"events-widget"},"components":[{"droppable":false,"highlightable":false,"classes":["no-bottom"],"components":[{"droppable":false,"highlightable":false,"classes":["container"],"components":[{"droppable":false,"highlightable":false,"classes":["row"],"components":[{"droppable":false,"highlightable":false,"classes":["col-lg-12"],"components":[{"droppable":false,"highlightable":false,"classes":["main-wraper"],"components":[{"tagName":"h4","type":"text","classes":["main-title"],"components":[{"type":"textnode","content":"Recent Events"},{"type":"link","editable":false,"classes":["view-all"],"attributes":{"href":"channels.html","title":""},"components":[{"type":"textnode","content":"view all"}]}]},{"droppable":false,"highlightable":false,"classes":["books-caro"],"components":[{"type":"image","removable":false,"draggable":false,"badgable":false,"stylable":false,"highlightable":false,"copyable":false,"resizable":false,"editable":false,"attributes":{"src":"assets/images/list.png"}}]}]}]}]}]}]}]}]}]}]}]}]}}],"id":"7qzxop89YXxfEhsx"}]}';
        echo "editor.loadProjectData(JSON.parse('" . $str . "'))";
      }
      ?>

      function getCode() {
        var code = editor.getHtml();
        var project = JSON.stringify(editor.getProjectData());

        community_link = '<?php echo $community_id; ?>';
        $.ajax({
          url: '<?php echo $root; ?>api/save-homepage.php',
          method: 'POST',
          type: 'POST',
          data: {
            community_link: community_link,
            code: code,
            data: project
          },
          success: function(data) {
            parent.alertify.success(data);
            parent.location.reload();
          }
        })

      }
    })
  </script>
  <script src="dist/grapes.min.js"></script>
</body>

</html>