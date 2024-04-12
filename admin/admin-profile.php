<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['vpmsaid'];
        $aname = $_POST['adminname'];
        $mobno = $_POST['contactnumber'];

        $current = mysqli_query($con, "SELECT * FROM tbladmin WHERE ID='$adminid'");
        $info = mysqli_fetch_array($current);
        $currentName = $info['AdminName'];

        $query = mysqli_query($con, "update tbladmin set AdminName ='$aname', MobileNumber='$mobno' where ID='$adminid'");

        $msg = "admin |$currentName| changed their name to |$aname|";
        $report = "INSERT INTO tblreports (Msg) VALUES ('$msg')";
        $logReport = mysqli_query($con, $report);
        if ($query) {
            echo '<script>alert("Admin profile has been updated.")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
    <!doctype html>
    <html class="no-js" lang="">

    <head>

        <title>VPMS - Admin Profile</title>

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

    <body class="scroll">

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>Admin <span>profile</span></h1>
            </div>
            <div class="dash-cont">
                <form class="add-vehicle-form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <?php
                    $adminid = $_SESSION['vpmsaid'];
                    $ret = mysqli_query($con, "select * from tbladmin where ID='$adminid'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($ret)) {

                    ?>
                        <div class="form-item">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Admin Name</label></div>
                            <div class="col-12 col-md-9"><input class=" form-control" id="adminname" name="adminname" type="text" value="<?php echo $row['AdminName']; ?>"></div>
                        </div>
                        <div class="form-item">
                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">User Name</label></div>
                            <div class="col-12 col-md-9"><input class=" form-control" id="username" name="username" type="text" value="<?php echo $row['UserName']; ?>" readonly='true'></div>
                        </div>
                        <div class="form-item">
                            <div class="col col-md-3"><label for="password-input" class=" form-control-label">Contact Number</label></div>
                            <div class="col-12 col-md-9"> <input class="form-control " id="contactnumber" name="contactnumber" type="text" value="<?php echo $row['MobileNumber']; ?>" required="true"></div>
                        </div>
                        <div class="form-item">
                            <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-9"><input class="form-control " id="email" name="email" type="email" value="<?php echo $row['Email']; ?>" required="true" readonly='true'></div>
                        </div>
                    <?php } ?>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit">Update</button>
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