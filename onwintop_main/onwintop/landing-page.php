<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
    $page=R::findOne("homepages","WHERE community_link=?",[$community_id]);
    $versions=json_decode($page['versions'],true);
    $com=R::findOne("communities","WHERE link=?",[$community_id]);
?>
<head>
    <title>Landing Page Editor | <?php echo $title; ?></title>
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

        .top_nav_landing label {
            font-size: 12px;
            font-weight: 400;
            color: #737373;
        }

        .top_nav_landing select {
            background-color: #ddd !important;
            padding: 5px;
            color: #737373;
            border-radius: 2px;
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
                                        <div class="main-title">Landing Page Editor
                                            <div class="status top_nav_landing" style='float:right;'>
                                                <label>Status : </label>
                                                <select id='status' value='<?php $com['landing_page']; ?>' style='width:150px'>
                                                    <?php if ($com['landing_page'] == 'Enabled') {
                                                        echo '
                                                        <option value="Enabled">Enabled</option>
                                                        <option value="Disabled">Disabled</option>
                                                        ';
                                                    } else {
                                                        echo '
                                                        <option value="Disabled">Disabled</option>
                                                        <option value="Enabled">Enabled</option>
                                                        ';
                                                    } ?>

                                                </select>
                                            </div>
                                            
                                            <div class="version top_nav_landing" style='float:right; margin-right:10px'>
                                                <label>Version : </label>
                                                <select id='version' value='<?php $com['landing_page']; ?>' style='width:150px'>
                                                    <option value="1">Current Version</option>
                                                    <?php
                                                        $i=1;
                                                        $dup=array();
                                                        foreach($versions as $version){
                                                            
                                                            echo '<option value="'.$version['version'].'">'.$version['name'].'</option>';
                                                            if($i==3){
                                                                break;
                                                            }
                                                            $i+=1;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="version top_nav_landing" style='float:right; margin-right:10px'>
                                                <label>Landing Page Type : </label>
                                                <?php
                                                    $type=R::findOne("homepage_type","id=?",[1]);
                                                ?>
                                                <select id='type' style='width:150px'>
                                                    <option value="Content-Based" <?php if($type['type']=='content-based') echo "selected='selected'";?>>Content Focus</option>
                                                    <option value="Challange-Based" <?php if($type['type']=='challange-based') echo "selected='selected'";?>>Challange Focus</option>
                                                </select>
                                            </div>
                                            <div class="version" style='float:right; margin-right:20px'>
                                                <a href="<?php URL('/edit-header');?>" class="soft-dark"><i class="icofont-paint mr-1"></i>Edit Header</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <iframe id='editor' src='<?php echo $url . "home-editor/index.php?community_id=".$_SESSION['community_id']; ?>' style='100%;height:500px'></iframe>
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
            var type='Content-Based';
            <?php
                $type=R::findOne("homepage_type","id=?",[1]);
                if($type['type']=='Challange-Based' || $type['type']=='challange-based'){
                    echo "type='Challange-Based';";
                }
            ?>
            var version=$('#version').val();
            LoadPage();
            function LoadPage(){
                url='';
                if(type=='Content-Based' || type=='content-based'){
                    url='<?php echo $url . "home-editor/index.php?community_id=".$_SESSION['community_id']; ?>&&version='+version;
                }else{
                    url='<?php echo $url . "focus-editor/index.php?community_id=".$_SESSION['community_id']; ?>&&version='+version;
                }
                $('#editor').attr('src',url);
            }
            $('#type').on('change',function(){
                type=$('#type').val();
                LoadPage();
            })
            $('#version').on('change',function(){
                version=$('#version').val();
                LoadPage();
            })
            $('#status').on('change', function() {
                status = $(this).val();
                $.ajax({
                    url: '<?php echo $root . "api/landing_page.php"; ?>',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        status,
                        method: 'STATUS',
                        id: '<?php echo $_SESSION['community_id']; ?>'
                    },
                    success: function(data) {
                        console.log(data);
                        alertify.success("Successfully Saved");
                    }
                })
            })
        })
    </script>
</body>

</html>