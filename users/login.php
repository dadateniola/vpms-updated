<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['login'])) {
    $emailcon = $_POST['emailcont'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "select ID,MobileNumber from tblregusers where  (Email='$emailcon' || MobileNumber='$emailcon') && Password='$password' ");
    $ret = mysqli_fetch_array($query);
    if ($ret > 0) {
        $_SESSION['vpmsuid'] = $ret['ID'];
        $_SESSION['vpmsumn'] = $ret['MobileNumber'];
        header('location:dashboard.php');
    } else {

        echo "<script>alert('Invalid Details.');</script>";
    }
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>

    <title>VPMS-Login Page</title>


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
</head>

<body>

    <div class="form-content">
    <div class="slide">
            <div class="slide-overlay"></div>
            <img src="../assets/img/slides ver/slide (1).jpg">
        </div>
        <div class="form-content-box">
            <div class="back-to-home">
                <a href="../index.php">back to home</a>
            </div>
            <form class="form-box" method="post">
                <div class="form-head">
                    <h1>sign in</h1>
                    <p>Enter credentials to get account access.</p>
                </div>
                <div class="form-item">
                    <label>Email or Contact Number:</label>
                    <input type="text" name="emailcont" required="true" placeholder="Enter your Email or Contact Number" required="true">
                </div>
                <div class="form-item">
                    <label>Password:</label>
                    <input type="password" name="password" placeholder="Enter your password" required="true">
                    <div class="flex-right">
                        <a href="forgot-password.php">Forgotten Password?</a>
                    </div>
                </div>
                <div class="form-item">
                    <button type="submit" name="login">Sign in</button>
                    <div class="flex-left">
                        <span>Don't have an account?,</span>
                        <a href="signup.php">Sign Up</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libraries/gsap/gsap.min.js"></script>
    <script src="../admin/assets/js/main.js"></script>

</body>

</html>