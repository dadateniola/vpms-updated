<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $catname = $_POST['catename'];

        $query = mysqli_query($con, "insert into  tblcategory(VehicleCat) value('$catname')");

        $msg = "a new category |$catname| was added to the system";
        $report = "INSERT INTO tblreports (Msg) VALUES ('$msg')";
        $logReport = mysqli_query($con, $report);
        if ($query) {
            echo "<script>alert('Category added successfully');</script>";
            echo "<script>window.location.href='manage-category.php'</script>";
        } else {

            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
?>
    <!doctype html>
    <html class="no-js" lang="">

    <head>

        <title>VPMS - Add Category</title>


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
                <h1>Add <span>category</span></h1>
            </div>
            <div class="dash-cont">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="catename" name="catename" class="form-control" placeholder="Vehicle Category" required="true"></div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit">Add</button>
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