<?php
// Tenant homepage to submit and view maintenance requests

include('db_connection.php');
include('crud_requests.php');

session_start();

// Check if user is logged in and is a Tenant
if (!isset($_SESSION['email']) || $_SESSION['usertype'] !== 'Tenant') {
    header("Location: login.php");
    exit();
}

// Process form submission for adding maintenance request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_request'])) {
    $apartmentNumber = $_POST['apartmentNumber'];
    $area = $_POST['area'];
    $problemDescription = $_POST['problemDescription'];
    $requestDateTime = date('Y-m-d H:i:s');
    $photo = $_FILES['photo'];
    $status = 'Pending';

    // Add the maintenance request
    addMaintenanceRequest($apartmentNumber, $area, $problemDescription, $requestDateTime, $photo, $status);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Homepage</title>
</head>
<body>

<h1>Welcome, Tenant!</h1>

<!-- Form for submitting maintenance request -->
<h2>Submit Maintenance Request</h2>
<form action="tenant_homepage.php" method="post" enctype="multipart/form-data">
    <label for="apartmentNumber">Apartment Number:</label>
    <input type="text" name="apartmentNumber" required><br>

    <label for="area">Area:</label>
    <input type="text" name="area" required><br>

    <label for="problemDescription">Problem Description:</label>
    <textarea name="problemDescription" required></textarea><br>

    <label for="photo">Photo:</label>
    <input type="file" name="photo" accept="image/*"><br>

    <input type="submit" name="submit_request" value="Submit Request">
</form>

<!-- Logout link -->
<p><a href="logout.php">Logout</a></p>

</body>
</html>
