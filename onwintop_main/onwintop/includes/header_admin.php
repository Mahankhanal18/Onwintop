<style>
    #community-switch {
        background-color: transparent;
        color: #333;
        margin-top: 5px;
        border: 1px solid #e5e5e5;
        width: 300px;
        text-align: left;
    }

    .top-text-menu {
        font-size: 16px;
        font-weight: 400;
        margin-right: 10px;
        cursor: pointer;
    }

    .top-text-menu:hover {
        font-weight: 450;
    }
</style>
<header class="">
    <div class="topbar stick">
        <?php
        $logo = "";
        if (strlen($data['logo']) != 0) {
            $logo = "<img src='" . $data['logo'] . "' style='max-width: 240px !important;' alt=''>";
        }
        ?>
        <a href="<?php echo URL('/'); ?>">
            <div class="logo"></div>
        </a>
        <div class="searches">

            <form action="<?php echo URL_Make('/search/'); ?>">
                <input type="text" name='q' id='search-text' placeholder="Search...">
                <button type="submit"><i class="icofont-search"></i></button>
                <span class="cancel-search"><i class="icofont-close"></i></span>
                <?php print_r(getCookieData('search')); ?>
            </form>
        </div>
        <ul class="web-elements">

            <li>
                <b class='top-text-menu' onclick="window.location='<?php echo $root . "admin/account-admin"; ?>'">Account Admin</b>
            </li>
            <li>
                <?php
                    //open the latest community by default
                    $tenant_id=$credentials['tenant_id'];
                    $nav_com=R::findOne("communities","WHERE tenant_id=? ORDER BY id DESC LIMIT 1",[$tenant_id]);
                    if(isset($_SESSION['last_visited_community'])){
                        $com_link_id=$_SESSION['last_visited_community'];
                    }else{
                        $com_link_id=$nav_com['link'];
                    }
                ?>
                <b class='top-text-menu' onclick="window.location='<?php echo $root.$com_link_id; ?>'">Communities</b>
            </li>

            <li>
                <a href="#" title="">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </i>
                </a>
                <ul class="dropdown">

                        <li class="logout"><a href="<?php URL('/logout'); ?>" title=""><i class="icofont-power"></i> Logout</a>
                        </li>


                </ul>
            </li>
        </ul>
    </div>

</header><!-- header -->
<section>
    <div class="white-bg">
        <div class="container-fluid" style='box-shadow: 0px 5px 8px #cccccc7d;'>
            <div class="menu-caro">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="sidemenu" id='nav_btn' style='float:left;margin-right:10px' id='sidemenu-btn'>
                            <i>
                                <svg id="side-menu" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                                    <path d="M3,12L21,12" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                                    <path d="M3,6L21,6" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                                    <path d="M3,18L21,18" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                                </svg></i>
                        </div>
                    </div>
                    <div class="col-lg-1" style='padding-top:15px'>

                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- UIkit JS -->
