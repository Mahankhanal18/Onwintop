<?php
require_once("init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "head.php";?>
    <title>Discussions</title>
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
        .card-rec:hover{
            cursor:pointer;
            box-shadow: 0px 0px 10px #a1a1a1;
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

<body style='background-color:#ffffff;'>
    <?php include "nav.php";?>
    <div class="container__">
        <div class="row">
            <div class="col-md-12 px-5">
                <div class='row'>
                    <div class="col-md-12 py-4">
                        <h5>Recommended for you</h5>
                        <div class="row p-2">
                            <?php
                            $challenges=R::findAll("challenges","community_link=?",[$community_id]);
                            $c = 0;
                            foreach ($challenges as $challenge) {
                                if($c==4){
                                    break;
                                }
                            ?>
                                <div class="col-md-3 px-2">
                                    <div class="card card-rec" style="border:none";>
                                        <div class="card-body"  style='padding:0px;border-top:6px solid var(--secondary-color);'>
                                            <img src="<?php echo $challenge['thumbnail']; ?>" alt="" style="width:100%;height:180px;object-fit:cover;object-position:center" srcset="">
                                            <div class="card-text p-2" style="border-bottom:1px solid #ebebeb;">
                                                <b class='single-line'><?php echo $challenge['headline']; ?></b></br>
                                                <small class='text-secondary two-line'><?php echo $challenge['description']; ?></small>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-6">
                                                    <small class='text-secondary'><?php echo $challenge['type']; ?></small>
                                                </div>
                                                <div class="col-md-6" style="display:flex;justify-content:flex-end;">
                                                    <small class='text-secondary'><i class="fa fa-coins"></i>&nbsp;0</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $c++;
                            }
                            if(count($challenges)==0){
                            ?>
                                <div class='card text-center p-5' style="border: 1px solid #ebebeb;">
                                    <h5>No Contents Available</h5>
                                </div>    
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class='col-md-9 p-4 mb-5'>
                        <div class="row">
                            <div class="col-md-3">
                                <select name="" id="" class='form-control'>
                                    <option value="">All Categories</option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1" style="display:flex;align-items:center;justify-content:center">
                                <a href="#" class='dis-type active'>Latest</a>
                            </div>
                            <div class="col-md-1" style="display:flex;align-items:center;justify-content:center">
                                <a href="#" class='dis-type'>Top</a>

                            </div>
                            <div class="col-md-1" style="display:flex;align-items:center;justify-content:center">
                                <a href="#" class='dis-type'>Categories</a>

                            </div>
                            <div class="col-md-5" style="display:flex;justify-content:end;align-items:flex-end">
                                <button class="btn btn-primary" style="background-color:var(--secondary-color);border:none"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table mt-4">
                                    <thead>
                                        <th class='text-center'>Topic</th>
                                        <th class='text-center'>Replies</th>
                                        <th class='text-center'>Views</th>
                                        <th class='text-center'>Latest Reply</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $discussions=R::findAll("discussions","community_id=?",[$community_id]);
                                        foreach($discussions as $discussion){
                                            echo "
                                            <tr>
                                                <td>
                                                    <div class='row'>
                                                        <div class='col-md-2' style='display:flex;justify-content:center;align-items:center'>
                                                            <img src='https://ui-avatars.com/api/?name=Test Test&amp;background=random' style='height:40px;width:auto;border-radius:50%;margin-right:8px'>
    
                                                        </div>
                                                        <div class='col-md-10'>
                                                            <b>Demo topic 1</b></br>
                                                            <small>By Test Test | 15 Nov 2022</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class='text-center'>0</td>
                                                <td class='text-center'>0</td>
                                                <td class='text-center'>0</td>
                                            </tr>
                                            ";
                                        }
                                        if(count($discussions)==0){
                                            echo "
                                            <tr>
                                                <td colspan='5' class='p-4 text-center'>No Topic Found</td>
                                            </tr>
                                            ";
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-3 pt-4'>
                        <h5 style="font-weight:400">Activity</h5>
                        <div class="tab-content mt-4" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row mt-4">
                                    <div class="col-md-12" style='padding-right:0px'>
                                        <div class="card card-rec" style="border-radius:5px">
                                            <div class="card-body" style="border-radius:5px">
                                                <center>
                                                    <p class="text-secondary">No Activity</p>
                                                </center>
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
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

    });
</script>

</html>