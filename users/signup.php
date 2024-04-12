<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $ret = mysqli_query($con, "select Email from tblregusers where Email='$email' || MobileNumber='$contno'");
    $result = mysqli_fetch_array($ret);
    if ($result > 0) {

        echo '<script>alert("This email or Contact Number already associated with another account")</script>';
    } else {
        $query = "INSERT INTO tblregusers(FirstName, LastName, MobileNumber, Email, Password) VALUES ('$fname', '$lname','$contno', '$email', '$password' )";
        $addUser = mysqli_query($con, $query);

        $msg = "new user |$fname $lname| was created through the sign-up page";
        $report = "INSERT INTO tblreports (Msg) VALUES ('$msg')";
        $logReport = mysqli_query($con, $report);

        if ($query) {
            echo '<script>alert("You have successfully registered")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>

    <title>VPMS-Signup Page</title>

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
            if (document.signup.password.value != document.signup.repeatpassword.value) {
                alert('Password and Repeat Password field does not match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        }
    </script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="bg-dark">

    <div class="form-content">
        <div class="slide" data-slide="4">
            <div class="slide-overlay"></div>
            <img src="../assets/img/slides ver/slide (4).jpg">
        </div>
        <div class="form-content-box">
            <div class="back-to-home">
                <a href="../index.php">back to home</a>
            </div>
            <form class="form-box" method="post" action="signup.php">
                <div class="form-head">
                    <h1>sign up</h1>
                    <p>Let up help you setup your new account.</p>
                </div>
                <div class="form-item">
                    <label>First Name</label>
                    <input type="text" name="firstname" placeholder="Your First Name..." required="true" class="form-control">
                </div>
                <div class="form-item">
                    <label>Last Name</label>
                    <input type="text" name="lastname" placeholder="Your Last Name..." required="true" class="form-control">
                </div>
                <div class="form-item">
                    <label>Mobile Number</label>
                    <input type="text" name="mobilenumber" maxlength="10" pattern="[0-9]{10}" placeholder="Mobile Number" required="true" class="form-control">
                </div>
                <div class="form-item">
                    <label>Email address</label>
                    <input type="email" name="email" placeholder="Email address" required="true" class="form-control">
                </div>
                <div class="form-item">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required="true" class="form-control">
                </div>
                <div class="form-item">
                    <label>Repeat Password</label>
                    <input type="password" name="repeatpassword" placeholder="Enter repeat password" required="true" class="form-control">
                </div>
                <div class="form-item">
                    <button type="submit" name="submit">Sign Up</button>
                    <div class="flex-left">
                        <span>Already have an account?,</span>
                        <a href="login.php">Sign In</a>
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