<?php
include('db.php');

session_start();


if (!isset($_SESSION['doctor_id'])) {
    
    header("Location: logindoctor.php");
    exit();
}

$doctor_username = $_SESSION['doctor_username'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
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
            <a href="logoutdoc.php"><button class="logout-button">Logout</button></a>
        </nav>
    </header>
    <div class="side-navbar">
      <ul>
          <li><a href="#" class="active">Dashboard</a></li>
          <li><a href="#"class="last">Appointments</a></li>
         
          
      </ul>
  </div>
    <main>
        <h1>Welcome, <?php echo htmlspecialchars($doctor_username); ?>!</h1>
        <div class="dashboard-container">
            <div class="dashboard-card">
                <i class="fas fa-calendar-check"></i>
                <h2>View Appointments
                <a href="#">Appointments</a>
            </div>
        </div>
    </main>
</body>
</html>
