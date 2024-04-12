<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsuid'] == 0)) {
    header('location:logout.php');
} else {



?>
    <!doctype html>

    <html class="no-js" lang="">

    <head>

        <title>VPMS - View Vehicle Parking Details</title>


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

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    </head>

    <body class="scroll" data-menu="view">
        <!-- Left Panel -->

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>View <span>Vehicle Parking Details</span><br>(on the basis of <span>Registered Mobile No</span>)</h1>
            </div>

            <div class="dash-box">
                <?php
                $ownerno = $_SESSION['vpmsumn'];
                $ret = mysqli_query($con, "select tblregusers.FirstName,tblregusers.LastName,tblregusers.MobileNumber,tblregusers.Email,tblvehicle.VehicleCompanyname,tblvehicle.VehicleCategory,tblvehicle.VehicleCompanyname,tblvehicle.RegistrationNumber,tblvehicle.OwnerName,tblvehicle.ID as vehid,tblvehicle.OwnerContactNumber,tblvehicle.InTime,tblvehicle.OutTime from tblvehicle join tblregusers on tblregusers.MobileNumber= tblvehicle.OwnerContactNumber where tblvehicle.OwnerContactNumber='$ownerno'");

                $num = mysqli_num_rows($ret);
                if ($num > 0) { ?>
                    <?php while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <div class="dash-item caps" data-type="<?php echo $row['VehicleCategory']; ?>">
                            <div class="dash-img"></div>
                            <p><?php echo $row['VehicleCompanyname']; ?></p>
                            <a class="dash-btn dash-btn-print" target="_blank" href="print.php?vid=<?php echo $row['vehid']; ?>">
                                <img src="../assets/img/printer.png" alt="">
                            </a>
                            <a class="dash-btn dash-btn-back" href="view--detail.php?viewid=<?php echo $row['vehid']; ?>">
                                <img src="../assets/img/back.png" alt="">
                            </a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h4>no vehicles registered</h4>
                <?php }?>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php include_once('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="../assets/libraries/gsap/gsap.min.js"></script>
        <script src="../admin/assets/js/main.js"></script>

    </body>

    </html>
<?php }  ?>