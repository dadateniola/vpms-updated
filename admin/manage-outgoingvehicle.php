<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // For deleting    
    if ($_GET['del']) {
        $catid = $_GET['del'];

        $current = mysqli_query($con, "SELECT * FROM tblvehicle WHERE ID='$catid'");
        $info = mysqli_fetch_array($current);
        $currentName = $info['VehicleCompanyname'];

        mysqli_query($con, "delete from tblvehicle where ID ='$catid'");

        $msg = "an outgoing vehicle |$currentName| was deleted from the system";
        $report = "INSERT INTO tblreports (Msg) VALUES ('$msg')";
        $logReport = mysqli_query($con, $report);

        echo "<script>alert('Data Deleted');</script>";
        echo "<script>window.location.href='manage-outgoingvehicle.php'</script>";
    }

?>
    <!doctype html>

    <html class="no-js" lang="">

    <head>

        <title>VPMS - Manage Incoming Vehicley</title>


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

    <body class="scroll" data-menu="veh">

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>Manage <span>outgoing vehicle</span></h1>
            </div>
            <div class="dash-box">
                <?php
                $ret = mysqli_query($con, "select *from   tblvehicle where Status='Out'");
                $cnt = 1;
                while ($row = mysqli_fetch_array($ret)) {
                ?>
                    <div class="dash-item caps" data-type="pe" data-random="a">
                        <div class="dash-img"></div>
                        <p><?php echo $row['OwnerName']; ?></p>
                        <a class="dash-btn dash-btn-back" href="view-outgoingvehicle-detail.php?viewid=<?php echo $row['ID']; ?>">
                            <img src="../assets/img/back.png" alt="">
                        </a>
                        <a class="dash-btn dash-btn-edit" href="print.php?vid=<?php echo $row['ID']; ?>" target="_blank">
                            <img src="../assets/img/printer.png" alt="">
                        </a>
                        <a class="dash-btn dash-btn-print" href="manage-outgoingvehicle.php?del=<?php echo $row['ID']; ?>" onClick="return confirm('Are you sure you want to delete?')">
                            <img src="../assets/img/trash.png" alt="">
                        </a>
                    </div>
                <?php
                    $cnt = $cnt + 1;
                } ?>
            </div>
            <div class="space"></div>
        </div>

        <?php include_once('includes/footer.php'); ?>

        </div>

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