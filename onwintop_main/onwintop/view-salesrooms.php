<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Digital Salesrooms | <?php echo $title; ?></title>
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

        em {
            box-shadow: 3px 3px 3px rgb(0 0 0 / 10%);
            color: #fff;
            background-color: var(--primary-color);
            font-size: 12px;
            font-style: normal;
            left: -5px;
            padding: 3px 10px;
            position: absolute;
            text-transform: capitalize;
            top: 20px;
        }

        .rate-result {
            background: #fec42d none repeat scroll 0 0;
            border-radius: 30px;
            bottom: 15px;
            color: #fff;
            font-size: 11px;
            left: 15px;
            padding: 2px 10px;
            position: absolute;
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
                                        <div class="main-title">Digital Salesrooms</div>
                                        <div class="row">
                                            <?php
                                            $c = "SELECT * FROM `salesrooms` WHERE `community_id`='" . $_SESSION['community_id'] . "' ";
                                            $channels = $db->RetriveArray($c);
                                            foreach ($channels as $channel) {
                                            ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="event-post mb-3">
                                                        <figure>
                                                            <a title="">
                                                                <img src="<?php echo $channel['thumbnail']; ?>" style='height:220px;width:100%;object-fit:cover;object-position:center' alt="">
                                                            </a>
                                                        </figure>
                                                        <div class="event-meta pt-1">
                                                            <h6><a class='single-line' title=""><?php echo $channel['name']; ?></a></h6>
                                                            <p class='single-line'><?php echo $channel['description']; ?></p>
                                                            <div class="more">
                                                                <div class="more-post-optns">
                                                                    <i class="">
                                                                        <svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                                            <circle r="1" cy="12" cx="12"></circle>
                                                                            <circle r="1" cy="12" cx="19"></circle>
                                                                            <circle r="1" cy="12" cx="5"></circle>
                                                                        </svg></i>
                                                                    <ul>
                                                                        <li onclick="window.location='<?php echo URL('/edit-salesroom/'.$channel['link']);  ?>'">
                                                                            <a>
                                                                                <i class="icofont-share-alt"></i>Edit
                                                                                <span>Edit Salesroom Contents</span>
                                                                            </a>
                                                                        </li>
                                                                        <li onclick="">
                                                                            <a>
                                                                                <i class="icofont-share-alt"></i>Print
                                                                                <span>Print Salesroom Invitation</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class='delete-channel' data-id='<?php echo $channel['id']; ?>'>
                                                                            <i class="icofont-ui-delete"></i>Delete Channel
                                                                            <span>If inappropriate salesroom</span>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            if (count($channels) == 0) {
                                                echo "<span style='padding:15px;text-align:center;width:100%'>No Digital Salesrooms available</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <div class="popup-wraper" id='delete-channel-popup'>
            <div class="popup">
                <span class="popup-closed"><i class="icofont-close"></i></span>
                <div class="popup-meta">
                    <div class="popup-head">
                        <h5><i class="fa fa-filter"></i> Delete Channel</h5>
                    </div>
                    <div class="send-message">
                        <b>Are you sure want to delete this channel?</b></br></br>
                        <button id='confirm-delete' class="button soft-danger">Yes</button>
                        <button id='dismiss-delete' class="button soft-primary">No</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            var curr_ch = 0;
            $('.delete-channel').click(function() {
                curr_ch = $(this).attr('data-id');
                $('#delete-channel-popup').addClass('active');
            })
            $('#confirm-delete').click(function() {
                $.ajax({
                    url: '<?php echo $url . "/api/channel.php"; ?>',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        method: 'DELETE',
                        id: curr_ch
                    },
                    success: function(data) {
                        location.reload();
                    }
                })
            })
            $('#dismiss-delete').click(function() {
                $('#delete-channel-popup').removeClass('active');
            })

            $('.featured').click(function(){
                channel_id=$(this).attr('data-id');
                $.ajax({
                    url: '<?php echo $url . "/api/channel.php"; ?>',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        method: 'FEATURED',
                        id: channel_id,
                        community_id:"<?php echo $_SESSION['community_id'];?>"
                    },
                    success: function(data) {
                        if(data=='200'){
                            location.reload();
                        }else{
                            alert(data);
                        }
                    }
                });
            })
        })
    </script>
</body>

</html>