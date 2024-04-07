<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Channels | <?php echo $title; ?></title>
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
        .simple-pagination {
			margin-top:40px;
			margin-left: 30%;
		}
		.gap{
		    
		}
    </style>
</head>

<body>
    <!--<div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
    </div>-->
    <!-- page loader -->
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>
        <?php include "includes/nav.php"; ?>
        <section>
            <div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Channels</div>
                                        <div class="row wrapper">
                                            <?php
                                            if(!isset($page)){
                                                $page=1;
                                            }
                                            $community_id=$_SESSION['community_id'];
                                            $limit=10;
                                            $channels=R::findAll('channels','WHERE community_link=? ORDER BY id LIMIT '.(($page-1)*$limit).', '.$limit,[$community_id]);
                                            $count=R::count('channels','WHERE community_link=?', [$community_id]);
                                            foreach ($channels as $channel) {
                                                $featured="";
                                                $is_featured=false;
                                                if($channel['featured']=='featured'){
                                                    $featured='<em>Featured</em>';
                                                    $is_featured=true;
                                                }
                                            ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 content-item">
                                                    <div class="event-post mb-3">
                                                        <figure>
                                                            <a title="">
                                                                <?php echo $featured;?>
                                                                <img src="<?php echo $channel['thumbnail']; ?>" style='height:220px;width:100%;object-fit:cover;object-position:center' alt="">
                                                            </a>
                                                        </figure>
                                                        <div class="event-meta pt-1">
                                                            <h6><a class='single-line' href='<?php echo URL_Make('/channel/' . $channel['link']); ?>' title=""><?php echo $channel['name']; ?></a></h6>
                                                            <p class='single-line'><?php echo $channel['description']; ?></p>
                                                            <?php
                                                            if($user_login==true){
                                                            ?>
                                                            <div class="more">
                                                                <div class="more-post-optns">
                                                                    <i class="">
                                                                        <svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                                            <circle r="1" cy="12" cx="12"></circle>
                                                                            <circle r="1" cy="12" cx="19"></circle>
                                                                            <circle r="1" cy="12" cx="5"></circle>
                                                                        </svg></i>
                                                                    <ul>
                                                                        <li onclick="window.location='<?php echo URL('/edit-channel/' . $channel['id']); ?>'">
                                                                            <a>
                                                                                <i class="icofont-share-alt"></i>Edit
                                                                                <span>Edit Channel Contents</span>
                                                                            </a>
                                                                        </li>
                                                                        <li onclick="window.location='<?php echo URL('/edit-channel-info/' . $channel['id']); ?>'">
                                                                            <a>
                                                                                <i class="icofont-settings-alt"></i>Edit Info
                                                                                <span>Edit Channel Info</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class='featured' data-id="<?php echo $channel['id'];?>">
                                                                            <a>
                                                                                <i class="icofont-flag"></i><?php if($is_featured) echo "Remove Featured"; else echo "Mark Featured"; ?>
                                                                                <span><?php if($is_featured) echo "Remove channel from featured"; else echo "Mark channel as featured"; ?></span>
                                                                            </a>
                                                                        </li>
                                                                        <li class='delete-channel' data-id='<?php echo $channel['id']; ?>'>
                                                                            <i class="icofont-ui-delete"></i>Delete Channel
                                                                            <span>If inappropriate channel</span>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            if (count($channels) == 0) {
                                                echo "<span style='padding:15px;text-align:center;width:100%'>No channels available</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-lg-12 mb-5'>
                                    <?php
										if(count($channels)!=0){
											echo '<div id="pagination"></div>';
										}
									?>
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
                            alertify.error(data);
                        }
                    }
                });
            })
        })
    </script>

    <script>
        $(document).ready(function(){
            $(".wrapper .content-item").slice(9).hide();
            $('#pagination').pagination({
                items: <?php echo $count;?>,
                itemsOnPage: 9,
                onPageClick: function(noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });
        })
    </script>
	<script>
    !(function (e) {
    var a = {
        init: function (t) {
            var s = e.extend(
                    {
                        items: 1,
                        itemsOnPage: 1,
                        pages: 0,
                        displayedPages: 5,
                        edges: 2,
                        currentPage: <?php if(isset($page)) echo $page; else echo 1;?>,
                        hrefTextPrefix: "<?php URL('/channels/');?>",
                        hrefTextSuffix: "",
                        prevText: "Prev",
                        nextText: "Next",
                        ellipseText: "&hellip;",
                        cssStyle: "light-theme",
                        selectOnClick: !0,
                        onPageClick: function (e, a) {},
                        onInit: function () {},
                    },
                    t || {}
                ),
                i = this;
            return (
                (s.pages = s.pages ? s.pages : Math.ceil(s.items / s.itemsOnPage) ? Math.ceil(s.items / s.itemsOnPage) : 1),
                (s.currentPage = s.currentPage - 1),
                (s.halfDisplayed = s.displayedPages / 2),
                this.each(function () {
                    i.addClass(s.cssStyle + " simple-pagination").data("pagination", s), a._draw.call(i);
                }),
                s.onInit(),
                this
            );
        },
        selectPage: function (e) {
            return a._selectPage.call(this, e - 1), this;
        },
        prevPage: function () {
            var e = this.data("pagination");
            return e.currentPage > 0 && a._selectPage.call(this, e.currentPage - 1), this;
        },
        nextPage: function () {
            var e = this.data("pagination");
            return e.currentPage < e.pages - 1 && a._selectPage.call(this, e.currentPage + 1), this;
        },
        getPagesCount: function () {
            return this.data("pagination").pages;
        },
        getCurrentPage: function () {
            return this.data("pagination").currentPage + 1;
            //return 3;
        },
        destroy: function () {
            return this.empty(), this;
        },
        redraw: function () {
            return a._draw.call(this), this;
        },
        disable: function () {
            var e = this.data("pagination");
            return (e.disabled = !0), this.data("pagination", e), a._draw.call(this), this;
        },
        enable: function () {
            var e = this.data("pagination");
            return (e.disabled = !1), this.data("pagination", e), a._draw.call(this), this;
        },
        updateItems: function (e) {
            var t = this.data("pagination");
            (t.items = e), (t.pages = Math.ceil(t.items / t.itemsOnPage) ? Math.ceil(t.items / t.itemsOnPage) : 1), this.data("pagination", t), a._draw.call(this);
        },
        _draw: function () {
            var t,
                s = this.data("pagination"),
                i = a._getInterval(s);
            a.destroy.call(this);
            var n = "UL" === this.prop("tagName") ? this : e("<ul></ul>").appendTo(this);
            if ((s.prevText && a._appendItem.call(this, s.currentPage - 1, { text: s.prevText, classes: "prev" }), i.start > 0 && s.edges > 0)) {
                var l = Math.min(s.edges, i.start);
                for (t = 0; t < l; t++) a._appendItem.call(this, t);
                s.edges < i.start && i.start - s.edges != 1 ? n.append('<li class="disabled"><span class="ellipse">' + s.ellipseText + "</span></li>") : i.start - s.edges == 1 && a._appendItem.call(this, s.edges);
            }
            for (t = i.start; t < i.end; t++) a._appendItem.call(this, t);
            if (i.end < s.pages && s.edges > 0)
                for (
                    s.pages - s.edges > i.end && s.pages - s.edges - i.end != 1
                        ? n.append('<li class="disabled"><span class="ellipse">' + s.ellipseText + "</span></li>")
                        : s.pages - s.edges - i.end == 1 && a._appendItem.call(this, i.end++),
                        t = Math.max(s.pages - s.edges, i.end);
                    t < s.pages;
                    t++
                )
                    a._appendItem.call(this, t);
            s.nextText && a._appendItem.call(this, s.currentPage + 1, { text: s.nextText, classes: "next" });
        },
        _getInterval: function (e) {
            return {
                start: Math.ceil(e.currentPage > e.halfDisplayed ? Math.max(Math.min(e.currentPage - e.halfDisplayed, e.pages - e.displayedPages), 0) : 0),
                end: Math.ceil(e.currentPage > e.halfDisplayed ? Math.min(e.currentPage + e.halfDisplayed, e.pages) : Math.min(e.displayedPages, e.pages)),
            };
        },
        _appendItem: function (t, s) {
            var i,
                n,
                l = this,
                r = l.data("pagination"),
                p = e("<li></li>"),
                d = l.find("ul");
            (t = t < 0 ? 0 : t < r.pages ? t : r.pages - 1),
                (i = e.extend({ text: t + 1, classes: "" }, s || {})),
                t == r.currentPage || r.disabled
                    ? (r.disabled ? p.addClass("disabled") : p.addClass("active"), (n = e('<span class="current">' + i.text + "</span>")))
                    : (n = e('<a href="' + r.hrefTextPrefix + (t + 1) + r.hrefTextSuffix + '" class="page-link">' + i.text + "</a>")).click(function (e) {
                          return a._selectPage.call(l, t, e);
                      }),
                i.classes && n.addClass(i.classes),
                p.append(n),
                d.length ? d.append(p) : l.append(p);
        },
        _selectPage: function (e, t) {
            var s = this.data("pagination");
            return (s.currentPage = e), s.selectOnClick && a._draw.call(this), s.onPageClick(e + 1, t);
        },
    };
    e.fn.pagination = function (t) {
        return a[t] && "_" != t.charAt(0) ? a[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof t && t ? void e.error("Method " + t + " does not exist on jQuery.pagination") : a.init.apply(this, arguments);
    };
})(jQuery);

</script>

</body>

</html>