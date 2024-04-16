<?php
session_start(); // Start the session

include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $serviceType = $_POST["service_type"];
    $date = $_POST["service_date"];
    $remark = $_POST["remark"];

    $lastVisitedUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    $errors = array();

    // Validate form fields
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Handle form submission
    if (empty($errors)) {
        // Prepare and execute SQL statement using prepared statement
        $stmt = $conn->prepare("INSERT INTO booking_service (name, email, service_type, service_date, remark) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $serviceType, $date, $remark);

        if ($stmt->execute()) {
            $_SESSION["flash_message"] = "Form submitted successfully";
        } else {
            $_SESSION["flash_error"] = "Error: " . $conn->error;
        }
        $stmt->close();
    } else {
        // Store errors in session
        foreach ($errors as $error) {
            $_SESSION["flash_error"] .= $error . "<br>";
        }
    }

    // Redirect back to previous page
    header("Location: $lastVisitedUrl");
    exit();
}
$conn->close();
?>
