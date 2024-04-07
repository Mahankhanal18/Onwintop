<?php
require_once("init.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php";?>
    <title>Challenges - <?php echo $community['name'];?></title>
    <style>
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
        .card-rec:hover{
            cursor:pointer;
            box-shadow: 0px 0px 10px #a1a1a1;
        }
        .headline{
            text-shadow:0px 0px 5px #000000;
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
        <title>Challenges</title>
        <div class="navbar navbar-light" id="io3q"> <a href="#" class="navbar-brand">
                <center id="ikc8k">
                    <h4 class="text-white"><?php echo $community['name'];?> </h4>
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

<body style='background-color:#f3f3f3;'>
    <?php include "nav.php";?>
    <div class="container">
        <div class="row">
            <div class="col-md-9 px-5">
                <div class='row'>
                    <div class="col-md-12 py-4 mb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn primary" style="background-color:var(--primary-color);border:none;color:#ffffff;">Available</button>
                                <button class="btn btn">Waiting</button>
                                <button class="btn">Completed</button>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3" style="display:flex;justify-content:flex-end">
                                <select name="" id="" class="form-control">
                                    <option value="">Filter by type</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-2">
                            <?php
                            $challenges=R::findAll("challenges","community_link=?",[$community_id]);
                            $c = 0;
                            foreach ($challenges as $challenge) {
                            ?>
                                <div class="col-md-4 px-2 mt-3">
                                    <div class="card card-rec">
                                        <div class="card-body" style='background-position:center;background-repeat:no-repeat;background-image:url(<?php echo $challenge['thumbnail'];?>);padding:0px;background-size:cover;'>
                                            <div style='background-image:url(<?php echo $_ENV['project_url'];?>challenge-focus/shade.png);background-size:100%;display:block;'>
                                                <div class="row align-items-end" style="height:280px;">
                                                    <div class="col-md-12 px-4 pt-1">
                                                        <div style="border-bottom:1px solid #ffffff;">
                                                            <h4 class='text-white headline'><?php echo $challenge['headline'];?></h4>
                                                        </div>
                                                        <p class='text-white' style="margin-top:5px"><?php echo $challenge['type'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            if(count($challenges)==0){
                            ?>
                                <div class='card text-center p-5' style="border: 1px solid #ebebeb;">
                                    <h5>No Contents Available</h5>
                                </div>    
                            <?php
                            }?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 py-4">
                <div class="btn-group" style="width:100%;border:1px solid #ebebeb;" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline" style="background-color:#ffffff;">Activity</button>
                    <button type="button" class="btn btn-outline-dark" style="background-color:var(--secondary-color);color:#ffffff;border-color:var(--secondary-color);">Progress</button>
                </div>
                <div class="card mt-4" style="border-radius:9px !important;border:1px solid #ebebeb;">
                    <div class="card-body p-3">
                        <b>Leaderboard</b></br>
                        <small> <a style="text-decoration:none;color:var(--secondary-color);" href="">My Ranking</a> | Top Ten </small>
                        </br>
                        <table class='table align-middle mt-2'>
                            <tr>
                                <td class='text-center' colspan='3'>No Members Available</td>
                            </tr>
                            <!--<tr>
                                <td><img src='https://ui-avatars.com/api/?name=Test Test&background=random' style='height:40px;width:40px;border-radius:50%;' /></td>
                                <td> <b style="color:var(--secondary-color);">Test Test</b> </td>
                                <td class='text-secondary'><i class="fa fa-coins"></i>&nbsp;80</td>
                            </tr>
                            <tr>
                                <td><img src='https://ui-avatars.com/api/?name=D&background=random' style='height:40px;width:40px;border-radius:50%;' /></td>
                                <td> <b style="color:var(--secondary-color);">Developer</b> </td>
                                <td class='text-secondary'><i class="fa fa-coins"></i>&nbsp;10</td>
                            </tr>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        header = $('h4').html();
        //alert(header);
        $('#header').html(header);
        $('#filter').on('change', function() {
            filter = $('#filter').val();

            url = 'https://app-dev.onwintop.com/4e2uq/challange-focus' + '/' + filter;

            window.location = url;
        })
    });
</script>

</html>