<?php 
include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Channels - <?php echo $title; ?></title>
	<?php include "includes/head.php"; ?>
	<?php
	$urls=URL_Parts();
	$path=$id;
	$info=R::findOne("channels","WHERE link=?",[$path]);
	
    if(!isset($page)){
		$page=1;
    }
    $community_id=$_SESSION['community_id'];
    $limit=10;
    $all_contents=R::findAll('contents','WHERE channel_id=? ORDER BY id LIMIT '.(($page-1)*$limit).', '.$limit,[$info['id']]);
	$count=R::count('contents','WHERE channel_id=?', [$info['id']]);
	//$all_contents = R::findAll("contents","WHERE channel_id=? LIMIT 1000",[$info['id']]);
	?>
	<style>
		.single-line {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.simple-pagination {
			margin-top:40px;
			margin-left: 30%;
		}
	</style>

</head>

<body>
	<div class="theme-layout">
		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>
		<div class="gap no-gap" id='content-header' style='<?php if($mobile) echo 'margin-left:0px !important;'; else echo 'margin-left:250px;';?>margin-top:0px !important'>
			<div class="top-area mate-black low-opacity">
				<div class="bg-image" style="background-image: url(<?php echo $info['thumbnail']; ?>)"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="post-subject">
								<div class="university-tag">
									<div class="uni-name">
										<h4><?php echo $info['name']; ?> </h4>
									</div>
								</div>
								<ul class="nav nav-tabs post-detail-btn">
									<li class="nav-item"><a class="active" href="#content" data-toggle="tab">Content</a></li>
									<li class="nav-item"><a class="" href="#members" data-toggle="tab">Members</a><span></span></li>
									<li class="nav-item"><a class="" href="#contributors" data-toggle="tab">Contributors</a><span></span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- top Head -->
		<section>
			<div class="gap" id='content-gap' style='margin-top:20px;<?php if($mobile) echo 'padding-left:0px !important;'; ?>'>
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-12">
									<div class="tab-content">
										<div class="tab-pane fade active show " id="content">
										    <div class='row'>
										    <div class='col-md-3' style='padding-right:5px'>
										        <div class="main-wraper">
    												<h3 class="main-title">About</h3>
    												<div class="lang">
    
    													<span style='text-align:justify;color:#000000;font-size:12px'><?php echo $info['description'];?></span>
    												</div>
    
    
    											</div>
										    </div>
										    <div class='col-md-9' style='padding-left:5px'>
											<div class="main-wraper" id='contents_holder'>
												<div id='demo'></div>
												<div class="row wrapper" id='wrapper'>

													<?php

													$i = 0;
													foreach ($all_contents as $content) {

															$reactions = count(json_decode($content['reactions']));
															$shares = count(json_decode($content['shares']));
															$description = "";
															$thumbnail_url = "";
															$sub = '';
															if ($content['type'] == "File") {
																$d = "SELECT * FROM `files` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['thumbnail'];
																$description = $con['description'];
																$sub = 'file';
															}
															if ($content['type'] == "Video") {
																$d = "SELECT * FROM `videos` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['thumbnail'];
																$description = $con['description'];
																$sub = 'video';
															}
															if ($content['type'] == "Solution") {
																$d = "SELECT * FROM `solutions` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['thumbnail'];
																$description = $con['short_description'];
																$sub = 'solution';
															}
															if ($content['type'] == "Blog") {
																$d = "SELECT * FROM `blogs` WHERE `id`='" . $content['data_id'] . "' ";
																$con = $db->RetriveSingle($d);
																$thumbnail_url = $con['cover'];
																$description = strip_tags($con['post']);
																$sub = 'blog';
															}
													?>
															<div class="col-lg-4 col-md-4 col-sm-6 content content-item">
																<div class="event-post mb-3">
																	<figure><a href="<?php URL('/' . $sub . '/' . $content['data_id']) ?>" title=""><img class='lazy thumbnail2' src='https://via.placeholder.com/360x150?text=Loading' data-src="<?php echo $content['thumbnail']; ?>" alt=""></a></figure>
																	<div class="event-meta">
																		<span><?php echo date_format(date_create($content['modification_date']), 'M, d Y'); ?></span>
																		<h6 class='single-line'><a href="<?php URL('/' . $sub . '/' . $content['data_id']) ?>" title=""><?php echo $content['name']; ?> </a></h6>
																		<p class='single-line'><?php echo $description; ?></p>
																		<!--<div class="share-info">
																			<span><?php echo $shares ?> Shares</span>
																			<span><?php echo $reactions ?> Likes</span>
																		</div>-->
																		<div class="stat-tools">
																			<div class="box">
																				<div class="Like"><a class="Like__link"><i class="icofont-like"></i> Like</a>
																					<div class="Emojis">
																						<div class="Emoji Emoji--like">
																							<div class="icon icon--like"></div>
																						</div>
																						<div class="Emoji Emoji--love">
																							<div class="icon icon--heart"></div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="box">
																				<div class="Emojis">
																					<div class="Emoji Emoji--like">
																						<div class="icon icon--like"></div>
																					</div>
																					<div class="Emoji Emoji--love">
																						<div class="icon icon--heart"></div>
																					</div>
																				</div>
																			</div>
																			<a title="" href="#" class="share-to"><i class="icofont-share-alt"></i> Share</a>
																		</div>
																	</div>
																</div>
															</div>

													<?php
														
													} ?>
													<?php
														if(count($all_contents)==0){
															echo '<b style="width:100%;text-align:center;padding:20px">No Contents Available</b>';
														}
													?>
												</div>

												<div class="load mt-0 mb-5">
													<?php
														if(count($all_contents)!=0){
															echo '<div id="pagination"></div>';
														}
													?>
													
												</div>


											</div>

                                            </div>
                                            </div>
										</div>

										<div class="tab-pane fade" id="members">
											<div class="row col-xs-6 merged-10 lazy">



												<?php
												$members = $db->RetriveArray("SELECT * FROM `members` WHERE `community_id`='" . $_SESSION['community_id'] . "' ");
												foreach ($members as $member) {
													echo '
														<div class="col-lg-4 col-md-4 col-sm-6">
															<div class="friendz">
																<figure><img class="lazy" src="https://via.placeholder.com/200x200?text=Loading" data-src="https://ui-avatars.com/api/?name=' . $member['first_name'] . " " . $member['last_name'] . '&background=random" alt=""></figure>
																<span><a href="' . URL_Make('/member/' . $member['id']) . '" title="">' . $member['first_name'] . " " . $member['last_name'] . '</a></span>
																<ins>' . $member['role'] . '</ins>
																<a href="' . URL_Make('/member/' . $member['id']) . '" title="" data-ripple=""><i class="icofont-star"></i>Follow</a>
															</div>
														</div>
														';
												}
												if (count($members) >= 2000) {
													echo '
														<div class="col-lg-4 col-md-4 col-sm-6">
															<div class="friendz">
																<figure><img class="lazy" src="https://via.placeholder.com/200x200?text=Loading" data-src="https://ui-avatars.com/api/?name=' . $member['first_name'] . " " . $member['last_name'] . '&background=random" alt=""></figure>
																<span><a href="' . URL_Make('/member/' . $member['id']) . '" title="">' . $member['first_name'] . " " . $member['last_name'] . '</a></span>
																<ins>' . $member['role'] . '</ins>
																<a href="' . URL_Make('/member/' . $member['id']) . '" title="" data-ripple=""><i class="icofont-star"></i>Follow</a>
															</div>
														</div>
														';
												}
												?>
												<?php
														if(count($members)==0){
															echo '<b style="width:100%;text-align:center;padding:20px">No Members Available</b>';
														}
													?>
											</div>
										</div>
										
										<div class="tab-pane fade" id="contributors">
											<div class="row col-xs-6 merged-10 lazy">



												<?php
												$members = $db->RetriveArray("SELECT * FROM `members` WHERE `community_id`='" . $_SESSION['community_id'] . "' ");
												foreach ($members as $member) {
													echo '
														<div class="col-lg-4 col-md-4 col-sm-6">
															<div class="friendz">
																<figure><img class="lazy" src="https://via.placeholder.com/200x200?text=Loading" data-src="https://ui-avatars.com/api/?name=' . $member['first_name'] . " " . $member['last_name'] . '&background=random" alt=""></figure>
																<span><a href="' . URL_Make('/member/' . $member['id']) . '" title="">' . $member['first_name'] . " " . $member['last_name'] . '</a></span>
																<ins>' . $member['role'] . '</ins>
																<a href="' . URL_Make('/member/' . $member['id']) . '" title="" data-ripple=""><i class="icofont-star"></i>Follow</a>
															</div>
														</div>
														';
												}
												if (count($members) >= 2000) {
													echo '
														<div class="col-lg-4 col-md-4 col-sm-6">
															<div class="friendz">
																<figure><img class="lazy" src="https://via.placeholder.com/200x200?text=Loading" data-src="https://ui-avatars.com/api/?name=' . $member['first_name'] . " " . $member['last_name'] . '&background=random" alt=""></figure>
																<span><a href="' . URL_Make('/member/' . $member['id']) . '" title="">' . $member['first_name'] . " " . $member['last_name'] . '</a></span>
																<ins>' . $member['role'] . '</ins>
																<a href="' . URL_Make('/member/' . $member['id']) . '" title="" data-ripple=""><i class="icofont-star"></i>Follow</a>
															</div>
														</div>
														';
												}
												?>
												<?php
														if(count($members)==0){
															echo '<b style="width:100%;text-align:center;padding:20px">No Members Available</b>';
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

	<?php include "includes/scripts.php"; ?>
	<script>
		var myLazyLoad = new LazyLoad();

		$(document).ready(function() {
		    var nav_open = true;
		    $('#sidemenu-btn').click(function(){
	              if (nav_open==true) {
                    $(".sidebar").addClass('hide'); 
                    nav_open = false;
                    $('#content-header').css('margin-left','250px');
                    $('#content-gap').css('padding-left','300px');
                  } else {
                    $("nav.sidebar").removeClass('hide');
                    nav_open = true;
                    $('#content-header').css('margin-left','0px');
                    $('#content-gap').css('padding-left','0px');
                  }
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
                        hrefTextPrefix: "<?php URL('/channel/'.$path."/");?>",
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