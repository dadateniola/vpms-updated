<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if (isset($_POST['submit'])) {
    $contactno = $_SESSION['contactno'];
    $email = $_SESSION['email'];
    $password = md5($_POST['newpassword']);

    $query = mysqli_query($con, "update tbladmin set Password='$password'  where  Email='$email' && MobileNumber='$contactno' ");
    if ($query) {
        echo "<script>alert('Password successfully changed');</script>";
        session_destroy();
    }
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>

    <title>VPMS-Reset Page</title>


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

<body class="bg-dark">

    <div class="form-content">
        <div class="form-content-box">
            <div class="back-to-home">
                <a href="../index.php">back to home</a>
            </div>
            <form class="form-box" method="post">
                <div class="form-head">
                    <h1>admin reset</h1>
                    <p>Last step and your account will be restored.</p>
                </div>
                <div class="form-item">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="newpassword" placeholder="New Password" required="true">
                </div>
                <div class="form-item">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="true">
                </div>
                <div class="form-item">
                    <button type="submit" name="submit">Reset</button>
                    <div class="flex-left">
                        <span>Rember your password?,</span>
                        <a href="index.php">Signin</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="slide" data-slide="19">
            <div class="slide-overlay"></div>
            <img src="../assets/img/slides ver/slide (19).jpg">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libraries/gsap/gsap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>