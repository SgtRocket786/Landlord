<?php
session_start();

// Include database connection code here
include("db_connection.php");

// Include CRUD functions for users and tenants
include("crud_users.php");
include("crud_tenants.php");

// Check if a manager is logged in
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "Manager") {
    header("Location: login.php"); // Redirect to login page if not logged in as a manager
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
</head>
<body>

<h2>Welcome, Manager!</h2>

<!-- Display users -->
<h3>All Users</h3>
<?php
displayUsers(); // Display the list of users
?>

<!-- Add new user form -->
<h3>Add New User</h3>
<form action="manager_homepage.php" method="post">
    Email: <input type="email" name="userEmail" required><br>
    Password: <input type="password" name="userPassword" required><br>
    Usertype:
    <select name="userType" required>
        <option value="Manager">Manager</option>
        <option value="Staff">Staff</option>
        <option value="Tenant">Tenant</option>
    </select><br>
    <input type="submit" name="addUser" value="Add User">
</form>

<!-- Update user form -->
<h3>Update User</h3>
<form action="manager_homepage.php" method="post">
    User ID: <input type="text" name="updateUserId" required><br>
    New Email: <input type="email" name="updateUserEmail" required><br>
    New Password: <input type="password" name="updateUserPassword" required><br>
    New Usertype:
    <select name="updateUserType" required>
        <option value="Manager">Manager</option>
        <option value="Staff">Staff</option>
        <option value="Tenant">Tenant</option>
    </select><br>
    <input type="submit" name="updateUser" value="Update User">
</form>

<!-- Delete user form -->
<h3>Delete User</h3>
<form action="manager_homepage.php" method="post">
    User ID: <input type="text" name="deleteUserId" required><br>
    <input type="submit" name="deleteUser" value="Delete User">
</form>

<?php
// Handle adding a new user
if (isset($_POST["addUser"])) {
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $userType = $_POST["userType"];

    // Call the addUser function
    addUser($userEmail, $userType, $userPassword);
}

// Handle updating a user
if (isset($_POST["updateUser"])) {
    $updateUserId = $_POST["updateUserId"];
    $updateUserEmail = $_POST["updateUserEmail"];
    $updateUserPassword = $_POST["updateUserPassword"];
    $updateUserType = $_POST["updateUserType"];

    // Call the updateUser function
    updateUser($updateUserId, $updateUserEmail, $updateUserType, $updateUserPassword);
}

// Handle deleting a user
if (isset($_POST["deleteUser"])) {
    $deleteUserId = $_POST["deleteUserId"];

    // Call the deleteUser function
    deleteUser($deleteUserId);
}
?>

<!-- Display tenants -->
<h3>All Tenants</h3>
<?php
displayTenants(); // Display the list of tenants
?>

<!-- Add new tenant form -->
<h3>Add New Tenant</h3>
<form action="manager_homepage.php" method="post">
    Name: <input type="text" name="tenantName" required><br>
    Email: <input type="email" name="tenantEmail" required><br>
    Phone Number: <input type="text" name="tenantPhone" required><br>
    Check-in Date: <input type="date" name="checkInDate" required><br>
    Check-out Date: <input type="date" name="checkOutDate" required><br>
    Apartment Number: <input type="text" name="apartmentNumber" required><br>
    <input type="submit" name="addTenant" value="Add Tenant">
</form>

<!-- Update tenant form -->
<h3>Update Tenant</h3>
<form action="manager_homepage.php" method="post">
    Tenant ID: <input type="text" name="updateTenantId" required><br>
    New Name: <input type="text" name="updateTenantName" required><br>
    New Email: <input type="email" name="updateTenantEmail" required><br>
    New Phone Number: <input type="text" name="updateTenantPhone" required><br>
    New Check-in Date: <input type="date" name="updateCheckInDate" required><br>
    New Check-out Date: <input type="date" name="updateCheckOutDate" required><br>
    New Apartment Number: <input type="text" name="updateApartmentNumber" required><br>
    <input type="submit" name="updateTenant" value="Update Tenant">
</form>

<!-- Delete tenant form -->
<h3>Delete Tenant</h3>
<form action="manager_homepage.php" method="post">
    Tenant ID: <input type="text" name="deleteTenantId" required><br>
    <input type="submit" name="deleteTenant" value="Delete Tenant">
</form>

<?php
// Handle adding a new tenant
if (isset($_POST["addTenant"])) {
    $tenantName = $_POST["tenantName"];
    $tenantEmail = $_POST["tenantEmail"];
    $tenantPhone = $_POST["tenantPhone"];
    $checkInDate = $_POST["checkInDate"];
    $checkOutDate = $_POST["checkOutDate"];
    $apartmentNumber = $_POST["apartmentNumber"];

    // Call the addTenant function
    addTenant($tenantName, $tenantEmail, $tenantPhone, $checkInDate, $checkOutDate, $apartmentNumber);
}

// Handle updating a tenant
if (isset($_POST["updateTenant"])) {
    $updateTenantId = $_POST["updateTenantId"];
    $updateTenantName = $_POST["updateTenantName"];
    $updateTenantEmail = $_POST["updateTenantEmail"];
    $updateTenantPhone = $_POST["updateTenantPhone"];
    $updateCheckInDate = $_POST["updateCheckInDate"];
    $updateCheckOutDate = $_POST["updateCheckOutDate"];
    $updateApartmentNumber = $_POST["updateApartmentNumber"];

    // Call the updateTenant function
    updateTenant($updateTenantId, $updateTenantName, $updateTenantEmail, $updateTenantPhone, $updateCheckInDate, $updateCheckOutDate, $updateApartmentNumber);
}

// Handle deleting a tenant
if (isset($_POST["deleteTenant"])) {
    $deleteTenantId = $_POST["deleteTenantId"];

    // Call the deleteTenant function
    deleteTenant($deleteTenantId);
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


?>

<!-- Additional CRUD forms and actions can be added here -->

<br><br>
<a href="logout.php">Logout</a>

</body>
</html>
