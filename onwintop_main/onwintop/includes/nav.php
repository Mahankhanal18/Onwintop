<?php
foreach ($custom_codes as $custom_code) {
    echo $custom_code['body'];
}
?>
<style>
    .uk-navbar-item,
    .uk-navbar-nav>li>a,
    .uk-navbar-toggle {
        justify-content: center;
        align-items: center;
        column-gap: 0.25em;
        box-sizing: border-box;
        float: right;
        font-size: .875rem;
        text-decoration: none;
        min-height: 0px !important;
    }

    .uk-navbar-container:not(.uk-navbar-transparent) {
        background: none;
        float: right;
        margin-top: -30px;
    }

    .nav-help-icon {
        margin-top: 10px;
        font-size: 10px;
    }

    .nav-help-icon:hover {
        cursor: pointer;
    }
    .menu-slide>li>a:hover {
        background: #fff none repeat scroll 0 0;
        border-radius: 9px;
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }
</style>

<?php
    //finding active menu
    function getIfActiveMenu($name){
        $full_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if(str_contains($full_url,$name)){
            echo 'active';
        }
    }

?>


<div class="responsive-header">
    <div class="logo res">
        <a href='<?php echo $root.$community_id;?>'><?php echo $logo; ?></a>
    </div>

    <div class="right-compact">
        <div class="sidemenu">
            <i>
                <svg id="side-menu2" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></i>
        </div>
        <div class="res-search">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg></span>
        </div>

    </div>
    <div class="restop-search">
        <span class="hide-search"><i class="icofont-close-circled"></i></span>
        <form method="get" action="<?php echo URL_Make('/search/'); ?>">
            <input type="text" name='q' placeholder="Search...">
        </form>
    </div>
</div><!-- responsive header -->
<?php
    $navs=json_decode($community['title'],true);
?>
<?php

$useragent=$_SERVER['HTTP_USER_AGENT'];
$parts=URL_Parts();
$mobile=false;
$index=false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    $mobile=true;
if(count($parts)==3){
    $index=true;
}
?>

