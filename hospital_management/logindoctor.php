<?php
session_start();
include('db.php');

// Doctor login handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database
    $sql = "SELECT * FROM doctors WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
      
        if ($password==$user['password']) {
            // Login successful, set session variables
            $_SESSION['doctor_id'] = $user['id'];
            $_SESSION['doctor_username'] = $user['username'];
            header("Location: doctor dashboard.php"); // Redirect to the doctor dashboard
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid username or password.";
        }
    } else {
        $_SESSION['error_message'] = "No such user found. Please check your username.";
    }

    // Redirect back to index.php with show=doctor in the URL
    header("Location: index.php?show=doctor");
    exit();
}
?>
