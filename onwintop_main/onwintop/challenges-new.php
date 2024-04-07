<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_POST['search'])) {
    echo "<script>window.location='" . URL_Make('/discussions/' . $_POST['search']) . "'</script>";
}
$parts = URL_Parts();
?>

<head>
    <title>Challenges | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        .label-discussion:hover {
            cursor: pointer;
        }

        .event-meta {
            display: inline-block;
            padding: 0 15px 5px;
            position: relative;
            width: 100%;
        }

        .post {
            display: none;
        }
    </style>

</head>
<?php $contents = R::findAll("contents", "WHERE community_id=? ORDER BY id DESC LIMIT 30", [$_SESSION['community_id']]); ?>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>
        <?php include "includes/nav.php"; ?>
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
            color: var(--primary-color) !important;
        }

        .nav-menu li a.active {
            color: var(--primary-color) !important;
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
        <section>
            <div class="gap" style='margin-top:10px !important'>
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
                                <input type="text" name="" id="" class="form-control" value="Filter by type" readonly>
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
                                        <div class="card-body" onclick="window.location='<?php echo URL('/challenge/'.$challenge['id']);?>'" style='background-position:center;background-repeat:no-repeat;background-image:url(<?php echo $challenge['thumbnail'];?>);padding:0px;background-size:cover;'>
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
                    <button type="button" class="btn btn-outline-dark" style="background-color:var(--primary-color);color:#ffffff;border-color:var(--secondary-color);">Progress</button>
                </div>
                <div class="card mt-4" style="border-radius:9px !important;border:1px solid #ebebeb;">
                    <div class="card-body p-3">
                        <b>Leaderboard</b></br>
                        <small> <a style="text-decoration:none;color:var(--primary-color);" href="">My Ranking</a> | Top Ten </small>
                        </br>
                        <table class='table align-middle mt-2'>
                            <?php
                                $members=R::findAll("members","community_id=? AND coins!=? ORDER BY coins DESC",[$community_id,'0']);
                                foreach($members as $member){
                                    if($member['coin']!='0'){
                                        echo "
                                        <tr>
                                            <td>
                                                <img src='https://ui-avatars.com/api/?name=Test%20Test&background=random' style='height:30px;width:30px;border-radius:50%'/> &nbsp;
                                                <b>".$member['first_name']." ".$member['last_name']."</b>
                                            </td>
                                            <td>
                                                <i class='fa fa-coins text-warning'></i>&nbsp;<b>".$member['coins']."</b>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                    
                                }
                                if(count($members)==0){
                                    echo "
                                    <tr>
                                        <td class='text-center' colspan='3'>No Members Available</td>
                                    </tr>";
                                }
                                
                            ?>
                            
                            
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
        </section>
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $(".wrapper .content-item").slice(12).hide();
            $('#pagination').pagination({
                items: 30,
                itemsOnPage: 12,
                onPageClick: function(noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });

            $('.filter-dis').click(function() {
                name = $(this).attr('data-name');
                window.location = '<?php URL('/discussions'); ?>/' + name;
            })

            $('#search').on('submit', function(e) {
                e.preventDefault();
                var keyword = $('#search_text').val();
                if (keyword.length != 0) {
                    window.location = '<?php URL('/discussions/search'); ?>/' + keyword;
                } else {
                    alertify.error('Enter some text to search');
                }

            })

        })
    </script>
    <script src="<?php URI("js/pagination.js"); ?>"></script>
    <script src="<?php URI("js/responsive.js"); ?>"></script>
</body>

</html>