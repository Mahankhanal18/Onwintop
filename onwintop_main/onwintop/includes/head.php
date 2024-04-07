<?php
//get branding code
$brand = R::findOne("branding", "community_id=?", [$_SESSION['community_id']]);
$info = R::findOne("communities", "link=?", [$_SESSION['community_id']]);

$colors = json_decode($brand['colors'], true);
//echo $brand['colors'];


$custom_codes = array();
if (empty($brand)) {
    $color = '{"post_background": "#4d92c7","post_text": "#f5f5f5","background_color": "#ffffff","header_text_color": "#000000","body_text_color": "#454545"}';
    $colors = json_decode($color, true);
}


//get custom code
$custom_codes = R::findOne("custom_code", "WHERE community_link=?", [$_SESSION['community_id']]);
if (!empty($custom_codes)) {
    foreach ($custom_codes as $custom_code) {
        echo $custom_code['header'];
    }
}

?>
<meta name="theme-color" content="<?php echo $colors['post_background']; ?>">

<style>
    :root {
        --banner-text: #ffffff;
        --primary-color:
            <?php echo $colors['post_background']; ?>
        ;
        --nav-background:
            <?php echo $colors['post_background']; ?>
            0d;
        --secondary-color:
            <?php echo $colors['post_text']; ?>
        ;
        --primary-color-transparent:
            <?php echo $colors['post_background']; ?>
            73;
        /**Primary color 73% */
        --topnav-color:
            <?php echo $colors['post_background']; ?>
        ;
        --background-color:
            <?php echo $colors['background_color']; ?>
        ;
        --topbar-color:
            <?php echo $colors['post_text']; ?>
        ;
        --footer-color:
            <?php echo $colors['post_text']; ?>
        ;
        --title-text-color:
            <?php echo $colors['header_text_color']; ?>
        ;
        --body-text-color:
            <?php echo $colors['body_text_color']; ?>
        ;
        /**Primary color 90% */
        /*--topbar-color:#f5f5f5;*/
        /*--primary-color: #088dcd;*/
    }

    .info-sec {
        background:
            <?php echo $colors['post_background']; ?>
            40 !important;
        border-radius: 6px;
        display: inline-block;
        padding: 20px;
        width: 100%;
    }

    .btn:focus {
        outline: none !important;
        box-shadow: none !important;
        background-color: var(--primary-color);
    }

    .btn-primary:not(:disabled):not(.disabled).active,
    .btn-primary:not(:disabled):not(.disabled):active,
    .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
    }
</style>
<?php

//favicon
$favicon = 'https://app-dev.onwintop.com/images/favicon.png';
if (isset($colors['favicon_image'])) {
    $favicon = $colors['favicon_image'];
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $info['meta_description']; ?>" />
<meta name="keywords" content="<?php echo $info['meta_keyword']; ?>" />
<meta property="image" content="<?php echo $favicon; ?>" />

<link rel="icon" href="<?php echo $favicon; ?>" type="image/png" sizes="16x16">

<link rel="stylesheet" href="<?php URI('css/uikit.min.css'); ?>">
<link rel="stylesheet" href="<?php URI("css/pagination.css"); ?>">
<link rel="stylesheet" href="<?php URI('css/main.min.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/icofont.min.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/responsive.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/paging.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/style.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/color.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/responsive.css'); ?>">
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->

<script>
    /*function AuthWarning() {
        var login = <?php if ($_SESSION['login'])
            echo 'true';
        else
            echo 'false'; ?>;
        if (!login) {
            document.getElementById('auth_warning').classList.add("active");
            return false;
        } else {
            return true;
        }
    }*/
</script>
<style>
    <?php
    if (isset($colors['font_family']) && $colors['font_family'] != 'Default') { ?>

        @import url('https://fonts.googleapis.com/css2?family=<?php echo $colors['font_family']; ?>&display=swap');

        body {
            font-family: '<?php echo str_replace("+", " ", $colors['font_family']); ?>', serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: '<?php echo str_replace("+", " ", $colors['font_family']); ?>', serif;
        }

    <?php } ?>
    .gap {
        padding-left: 0px;
    }

    .post {
        display: none;
    }

    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl {
        max-width: 1530px;
    }

    svg {
        stroke: var(--primary-color) !important;
    }

    .nav-switch-icon {
        stroke: var(--secondary-color) !important;
    }

    svg:hover {
        stroke: var(--primary-color) !important;
    }

    body {
        animation: fadeInAnimation ease 1s;
        animation-iteration-count: 0.8;
        animation-fill-mode: forwards;
    }

    @keyframes fadeInAnimation {
        0% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }
</style>