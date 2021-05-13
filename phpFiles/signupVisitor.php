<?php

//config inclusion session starts
include("config.php");
session_start();

//defining necessary variables
$username = "";
$password = "";
$confirmPassword = "";
$email = "";
$name = "";
$billing_address = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];


    $sql = "INSERT INTO visitor(username, password, email, name, billing_address) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $password, $username, $billing_address);
    mysqli_stmt_execute($stmt);
    header("location: index.php");    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        #centerwrapper { text-align: center; margin-bottom: 10px; }
        #centerdiv { display: inline-block; }
        /* Navbar container */
        .navbar {
        overflow: hidden;
        background-color: #333;
        font-family: Arial;
        }

        /* Links inside the navbar */
        .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }
        
        /* Add a red background color to navbar links on hover */
        .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: black;
        }

    </style>
</head>
<body>
    
    <div class="container">
        
        <nav class="navbar navbar-inverse bg-primary navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h4 class="navbar-text">Zoo Database</h4>

                </div>
                <a href="index.php">Home</a>
                <a href="signupUser.php">Sign Up</a>
    </div>
            </div>
        </nav>
        <div id="centerwrapper">
            <div id="centerdiv">
                <br><br>
                <h2>Visitor Sign Up</h2>
                
                <p>Choose Your Role: 
                <form action="">
                    <input type="radio" name="user_type" value="user" onclick = "document.location.href='signupUser.php'"> User
                    <input type="radio" name="user_type" value="visitor" checked="checked"> Visitor
                    <input type="radio" name="user_type" value="veterinarian" onclick = "document.location.href='signupVeterinarian.php'"> Veterinarian
                    <input type="radio" name="user_type" value="keeper"onclick = "document.location.href='signupKeeper.php'"> Keeper
                    <input type="radio" name="user_type" value="coordinator"onclick = "document.location.href='signupCoordinator.php'"> Coordinator
                    <input type="radio" name="user_type" value="advertiser"onclick = "document.location.href='signupAdvertiser.php'"> Advertiser
                </form>
                <form id="signupForm" action="" method="post">
                    <div class="form-group">
                        <label>Visitor Login Name</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                    </div>

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label>Billing Address</label>
                        <input type="text" name="billing_address" class="form-control" id="billing_address">
                    </div>

                    <div class="form-group">
                        <input onclick="checkEmptyAndLogin()" class="btn btn-primary" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function checkEmptyAndLogin() {
            var usernameVal = document.getElementById("username").value;
            var passwordVal = document.getElementById("password").value;
            var confirmPasswordVal = document.getElementById("confirm_password").value;
            var emailVal = document.getElementById("email").value;
            var nameVal = document.getElementById("name").value;
            var billing_addressVal = document.getElementById("billing_address").value;
            
            if (usernameVal === "" || passwordVal === "" || confirmPasswordVal === "" || emailVal === "" || nameVal === "" || billing_addressVal === "") {
                alert("Make sure to fill all fields");
            }
            else if (passwordVal != confirmPasswordVal) {
                alert("Passwords are not the same");
            }
            else {
                var form = document.getElementById("signupForm").submit();
            }
        }
    </script>
</body>
</html> 