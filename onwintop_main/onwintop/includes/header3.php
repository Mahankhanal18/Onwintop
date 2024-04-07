

    <header class="">
    <div class="topbar stick">
        <div class="sidemenu">
            <i>
                <svg id="side-menu" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></i>
        </div>
        <?php
        $logo = "";
        if (strlen($data['logo']) != 0) {
            $logo = "<img src='" . $data['logo'] . "' style='max-width: 240px !important;' alt=''>";
        }
        ?>
        <a href="<?php echo URL('/'); ?>">
            <div class="logo"><?php echo $logo; ?></div>
        </a>
        <div class="searches">
            
            <form action="<?php echo URL_Make('/search/');?>">
                <input type="text" name='q' id='search-text' placeholder="Search...">
                <button type="submit"><i class="icofont-search"></i></button>
                <span class="cancel-search"><i class="icofont-close"></i></span>
                <?php print_r(getCookieData('search'));?>
                <!--<div class="recent-search">
                    <h4 class="recent-searches">Your's Recent Search</h4>
                    <ul class="so-history">
                        <li>
                            <div class="searched-user">
                                <figure><img src="images/resources/user1.jpg" alt=""></figure>
                                <span>Danial Carabal</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="images/resources/user2.jpg" alt=""></figure>
                                <span>Maria K</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="images/resources/user3.jpg" alt=""></figure>
                                <span>Fawad Khan</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="images/resources/user4.jpg" alt=""></figure>
                                <span>Danial Sandos</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="images/resources/user5.jpg" alt=""></figure>
                                <span>Jack Carter</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                    </ul>
                </div>-->
            </form>
        </div>
        <ul class="web-elements">

            <li>
                <a href="<?php URL("");?>" title="Home" data-toggle="tooltip">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg></i>
                </a>
            </li>

            <li class="go-live">
                <?php
                    if($_SESSION['community_login']==1){
                        ?>
                        <a href="<?php URL('/go-live'); ?>" title="Go Live" data-toggle="tooltip">
                                <i>
                                <svg fill="#f00" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18px" height="18px">
                                    <path d="M 6.1015625 6.1015625 C 3.5675625 8.6345625 2 12.134 2 16 C 2 19.866 3.5675625 23.365437 6.1015625 25.898438 L 7.5195312 24.480469 C 5.3465312 22.307469 4 19.308 4 16 C 4 12.692 5.3465312 9.6925313 7.5195312 7.5195312 L 6.1015625 6.1015625 z M 25.898438 6.1015625 L 24.480469 7.5195312 C 26.653469 9.6925312 28 12.692 28 16 C 28 19.308 26.653469 22.307469 24.480469 24.480469 L 25.898438 25.898438 C 28.432437 23.365437 30 19.866 30 16 C 30 12.134 28.432437 8.6345625 25.898438 6.1015625 z M 9.6367188 9.6367188 C 8.0077188 11.265719 7 13.515 7 16 C 7 18.485 8.0077187 20.734281 9.6367188 22.363281 L 11.052734 20.947266 C 9.7847344 19.680266 9 17.93 9 16 C 9 14.07 9.7847344 12.319734 11.052734 11.052734 L 9.6367188 9.6367188 z M 22.363281 9.6367188 L 20.947266 11.052734 C 22.215266 12.319734 23 14.07 23 16 C 23 17.93 22.215266 19.680266 20.947266 20.947266 L 22.363281 22.363281 C 23.992281 20.734281 25 18.485 25 16 C 25 13.515 23.992281 11.265719 22.363281 9.6367188 z M 16 12 A 4 4 0 0 0 16 20 A 4 4 0 0 0 16 12 z" />
                                </svg></i>
                        </a>
                        <?php
                    }else{
                        ?>
                        <a href="<?php URL('/signin'); ?>" title="Go Live" data-toggle="tooltip">
                                <i>
                                <svg fill="#f00" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18px" height="18px">
                                    <path d="M 6.1015625 6.1015625 C 3.5675625 8.6345625 2 12.134 2 16 C 2 19.866 3.5675625 23.365437 6.1015625 25.898438 L 7.5195312 24.480469 C 5.3465312 22.307469 4 19.308 4 16 C 4 12.692 5.3465312 9.6925313 7.5195312 7.5195312 L 6.1015625 6.1015625 z M 25.898438 6.1015625 L 24.480469 7.5195312 C 26.653469 9.6925312 28 12.692 28 16 C 28 19.308 26.653469 22.307469 24.480469 24.480469 L 25.898438 25.898438 C 28.432437 23.365437 30 19.866 30 16 C 30 12.134 28.432437 8.6345625 25.898438 6.1015625 z M 9.6367188 9.6367188 C 8.0077188 11.265719 7 13.515 7 16 C 7 18.485 8.0077187 20.734281 9.6367188 22.363281 L 11.052734 20.947266 C 9.7847344 19.680266 9 17.93 9 16 C 9 14.07 9.7847344 12.319734 11.052734 11.052734 L 9.6367188 9.6367188 z M 22.363281 9.6367188 L 20.947266 11.052734 C 22.215266 12.319734 23 14.07 23 16 C 23 17.93 22.215266 19.680266 20.947266 20.947266 L 22.363281 22.363281 C 23.992281 20.734281 25 18.485 25 16 C 25 13.515 23.992281 11.265719 22.363281 9.6367188 z M 16 12 A 4 4 0 0 0 16 20 A 4 4 0 0 0 16 12 z" />
                                </svg></i>
                        </a>
                        <?php
                    }
                ?>
               
            </li>
            <!--<li>
                <div class="user-dp">
                    <a href="#" title="">
                        <img alt="" src="images/resources/user.jpg">
                        <div class="name">
                            <h4>My Network</h4>
                        </div>
                    </a>
                    <ul class="dropdown">
                        <li><a href="network.html" title=""><i class="icofont-user-alt-3"></i> People</a></li>
                        <li><a href="network.html" title=""><i class="icofont-price"></i> Channel</a></li>
                        <li><a href="network.html" title=""><i class="icofont-question-circle"></i> Event</a></li>
                        <li><a href="network.html" title=""><i class="icofont-gear"></i> Analytics</a></li>
                    </ul>
                </div>
            </li>-->
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
                    <?php
                    if ($_SESSION['community_login'] == 1) {
                    ?>
                        <li><a href="<?php URL('/profile');?>" title=""><i class="icofont-user-alt-3"></i> Your Profile</a></li>
                        <li><a href="<?php URL('/settings');?>" title=""><i class="icofont-gear"></i> Setting</a></li>
                        <!--<li><a href="pay-out.html" title=""><i class="icofont-price"></i> Payout</a></li>
                    <li><a href="nfts.html" title=""><i class="icofont-price"></i> NFTs</a></li>
                    
                    <li><a class="dark-mod" href="#" title=""><i class="icofont-moon"></i> Dark Mode</a></li>-->
                        <li class="logout"><a href="<?php URL('/logout');?>" title=""><i class="icofont-power"></i> Logout</a>
                        </li>
                    <?php
                    }else{
                        ?>
                        <li><a href="<?php URL('/settings');?>" title=""><i class="icofont-user-alt-3"></i> Signin</a></li>
                        <?php
                    }
                    ?>

                </ul>
            </li>
        </ul>
    </div>

</header><!-- header -->