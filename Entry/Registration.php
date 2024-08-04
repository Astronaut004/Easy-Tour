<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="container">
        <form method="POST" action="registration.php">
            <h2 class="text-center mb-4 text-dark">Registration</h2>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="uname">
                <small class="form-text text-muted">Pick a nice and unique name for yourself.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="pass">
                <small class="form-text text-muted">Must include special characters, numbers, and uppercase letters.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <div class="d-flex">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="role" value="User" onclick="toggleAdminCode(false)">User
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="Admin" onclick="toggleAdminCode(true)">Admin
                    </div>
                </div>
            </div>

            <div id="adminCodeBox" class="mb-3" style="display: none;">
                <label class="form-label">Admin Code</label>
                <input type="number" class="form-control" name="adminCode" maxlength="5">
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="form-text mt-3">Already have an account? <a href="./login.php">Login here</a></p>
        </form>
    </div>

    <script>
        function toggleAdminCode(show) {
            const adminCodeBox = document.getElementById('adminCodeBox');
            adminCodeBox.style.display = show ? 'block' : 'none';
        }
    </script>
</body>

</html>


<?php
include "../connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_REQUEST['uname'];
    $password = $_REQUEST['pass'];
    $email = $_REQUEST['email'];
    $role = $_REQUEST['role'];
    $adminCode = isset($_REQUEST['adminCode']) ? (int)$_REQUEST['adminCode'] : 0;



    if (empty($username) || empty($password) || empty($email) || empty($role)) {
        echo "
            <script>alert('All fields are required')</script>
            ";
        die();
    }

    if ($role == 'Admin') {
        if ($adminCode != 12345) {
            echo "<script>alert('Invalid admin code.'); window.location.href='./Registration.php';</script>";
            die();
        }
    } else {
        $adminCode = 0;
    }

    // Check user exits or not 

    $sql = "SELECT id FROM user_tb WHERE username = ? OR email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo  "<script>alert('User Already exists '); window.location.href='registration.php';</script>";
        die();
    }

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql1 = "INSERT INTO user_tb (username , password , email , role , admin_code) VALUES (?,?,?,?,?)";
    $stmt1 = $con->prepare($sql1);
    $stmt1->bind_param("ssssi", $username, $hashPassword, $email, $role, $adminCode);

    if ($stmt1->execute()) {
        echo "<script>alert('Registration successful.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='registration.php';</script>";
    }

    // Close connection
    $stmt->close();
    $con->close();
} else {
    echo 'Error';
}
?>