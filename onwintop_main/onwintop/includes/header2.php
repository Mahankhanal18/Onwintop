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

    .dropdown>li>a:hover {
        background-color:
            <?php echo $colors['post_background']; ?>
            40 !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<header class="">
    <?php
    $comm = R::findOne("communities", "WHERE link=?", [$_SESSION['community_id']]);
    $navs = json_decode($comm['title'], true);

    ?>
    <div class="topbar container py-1"
        style='color:var(--topnav-color);border-bottom:none;background-color:var(--secondary-color) !important;'>
        <style>
            .nav-menu li {
                display: inline;
                list-style-type: none;
                margin-right: 25px;
                font-size: 14px;
                color: #727272;
            }

            .nav-menu li:hover {
                color: var(--primary-color);
            }
        </style>
        <div class="searches" style="width:auto;">
            <ul class="nav-menu" style="margin-bottom:0rem">
                <li><a href="<?php echo $_ENV['project_url'] . $community_id . "/"; ?>videos">Videos</a>
                </li>
                <?php
                if ($tenant['plan'] == 'NULL') { ?>
                    <li><a
                            href="<?php echo $_ENV['project_url'] . $community_id . "/choose-subscription"; ?>">Challenges</a>
                    </li>
                    <li><a href="<?php echo $_ENV['project_url'] . $community_id . "/choose-subscription"; ?>">Rewards</a>
                    </li>
                    <li><a href="<?php echo $_ENV['project_url'] . $community_id . "/choose-subscription"; ?>">Contents</a>
                    </li>
                <?php } else { ?>
                    <li><a
                            href="<?php echo $_ENV['project_url'] . $community_id . "/challange-focus/"; ?>challenges">Challenges</a>
                    </li>
                    <li><a href="<?php URL('/rewards'); ?>">Rewards</a></li>
                    <li><a href="<?php URL('/explore'); ?>">Contents</a></li>
                <?php } ?>
            </ul>
        </div>
        <ul class="web-elements">
            <div class='searches' style="display:none">
                <form method='get' action='<?php URL('/search/'); ?>'>
                    <input type="text" name='q' id='search-text' placeholder="Search..."
                        style="padding:1px 9px 0px 42px;">
                    <button style="top:0px" type="submit"><i class="icofont-search"></i></button>
                    <span class="cancel-search"><i class="icofont-close"></i></span>
                </form>
            </div>
            <?php
            if ($comm['landing_page'] == 'Enabled') {
                ?>
                <li>
                    <?php
                    if (!empty($auth_credentials)) {
                        $member = R::findOne("members", "email=? AND community_id=?", [$auth_credentials['email'], $community_id]);
                        echo "<i class='fa fa-coins text-warning'></i>&nbsp; <b>" . $member['coins'] . "</b> ";
                    }
                    ?>

                    <!--<a href="<?php URL(""); ?>" title="Home" data-toggle="tooltip">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg></i>
                </a>-->
                </li>
            <?php } else { ?>
                <li>

                    <!--<a href="<?php URL("/challange-focus"); ?>" title="Home" data-toggle="tooltip">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg></i>
                </a>-->
                </li>
            <?php } ?>
            <li>
                <a href="#" title="" style="margin-top:8px">
                    <i>
                        <?php
                        if (!empty($user_credentials)) {
                            ?>
                            <img src='https://ui-avatars.com/api/?name=<?php echo $auth_credentials['first_name'] . " " . $auth_credentials['last_name']; ?>&background=random'
                                style="height:36px;width:36px;border-radius:50%;" />
                        <?php } else { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        <?php } ?>
                    </i>
                </a>
                <ul class="dropdown">
                    <?php
                    if ($user_login == true && !empty($auth_credentials)) {
                        ?>
                        <li><a href="#modal-community" uk-toggle title=""><i class="icofont-exchange"></i> Switch Space</a>
                        </li>
                        <li><a href="<?php URL('/profile'); ?>" title=""><i class="icofont-user-alt-3"></i> Your Profile</a>
                        </li>
                        <li><a href="<?php URL('/login-as-member'); ?>" title=""><i class="icofont-globe"></i> Login as
                                member</a></li>
                        <?php
                        //community users only
                        if ($user_login == true && $user_role == 'Admin') {
                            ?>
                            <li><a href="<?php echo $root . "admin/account-admin/" . $_SESSION['community_id']; ?>" title=""><i
                                        class="icofont-gear"></i> Account Admin</a></li>
                        <?php } ?>

                        <li class="logout"><a href="<?php URL('/logout'); ?>"
                                style='background-color:var(--primary-color-transparent)' title=""><i
                                    class="icofont-power"></i> Logout</a>
                        </li>
                        <?php
                    } elseif ($member_login == true && !empty($auth_credentials)) {
                        ?>
                        <li><a href="<?php URL('/profile'); ?>" title=""><i class="icofont-user-alt-3"></i> Your Profile</a>
                        </li>
                        <li class="logout"><a href="<?php URL('/logout'); ?>"
                                style='background-color:var(--primary-color-transparent)' title=""><i
                                    class="icofont-power"></i> Logout</a>
                        </li>
                        <?php
                    } else {
                        $request_url=(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        ?>
                        <li><a href="<?php URL('/signin?q='.base64_encode($request_url)); ?>" title=""><i class="icofont-user-alt-3"></i> Signin</a></li>
                        <li><a href="<?php URL('/signup?q='.base64_encode($request_url)); ?>" title=""><i class="icofont-ui-rate-add"></i> Signup</a></li>
                        <?php
                    }
                    ?>

                </ul>
            </li>
        </ul>
    </div>

</header><!-- header -->
<style>
    .top-header {
        padding-left: 35px;
        padding-right: 35px;
    }

    @media screen and (max-width: 812px) {
        .top-header {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .px-5{
            padding-left:12px !important;
            padding-right:12px !important;
        }
        .px-4{
            padding-left:0px !important;
            padding-right:0px !important;
        }
        .main-wraper{
            border:none;
        }
        .py-4{
            padding-top:0px !important;
            padding-bottom:0px !important;
        }
    }
</style>
<section class='top-header' style="z-index:99;background-color:<?php echo $colors['post_background']; ?>;">
    <div>
        <div class='container-fluid pt-2' style="display:flex;align-items:center;height:auto">
            <div class="sidemenu" style='float:left;margin-right:10px;user-select: none;' id='sidemenu-btn'>
                <i>
                    <svg id="side-menu" style="stroke:#ffffff;" xmlns="http://www.w3.org/2000/svg" width="26"
                        height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="nav-switch-icon feather feather-menu">
                        <path d="M3,12L21,12" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                        <path d="M3,6L21,6" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                        <path d="M3,18L21,18" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                    </svg>
                </i>
            </div>
            <a class='ml-2' href='<?php echo URL_Make('/explore'); ?>'>
                <?php
                //get current community name
                $community_name = R::findOne("communities", "WHERE link=?", [$_SESSION['community_id']]);
                if (strlen($brand['logo']) != 0) {
                    echo '<img src="' . $brand['logo'] . '" style="height:35px;width:auto;float:left;margin-right:30px;padding-right:30px;border-right:5px solid #ffffff;"/>';
                }
                ?>
            </a>
            <a class='ml-2' href='<?php echo URL_Make('/explore'); ?>'>
                <h3 style="color:#ffffff;">
                    <?php echo $community_name['name']; ?>
                </h3>
            </a>
        </div>
        <div class="container-fluid" style='box-shadow: 0px 5px 8px #cccccc7d00;'>
            <div class="menu-caro" style='border-bottom:none'>
                <div class="row">
                    <div class="col-lg-8">
                        <!--<div class="sidemenu" style='float:left;margin-right:10px' id='sidemenu-btn'>
                            <i>
                                <svg id="side-menu" style="stroke:#ffffff;" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nav-switch-icon feather feather-menu">
                                    <path d="M3,12L21,12" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                                    <path d="M3,6L21,6" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                                    <path d="M3,18L21,18" style="stroke-dasharray: 18, 38; stroke-dashoffset: 0;"></path>
                                </svg>
                            </i>
                        </div>-->
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