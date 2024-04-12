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

        <title>VPMS - View Vehicle Detail</title>


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

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>View <span>Vehicle Details</span></h1>
            </div>

            <div class="dash-table">
                <?php
                $cid = $_GET['viewid'];
                $ret = mysqli_query($con, "select * from tblvehicle where ID='$cid'");
                $cnt = 1;
                while ($row = mysqli_fetch_array($ret)) {
                ?> <table class="table table-bordered mg-b-0">
                        <tr>
                            <th>Parking Number</th>
                            <td><?php echo $row['ParkingNumber']; ?></td>
                        </tr>
                        <tr>
                            <th>Vehicle Category</th>
                            <td><?php echo $row['VehicleCategory']; ?></td>
                        </tr>
                        <tr>
                            <th>Vehicle Company Name</th>
                            <td><?php echo $packprice = $row['VehicleCompanyname']; ?></td>
                        </tr>
                        <tr>
                            <th>Registration Number</th>
                            <td><?php echo $row['RegistrationNumber']; ?></td>
                        </tr>
                        <tr>
                            <th>Owner Name</th>
                            <td><?php echo $row['OwnerName']; ?></td>
                        </tr>
                        <tr>
                            <th>Owner Contact Number</th>
                            <td><?php echo $row['OwnerContactNumber']; ?></td>
                        </tr>
                        <tr>
                            <th>In Time</th>
                            <td><?php echo $row['InTime']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td> <?php
                                    if ($row['Status'] == "") {
                                        echo "Vehicle In";
                                    }
                                    if ($row['Status'] == "Out") {
                                        echo "Vehicle out";
                                    }; ?></td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td><?php echo $row['Remark']; ?></td>
                        </tr>
                        <tr>
                        <tr>
                            <th>Parking Fee</th>
                            <td><?php echo $row['ParkingCharge']; ?></td>
                        </tr>
                    </table><?php } ?>
            </div>

            <div class="space"></div>
        </div>

        <div class="clearfix"></div>

        <?php include_once('includes/footer.php'); ?>

        </div>

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