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
    <title>Explore |
        <?php echo $title; ?>
    </title>
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
        <section>
            <div class="gap" style='margin-top:0px !important'>

                <!--Full Width Recommendation-->
                <div class="recommendation" style="width:100%;background-color:#000000">
                    <img src="http://localhost/onwintop/dump1.png" style="width:100%;height:auto" alt="" srcset="">
                </div>

                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper"
                                        style='margin-bottom:0px;padding:15px 6px 20px'>
                                        <h5 class='mb-2'>Recommendation for you</h5>

                                        <div class="row">
                                            <?php
                                            $c = 0;
                                            foreach ($contents as $content) {
                                                if ($content['type'] == 'File') {
                                                    $detail = R::findOne("files", "WHERE id=?", [$content['data_id']]);
                                                }
                                                if ($content['type'] == 'Blog') {
                                                    $detail = R::findOne("blogs", $content['data_id']);
                                                }
                                                if ($content['type'] == 'Solution') {
                                                    $detail = R::findOne("solutions", $content['data_id']);
                                                }
                                                if ($content['type'] == 'Video') {
                                                    $detail = R::findOne("videos", $content['data_id']);
                                                }
                                                ?>
                                                <div class="col-lg-3 col-md-3 col-sm-6">
                                                    <div class="event-post mb-3">
                                                        <figure><a
                                                                href="<?php URL("/" . strtolower($content['type']) . "/" . $content["data_id"]); ?>"
                                                                title=""><img class="lazyload"
                                                                    style="height:180px;width:100%;object-fit:cover;object-position:center"
                                                                    src="<?php echo $content['thumbnail']; ?>" alt=""></a>
                                                        </figure>
                                                        <div class="event-meta">
                                                            <div style='border-bottom:1px solid #eaeaea' class='pt-1'>
                                                                <h6><a class='single-line'
                                                                        href="<?php URL("/file/" . $content["data_id"]); ?>"
                                                                        title=""><?php echo $content['name']; ?></a></h6>
                                                                <p class='two-line'>
                                                                    <?php echo $content['description']; ?>
                                                                </p>
                                                            </div>
                                                            <small><i class="icofont-eye"></i>
                                                                <?php echo $content['views']; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $c++;
                                                if ($c == 4)
                                                    break;
                                            }
                                            //for empty list
                                            if (count($contents) == 0) {
                                                echo "
                                                <div class='col-lg-12 col-md-12 col-sm-12 text-center p-2'>
                                                    <p>No Recommendations Found!</p>
                                                </div>
                                                ";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="main-wraper">
                                        <div class="main-title">
                                            Discussion
                                            <div style='float:right'>
                                                <form action='' id='search' method='post' class="uk-inline"
                                                    style='text-align:left;width:250px'>
                                                    <button class="uk-form-icon uk-form-icon-flip"
                                                        style='color:var(--primary-color)' href="#"
                                                        uk-icon="icon: search"></button>
                                                    <input id='search_text' class="uk-input"
                                                        value='<?php if (isset($search))
                                                            echo $search; ?>' name='search'
                                                        style='padding:7px 15px;background-color:#ffffff;color:var(--primary-color)'
                                                        type="text" aria-label="Clickable icon">
                                                </form>
                                                <a href='<?php URL('/discussions'); ?>' class="button primary">+ New
                                                    Topic</a>
                                            </div>
                                        </div>
                                        <div class="container row">
                                            <h5 class='label-discussion filter-dis' data-name='latest'
                                                style='margin-right:15px'>Latest</h5>
                                            <h5 class='label-discussion filter-dis' data-name='top'
                                                style='margin-right:15px'>Top</h5>
                                            <h5 class='label-discussion filter-dis' data-name='categories'
                                                style='margin-right:15px'>Categories</h5>
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
                                    <div class="main-wraper blank-wrapper"
                                        style='margin-bottom:0px;padding:15px 6px 20px'>
                                        <h5 class='mb-2'>Contents</h5>
                                        <div class="row wrapper">
                                            <?php
                                            $c = 0;
                                            foreach ($contents as $content) {
                                                if ($content['type'] == 'File') {
                                                    $detail = R::findOne("files", "WHERE id=?", [$content['data_id']]);
                                                }
                                                if ($content['type'] == 'Blog') {
                                                    $detail = R::findOne("blogs", $content['data_id']);
                                                }
                                                if ($content['type'] == 'Solution') {
                                                    $detail = R::findOne("solutions", $content['data_id']);
                                                }
                                                if ($content['type'] == 'Video') {
                                                    $detail = R::findOne("videos", $content['data_id']);
                                                }
                                                $type = strtolower($content['type']);
                                                ?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 content-item">
                                                    <div class="event-post mb-3">
                                                        <figure><a
                                                                href="<?php URL("/" . $type . "/" . $content["data_id"]); ?>"
                                                                title="">
                                                                <img class="lazyload"
                                                                    style="height:180px;width:100%;object-fit:cover;object-position:center"
                                                                    src="<?php echo $content['thumbnail']; ?>" alt=""></a>
                                                        </figure>
                                                        <div class="event-meta">
                                                            <div style='border-bottom:1px solid #eaeaea' class='pt-1'>
                                                                <h6><a class='single-line'
                                                                        href="<?php URL("/" . $type . "/" . $content["data_id"]); ?>"
                                                                        title=""><?php echo $content['name']; ?></a></h6>
                                                                <p class='two-line'>
                                                                    <?php echo $content['description']; ?>
                                                                </p>
                                                            </div>
                                                            <small><i class="icofont-eye"></i>
                                                                <?php echo $content['views']; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $c++;
                                                if ($c == 30)
                                                    break;
                                            }
                                            if (count($contents) == 0) {
                                                echo "
                                                <div class='col-lg-12 col-md-12 col-sm-12 text-center p-2'>
                                                    <p>No Contents Found!</p>
                                                </div>
                                                ";
                                            }
                                            ?>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12 col-lg-12'>
                                                <?php
                                                if (count($contents) != 0) {
                                                    echo '</div></br></br><div id="pagination"></div>';
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
        </section>
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function () {
            $(".wrapper .content-item").slice(12).hide();
            $('#pagination').pagination({
                items: 30,
                itemsOnPage: 12,
                onPageClick: function (noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });

            $('.filter-dis').click(function () {
                name = $(this).attr('data-name');
                window.location = '<?php URL('/discussions'); ?>/' + name;
            })

            $('#search').on('submit', function (e) {
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