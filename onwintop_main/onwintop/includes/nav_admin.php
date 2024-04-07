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
</style>

<div class="responsive-header">
    <div class="logo res"></div>

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

<nav class="sidebar hide" id='sidenav'>
    <ul class="menu-slide">
        <li class="">
            <a class="" href="<?php echo $root . "admin/admin-users"; ?>" title="">
                <i class="">
                    <svg class="feather feather-users" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle r="4" cy="7" cx="9" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </i> Users
            </a>
        </li>
        <li class="">
            <a class="" href="<?php echo $root . "admin/account-admin"; ?>" title="">
                <i class="">
                    <svg id="ab3" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                        <path d="M12,2L15.09,8.26L22,9.27L17,14.14L18.18,21.02L12,17.77L5.82,21.02L7,14.14L2,9.27L8.91,8.26L12,2Z" style="stroke-dasharray: 70, 90; stroke-dashoffset: 0;"></path>
                    </svg>
                </i>
                Billings
            </a>
        </li>
        <li class="">
            <a class="" href="<?php echo $root . "admin/account-wallet/6x0ey"; ?>" title="">
                <i class="">
                    <svg class="feather feather-zap" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                    </svg>
                </i>
                Account Wallet
            </a>
        </li>
        <li class="">
            <a class="" href="<?php echo $root . "admin/admin-api-clients"; ?>" title="">
                <i class="">
                    <svg class="feather feather-zap" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                    </svg>
                </i>
                API Clients
            </a>
        </li>
        <li class="">
            <a class="" href="<?php echo $root . "admin/admin-close-account"; ?>" title="">
                <i class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                </i>
                Close Account
            </a>
        </li>




    </ul>
</nav><!-- nav sidebar -->