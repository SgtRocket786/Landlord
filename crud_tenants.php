<?php
// CRUD operations for tenants

if (!function_exists('displayTenants')) {
    function displayTenants() {
        global $conn;
        $sql = "SELECT * FROM tenant";
        $result = $conn->query($sql);

        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Check-in Date</th><th>Check-out Date</th><th>Apartment Number</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['tenantID']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phoneNumber']}</td><td>{$row['checkInDate']}</td><td>{$row['checkOutDate']}</td><td>{$row['apartmentNumber']}</td></tr>";
        }

        echo "</table>";
    }
}

if (!function_exists('addTenant')) {
    function addTenant($name, $email, $phoneNumber, $checkInDate, $checkOutDate, $apartmentNumber) {
        global $conn;
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
        $checkInDate = mysqli_real_escape_string($conn, $checkInDate);
        $checkOutDate = mysqli_real_escape_string($conn, $checkOutDate);
        $apartmentNumber = mysqli_real_escape_string($conn, $apartmentNumber);

        // Check if the email already exists
        $checkQuery = "SELECT * FROM tenant WHERE email='$email'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            echo "Error: Tenant with this email already exists.";
            return;
        }

        $sql = "INSERT INTO tenant (name, email, phoneNumber, checkInDate, checkOutDate, apartmentNumber) 
                VALUES ('$name', '$email', '$phoneNumber', '$checkInDate', '$checkOutDate', '$apartmentNumber')";
        $result = $conn->query($sql);

        if ($result) {
            echo "Tenant added successfully!";
        } else {
            echo "Error adding tenant: " . $conn->error;
        }
    }
}

if (!function_exists('updateTenant')) {
    function updateTenant($id, $name, $email, $phoneNumber, $checkInDate, $checkOutDate, $apartmentNumber) {
        global $conn;
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
        $checkInDate = mysqli_real_escape_string($conn, $checkInDate);
        $checkOutDate = mysqli_real_escape_string($conn, $checkOutDate);
        $apartmentNumber = mysqli_real_escape_string($conn, $apartmentNumber);

        $sql = "UPDATE tenant SET name='$name', email='$email', phoneNumber='$phoneNumber', 
                checkInDate='$checkInDate', checkOutDate='$checkOutDate', apartmentNumber='$apartmentNumber' 
                WHERE tenantID=$id";
        $result = $conn->query($sql);

        if ($result) {
            echo "Tenant updated successfully!";
        } else {
            echo "Error updating tenant: " . $conn->error;
        }
    }
}

if (!function_exists('deleteTenant')) {
    function deleteTenant($id) {
        global $conn;
        $sql = "DELETE FROM tenant WHERE tenantID=$id";
        $result = $conn->query($sql);

        if ($result) {
            echo "Tenant deleted successfully!";
        } else {
            echo "Error deleting tenant: " . $conn->error;
        }
    }
}
?>
