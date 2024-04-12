<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
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
            <div class="dash-head">
                <h1>Generate <span>report</span></h1>
            </div>
            <div class="dash-cont">
                <?php
                $query = mysqli_query($con, "SELECT MIN(DATE(inTime)) AS farthest_date FROM tblreports");
                $row = mysqli_fetch_array($query)
                ?>
                <form class="add-vehicle-form" action="bwdates-reports-details.php" method="post" enctype="multipart/form-data" class="form-horizontal" name="bwdatesreport">
                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">From Date</label></div>
                        <div class="col-12 col-md-9"><input type="date" name="fromdate" id="fromdate" class="form-control" required="true" value="<?php echo $row['farthest_date']; ?>" min="<?php echo $row['farthest_date']; ?>"></div>
                    </div>
                    <div class="form-item">
                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">To Date</label></div>
                        <div class="col-12 col-md-9"><input type="date" name="todate" class="form-control" required="true" data-date="current" min="<?php echo $row['farthest_date']; ?>"></div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
                    </div>
                </form>
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