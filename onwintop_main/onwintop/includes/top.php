<header class="transparent">
    <div class="topbar">
        <?php
        $logo = "";
        if (strlen($data['logo']) != 0) {
            $logo = "<img src='" . $data['logo'] . "' style='max-width: 240px !important;' alt=''>";
        }
        ?>
        <div class="logo"><?php echo $logo;?></div>
        <?php echo $logo;?>
        <div class="searches">
            <form action='<?php echo URL_Make('/search/');?>'>
                <input type="text" name='q' id='search-text' placeholder="Search...">
                <button type="submit"><i class="icofont-search"></i></button>
                <span class="cancel-search"><i class="icofont-close"></i></span>
                <div class="recent-search">
                    <h4 class="recent-searches">Your's Recent Search</h4>
                    <ul class="so-history">
                        <!--<li>
                            <div class="searched-user">
                                <figure><img src="<?php echo URI('images/resources/user1.jpg'); ?>" alt=""></figure>
                                <span>Danial Carabal</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="<?php echo URI('images/resources/user2.jpg'); ?>" alt=""></figure>
                                <span>Maria K</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="<?php echo URI('images/resources/user3.jpg'); ?>" alt=""></figure>
                                <span>Fawad Khan</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="<?php echo URI('images/resources/user4.jpg'); ?>" alt=""></figure>
                                <span>Danial Sandos</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>
                        <li>
                            <div class="searched-user">
                                <figure><img src="<?php echo URI('images/resources/user5.jpg'); ?>" alt=""></figure>
                                <span>Jack Carter</span>
                            </div>
                            <span class="trash"><i class="icofont-close-circled"></i></span>
                        </li>-->
                    </ul>
                </div>
            </form>
        </div>
        <ul>

            <li><a title=""><img src="<?php echo URI('images/flags/US.png'); ?>" alt=""></a></li>
            <?php
            if (LoggedIn()) {
                echo '<li><a class="join-butn" href="'.URL_Make('/profile').'" title="">Profile</a></li>';
            } else {
                echo '<li><a href="'.URL_Make('/signin').'" title="">Login / Register</a></li>';
            }
            ?>

        </ul>
    </div>
</header>