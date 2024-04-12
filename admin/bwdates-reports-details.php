<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {



?>
    <!doctype html>

    <html class="no-js" lang="">

    <head>

        <title>VPMS - Reports</title>


        <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
        <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    </head>

    <body class="scroll" data-menu="rep">

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <?php
            $fdate = $_POST['fromdate'];
            $tdate = $_POST['todate'];
            ?>
            <div class="dash-head small">
                <h1>Report From <span><?php echo $fdate ?></span> to <span><?php echo $tdate ?></span></h1>
            </div>
            <div class="dash-cont">
                <?php
                $ret = mysqli_query($con, "SELECT DATE(InTime) AS report_date, TIME(InTime) AS report_time, Msg FROM tblreports WHERE DATE(InTime) BETWEEN '$fdate' AND '$tdate' ORDER BY InTime DESC");
                $count = 1;

                $num = mysqli_num_rows($ret);
                if ($num > 0) { ?>
                    <?php while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <div class="dash-report-box">
                            <div class="dash-report">
                                <div class="dash-report-index">
                                    <h1><?php echo $count ?></h1>
                                </div>
                                <div class="dash-report-text">
                                    <h6 data-date="<?php echo $row['report_date']; ?>"></h6>
                                    <p><?php echo $row['Msg']; ?>.</p>
                                    <span><?php echo $row['report_time']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php $count++ ?>
                    <?php }  ?>
                <?php } else { ?>
                    <h4>no reports available</h4>
                <?php } ?>
                <div class="space"></div>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="../assets/libraries/gsap/gsap.min.js"></script>
        <script src="assets/js/main.js"></script>


    </body>

    </html>
<?php }  ?>