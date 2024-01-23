<?php
// CRUD operations for users

if (!function_exists('displayUsers')) {
    function displayUsers() {
        global $conn;
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Email</th><th>Usertype</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['email']}</td><td>{$row['usertype']}</td></tr>";
        }

        echo "</table>";
    }
}

if (!function_exists('addUser')) {
    function addUser($email, $usertype, $password) {
        global $conn;
        $email = mysqli_real_escape_string($conn, $email);
        $usertype = mysqli_real_escape_string($conn, $usertype);
        $password = mysqli_real_escape_string($conn, $password);

        // Check if the email already exists
        $checkQuery = "SELECT * FROM users WHERE email='$email'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            echo "Error: User with this email already exists.";
            return;
        }

        $sql = "INSERT INTO users (email, usertype, password) VALUES ('$email', '$usertype', '$password')";
        $result = $conn->query($sql);

        if ($result) {
            echo "User added successfully!";
        } else {
            echo "Error adding user: " . $conn->error;
        }
    }
}

if (!function_exists('updateUser')) {
    function updateUser($id, $email, $usertype, $password) {
        global $conn;
        $email = mysqli_real_escape_string($conn, $email);
        $usertype = mysqli_real_escape_string($conn, $usertype);
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "UPDATE users SET email='$email', usertype='$usertype', password='$password' WHERE id=$id";
        $result = $conn->query($sql);

        if ($result) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }
}

if (!function_exists('deleteUser')) {
    function deleteUser($id) {
        global $conn;
        $sql = "DELETE FROM users WHERE id=$id";
        $result = $conn->query($sql);

        if ($result) {
            echo "User deleted successfully!";
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    }
}
?>
