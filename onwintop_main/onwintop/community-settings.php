<?php
//session_start();

include "init.php";
$s = "SELECT * FROM `blogs` WHERE `community_id`='" . $community_id . "'  ";
$db = new Database();
$blogs = $db->RetriveArray($s);
$edit_mode=false;
$data=array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Blog | <?php echo $title; ?></title>

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
                                        <div class="main-title">Blog Posts
                                
                                        </div>

                                        <div class="d-widget-content">
                                            <form id='create-data' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        </br>
                                                        <label>Title:<span class='text-danger'>*</span></label>
                                                        <input type="text" name='name' value='<?php if ($edit_mode) echo $data['name']; ?>' placeholder="Enter Blog Title" required>
                                                        <label>Post:<span class='text-danger'>*</span></label>
                                                        <textarea id='description' class='editor' name='description' placeholder="Start Writing..."><?php if ($edit_mode) echo $data['description']; ?></textarea></br>
                                                        <label>Channel:<span class='text-danger'>*</span></label>
                                                        <select class="select2" id='channel' multiple="multiple" style="width: 100%;border:none" name="state">
                                                            <?php
                                                            foreach ($channels as $ch) {
                                                                if ($ch['link'] == $channel) {
                                                                    echo "<option value='" . $ch['id'] . "' selected='selected'>" . $ch['name'] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $ch['id'] . "'>" . $ch['name'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select></br></br>
                                                        <label>Tags:<span class='text-danger'>*</span></label>
                                                        <select id='category' multiple="multiple" style="width: 100%;border:none" name="tags">
                                                        </select></br>
                                                        <label class='text-primary' id='tag_btn'>Edit Tags</label>
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
                                                            </label>
                                                        </div>
                                                        <b class='text-primary loading2' style='display:none'>Loading...</b></br>
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


</body>

</html>