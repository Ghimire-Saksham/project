<?php
session_start();
$show_form = isset($_GET['show']) ? $_GET['show'] : 'patient';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="indexGGMU.css">
</head>
<body>

    <div class="landing-page">
        <header>
            <div class="logo">
                <i class="fas fa-hospital"></i>
                <span>GLOBAL HOSPITAL</span>
            </div>
            <nav class="navbar">
                <ul class="navwords">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </header>

   
        <div class="content" id="patient">
            <div class="welcome-section">
                <i class="fas fa-hand-holding-heart"></i>
                <h1>Welcome</h1>
                <p>Your Health is our first priority</p>
            </div>
            <div class="registration-form">
                <h2>Register as</h2>
                <div class="role-tabs">
                    <button class="active" onclick="patient()">Patient</button>
                    <button onclick="doctor()">Doctor</button>
                    <button onclick="receptionist()">Receptionist</button>
                </div>
                <form action="signup.php" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="First Name *" name="firstname" id="firstname" required>
                        <input type="text" placeholder="Last Name *" name="lastname" id="lastname" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email *" name="email" id="email" required>
                        <input type="password" placeholder="Password *" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label><input type="radio" name="gender" value="Male" id="gender"> Male</label>
                        <label><input type="radio" name="gender" value="Female" id="gender" required> Female</label>
                    </div>
                    <button type="submit" class="submit-btn" onclick="validatesign()">Register</button>
                    <p class="login-link">Already have an account? <a href="loginuser.html">Log in</a></p>
                </form>
            </div>
        </div>

        
        <div class="content" id="logindoctor" style="display: none;">
            <div class="welcome-section">
                <i class="fas fa-stethoscope"></i>
                <h1>Welcome</h1>
                <p>Your Health is our first priority</p>
            </div>
            <div class="registration-form">
                <h2>Login as Doctor</h2>
                <div class="role-tabs">
                    <button onclick="patient()">Patient</button>
                    <button class="active" onclick="doctor()">Doctor</button>
                    <button onclick="receptionist()">Receptionist</button>
                </div>
                <form action="logindoctor.php" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="User Name *" name="username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password *" name="password" required>
                    </div>
                    <button type="submit" class="submit-btn" onclick="validatereception()">Log in</button>
                    <?php
                if (isset($_SESSION['error_message'])) {
                    echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
                    unset($_SESSION['error_message']); 
                }
                ?>
                </form>
            </div>
        </div>

       
        <div class="content" id="loginreception" style="display: none;">
            <div class="welcome-section">
                <i class="fas fa-headset"></i>
                <h1>Welcome</h1>
                <p>Your Health is our first priority</p>
            </div>
            <div class="registration-form">
                <h2>Login as Receptionist</h2>
                <div class="role-tabs">
                    <button onclick="patient()">Patient</button>
                    <button onclick="doctor()">Doctor</button>
                    <button class="active" onclick="receptionist()">Receptionist</button>
                </div>
                <form action="loginreception.php" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="User Name *" required>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password *" required>
                    </div>
                    <button type="submit" class="submit-btn">Log in</button>

                   <?php if (isset($_SESSION['error_message'])) {
                    echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
                    unset($_SESSION['error_message']); 
                }
                ?>
                </form>
            </div>
        </div>

    </div>

    
    <script src="script.js"></script>
    <script>
        const showForm = '<?php echo $show_form; ?>';
        if (showForm === 'doctor') {
            doctor();
        } else if (showForm === 'receptionist') {
            receptionist();
        } else {
            patient();
        }
    </script>

</body>
</html>

