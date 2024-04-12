<?php
include('includes/dbconnection.php');

if (isset($_GET['del'])) {
    $id = $_GET['del'];

    // Check if 'type' is set and matches either 'vehicle' or 'tblregusers'
    if (isset($_GET['type'])) {
        $type = $_GET['type'] == 'vehicle' ? 'tblvehicle' : 'tblregusers';
        $deleted = ($type == 'tblvehicle') ? 'vehicle' : 'user';
        $sql = "DELETE FROM $type WHERE ID = '$id'";
        
        $current = mysqli_query($con, "SELECT * FROM $type WHERE ID='$id'");
        $info = mysqli_fetch_array($current);
        $currentName = ($deleted == 'vehicle') ? $info['VehicleCompanyname'] : $info['FirstName'] . " " . $info['LastName'];

        mysqli_query($con, $sql);

        $msg = "a $deleted |$currentName| was removed from the system";
        $report = "INSERT INTO tblreports (Msg) VALUES ('$msg')";
        $logReport = mysqli_query($con, $report);

        echo "<script>alert('Data Deleted');</script>";
        // Redirect to the previous page
        echo "<script>window.history.back();</script>";
    } else {
        echo "<script>alert('Type not set');</script>";
    }
}
?>