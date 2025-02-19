<?php
// Start session if not already started
session_start();

// Include your database configuration file
include('db.php'); // This file should contain your database connection settings

// Only process the form if it's submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email and password are provided
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Sanitize the input to prevent SQL Injection
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Check if email format is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

 
        $sql = "SELECT * FROM patients WHERE email = ?";
        $stmt = $conn->prepare($sql);
        
 
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with that email exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc(); // Fetch the user data

            // Check if the password is correct
            if (password_verify($password, $user['password'])) {
                // Store user info in session to remember the logged-in user
                $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the primary key in the database
                $_SESSION['email'] = $user['email'];

                // Redirect to the patient dashboard or homepage
                header("Location: patient dashboard.php"); // Change this to your actual dashboard page
                exit(); // Ensure that no further code is executed after redirect
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with that email address.";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Please enter both email and password.";
    }
} else {
    // If the form is not submitted, you can display the form
    echo "Please fill in the form.";
}

// Close database connection
$conn->close();
?>
