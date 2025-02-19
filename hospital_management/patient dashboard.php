<?php

// Start session
session_start();



// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login-patient.php");
    exit();
}

// Include the database configuration
include('db.php');

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Query to get the user's data from the database
$sql = "SELECT * FROM patients WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = $user['firstname'] . ' ' . $user['lastname']; // Assuming the name is stored in firstname and lastname
} else {
    echo "User not found!";
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
    <title>Patient Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="patient.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-hospital"></i>
            <span>GLOBAL HOSPITAL</span>
        </div>
        <nav class="navbar">
            <a href="logout.php"><button class="logout-button">Logout</button></a>
        </nav>
    </header>
    <div class="side-navbar">
      <ul>
          <li><a href="#" class="active">Dashboard</a></li>
          <li><a href="#" class="book">Book Appointment</a></li>
          <li><a href="#"class="last">Appointment History</a></li>
          
      </ul>
  </div>
    <main>
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <div class="dashboard-container">
            <div class="dashboard-card">
                <i class="fas fa-calendar-check"></i>
                <h2>Book My Appointment</h2>
                <a href="#">Book Appointment</a>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-calendar-alt"></i>
                <h2>My Appointments</h2>
                <a href="#">View Appointment History</a>
                
            </div>
        </div>
        <div class="form-container" style="display: none;">
            <h2>Create an Appointment</h2>
            <form class="appointment-form">
                <div class="form-section">
                    <h3>General</h3>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-input">
                            <option>Dr. Dinesh Sharma</option>
                            <option>Dr. Anjali Verma</option>
                            <option>Dr. Rajesh Kumar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fee</label>
                        <input type="text" class="form-input" value="₹700" readonly>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-input" value="2024-03-25">
                    </div>
                </div>

                <div class="form-section">
                    <h3>Specification</h3>
                    <div class="form-group">
                        <label>Consultancy Type</label>
                        <select class="form-input">
                            <option>General Checkup</option>
                            <option>Specialist Consultation</option>
                            <option>Follow-up Visit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" class="form-input">
                    </div>
                </div>

                <button type="submit" class="create-button">
                    Create New Entry <i class="fas fa-plus-circle"></i>
                </button>
            </form>
        </div>
        <script>
document.addEventListener("DOMContentLoaded", function () {
    const dashboardContainer = document.querySelector('.dashboard-container');
    const formContainer = document.querySelector('.form-container');

    // Sidebar buttons
    const dashboardBtn = document.querySelector('.side-navbar a[href="#"]'); // Dashboard
    const appointmentBtn = document.querySelector('.side-navbar .book'); // Appointment in sidebar

    // Dashboard card buttons
    const bookAppointmentCard = document.querySelector('.dashboard-card a[href="#"]');

    function showForm() {
        // Hide the dashboard content and show the form
        dashboardContainer.style.display = 'none';
        formContainer.style.display = 'block';

        // Change sidebar active states
        dashboardBtn.classList.remove('active');
        appointmentBtn.classList.add('active');
    }

    function showDashboard() {
        // Show the dashboard content and hide the form
        dashboardContainer.style.display = 'flex';
        formContainer.style.display = 'none';

        // Change sidebar active states
        dashboardBtn.classList.add('active');
        appointmentBtn.classList.remove('active');
    }

    // Click listeners for booking appointment
    appointmentBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showForm();
    });

    bookAppointmentCard.addEventListener('click', (e) => {
        e.preventDefault();
        showForm();
    });

    // Click listener for dashboard button
    dashboardBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showDashboard();
    });

    // Optional: Make sure the initial state of the page is consistent (dashboard is shown by default)
    showDashboard();
});


        </script>
    </main>
</body>
</html>
