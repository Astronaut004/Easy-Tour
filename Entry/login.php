<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <h2 class="text-center mb-4 text-dark">Login</h2>
            <div class="mb-3">
                <label  class="form-label">Username</label>
                <input type="text" class="form-control"  placeholder="Enter your username" name="uname">
                <small class="form-text text-muted">Your unique username</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="pass">
                <!-- Uncomment this if needed
                <small class="form-text text-muted">Must have special symbol $,#,&.., number and #one uppercase letter</small>
                -->
            </div>
            <button type="submit" class="btn w-100">Login</button>
            <p class="form-text mt-3">Don't have any unique name yet? <a href="./Registration.php"> Register </a> here</p>
        </form>
    </div>
</body>

</html>


<?php
include "../connection.php";
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_REQUEST['uname'];
    $password = $_REQUEST['pass'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('Fill up Everything'); window.location.href='login.php';</script>";
        die();
    }

    $sql = "SELECT * FROM user_tb WHERE username = ?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo "<script>alert('No user found'); window.location.href='login.php';</script>";
        die();
    }
    
    $row = $result->fetch_assoc();
    $passwordDB = $row['password'];
    $role = $row['role'];
    $adminCode = $row['admin_code'];

    if (password_verify($password, $passwordDB)) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        if ($role == "Admin" && $adminCode == 12345) {
            header("Location: Admin.php");
            exit();
        } else {
            header("Location: user.php");
            exit();
        }
    } else {
        echo "<script>alert('Wrong Credentials'); window.location.href='login.php';</script>";
        die();
    }
} 
// else {
//     echo "<script>alert('Wrong Method'); window.location.href='login.php';</script>";
// }
?>

