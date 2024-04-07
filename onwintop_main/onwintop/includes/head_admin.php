<?php
$db = new Database();
?>
<meta name="theme-color" content="#4d92c7">
<style>
    :root {
        --banner-text: #ffffff;
        --primary-color: #4d92c7;
        --secondary-color: #f5f5f5;
        --primary-color-transparent: #4d92c773;
        /**Primary color 73% */
        --background-color: #ffffff;
        --topbar-color: #f5f5f5;
        --footer-color: #f5f5f5;
        --title-text-color: #000000;
        --body-text-color: #454545;
        /**Primary color 90% */
        /*--topbar-color:#f5f5f5;*/
        /*--primary-color: #088dcd;*/
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="icon" href="<?php URI('images/fav.png'); ?>" type="image/png" sizes="16x16">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/css/uikit.min.css" />
<link rel="stylesheet" href="<?php URI('css/main.min.css'); ?>">
<link rel="stylesheet" href='css/icofont.min.css'>
<link rel="stylesheet" href="<?php URI('css/responsive.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/paging.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/style.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/color.css'); ?>">
<link rel="stylesheet" href="<?php URI('css/responsive.css'); ?>">
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    function AuthWarning() {
        var login = <?php if ($_SESSION['login']) echo 'true';
                    else echo 'false'; ?>;
        if (!login) {
            document.getElementById('auth_warning').classList.add("active");
            return false;
        } else {
            return true;
        }
    }
</script>