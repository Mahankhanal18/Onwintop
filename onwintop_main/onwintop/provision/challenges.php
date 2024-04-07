<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="theme-color" content="#f1863b">
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

<body style='background-color:#f3f3f3;'>
    <div style="background-color: #ffffff;padding:20px">
        <div class='container'>
            <div class='row px-5' style='background-color:#ffffff;'>
                <div class='col-md-8' style='padding-right:20px;align-items: center;display: flex;'>
                    <ul class="nav-menu p-2">
                        <li><a href="discussions.php">Discussion</a></li>
                        <li><a class="active" href="challenges.php">Challenges</a></li>
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
                            $c = 0;
                            foreach ($images as $image) {
                            ?>
                                <div class="col-md-4 px-2 mt-3">
                                    <div class="card card-rec">
                                        <div class="card-body" style='background-position:center;background-image:url(https://via.placeholder.com/400/29b9ce/d4f7fc/?text=Preview);padding:0px;'>
                                            <div style='background-image:url(shade.png);background-size:100%;display:block;'>
                                                <div class="row align-items-end" style="height:280px;">

                                                    <div class="col-md-12 px-4 pt-1">
                                                        <div style="border-bottom:1px solid #ffffff;">
                                                            <h4 class='text-white'>Name</h4>
                                                        </div>
                                                        <p class='text-white' style="margin-top:5px">1 Challenges</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
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
                                <td><img src='https://ui-avatars.com/api/?name=Test Test&background=random' style='height:40px;width:40px;border-radius:50%;' /></td>
                                <td> <b style="color:var(--secondary-color);">Test Test</b> </td>
                                <td class='text-secondary'><i class="fa fa-coins"></i>&nbsp;80</td>
                            </tr>
                            <tr>
                                <td><img src='https://ui-avatars.com/api/?name=D&background=random' style='height:40px;width:40px;border-radius:50%;' /></td>
                                <td> <b style="color:var(--secondary-color);">Developer</b> </td>
                                <td class='text-secondary'><i class="fa fa-coins"></i>&nbsp;10</td>
                            </tr>
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