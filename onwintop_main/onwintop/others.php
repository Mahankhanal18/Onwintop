<?php
include "init.php";
$edit_mode = false;
$data = array();

//check edit
$parts=URL_Parts();
if(isset($parts[7])){
    $data=R::findOne("blogs","WHERE id=?",[$parts[7]]);
    $con=$data;
    $edit_mode=true;
}

if (isset($_POST['name'])) {
    if ($_POST['method'] == 'NEW') {
        $data = R::dispense("blogs");
        $data->name = $_POST['name'];
        $data->post = $_POST['description'];
        $data->cover = $_POST['thumbnail'];
        $data->categories = $_POST['tags'];
        $data->community_id = $_SESSION['community_id'];
        $data->date = date('Y-m-d');
        $data->time = date('h:ia');
        if(R::store($data)){
            echo "<script>window.location='".URL_Make('/blogs')."';</script>";
        }
    } else {
        
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Others | <?php echo $title; ?></title>

    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #category_chosen {
            display: none;
        }

        .chosen-container-multi .chosen-choices {
            background: #f8fafa none repeat scroll 0 0 !important;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            padding: 5px;
            font-size: 13px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }

        .select2-container--default .select2-selection--multiple {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline;
            list-style: none;
            padding: 0;
            float: left;
            padding-top: 5px;
            padding-left: 5px;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline;
            list-style: none;
            padding: 0;
            float: left;
            padding-top: 5px;
            padding-left: 5px;
        }

        #tag_btn:hover {
            cursor: pointer;
        }
        .post{
            display:none;
        }
    </style>
</head>

<body>
    <div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>

    </div><!-- page loader -->
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
                                        <div class="main-title">Others

                                        </div>

                                        <div class="d-widget-content">
                                            <table style='width:80%'>
                                                <tbody>
                                                    <tr>
                                                        <td>Blogs</td>
                                                        <td>
                                                            <button class='button btn-success'>Enabled</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Digital Salesrooms</td>
                                                        <td>
                                                            <button class='button btn-success'>Enabled</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Channels</td>
                                                        <td>
                                                            <button class='button btn-success'>Enabled</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discussions</td>
                                                        <td>
                                                            <button class='button btn-success'>Enabled</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Events</td>
                                                        <td>
                                                            <button class='button btn-success'>Enabled</button>
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
        </section>

        <?php include "includes/footer.php"; ?>
    </div>



    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
 

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>