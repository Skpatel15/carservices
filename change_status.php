<?php
session_start();
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $serviceId = $_POST['serviceId'];


    // Update status in the database
    $sql = "UPDATE booking_service SET status = '$status' WHERE id = $serviceId";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = "Status updated successfully";
    } else {
        $_SESSION['flash'] = "Error updating status: " . mysqli_error($conn);
    }
} else {
    $_SESSION['flash'] = "Invalid request";
}
header("Location: service_report.php");
exit();

?>
