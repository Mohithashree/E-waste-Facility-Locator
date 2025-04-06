<?php
// Initialize variables
$registered = 0;
$userExists = 0;
$userType = ''; // Variable to hold user type (student or teacher)

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include server.php for database connection
    include 'server.php';
    
    // Retrieve form data and sanitize
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']); // Get date of birth
    $cpass = mysqli_real_escape_string($con, $_POST['cpass']); // Get standard
   
    // Check if the user already exists
    $sql_check = "SELECT * FROM sign WHERE email='$email'";
    $result_check = mysqli_query($con, $sql_check);

    if ($result_check) {
        $num = mysqli_num_rows($result_check);
        if ($num > 0) {
            $userExists = 1;
        } else {
            // Insert new user
            $sql_insert = "INSERT INTO sign (username, phone, email, dob, pass, cpass) VALUES ('$username', '$phone', '$email', '$dob', '$pass', '$cpass')";
            $result_insert = mysqli_query($con, $sql_insert);
            if ($result_insert) {
                $registered = 1;
                // Redirect based on user type
                header('location: sign in.php');
                exit(); // Make sure to exit after redirection
            } else {
                // Handle insertion error
                die("Error: " . mysqli_error($con));
            }
        }
    } else {
        // Handle query error
        die("Error: " . mysqli_error($con));
    }
}
?>
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Poppins for the body text */
            background: linear-gradient(to bottom right, #f9f9f9, #e9f5e9); /* Light background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            backdrop-filter: blur(5px);
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 20px; /* Rounded edges */
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            width: 400px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .container:hover {
            transform: scale(1.03);
        }

        h1 {
            text-align: center;
            color: #2e7d32; /* Dark green for the heading */
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif; /* Roboto for the heading */
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
 
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .half {
            flex: 1;
            margin-right: 10px;
        }

        .half:last-child {
            margin-right: 0;
        }

        label {
            margin-bottom: 5px;
            color: #333; /* Dark grey for labels */
            font-weight: 600; /* Medium weight for labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 14px;
            border: 2px solid #ccc; /* Light grey border */
            border-radius: 10px; /* Rounded edges for inputs */
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 14px;
            font-family: 'Poppins', sans-serif; /* Poppins for inputs */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus {
            border-color: #4caf50; /* Green border on focus */
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #2e7d32; /* Dark green button */
            border: none;
            color: white;
            border-radius: 10px; /* Rounded edges for buttons */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            position: relative;
            overflow: hidden;
            font-family: 'Roboto', sans-serif; /* Roboto for buttons */
            font-weight: 600;
        }

        button:hover {
            background-color: #1b5e20; /* Darker green on hover */
            transform: scale(1.05);
        }

        button:after {
            content: '';
            position: absolute;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.3);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50%;
            transition: transform 0.5s ease;
        }

        button:hover:after {
            transform: translate(-50%, -50%) scale(1);
        }

        p {
            text-align: center;
            margin-top: 20px;
            color: #333; /* Dark grey for text */
        }

        a {
            color: #2e7d32; /* Dark green link */
            text-decoration: none;
            font-weight: 600; /* Medium weight for links */
        }

        a:hover {
            text-decoration: underline;
            color: #1b5e20; /* Darker green on hover */
        }

        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>WELCOME !!</h1>
        <form>
            <div class="row">
                <div class="half form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="half form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>
            <div class="row">
                <div class="half form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="half form-group">
                    <label for="fullname">DOB</label>
                    <input type="date" id="fullname" name="fullname" placeholder="dd-mm-yy" required>
                </div>
            </div>
            <div class="row">
                <div class="half form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="half form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
            </div>
            <button type="submit">Sign Up</button>
            <p class="forgot-password"><a href="#">Forgot Password?</a></p>--
        </form>
        <p>Already have an account? <a href="sign in.html">Log In</a></p>
    </div>
</body>
</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Poppins for the body text */
            background: linear-gradient(to bottom right, #f9f9f9, #e9f5e9); /* Light background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            backdrop-filter: blur(5px);
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 20px; /* Rounded edges */
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            width: 400px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .container:hover {
            transform: scale(1.03);
        }

        h1 {
            text-align: center;
            color: #2e7d32; /* Dark green for the heading */
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif; /* Roboto for the heading */
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .half {
            flex: 1;
            margin-right: 10px;
        }

        .half:last-child {
            margin-right: 0;
        }

        label {
            margin-bottom: 5px;
            color: #333; /* Dark grey for labels */
            font-weight: 600; /* Medium weight for labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
            padding: 14px;
            border: 2px solid #ccc; /* Light grey border */
            border-radius: 10px; /* Rounded edges for inputs */
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 14px;
            font-family: 'Poppins', sans-serif; /* Poppins for inputs */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus,
        input[type="date"]:focus {
            border-color: #4caf50; /* Green border on focus */
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #2e7d32; /* Dark green button */
            border: none;
            color: white;
            border-radius: 10px; /* Rounded edges for buttons */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            position: relative;
            overflow: hidden;
            font-family: 'Roboto', sans-serif; /* Roboto for buttons */
            font-weight: 600;
        }

        button:hover {
            background-color: #1b5e20; /* Darker green on hover */
            transform: scale(1.05);
        }

        button:after {
            content: '';
            position: absolute;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.3);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50%;
            transition: transform 0.5s ease;
        }

        button:hover:after {
            transform: translate(-50%, -50%) scale(1);
        }

        p {
            text-align: center;
            margin-top: 20px;
            color: #333; /* Dark grey for text */
        }

        a {
            color: #2e7d32; /* Dark green link */
            text-decoration: none;
            font-weight: 600; /* Medium weight for links */
        }

        a:hover {
            text-decoration: underline;
            color: #1b5e20; /* Darker green on hover */
        }

        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>WELCOME !!</h1>
        <form>
            <div class="row">
                <div class="half form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="half form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>
            <div class="row">
                <div class="half form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="half form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
            </div>
            <div class="row">
                <div class="half form-group">
                    <label for="password">Password</label>
                    <input type="password" id="pass" name="pass" required>
                </div>
                <div class="half form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="cpass" name="cpass" required>
                </div>
            </div>
            <button type="submit">Sign Up</button>
            <p class="forgot-password"><a href="#">Forgot Password?</a></p>
        </form>
        <p>Already have an account? <a href="sign in.php">Log In</a></p>
    </div>
    <?php if ($registered): ?>
                <div class="alert alert-success mt-3" role="alert">
                  Registration successful! Redirecting...
                </div>
              <?php elseif ($userExists): ?>
                <div class="alert alert-danger mt-3" role="alert">
                  User already exists.
                </div>
              <?php endif; ?>
</body>
</html>
