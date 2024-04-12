<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $adminuser = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "select ID from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret = mysqli_fetch_array($query);
    if ($ret > 0) {
        $_SESSION['vpmsaid'] = $ret['ID'];
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
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="bg-dark">

    <div class="form-content">
        <div class="form-content-box">
            <div class="back-to-home">
                <a href="../index.php">back to home</a>
            </div>
            <form class="form-box" method="post">
                <div class="form-head">
                    <h1>admin login</h1>
                    <p>Enter credentials to get account access.</p>
                </div>
                <div class="form-item">
                    <label>User Name</label>
                    <input class="form-control" type="text" placeholder="Username" required="true" name="username">
                </div>
                <div class="form-item">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                    <div class="flex-right">
                        <a href="forgot-password.php">Forgotten Password?</a>
                    </div>
                </div>
                <div class="form-item">
                    <button type="submit" name="login">Log in</button>
                </div>
            </form>
        </div>
        <div class="slide" data-slide="13">
            <div class="slide-overlay"></div>
            <img src="../assets/img/slides ver/slide (13).jpg">
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