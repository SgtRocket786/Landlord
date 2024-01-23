<?php
// Staff homepage to view and manage maintenance requests

include('db_connection.php');
include('crud_requests.php');

session_start();

// Check if user is logged in and is a Staff member
if (!isset($_SESSION['email']) || $_SESSION['usertype'] !== 'Staff') {
    header("Location: login.php");
    exit();
}

// Process form submission for updating request status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $requestID = $_POST['requestID'];
    $newStatus = $_POST['new_status'];

    // Update the status of the maintenance request
    updateMaintenanceRequestStatus($requestID, $newStatus);
}

// Retrieve all maintenance requests
$maintenanceRequests = getAllMaintenanceRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Homepage</title>
</head>
<body>

<h1>Welcome, Staff Member!</h1>

<!-- Display maintenance requests -->
<h2>All Maintenance Requests</h2>
<?php if ($maintenanceRequests): ?>
    <table border="1">
        <tr>
            <th>Request ID</th>
            <th>Apartment Number</th>
            <th>Area</th>
            <th>Problem Description</th>
            <th>Date/Time</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($maintenanceRequests as $request): ?>
            <tr>
                <td><?php echo $request['requestID']; ?></td>
                <td><?php echo $request['apartmentNumber']; ?></td>
                <td><?php echo $request['area']; ?></td>
                <td><?php echo $request['problemDescription']; ?></td>
                <td><?php echo $request['requestDateTime']; ?></td>
                <td><img src="<?php echo $request['photoPath']; ?>" alt="Maintenance Request Photo" height="50"></td>
                <td><?php echo $request['status']; ?></td>
                <td>
                    <form action="staff_homepage.php" method="post">
                        <input type="hidden" name="requestID" value="<?php echo $request['requestID']; ?>">
                        <select name="new_status">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <input type="submit" name="update_status" value="Update Status">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No maintenance requests found.</p>
<?php endif; ?>

<!-- Logout link -->
<p><a href="logout.php">Logout</a></p>

</body>
</html>
