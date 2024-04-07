<?php
include "init.php";
if (isset($_POST['name']) && isset($_POST['type'])) {
    $link = UID(5);
    $data = R::dispense("videoprojects");
    $data->name = $_POST['name'];
    $data->type = $_POST['type'];
    $data->community_id = $community_id;
    $data->link = $link;
    $data->date = date('Y-m-d');
    $d = R::store($data);

    $brand=R::dispense("videobrandings");
    $brand->community_id = $community_id;
    $brand->link = $link;
    $b = R::store($brand);

    if ($d && $b) {
        $url = URL_Make('/video-project/') . $link;
        echo "<script>window.location='" . $url . "';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Videos |
        <?php echo $title; ?>
    </title>
    <?php include "includes/head.php"; ?>
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .new-comment form button i {
            transform: rotate(1deg) !important;
        }

        .vjs-big-play-centered .vjs-big-play-button {
            top: 50%;
            left: 50%;
            border-radius: 50%;
            margin-top: -0.81666em;
            margin-left: -1.5em;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .modal-dialog {
            max-width: 750px;
            margin: 1.75rem auto;
        }

        .modal {
            top: 20% !important;
        }
    </style>
</head>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>

        <?php include "includes/nav.php"; ?>

        <section>
            <div class="gap">
                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12 py-3 p-5">
                                    <h4 class='text-secondary'>Manage Video Projects</h4></br>
                                    <a class='mb-2 mt-2' href='<?php URL('/videos'); ?>'>
                                        <b>
                                            << Back to Videos</b>
                                    </a>
                                    <?php
                                    if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] != true) {
                                        echo '<script>window.location="' . URL_Make('/videos') . '";</script>';
                                    }
                                    ?>
                                    <div class="main-wraper p-4"
                                        style="background-color:#ffffff;font-family: 'Roboto', sans-serif;">
                                        <button type="button" data-toggle="modal" data-target="#exampleModal"
                                            class='btn btn-primary'
                                            style="border-radius:0px;background-color:var(--primary-color);border:none">Create
                                            Video Project</button></br>
                                        <small>Click to get help to generate more branded videos faster</small>
                                        <div class="wrapper my-4" style="display:flex;">
                                            <h5 style="color:#3a3f43;flex:1"><b>Projects List</b></h5>
                                            <div class='text-secondary mx-2'>
                                                <b style="font-size:18px"><i class="fa fa-user"></i>
                                                    0</b></br>Visitors
                                            </div>
                                            <img class='ml-2 mr-5' src="<?php URI('images/stat.png'); ?>"
                                                style="height:45px;width:auto;" alt="">
                                            <div class='text-secondary mx-2'>
                                                <b style="font-size:18px"><i class="fa fa-globe"></i>
                                                    0</b></br>Views
                                            </div>
                                            <img class='ml-2' src="<?php URI('images/stat.png'); ?>"
                                                style="height:45px;width:auto;" alt="">
                                        </div>

                                        <div class="mt-4">
                                            <table id='table'>
                                                <thead>
                                                    <tr>
                                                        <th>Project</th>
                                                        <th>Progress</th>
                                                        <th style="text-align:center">Status</th>
                                                        <th style="text-align:right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data = R::findAll("videoprojects", "community_id=? ORDER BY id DESC", [$community_id]);
                                                    foreach ($data as $d) { 
                                                        $brand=R::findOne("videobrandings","link=?",[$d['link']]);
                                                        $percentage=0;
                                                        if(strlen($brand['welcome_json'])!=0){
                                                            $welcome=json_decode($brand['welcome_json'],true);
                                                            $expiry=date_create($welcome['expiry']);
                                                            $create=date_create($d['date']);
                                                            $diff=date_diff($create,$expiry);
                                                            $diff=$diff->format("%a");

                                                            $current_date=date_create();
                                                            $achievement=date_diff($create,$current_date);
                                                            $achievement=$achievement->format("%a");

                                                            if($achievement>$diff){
                                                                $percentage=100;
                                                            }else{
                                                                $percentage=round(($achievement/$diff)*100);
                                                            }


                                                        }
                                                        
                                                        ?>
                                                        <tr>
                                                            <td style="width:30%">
                                                                <b>
                                                                    <?php echo $d['name']; ?>
                                                                </b></br>
                                                                <small class='text-secondary'>Created
                                                                    <?php echo date_format(date_create($d['date']), 'd M, Y'); ?>
                                                                </small>
                                                            </td>
                                                            <td style="width:40%">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-info" role="progressbar"
                                                                        style="width: <?php echo $percentage;?>%" aria-valuenow="0"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small class='text-secondary'>Completion with : <?php echo $percentage;?>%</small>
                                                            </td>
                                                            <td style="width:15%;text-align:center">
                                                                <h4 class="badge badge-lg badge-success" style="padding:.65em 1em;">Active</h4>
                                                            </td>
                                                            <td style="text-align:right;width:15%">
                                                                <a href="<?php URL('/video-project/'.$d['link']);?>" class="btn btn-outline-secondary">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a href="<?php URL('/video-project/'.$d['link']);?>" class="btn btn-outline-success">
                                                                    <i class="fa fa-pen"></i>
                                                                </a>
                                                                <a href="<?php URL('/video-project/'.$d['link']);?>" class="btn btn-outline-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

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
        </section>
        <div class="modal fade" style="font-family: 'Roboto', sans-serif;" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content new-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:23px;font-weight:300">Create a
                            Project</h5>
                    </div>
                    <div class="modal-body">
                        <div class="content py-3" style="display:flex;align-items:center;justify-content:center;">
                            <div class="left text-center" style="flex:1;">
                                <h6>Using supervised AI to generate</h6>
                                <p class='text-secondary mt-1'>Using supervised AI capabilities to generate videos based
                                    on your settings.</p>
                                <button id='project-create-btn-ai' class="btn btn-primary">Create</button>
                            </div>
                            <div class="text-center p-3">
                                <b>OR</b>
                            </div>
                            <div class="right text-center" style="flex:1;">
                                <h6>Through user generated videos</h6>
                                <p class='text-secondary mt-1'>Activate your network to collect videos via landing page
                                    based on your settings.</p>
                                <button id='project-create-btn' class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id='project-name-modal' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:550px">
                <form action='' method='post' class="modal-content new-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:23px;font-weight:300">Name your
                            video project</h5>
                    </div>
                    <div class="modal-body">
                        <div class="content py-3 px-3" style="display:flex;">
                            <div class="form-group" style="width:100%">
                                <label>Project name</label>
                                <input type="hidden" name="type" value="Manual">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="btn btn-secondary" data-dismiss="modal">Close</span>
                        <button type="submit" class="btn btn-primary">Create project</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id='project-name-modal-ai' style="font-family: 'Roboto', sans-serif;" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:550px">
                <form action='' method='post' class="modal-content new-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:23px;font-weight:300">Name your
                            video project</h5>
                    </div>
                    <div class="modal-body">
                        <div class="content py-3 px-3" style="display:flex;">
                            <div class="form-group" style="width:100%">
                                <label>Project name</label>
                                <input type="hidden" name="type" value="AI">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="btn btn-secondary" data-dismiss="modal">Close</span>
                        <button type="submit" class="btn btn-primary">Create project</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.1/Youtube.min.js"
        integrity="sha512-W11MwS4c4ZsiIeMchCx7OtlWx7yQccsPpw2dE94AEsZOa3pmSMbrcFjJ2J7qBSHjnYKe6yRuROHCUHsx8mGmhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var player = videojs('my-video');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = new DataTable('#table');
            $('#project-create-btn').on('click', function () {
                $('.modal').modal('hide');
                $('#project-name-modal').modal('show');
            })
            $('#project-create-btn-ai').on('click', function () {
                $('.modal').modal('hide');
                $('#project-name-modal-ai').modal('show');
            })
        })
    </script>
</body>

</html>