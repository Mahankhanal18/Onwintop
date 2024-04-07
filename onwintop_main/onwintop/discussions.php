<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
    if(isset($_POST['search'])){
        echo "<script>window.location='".URL_Make('/discussions/'.$_POST['search'])."'</script>";
    }
    if(isset($search)){
        $search=str_replace("%20"," ",$search);
    }
    
    
?>
<head>
   <title>Discussions | <?php echo $title; ?></title>

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
      .uk-icon:hover{
          cursor:pointer;
      }
   </style>
</head>
<?php
   $contents = R::findAll("contents", "WHERE community_id=? ORDER BY id DESC", [$_SESSION['community_id']]);
   $count_contents=count($contents);
?>
<body>
   <div class="theme-layout">
      <?php include "includes/header2.php"; ?>
      <?php include "includes/nav.php"; ?>
      <section>
         <div class="gap"  style='<?php if($mobile) echo 'padding-left:0px !important;';?>margin-top:10px !important'>
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div id="page-contents" class="row merged20">
                        <div class="col-lg-12">
                           <div class="main-wraper">
                              <div class="main-title">
                                 Discussion
                                 <div style='float:right'>

                                    <form action='' id='search' method='post' class="uk-inline" style='text-align:left;width:250px'>
                                        <button class="uk-form-icon uk-form-icon-flip" style='color:var(--primary-color)' href="#" uk-icon="icon: search"></button>
                                        <input id='search_text' class="uk-input" value='<?php if(isset($search)) echo $search;?>' name='search' style='padding:7px 15px;background-color:#ffffff;color:var(--primary-color)' type="text" aria-label="Clickable icon">
                                    </form>

                                    <a href='<?php URL('/create-topic'); ?>' class="button primary">+ New Topic</a>
                                 </div>
                              </div>
                              <div class="container row">
                                 <h5 class='label-discussion filter-dis' data-name='latest' style='margin-right:15px'>Latest</h5>
                                 <h5 class='label-discussion filter-dis' data-name='top' style='margin-right:15px'>Top</h5>
                                 <h5 class='label-discussion filter-dis' data-name='categories' style='margin-right:15px'>Categories</h5>
                                 <table class="uk-table uk-table-striped">
                                    <thead>
                                       <tr>
                                          <th class='filter-dis' data-name='topic'>Topic</th>
                                          <th class='filter-dis' data-name='replies'>Replies</th>
                                          <th class='filter-dis' data-name='creator'>Creator</th>
                                          <?php if($user_login==true){ echo '<th></th>';}else echo ""; ?>
                                       </tr>
                                    </thead>
                                    <tbody class='wrapper'>
                                       <?php                                   
                                        if(isset($page)){
                                            $page=(int) $page;
                                            if($page>2000){
                                                $page=(int)($page/800);
                                            }
                                        }else{
                                            $page=1;
                                        }
                                        $limit=10;
                                        $counts=R::count('discussions','WHERE community_id=?', [$community_id]);
                                        $discussions=R::findAll('discussions','WHERE community_id=? ORDER BY id LIMIT '.(($page-1)*$limit).', '.$limit,[$community_id]);

                                        if(isset($search)){
                                            $discussions=R::findAll('discussions','WHERE community_id=? AND title LIKE ?', [$community_id,'%'.$search.'%']);
                                        }
                                       
                                       
                                       foreach($discussions as $discussion){
                                          $comments=json_decode($discussion['comments']);
                                          $actions="";
                                          if($user_login==true){
                                             $actions="
                                             <td class='content-item'>  
                                                <button style='background-color:#ffffff00;font-size:22px;border:none' type='button'><i class='icofont-edit'></i></button>
                                                <div uk-dropdown>
                                                   <ul class='uk-nav uk-dropdown-nav'>
                                                      <li><a href='".URL_Make('/discussion/'.$discussion['id'])."'>View</a></li>
                                                      <li><a href='".URL_Make('/edit-topic/'.$discussion['id'])."'>Edit</a></li>
                                                   </ul>
                                                </div>
                                             </td>
                                             ";
                                          }
                                          echo "
                                          <tr class='content-item'>
                                             <td>
                                                <a href='".URL_Make('/discussion/'.$discussion['id'])."'><b class='single-line'>".$discussion['title']."</b></a></br>
                                                <small>By ".$discussion['creator']." | ".date_format(date_create($discussion['date']),'d M Y')."</small>
                                             </td>
                                             <td>
                                                ".count($comments)."
                                             </td>
                                             <td>
                                                <img src='https://ui-avatars.com/api/?name=".$discussion['creator']."&background=random' style='height:35px;width:auto;border-radius:50%;margin-right:8px' alt='' srcset=''>
                                                ".date_format(date_create($discussion['date']),'d M')." by <b>".$discussion['creator']."</b>
                                             </td>
                                             ".$actions."
                                          </tr>
                                          ";
                                       }
                                       if(count($discussions)==0){
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
               <div class='row'>
                    <div class='col-lg-12 text-center col-sm-12 mb-5'>
                        <center>
                        <?php
                        if(count($discussions)!=0){
                            echo '<div id="pagination"></div>';
                        }
                        ?>
                        </center>
                    </div>
                </div>
            </div>
      </section>
      <?php include "includes/footer.php"; ?>
   </div>
   <script src="<?php URI("js/main.min.js"); ?>"></script>
   <script src="<?php URI("js/script.js"); ?>"></script>
      <script>
        $(document).ready(function(){
            $(".wrapper .content-item").slice(12).hide();
            $('#pagination').pagination({
                items: <?php echo $counts;?>,
                itemsOnPage: 12,
                onPageClick: function(noofele) {
                    $(".wrapper .content-item").hide()
                        .slice(12 * (noofele - 1),
                            12 + 12 * (noofele - 1)).show();
                }
            });
        })
    </script>
   <script>
      $(document).ready(function() {
          $('.filter-dis').click(function(){
              name=$(this).attr('data-name');
              window.location='<?php URL('/discussions');?>/'+name;
          })
          $('#search').on('submit',function(e){
            e.preventDefault();
            var keyword=$('#search_text').val();
            if(keyword.length!=0){
                window.location='<?php URL('/discussions/search');?>/'+keyword;
            }else{
                alertify.error('Enter some text to search');
            }
            
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
                        currentPage: <?php if(isset($page)) echo $page; else echo 1;?>,
                        hrefTextPrefix: "<?php URL('/discussions/');?>",
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