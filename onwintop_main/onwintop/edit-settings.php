<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
    $edit_mode=true;
    $saved=false;
    if(isset($_POST['name'])){
        $con=R::findOne("communities","WHERE link=?",[$_SESSION['community_id']]);
        $con->name=$_POST['name'];
        $con->description=$_POST['description'];
        $con->landingpage_title=$_POST['landingpage_title'];
        $con->meta_description=$_POST['meta_description'];
        $con->meta_keyword=$_POST['meta_keyword'];
        if(R::store($con)){
            $saved=true;
        }
    }
    $con=R::findOne("communities","WHERE link=?",[$_SESSION['community_id']]);
?>
<head>
    <title>Settings | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <style>
        .daywise:hover {
            cursor: pointer;
        }

        .blank-wrapper {
            background: #fafafa00 none repeat scroll 0 0 !important;
            border: 1px solid #e1e8ed00 !important;
            border-radius: 5px;
            display: block;
            margin-bottom: 30px;
            padding: 15px 20px 20px;
            position: relative;
            width: 100%;
            z-index: 9;
        }
        .post{
            display: none;
        }
    </style>
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
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Settings</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id='create-data' action='' method='POST' class="c-form">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            </br>
                                                            <label>Community Name:<span class='text-danger'>*</span></label>
                                                            <input type="text" name='name' value='<?php if ($edit_mode) echo $con['name']; ?>' placeholder="Enter Community Name" required>
                                                            <label>Description:<span class='text-danger'>*</span></label>
                                                            <textarea id='description' class='editor' name='description' placeholder="Start Writing..." required><?php if ($edit_mode) echo $con['description']; ?></textarea></br>

                                                            <label>Landing Page Title:<span class='text-danger'>*</span></label>
                                                            <input type="text" name='landingpage_title' value='<?php if ($edit_mode) echo $con['landingpage_title']; ?>' placeholder="Enter Community Title" required>
                                                            <label>Meta Description:<span class='text-danger'>*</span></label>
                                                            <textarea id='description' class='editor' name='meta_description' placeholder="Start Writing..." required><?php if ($edit_mode) echo $con['meta_description']; ?></textarea></br>
                                                            
                                                            <label>Keywords:<span class='text-danger'>*</span></label>
                                                            <textarea class='editor' name='meta_keyword' placeholder="Start Writing..." required><?php if ($edit_mode) echo $con['meta_keyword']; ?></textarea></br>
                                                            
                                                            </br></br>
                                                        </div>
                                                    </div>
                                                    </hr>
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
            if(<?php echo $saved?>){
                alertify.success('Settings Updated');
            }
        })
    </script>
</body>

</html>