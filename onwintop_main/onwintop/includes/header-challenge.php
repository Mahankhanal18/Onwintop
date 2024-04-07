<style>
    #community-switch {
        background-color: transparent;
        color: #333;
        margin-top: 5px;
        border: 1px solid #e5e5e5;
        width: 300px;
        text-align: left;
    }
    .leftpanel{
    padding-bottom:400px;
    height:900px !important;
    background-color: var(--theme);
}
.rightpanel{
    height:100vh !important;
}
.form-control{
    border:none;
    border-radius: 0px;
    border-bottom: 1px solid #a1a1a1 !important;
}
.form-control:focus{
    border-color: none !important;
    box-shadow: none !important; 
    color: var(--theme);
}
.btn:focus{
    border-color: none !important;
    box-shadow: none !important; 
}
.form-check-input:focus{
    border-color: none !important;
    box-shadow: none !important; 
    color: var(--theme);
}
.operation-holder{
    width:100%;
    position:fixed;
    z-index: 9;
    bottom: 0px;
}
.operation-board{
    background-color: #ffffff !important;
    border-top: 1px solid #ebebeb;
    box-shadow: 0px 0px 10px #ebebeb;
    padding:10px;
}
.form-check-input:checked {
    background-color: var(--theme);
    border-color: var(--theme);
}
select:focus{
    border-color: none !important;
    box-shadow: none !important; 
}
.form-check-label{
    color:#a1a1a1;
    font-size: 13px;
}
.theme-holder:hover{
    cursor: pointer;
}
.nav-menu{
    display:inline;
}
.nav-menu li{
    display:inline;
}
</style>
<div style="background-color: #ffffff;padding:20px;z-index:9999999999;">
    <div class='container'>
        <div class='row px-5' style='background-color:#ffffff;'>
            <div class='col-md-8' style='padding-right:20px;align-items: center;display: flex;'>
                <ul class="nav-menu p-2">
                    <li><a href="<?php echo $_ENV['project_url'].$community_id."/challange-focus/";?>discussions">Discussion</a></li>
                    
                    <?php
                    if($tenant['plan']=='NULL'){?>
                        <li><a href="<?php echo $_ENV['project_url'].$community_id."/choose-subscription";?>">Challenges</a></li>
                        <li><a href="<?php echo $_ENV['project_url'].$community_id."/choose-subscription";?>">Rewards</a></li>
                        <li><a href="<?php echo $_ENV['project_url'].$community_id."/choose-subscription";?>">Contents</a></li>
                        <?php } else{ ?>
                        <li><a href="<?php echo $_ENV['project_url'].$community_id."/challange-focus/";?>challenges">Challenges</a></li>
                        <li><a href="<?php URL('/rewards');?>">Rewards</a></li>
                        <li><a href="<?php URL('/channels');?>">Contents</a></li>
                    <?php } ?>
                    
                    
                </ul>
            </div>
            <div class='col-md-4' style='display:flex;align-items:center;justify-content:right;'>
                <!--
                <b style='color:#929090;'><i class='fa fa-coins'></i>&nbsp; 0 &nbsp;&nbsp;</b>
                <a href='https://app-dev.onwintop.com/4e2uq/profile'><img src='https://ui-avatars.com/api/?name=Test Test&background=random' style='height:35px;width:35px;border-radius:50%;' /></a>
                -->
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-light px-2 py-5" style="background-color:<?php echo $colors['post_background'];?> !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 px-5">
                <h2 class='text-white'>
                    <?php
                        if(strlen($branding['logo'])!=0){
                            echo "<img src='".$branding['logo']."' style='max-width: 180px !important;padding-right:20px;border-right:3px solid #ffffff;margin-right:20px' alt='Logo'>";
                        }
                    ?>
                    <b id='header'><?php echo $community['name'];?></b>
                </h2>
            </div>
        </div>
    </div>
</nav>

