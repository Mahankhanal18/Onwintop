<?php include "init.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Events | <?php echo $title; ?></title>
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
        .simple-pagination {
			margin-top:40px;
			margin-left: 30%;
		}
    </style>
</head>
<body>
    <!-- page loader<div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
    </div> -->
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
                                        <div class="main-title">Browse Events</div>
                                        <div class="row wrapper">
                                            <?php
                                            
                                            $parts=URL_Parts();
                                            $page=1;
                                            if(isset($parts[7])){
                                                $page=$parts[7];
                                                if($parts[7]>2000){
                                                    $page=(int)($parts[7]/800);
                                                }
                                            }
                                            $community_id=$_SESSION['community_id'];
                                            $limit=10;
                                            $events=R::findAll('events','WHERE community_id=? ORDER BY id LIMIT '.(($page-1)*$limit).', '.$limit,[$community_id]);
                                            //$c = "SELECT * FROM `events` WHERE `community_id`='" . $_SESSION['community_id'] . "' ORDER BY `id` DESC ";
                                            //$events = $db->RetriveArray($c);
                                            foreach ($events as $channel) {
                                            ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 content-item">
                                                    <div class="event-post mb-3">
                                                        <figure><a title=""><img src="<?php echo $channel['cover']; ?>" style='height:220px;width:100%;object-fit:cover;object-position:center' alt=""></a></figure>
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
                                                                        <li onclick="window.location='<?php echo URL('/edit-event/' . $channel['url']); ?>'">
                                                                            <a>
                                                                                <i class="icofont-share-alt"></i>Edit
                                                                                <span>Edit Event Information</span>
                                                                            </a>
                                                                        </li>
                                                                        <li onclick="window.location='<?php echo URL('/manage-event/' . $channel['url']); ?>'">
                                                                            <a>
                                                                                <i class="icofont-settings-alt"></i>Manage Event
                                                                                <span>Manage Event</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class='delete-channel' data-id='<?php echo $channel['id']; ?>'>
                                                                            <i class="icofont-ui-delete"></i>Delete Event
                                                                            <span>If inappropriate event</span>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            if(count($events)==0){
												echo "<span style='padding:15px;text-align:center;width:100%'>No channels available</span>";
											}
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-lg-12 mb-5'>
                                    <?php
                                    if(count($events)!=0){
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
                        <h5><i class="fa fa-filter"></i> Delete Event</h5>
                    </div>
                    <div class="send-message">
                        <b>Are you sure want to delete this event?</b></br></br>
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
            $(".wrapper .content-item").slice(9).hide();
            $('#pagination').pagination({
                items: <?php if($_SESSION['community_id']=='s53k1') echo count($events)*3000; else echo count($events);?>,
                itemsOnPage: 9,
                onPageClick: function(noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });
            var curr_ch = 0;
            $('.delete-channel').click(function() {
                curr_ch = $(this).attr('data-id');
                $('#delete-channel-popup').addClass('active');
            })
            $('#confirm-delete').click(function() {
                $.ajax({
                    url: '<?php echo $url . "api/event.php"; ?>',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        method: 'DELETE',
                        id: curr_ch
                    },
                    success: function(data) {
                        alertify.success(data);
                        location.reload();
                    }
                })
            })
            $('#dismiss-delete').click(function() {
                $('#delete-channel-popup').removeClass('active');
            })
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
                        currentPage: <?php if(isset($parts[7])) echo $parts[7]; else echo 1;?>,
                        hrefTextPrefix: "<?php URL('/view-events/');?>",
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