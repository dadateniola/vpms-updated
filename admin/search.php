<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {



?>
    <!doctype html>

    <html class="no-js" lang="">

    <head>
        <title>VPMS - Search Vehicle</title>

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

    </head>

    <body class="scroll" data-menu="search">

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="dash">
            <div class="dash-head">
                <h1>Search <span>vehicles</span> or <span>users</span></h1>
            </div>
            <div class="dash-cont">
                <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-item">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Search By Name:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="searchdata" name="searchdata" class="form-control" required="required" autofocus="autofocus"></div>
                        <p class="little-text">Search for <span class="wine">"all"</span> to display all records</p>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
                    </div>
                </form>
                <?php
                if (isset($_GET['search'])) {
                    $sdata = strtolower($_GET['searchdata']);
                ?>
                    <div class="dash-result" data-search="<?php echo $sdata; ?>">
                        <?php if ($sdata == 'all') { ?>
                            <h1>Showing <span class="wine">"all"</span> records available</h1>
                        <?php } else { ?>
                            <h1>Result against <span class="wine">"<?php echo $sdata; ?>"</span> keyword </h1>
                        <?php } ?>

                        <?php
                        $ret = ($sdata == 'all')
                            ? mysqli_query($con, "select *from tblregusers order by FirstName")
                            : mysqli_query($con, "select *from tblregusers where FirstName like '%$sdata%' or LastName like '%$sdata%'");
                        $num = mysqli_num_rows($ret);
                        if ($num > 0) { ?>
                            <div class="dash-result-item">
                                <div class="dash-result-head">
                                    <h1>users</h1>
                                </div>
                                <div class="dash-box">
                                    <?php while ($row = mysqli_fetch_array($ret)) { ?>
                                        <div class="dash-item caps" data-type="pe">
                                            <div class="dash-img"></div>
                                            <p><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></p>
                                            <a class="dash-btn dash-btn-back" href="view-user-details.php?viewid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/back.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-print" href="delete.php?del=<?php echo $row['ID']; ?>&type=user" onClick="return confirm('Are you sure you want to delete?')">
                                                <img src="../assets/img/trash.png" alt="">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        $ret = ($sdata == 'all')
                            ? mysqli_query($con, "select *from tblvehicle order by VehicleCompanyname asc")
                            : mysqli_query($con, "select *from tblvehicle where VehicleCompanyname like '%$sdata%' order by VehicleCompanyname asc");
                        $num = mysqli_num_rows($ret);
                        if ($num > 0) { ?>
                            <div class="dash-result-item">
                                <div class="dash-result-head">
                                    <h1>vehicles</h1>
                                </div>
                                <div class="dash-box">
                                    <?php while ($row = mysqli_fetch_array($ret)) { ?>
                                        <div class="dash-item" data-type="<?php echo $row['VehicleCategory']; ?>">
                                            <div class="dash-img"></div>
                                            <p><?php echo $row['VehicleCompanyname']; ?></p>
                                            <a class="dash-btn dash-btn-back" href="view-vehicle-details.php?viewid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/back.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-edit" href="print.php?vid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/printer.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-print" href="delete.php?del=<?php echo $row['ID']; ?>&type=vehicle" onClick="return confirm('Are you sure you want to delete?')">
                                                <img src="../assets/img/trash.png" alt="">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        $ret = ($sdata == 'all')
                            ? mysqli_query($con, "select *from tblvehicle where status = '' order by OwnerName asc")
                            : mysqli_query($con, "select *from tblvehicle where OwnerName like '%$sdata%' and status = '' order by OwnerName asc");
                        $num = mysqli_num_rows($ret);
                        if ($num > 0) { ?>
                            <div class="dash-result-item">
                                <div class="dash-result-head">
                                    <h1>incoming vehicle owners</h1>
                                </div>
                                <div class="dash-box">
                                    <?php while ($row = mysqli_fetch_array($ret)) { ?>
                                        <div class="dash-item" data-type="pe">
                                            <div class="dash-img"></div>
                                            <p><?php echo $row['OwnerName']; ?></p>
                                            <a class="dash-btn dash-btn-back" href="view-vehicle-details.php?viewid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/back.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-edit" href="print.php?vid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/printer.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-print" href="delete.php?del=<?php echo $row['ID']; ?>&type=vehicle" onClick="return confirm('Are you sure you want to delete?')">
                                                <img src="../assets/img/trash.png" alt="">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        $ret = ($sdata == 'all')
                            ? mysqli_query($con, "select *from tblvehicle where status = 'Out' order by OwnerName asc")
                            : mysqli_query($con, "select *from tblvehicle where OwnerName like '%$sdata%' and status = 'Out' order by OwnerName asc");
                        $num = mysqli_num_rows($ret);
                        if ($num > 0) { ?>
                            <div class="dash-result-item">
                                <div class="dash-result-head">
                                    <h1>outgoing vehicle owners</h1>
                                </div>
                                <div class="dash-box">
                                    <?php while ($row = mysqli_fetch_array($ret)) { ?>
                                        <div class="dash-item" data-type="pe">
                                            <div class="dash-img"></div>
                                            <p><?php echo $row['OwnerName']; ?></p>
                                            <a class="dash-btn dash-btn-back" href="view-vehicle-details.php?viewid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/back.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-edit" href="print.php?vid=<?php echo $row['ID']; ?>" target="_blank">
                                                <img src="../assets/img/printer.png" alt="">
                                            </a>
                                            <a class="dash-btn dash-btn-print" href="delete.php?del=<?php echo $row['ID']; ?>&type=vehicle" onClick="return confirm('Are you sure you want to delete?')">
                                                <img src="../assets/img/trash.png" alt="">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="space"></div>
                    </div>
                <?php } ?>
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