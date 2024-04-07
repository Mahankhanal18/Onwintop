<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tellselling | We help you grow digitally</title>
  <?php include "includes/head.php";?>
</head>

<body>
  <div class="page-loader" id="page-loader">

    <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>

  </div>

  <div class="theme-layout">
    <?php include "includes/header.php";?>
    <?php include "includes/top.php";?>
    <?php include "includes/nav.php";?>
    <section>
      <div class="gap overlap nogap mate-black low-opacity">
        <div class="bg-image" style="background-image: url(https://source.unsplash.com/random/1919x810/?nature)"></div>
        <div class="feature-meta">
          <h1>Welcome to the Tellselling Community</h1>
          <h3>The community for Community Managers</h3>
          <a href="#" title="" class="main-btn" data-ripple="">Join Free Now</a>
          <a href="#" title="" class="main-btn" data-ripple="">External link</a>
        </div>
      </div>
    </section>

    <section>
      <div class="gap no-bottom grey-bg nogap">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="info-sec">
                <i class="icofont-checked"></i>
                <div>
                  <h6>Get started</h6>
                  <p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="info-sec">
                <i class="icofont-play-alt-1"></i>
                <div>
                  <h6>Assistance</h6>
                  <p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="info-sec">
                <i class="icofont-clock-time"></i>
                <div>
                  <h6>Start exploring</h6>
                  <p>Share your research, collaborate with your peers, and get the support you need to advance your career.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php //include "widgets/recent_events.php";?>
    <?php include "widgets/promo.php";?>
    <?php //include "widgets/rooms.php";?>
    <?php include "widgets/channels.php";?>
    <?php //include "widgets/promo.php";?>
    <?php //include "widgets/team.php";?>
    <?php //include "widgets/advisor_group.php";?>


    <?php include "includes/footer.php";?>

  </div>

<?php include "includes/scripts.php";?>


</body>

</html>