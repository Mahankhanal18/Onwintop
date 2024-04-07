<?php include "init.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Page Title | <?php echo $title; ?>
	</title>
	<?php include "includes/head.php"; ?>
	<!--Link to additional resource files-->
	<link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
		integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
	<div class="theme-layout">
		<!--Header-->
		<?php include "includes/header2.php"; ?>
		<!--Navigation-->
		<?php include "includes/nav.php"; ?>
        <section>
            <!--Put all contents here-->



        </section>
        <?php include "includes/footer.php"; ?>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
</body>

</html>