<nav class="sidebar <?php if(!$mobile && $index!=3) echo "";?>" id='sidenav'>
    <ul class="menu-slide">
        <li class="menu-item-has-children <?php getIfActiveMenu('explore');?>">
            <a class="" href="<?php echo URL('/explore'); ?>" title="">
                <i class=""><svg class="feather feather-users" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle r="4" cy="7" cx="9" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg></i> Contents
            </a>
            <?php //print_r($navs);?>
            <ul class="submenu" style="<?php if(str_contains("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",'active')){ echo 'display: block';} else{ echo 'display: none'; }?>;">
                <li style="<?php if(isset($navs['blogs']) && $navs['blogs']=='disabled') echo "display:none;"; else echo "display:block;";?>" ><a href="<?php echo URL('/blogs'); ?>" title="">Blogs</a>
                    <?php
                    //community users only
                    if ($user_login == true) {
                    ?>
                        <nav class="uk-navbar-container" style='margin-right:15px' uk-navbar>
                            <div class="uk-navbar-left">
                                <ul class="uk-navbar-nav" style='list-style-type:none'>
                                    <li style='list-style-type:none'>
                                        <span style='list-style-type:none' href="#"><i class="icofont-plus nav-help-icon"></i></span>
                                        <div class="uk-navbar-dropdown">
                                            <ul style='list-style-type:none' class="uk-nav uk-navbar-dropdown-nav">
                                                <a href="<?php echo URL('/view-blogs'); ?>">Browse Blogs</a>
                                                <a href="<?php echo URL('/ai-writters'); ?>">AI Writters</a>
                                                <a href="<?php echo URL('/create-blog'); ?>">Create Blog</a>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    <?php
                    }
                    ?>
                </li>
                <li style="<?php if(isset($navs['salesrooms']) && $navs['salesrooms']=='disabled') echo "display:none"; ?>"><a href="<?php echo URL('/salesrooms'); ?>" title="">Digital Salesrooms</a>
                    <?php
                    //community users only
                    if ($user_login == true) {
                    ?>
                        <nav class="uk-navbar-container" style='margin-right:15px' uk-navbar>
                            <div class="uk-navbar-left">
                                <ul class="uk-navbar-nav" style='list-style-type:none'>
                                    <li style='list-style-type:none'>
                                        <span style='list-style-type:none' href="#"><i class="icofont-plus nav-help-icon"></i></span>
                                        <div class="uk-navbar-dropdown">
                                            <ul style='list-style-type:none' class="uk-nav uk-navbar-dropdown-nav">
                                                <a href="<?php echo URL('/view-salesrooms'); ?>">Browse Salesrooms</a>
                                                <a href="<?php echo URL('/create-salesroom'); ?>">Create Salesroom</a>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    <?php
                    }
                    ?>
                </li>
                <?php
                $db = new Database();
                //check if featured channel exists
                $channels = R::findAll('channels', 'WHERE community_link=? AND featured=? LIMIT 3', [$_SESSION['community_id'], 'featured']);
                if (count($channels) == 0) {
                    $channels = R::findAll('channels', 'WHERE community_link=? ORDER BY id DESC LIMIT 3', [$_SESSION['community_id']]);
                }
                foreach ($channels as $channel) {
                    if(!isset($navs['channels']) || $navs['channels']=='enabled'){
                        echo '<li><a href="' . URL_Make('/channel/' . $channel['link']) . '" title="">' . $channel["name"] . '</a></li>';
                    }
                }
                ?>
                <li><a href="<?php echo URL('/channels'); ?>" title="">View All Channels</a>
                    <?php
                    //community users only
                    if ($user_login == true) {
                    ?>
                        <nav class="uk-navbar-container" style='margin-right:15px' uk-navbar>
                            <div class="uk-navbar-left">
                                <ul class="uk-navbar-nav" style='list-style-type:none'>
                                    <li style='list-style-type:none'>
                                        <span style='list-style-type:none' href="#"><i class="icofont-plus nav-help-icon"></i></span>
                                        <div class="uk-navbar-dropdown">
                                            <ul style='list-style-type:none' class="uk-nav uk-navbar-dropdown-nav">
                                                <a href="<?php echo URL('/channels'); ?>">Browse Channels</a>
                                                <a href="<?php echo URL('/create-channel'); ?>">Create Channel</a>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    <?php } ?>
                </li>
            </ul>
        </li>
        <li class="<?php getIfActiveMenu('events');?>" style="<?php if(isset($navs['events']) && $navs['events']=='disabled') echo 'display:none'; ?>">
            <a class="" href="<?php echo URL('/events'); ?>" title="">
                <i class="">
                    <svg class="feather feather-users" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle r="4" cy="7" cx="9" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </i> Events
                <?php
                //community users only
                if ($user_login == true) {
                ?>
                    <nav class="uk-navbar-container" style='margin-right:-5px' uk-navbar>
                        <div class="uk-navbar-left">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <a href="#"><span style='float:right' uk-icon="icon: more-vertical"></span></a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="<?php echo URL('/view-events'); ?>">Browse Events</a></li>
                                            <li><a href="<?php echo URL('/create-event'); ?>">Create Event</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                <?php } ?>
            </a>
        </li>
        <li class="<?php getIfActiveMenu('discussion');?>" style="<?php if(isset($navs['discussion']) && $navs['discussion']=='disabled') echo 'display:none'; ?>">
            <a class="" href="<?php echo URL('/discussions'); ?>" title="">
                <i class="">
                    <svg id="ab3" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                        <path d="M12,2L15.09,8.26L22,9.27L17,14.14L18.18,21.02L12,17.77L5.82,21.02L7,14.14L2,9.27L8.91,8.26L12,2Z" style="stroke-dasharray: 70, 90; stroke-dashoffset: 0;"></path>
                    </svg>
                </i>
                Discussion
            </a>
        </li>
        <li class="<?php getIfActiveMenu('challenges');?>">
			<a class="" href="<?php echo URL('/challenges'); ?>" title="">
				<i class="">
                <svg id="ab5" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></i> 
                Challenges
                <?php
                //community users only
                if ($user_login == true) {
                ?>
                    <nav class="uk-navbar-container" style='margin-right:-5px' uk-navbar>
                        <div class="uk-navbar-left">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <a href="#"><span style='float:right' uk-icon="icon: more-vertical"></span></a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="<?php echo URL('/challenges'); ?>">Browse Challenges</a></li>
                                            <li><a href="<?php echo URL('/create-challenge'); ?>">Create Challenge</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                <?php } ?>
			</a>
			
		</li>
		
		<li class="<?php getIfActiveMenu('rewards');?>">
			<a class="" href="<?php echo URL('/rewards'); ?>" title="">
				<i class="">
				    <svg class="feather feather-zap" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </i> 
                
                Rewards
                <?php
                //community users only
                if ($user_login == true) {
                ?>
                    <nav class="uk-navbar-container" style='margin-right:-5px' uk-navbar>
                        <div class="uk-navbar-left">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <a href="#"><span style='float:right' uk-icon="icon: more-vertical"></span></a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="<?php echo URL('/rewards'); ?>">Browse Rewards</a></li>
                                            <li><a href="<?php echo URL('/create-reward'); ?>">Create Reward</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                <?php } ?>
			</a>
			
		</li>
		


        <?php
        //community users only
        if ($user_login == true) {
        ?>
            <li class="menu-item-has-children">
                <a class="" href="#" title="">
                    <i class=""><svg id="team" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                            <path d="M2,12A10,10 0,1,1 22,12A10,10 0,1,1 2,12" style="stroke-dasharray: 63, 83; stroke-dashoffset: 0;"></path>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2" style="stroke-dasharray: 10, 30; stroke-dashoffset: 0;"></path>
                            <path d="M9,9L9.01,9" style="stroke-dasharray: 1, 21; stroke-dashoffset: 0;"></path>
                            <path d="M15,9L15.01,9" style="stroke-dasharray: 1, 21; stroke-dashoffset: 0;"></path>
                        </svg></i>
                    Admin
                </a>
                <ul class="submenu">
                    <li><a href="<?php URL('/view-members'); ?>" title="">Member</a></li>
                    <li><a href="<?php URL('/landing-page'); ?>" title="">Landing Page</a></li>
                    <li><a href="<?php URL('/custom-code'); ?>" title="">Custom Code</a></li>
                    <li><a href="<?php URL('/branding-settings'); ?>" title="">Branding</a></li>
                    <li><a href="<?php URL('/sharing'); ?>" title="">Sharing</a></li>
                    <li><a href="<?php URL('/edit-settings'); ?>" title="">Setting</a></li>
                </ul>
            </li>
        <?php  } ?>

    </ul>
</nav><!-- nav sidebar -->