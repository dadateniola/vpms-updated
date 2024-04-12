<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];

    $query = mysqli_query($con, "select ID from tbladmin where  Email='$email' and MobileNumber='$contactno' ");
    $ret = mysqli_fetch_array($query);
    if ($ret > 0) {
        $_SESSION['contactno'] = $contactno;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
    } else {

        echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>

    <title>VPMS-Forgot Page</title>


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

<body class="bg-dark">

    <div class="form-content">
        <div class="form-content-box">
            <div class="back-to-home">
                <a href="../index.php">back to home</a>
            </div>
            <form class="form-box" method="post">
                <div class="form-head">
                    <h1>admin recovery</h1>
                    <p>Don't worry, we've got you covered.</p>
                </div>
                <div class="form-item">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" autofocus required="true">
                </div>
                <div class="form-item">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="contactno" placeholder="Mobile Number" required="true">
                </div>
                <div class="form-item">
                    <button type="submit" name="submit">Next</button>
                    <div class="flex-left">
                        <span>Have you retried?,</span>
                        <a href="index.php">Signin</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="slide" data-slide="16">
            <div class="slide-overlay"></div>
            <img src="../assets/img/slides ver/slide (16).jpg">
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