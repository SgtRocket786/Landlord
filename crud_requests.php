<?php
// CRUD operations for maintenance requests

// Function to add a new maintenance request with image
function addMaintenanceRequest($apartmentNumber, $area, $problemDescription, $requestDateTime, $photo, $status) {
    global $conn;
    $area = mysqli_real_escape_string($conn, $area);
    $problemDescription = mysqli_real_escape_string($conn, $problemDescription);

    // Handle file upload
    $targetDir = "uploads/";
    $fileName = basename($photo["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (move_uploaded_file($photo["tmp_name"], $targetFilePath)) {
        // File uploaded successfully, now store the file path in the database
        $sql = "INSERT INTO maintenance_requests (apartmentNumber, area, problemDescription, requestDateTime, photoPath, status) 
                VALUES ('$apartmentNumber', '$area', '$problemDescription', '$requestDateTime', '$targetFilePath', '$status')";

        $result = $conn->query($sql);

        if ($result) {
            echo "Maintenance request submitted successfully!";
        } else {
            echo "Error submitting maintenance request: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

// Function to retrieve maintenance requests for a specific tenant

// Function to retrieve all maintenance requests
function getAllMaintenanceRequests() {
    global $conn;

    $sql = "SELECT * FROM maintenance_requests ORDER BY requestDateTime DESC";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

// Function to update the status of a maintenance request
function updateMaintenanceRequestStatus($requestID, $newStatus) {
    global $conn;
    $requestID = mysqli_real_escape_string($conn, $requestID);
    $newStatus = mysqli_real_escape_string($conn, $newStatus);

    $sql = "UPDATE maintenance_requests SET status='$newStatus' WHERE requestID='$requestID'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Maintenance request status updated successfully!";
    } else {
        echo "Error updating maintenance request status: " . $conn->error;
    }
}

// Function to delete a maintenance request
function deleteMaintenanceRequest($requestID) {
    global $conn;
    $requestID = mysqli_real_escape_string($conn, $requestID);

    $sql = "DELETE FROM maintenance_requests WHERE requestID='$requestID'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Maintenance request deleted successfully!";
    } else {
        echo "Error deleting maintenance request: " . $conn->error;
    }
}

// Function to filter maintenance requests by area
function getMaintenanceRequestsByArea($area) {
    global $conn;
    $area = mysqli_real_escape_string($conn, $area);

    $sql = "SELECT * FROM maintenance_requests WHERE area='$area' ORDER BY requestDateTime DESC";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

// Function to filter maintenance requests by date range
function getMaintenanceRequestsByDateRange($startDate, $endDate) {
    global $conn;
    $startDate = mysqli_real_escape_string($conn, $startDate);
    $endDate = mysqli_real_escape_string($conn, $endDate);

    $sql = "SELECT * FROM maintenance_requests WHERE requestDateTime BETWEEN '$startDate' AND '$endDate' ORDER BY requestDateTime DESC";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

// Function to filter maintenance requests by status
function getMaintenanceRequestsByStatus($status) {
    global $conn;
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "SELECT * FROM maintenance_requests WHERE status='$status' ORDER BY requestDateTime DESC";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

// Additional CRUD functions can be added as needed
?>
