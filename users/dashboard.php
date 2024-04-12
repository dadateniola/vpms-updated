<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vpmsuid'] == 0)) {
    header('location:logout.php');
} else { ?>


    <!doctype html>

    <html class="no-js" lang="">

    <head>

        <title>VPMS - User Dashboard</title>


        <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
        <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="../admin/assets/css/style.css">
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    </head>

    <body class="scroll" data-menu="dash">

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>Welcome to the panel,<br>
                    <?php
                    $uid = $_SESSION['vpmsuid'];
                    $ret = mysqli_query($con, "select * from tblregusers where ID='$uid'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <span><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></span>
                    <?php } ?>
                </h1>
            </div>
            <div class="dash-slide">
                <div class="dash-over-top">
                    <div class="dash-over-cont">
                        <div class="dash-over-img">
                            <img src="../assets/img/register.jpg">
                        </div>
                        <p>Nice to see everything’s been going alright. We hope to be of use to you today.</p>
                    </div>
                    <svg class="dash-top-curve" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M0 0H40V40L39.8921 37.9502C38.8165 17.5126 22.4874 1.18355 2.04976 0.107882L0 0Z" fill="#FFFFFA" />
                    </svg>
                    <svg class="dash-bottom-curve" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M0 0H40V40L39.8921 37.9502C38.8165 17.5126 22.4874 1.18355 2.04976 0.107882L0 0Z" fill="#FFFFFA" />
                    </svg>
                </div>
                <div class="slide" data-slide="22" data-max="5">
                    <div class="slide-overlay"></div>
                    <img src="../assets/img/slides ver/slide (22).jpg">
                </div>
            </div>
        </div>

        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="../assets/libraries/gsap/gsap.min.js"></script>
        <script src="../admin/assets/js/main.js"></script>

        <!--  Chart js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

        <!--Chartist Chart-->
        <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
        <script src="../admin/assets/js/init/weather-init.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
        <script src="../admin/assets/js/init/fullcalendar-init.js"></script>

    </body>

    </html>
<?php } ?>