<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vpmsuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $userid = $_SESSION['vpmsuid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $query1 = mysqli_query($con, "select ID from tblregusers where ID='$userid' and   Password='$cpassword'");
        $row = mysqli_fetch_array($query1);
        if ($row > 0) {
            $ret = mysqli_query($con, "update tblregusers set Password='$newpassword' where ID='$userid'");

            echo '<script>alert("Your password successully changed.")</script>';
        } else {
            echo '<script>alert("Your current password is wrong.")</script>';
        }
    }


?>
    <!doctype html>
    <html class="no-js" lang="">

    <head>

        <title>VPMS - Change Password</title>


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
        <script type="text/javascript">
            function checkpass() {
                if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    alert('New Password and Confirm Password field does not match');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>

    </head>

    <body class="scroll">

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>Change <span>password</span></h1>
            </div>
            <div class="dash-cont">
                <form class="add-vehicle-form" action="" method="post" class="form-horizontal" name="changepassword" onsubmit="return checkpass();">
                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Current Password</label></div>
                        <div class="col-12 col-md-9"><input type="password" name="currentpassword" class=" form-control" required="true" value=""></div>
                    </div>
                    <div class="form-item">
                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">New Password</label></div>
                        <div class="col-12 col-md-9"><input type="password" name="newpassword" class="form-control" value="" required="true"></div>
                    </div>
                    <div class="form-item">
                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Confirm Password</label></div>
                        <div class="col-12 col-md-9"> <input type="password" name="confirmpassword" class="form-control" value="" required="true"></div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit">Change</button>
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
        <script src="../admin/assets/js/main.js"></script>

    </body>

    </html>
<?php }  ?>