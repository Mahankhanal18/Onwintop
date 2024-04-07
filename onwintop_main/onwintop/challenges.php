<?php

include "init.php";

if(!isset($page)){
    $page=1;
}
$community_id=$_SESSION['community_id'];
$limit=10;
$challenges=R::findAll('challenges','community_link=? ORDER BY id DESC',[$community_id]);
$count=R::count('challenges');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Challenges | <?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>

</head>

<body style='background-color:aqua'>
	<!--<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div> -->
	<div class="theme-layout"  style='background-color:#ffffff'>

		<?php include "includes/header2.php"; ?>

		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-8 col-md-8">
									<div class="main-wraper wrapper">
										<div class="main-title">Challenges

										</div>
										<h6 class='mb-3'><a style='font-weight:500;'><u>All</u></a> <a href='<?php URL('/pending-challenges');?>' class='ml-3'>Waiting</a> <a class='ml-3'>Completed</a></h6>
										</br>
										<?php
										//$count=count($blogs);
										foreach ($challenges as $challenge) {
											$cover = $challenge['thumbnail'];
										?>
											<div class="blog-posts mb-3 content-item" style='border-bottom:1px solid #eaeaea;padding-bottom:15px'>
											    <div class="row">
											        
											        <div class='col-md-4'>
											            <figure><img src="<?php echo $cover; ?>" style='height:140px;width:100%;object-fit:cover;object-position:center;border-radius:8px;border:1px solid #ebebeb;' alt=""></figure>
											        </div>
											        <div class='col-md-5'>
											            <b class='single-line'><a href="<?php URL("/challenge/" . $challenge['id']); ?>"><?php echo $challenge['headline']; ?></a></b></br>
											            <p>Goals : <?php echo $challenge['type'];?></p>
											            <div class='row'>
											                <div class='col-md-4'>
											                    <i class="fa fa-trophy"></i>&nbsp; 0
											                </div>
											                <div class='col-md-4'>
											                    <i class="fa fa-award"></i>&nbsp; 0
											                </div>
											                <div class='col-md-4'>
											                    <i class="fa fa-coins"></i>&nbsp; <?php echo $challenge['reward'];?>
											                </div>
											            </div>
											        </div>
											        <div class='col-md-3'>
											            <span class="badge badge-success">Published</span></br>
											            <small>Date : <?php echo date('Y-m-d');?></small></br>
											            <small>Targeted to : 0 Advocates</small>
											        </div>
											        <div class='col-md-1'>

											        </div>
											    </div>
											</div>
										<?php
										}
										if(count($challenges)==0){
											echo "<span style='padding:15px;text-align:center;width:100%'>No blogs available</span>";
										}
										?>

									</div>
								</div>
								<?php 
								if($_SESSION['user_login']=='true'){ 
								    $to_review=R::count("challengesubmissions", "community_link=? AND status=?",[$community_id,'Pending']);
								    $st_count=R::count("challengesubmissions", "community_link=? AND credit!=?",[$community_id,0]);
								?>
								<div class="col-lg-4 col-md-4">
									<aside class="sidebar static right">
                                        <div class="widget">
                                            
                                            <h4 class="widget-title">Items to Review</h4>
                                            <div class='row'>
                                                <div class='col-md-2'><h3><?php echo $to_review;?></h3></div>
                                                <div class='col-md-6'>
                                                    <b>Challanges Confirmation</b>
                                                </div>
                                                <div class='col-md-4'><a href='https://app-dev.onwintop.com/<?php echo $community_id;?>/pending-challenges' class='btn btn-primary btn-sm'>Review</a></div>
                                            </div>
                                            <div class='row mt-4'>
                                                <div class='col-md-2'><h3><h3><?php echo $st_count;?></h3></div>
                                                <div class='col-md-6'>
                                                    <b>Reward Redemptions</b>
                                                </div>
                                                <div class='col-md-4'><a href='https://app-dev.onwintop.com/<?php echo $community_id;?>/completed-challenges' class='btn btn-primary btn-sm'>Review</a></div>
                                            </div>
                                            <div class='row mt-4'>
                                                <div class='col-md-2'><h3>0</h3></div>
                                                <div class='col-md-6'>
                                                    <b>Join Requests</b>
                                                </div>
                                                <div class='col-md-4'><button class='btn btn-primary btn-sm'>Review</button></div>
                                            </div>
                                            
                                        </div>
									</aside>
								</div>
								<?php } ?>
								<div class='col-lg-12 text-center mb-5'>
								    <?php
								        if(count($challenges)!=0){
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

    <script>
        $(document).ready(function(){
            
            
            $(".wrapper .content-item").slice(8).hide();
            $('#pagination').pagination({
                items: <?php echo $count;?>,
                itemsOnPage: 8,
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
                        hrefTextPrefix: "<?php URL('/blogs/');?>",
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