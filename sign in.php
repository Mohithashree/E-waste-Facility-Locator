<?php
$logged=0;
$invalid=0;
if($_SERVER['REQUEST_METHOD']=='POST') {
  include 'server.php';
  $email=$_POST['email']; // Corrected from '$_POST['username']' to '$_POST['name']'
  $pass=$_POST['pass'];
  $sql="SELECT * FROM sign WHERE email='$username' AND pass='$pass'";
  $result=mysqli_query($con,$sql);
  if ($result) {
    $num=mysqli_num_rows($result);
    if ($num>0) {
      $logged=1;
      session_start();
      $_SESSION['email']=$email;
      header('location: home.php');
    }
     else {
      $invalid=1;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
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
            margin-bottom: 10px;
            font-family: 'Roboto', sans-serif; /* Roboto for the heading */
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        p.description {
            text-align: center;
            color: #666; /* Medium grey for description */
            margin-bottom: 20px;
            font-size: 14px; /* Slightly smaller font size */
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #333; /* Dark grey for labels */
            font-weight: 600; /* Medium weight for labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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
        input[type="password"]:focus {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome Back !!</h1>
        <p class="description">Please enter your details.</p>
        <form>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign In</button>
            <p class="forgot-password"><a href="#">Forgot Password?</a></p>
        </form>
        <p>Don't have an account? <a href="sign up.php">Sign Up</a></p>
    </div>
</body>
</html>