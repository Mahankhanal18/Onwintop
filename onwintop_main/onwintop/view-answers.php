
<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sharing | <?php echo $title; ?></title>
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
            display:none;
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
                                        <div class="main-title">View Answers</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class='c-form'>
                                                <?php
                                                    $parts=URL_Parts();
                                                    $member_id=$parts[7];
                                                    $member=R::findOne("members","WHERE id=?",[$member_id]);
                                                    //answers
                                                    $answers=json_decode($member['answers'],true);
                                                    //questions
                                                    $qstn=R::findOne("questions","WHERE community_id=?",[$_SESSION['community_id']]);
                                                    $questions=json_decode($qstn['data'],true);
                                                    
                                                    foreach($questions as $qstn){
                                                        $name=$qstn['name'];
                                                        $label=$qstn['label'];
                                                        $answer=$answers[$name];
                                                        if(strlen($answer)!=0){
                                                            echo "
                                                            <label>".$label."</label>
                                                            <input type='text' value='".$answer."' readonly/>
                                                            ";
                                                        }
                                                    }
                                                    
                                                ?>
                                                </div>
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
</body>

</html>