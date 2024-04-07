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
    <title>Explore | <?php echo $title; ?></title>
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
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper" style='margin-bottom:0px;padding:15px 6px 20px'>
                                        <h5 class='mb-2'>Recommended for you</h5>

                                        <div class="row">
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
                                        <div class="card-body" onclick="window.location='<?php echo URL('/challenge/'.$challenge['id']);?>'" style='padding:0px;border-top:6px solid var(--secondary-color);'>
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
                                    <div class="main-wraper mt-3">
                                        <div class="main-title">
                                            Discussion
                                            <div style='float:right'>
                                                <form action='' id='search' method='post' class="uk-inline" style='text-align:left;width:250px'>
                                                    <button class="uk-form-icon uk-form-icon-flip" style='color:var(--primary-color)' href="#" uk-icon="icon: search"></button>
                                                    <input id='search_text' class="uk-input" value='<?php if (isset($search)) echo $search; ?>' name='search' style='padding:7px 15px;background-color:#ffffff;color:var(--primary-color)' type="text" aria-label="Clickable icon">
                                                </form>
                                                <a href='<?php URL('/discussions'); ?>' class="button primary">+ New Topic</a>
                                            </div>
                                        </div>
                                        <div class="container row">
                                            <h5 class='label-discussion filter-dis' data-name='latest' style='margin-right:15px'>Latest</h5>
                                            <h5 class='label-discussion filter-dis' data-name='top' style='margin-right:15px'>Top</h5>
                                            <h5 class='label-discussion filter-dis' data-name='categories' style='margin-right:15px'>Categories</h5>
                                            <table class="uk-table uk-table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Topic</th>
                                                        <th>Replies</th>
                                                        <th>Creator</th>
                                                        <?php if ($user_login == true) {
                                                            echo '<th></th>';
                                                        } ?>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $discussions = R::findAll("discussions", "WHERE community_id=? ORDER BY id DESC LIMIT 5", [$_SESSION['community_id']]);
                                                    foreach ($discussions as $discussion) {
                                                        $comments = json_decode($discussion['comments']);
                                                        $actions = "";
                                                        if ($user_login == true) {
                                                            $actions = "
                                                         <td>  
                                                            <button style='background-color:#ffffff00;font-size:22px;border:none' type='button'><i class='icofont-edit'></i></button>
                                                            <div uk-dropdown>
                                                               <ul class='uk-nav uk-dropdown-nav'>
                                                                  <li><a href='" . URL_Make('/discussion/' . $discussion['id']) . "'>View</a></li>
                                                                  <li><a href='" . URL_Make('/edit-topic/' . $discussion['id']) . "'>Edit</a></li>
                                                               </ul>
                                                            </div>
                                                         </td>
                                                         ";
                                                        }
                                                        echo "
                                                          <tr>
                                                             <td>
                                                                <a href='" . URL_Make('/discussion/' . $discussion['id']) . "'><b class='single-line'>" . $discussion['title'] . "</b></a></br>
                                                                <small>By " . $discussion['creator'] . " | " . date_format(date_create($discussion['date']), 'd M Y') . "</small>
                                                             </td>
                                                             <td>
                                                                " . count($comments) . "
                                                             </td>
                                                             <td>
                                                                <img src='https://ui-avatars.com/api/?name=" . $discussion['creator'] . "&background=random' style='height:35px;width:auto;border-radius:50%;margin-right:8px' alt='' srcset=''>
                                                                " . date_format(date_create($discussion['date']), 'd M') . " by <b>" . $discussion['creator'] . "</b>
                                                             </td>
                                                             " . $actions . "
                                                          </tr>
                                                          ";
                                                    }
                                                    if (count($discussions) == 0) {
                                                        echo "
                                                      <tr>
                                                         <td colspan='3' style='padding:30px;text-align:center'>
                                                            <b>No Discussion Found</b>
                                                         </td>
                                                      </tr>
                                                      ";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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