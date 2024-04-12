<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $parkingnumber = mt_rand(100000000, 999999999);
        $catename = $_POST['catename'];
        $vehcomp = $_POST['vehcomp'];
        $vehreno = $_POST['vehreno'];
        $ownername = $_POST['ownername'];
        $ownercontno = $_POST['ownercontno'];
        $enteringtime = $_POST['enteringtime'];

        $query = mysqli_query($con, "insert into  tblvehicle(ParkingNumber,VehicleCategory,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber) value('$parkingnumber','$catename','$vehcomp','$vehreno','$ownername','$ownercontno')");

        $msg = "a |$catename| with the name |$vehcomp| was added with its owner being |$ownername|";
        $report = "INSERT INTO tblreports (Msg) VALUES ('$msg')";
        $logReport = mysqli_query($con, $report);
        if ($query) {
            echo "<script>alert('Vehicle Entry Detail has been added');</script>";
            echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
?>
    <!doctype html>
    <html class="no-js" lang="">

    <head>

        <title>VPMS - Add Vehicle</title>


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

        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    </head>

    <body class="scroll" data-menu="veh">
        <?php include_once('includes/sidebar.php'); ?>
        <!-- Right Panel -->

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>Add <span>vehicle</span></h1>
            </div>
            <div class="dash-cont">
                <form method="post" enctype="multipart/form-data" class="add-vehicle-form">
                    <div class="form-item">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Category</label></div>
                        <div class="col-12 col-md-9 select-box">
                            <img src="../assets/img/arrow down.png" alt="arrow">
                            <select name="catename" id="catename" class="form-control">
                                <option value="0">Select Category</option>
                                <?php $query = mysqli_query($con, "select * from tblcategory");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['VehicleCat']; ?>"><?php echo $row['VehicleCat']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Vehicle Company</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="vehcomp" name="vehcomp" class="form-control" placeholder="Vehicle Company" required="true"></div>
                    </div>

                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Registration Number</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="vehreno" name="vehreno" class="form-control" placeholder="Registration Number" required="true"></div>
                    </div>
                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Owner Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="ownername" name="ownername" class="form-control" placeholder="Owner Name" required="true"></div>
                    </div>
                    <!-- <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Owner Contact Number</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="ownercontno" name="ownercontno" class="form-control" placeholder="Owner Contact Number" required="true" maxlength="10" pattern="[0-9]+"></div>
                    </div> -->
                    <div class="form-item">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Owner Contact Number</label></div>
                        <div class="col-12 col-md-9 select-box">
                            <img src="../assets/img/arrow down.png" alt="arrow">
                            <select name="ownercontno" id="ownercontno" class="form-control">
                                <option value="0">Select Number</option>
                                <?php $query = mysqli_query($con, "select * from tblregusers");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['MobileNumber']; ?>"><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit">Add Vehicle</button>
                    </div>
                </form>
            </div>
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