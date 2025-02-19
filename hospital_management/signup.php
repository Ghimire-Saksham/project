<?php
// Include the database connection file
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password before storing it
    $gender = $_POST['gender'];

    // Check if email already exists
    $check_email_sql = "SELECT * FROM patients WHERE email='$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        echo "Email already exists! Please try a different one.";
    } else {
        // Insert new patient record into database
        $sql = "INSERT INTO patients (firstname, lastname, email, password, gender) 
                VALUES ('$firstname', '$lastname', '$email', '$password', '$gender')";

        if ($conn->query($sql) === TRUE) {
            header("Location: loginuser.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
