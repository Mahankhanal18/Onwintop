<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
$parts = URL_Parts();
$info = R::findOne("channels", "WHERE id=?", [$id]);

if (strlen($id) == 0) {
    echo "<script>window.location='" . URL_Make('/channels') . "';</script>";
} else {
    $_SESSION['selected_channel'] = $info;
}

if (isset($_POST['id']) && isset($_POST['featured'])) {
    $up = R::findOne("contents", "WHERE id=?", [$_POST['id']]);
    $up->featured = $_POST['featured'];
    R::store($up);
}

?>

<head>
    <title><?php echo $info['name']; ?> Edit Channel | <?php echo $title; ?></title>
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

        .single-line {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .simple-pagination {
            margin-top: 10px;
            margin-left: 45%;
        }

        .popup-wraper.active {
            z-index: 99;
        }

        .chosen-container {
            display: none;
        }
    </style>
</head>

<body>
    <!-- page loader <div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
    </div>-->
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
                                        <div class="main-title"><?php echo $info['name']; ?></div>
                                        <div class="uk-overflow-auto">
                                            <div style='width:100%' class='mt-3'>
                                                <a href="<?php echo URL('/create-file/' . $info['id']); ?>" class="button soft-primary button-sm"><i class="icofont-ui-file"></i> &nbsp;Create File</a>
                                                <a href="<?php echo URL('/create-video/' . $info['id']); ?>" class="button soft-primary button-sm"><i class="icofont-video"></i>&nbsp;Create Video</a>
                                                <a href="<?php echo URL('/create-solution/' . $info['id']); ?>" class="button soft-primary button-sm"><i class="icofont-file-document"></i>&nbsp;Create Solution</a>
                                                <div class="input-group mb-1" style='float:right;width:300px'>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icofont-search-1"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Search Something..." aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                                                <thead>
                                                    <tr>
                                                        <th class="">Creator</th>
                                                        <th class="">Name</th>
                                                        <th class="">Type</th>
                                                        <th class="">Date Modified</th>
                                                        <th class="">Views</th>
                                                        <th class="">Shares</th>
                                                        <th class="">Comments</th>
                                                        <th class="">Reactions</th>
                                                        <th class="">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class='wrapper'>
                                                    <?php
                                                    $contents = R::findAll("contents", "WHERE community_id=? ORDER BY id DESC", [$_SESSION['community_id']]);
                                                    foreach ($contents as $content) {
                                                        $edit_url = '';
                                                        if ($content['type'] == 'File') {
                                                            $detail = R::findOne("files", "WHERE id=?", [$content['data_id']]);
                                                            $edit_url = URL_Make('/edit-file/' . $content['data_id']);;
                                                        }
                                                        if ($content['type'] == 'Solution') {
                                                            $detail = R::findOne("solutions", $content['data_id']);
                                                            $edit_url = URL_Make('/edit-solution/' . $content['data_id']);;
                                                        }
                                                        if ($content['type'] == 'Video') {
                                                            $detail = R::findOne("videos", $content['data_id']);
                                                            $edit_url = URL_Make('/edit-video/' . $content['data_id']);;
                                                        }
                                                        $featured = "";
                                                        if ($content['featured'] == 'Featured') {
                                                            $featured = "<span class='badge badge-success'>Featured</span>";
                                                        }

                                                    ?>
                                                        <tr class='content-item'>
                                                            <td><img class="uk-preserve-width uk-border-circle" src="https://ui-avatars.com/api/?name=<?php echo $content['creator']; ?>&background=random" width="40" height="40" alt=""></td>
                                                            <td class=""><?php echo $content['name']; ?> <?php echo $featured; ?></td>
                                                            <td class="uk-text-truncate"><?php echo $content['type']; ?></td>
                                                            <td class="uk-text-truncate"><?php echo date_format(date_create($content['modification_date']), 'd M, Y'); ?></td>
                                                            <td class="uk-text-truncate text-center"><?php echo $content['views']; ?></td>
                                                            <td class="uk-text-truncate text-center"><?php echo count(json_decode($content['shares'])); ?></td>
                                                            <td class="uk-text-truncate text-center"><?php echo count(json_decode($content['comments'])); ?></td>
                                                            <td class="uk-text-truncate text-center"><?php echo count(json_decode($content['reactions'])); ?></td>
                                                            <td>
                                                                <!--<a data-id='<?php echo $content['id']; ?>' featured='<?php echo $content['featured']; ?>' class="info button soft-info button-sm"><i class="icofont-flag-alt-1"></i></a>-->
                                                                <a href='<?php echo $edit_url; ?>' class="button soft-primary button-sm"><i class="icofont-ui-edit"></i></a>
                                                                <a class="button soft-danger button-sm delete" data-id='<?php echo $content['id']; ?>'><i class="icofont-ui-delete"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    if (count($contents) == 0) {
                                                        echo "
                                                        <tr>
                                                            <td colspan='9' style='text-align:center;padding:20px'>No Contents Available</td>
                                                        </tr>
                                                        ";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>


                                </div>
                                <div class='col-lg-12 text-center'>
                                    <div class="load mt-0 mb-5">
                                        <?php
                                        if (count($contents) != 0) {
                                            echo '<div id="pagination"></div>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <?php include "includes/footer.php"; ?>

    </div>

    <div class="popup-wraper" id='confirm'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i>Confirmation</h5>
                </div>
                <div class="send-message">
                    <b>Do you sure want to delete this content?</b></br></br>
                    <button id='confirm_delete' class="button soft-danger">Yes</button>
                    <button id='dismiss_delete' class="button soft-success">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-wraper" id='featured_popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <form action='' method='post' class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i>Content Type</h5>
                </div>
                <div class="send-message">
                    <b>Type:</b></br>
                    <input type="hidden" name="id" id="data_id">
                    <select name="featured" id="featured" style="width:100%;padding:10px">
                        <option value="Featured">Featured</option>
                        <option value="">Non Featured</option>
                    </select></br></br>
                    <button type='submit' class="button soft-success">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="<?php echo URI('js/script.js'); ?>"></script>
    <script>
        $(document).ready(function() {

            //$("#sidenav").removeClass('hide');
            var nav_open = true;
            $('#sidemenu-btn').click(function() {
                alert();
                if (nav_open == true) {
                    $(".sidebar").addClass('hide');
                    nav_open = false;
                } else {
                    $("nav.sidebar").removeClass('hide');
                    nav_open = true;
                }
            })
            $('#view-all-event').on('click', function() {
                loc = '<?php URL('/events'); ?>';
                window.location = loc;
            })
            $('#view-all-channel').on('click', function() {
                loc = '<?php URL('/channels'); ?>';
                window.location = loc;
            })


            $('.info').click(function() {
                featured = $(this).attr('featured');
                id = $(this).attr('data-id');
                $('#featured').val(featured);
                $('#featured').trigger('change');
                $('#data_id').val(id);
                $('#featured_popup').addClass('active');
            })

            $(".wrapper .content-item").slice(12).hide();
            $('#pagination').pagination({

                // Total number of items present
                // in wrapper class
                items: <?php echo count($contents) * 30; ?>,

                // Items allowed on a single page
                itemsOnPage: 100,
                onPageClick: function(noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });
            var selected_file = '';
            $('.delete').click(function() {
                selected_file = $(this).attr('data-id');
                $('#confirm').addClass('active');
            })
            $('#confirm_delete').click(function() {
                $.ajax({
                    url: '<?php echo $url; ?>api/contents.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        method: 'DELETE_CONTENT',
                        data_id: selected_file
                    },
                    success: function(data) {
                        if (data == '200') {
                            location.reload();
                        } else {
                            alert(data);
                        }
                    }
                })

            })
            $('#dismiss_delete').click(function() {
                $('#confirm').removeClass('active');
            })

        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    

</body>

</html>