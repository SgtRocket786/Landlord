<?php
global $conn;
session_start();

// Include database connection code here
include("db_connection.php");

// Include common functions or configurations
include("common.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate usertype, email, and password
    $usertype = sanitize_input($_POST["usertype"]);
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    if (empty($usertype) || empty($email) || empty($password)) {
        $error_message = "Usertype, email, and password are required.";
    } else {
        // Check if the user exists in the 'users' table
        $sql = "SELECT * FROM users WHERE usertype = '$usertype' AND email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User exists, set session variables
            $_SESSION["usertype"] = $usertype;
            $_SESSION["email"] = $email;

            // Redirect to the manager homepage or other pages based on usertype
            // Redirect to the appropriate homepage based on usertype
            if ($usertype == "Manager") {
                header("Location: manager_homepage.php");
            } elseif ($usertype == "Staff") {
                header("Location: staff_homepage.php");
            } elseif ($usertype == "Tenant") {
                header("Location: tenant_homepage.php");
            }
            exit();
        } else {
            $error_message = "Invalid usertype, email, or password.";
        }
    }
}

// Logout section
if (isset($_GET["logout"])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the original login page
    header("Location: login.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<?php
if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Usertype:
    <select name="usertype">
        <option value="Manager">Manager</option>
        <option value="Staff">Staff</option>
        <option value="Tenant">Tenant</option>
    </select>
    <br><br>

    Email:
    <input type="text" name="email">
    <br><br>

    Password:
    <input type="password" name="password">
    <br><br>

    <input type="submit" name="submit" value="Login">
</form>
</body>
</html>
