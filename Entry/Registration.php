<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./login.css">
    <style>
        /* Existing CSS */
        #alertBox {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 350px;
            z-index: 99;
            opacity: 0;
            transform: translateX(10%);
            animation: none;
            animation-duration: 0.5s;
            animation-fill-mode: forwards;
        }

        @keyframes slideInFromRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        #alertBox.show {
            animation-name: slideInFromRight;
            opacity: 1;
        }



        @keyframes slide {
            from {
                width: 0%;
            }

            to {
                width: 100%;
            }
        }

        #slider {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            border-bottom: 2px solid black;
            animation: slide 3s linear forwards;
        }
    </style>
</head>

<body>
    <?php
    // if ($emptyData) {
    //     echo '
    //     <div id="alertBox" class="alert alert-warning fade show" role="alert">
    //         <div id="slider"></div>
    //         <strong>Check Properly!</strong>Something Empty.
    //     </div>
    //     ';
    // }
    ?>
    <div class="container" style="position: relative;">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2 class="text-center mb-4 text-dark">Registration</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Enter your username" name="uname">
                    <small class="form-text text-muted">Pick a nice and unique name for yourself.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="role" value="User" onclick="toggleAdminCode(false)" checked>User
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="Admin" onclick="toggleAdminCode(true)">Admin
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Code Field (always displayed but disabled/enabled based on role) -->
            <div id="adminCodeBox" class="mb-3">
                <label class="form-label">Admin Code</label>
                <input type="number" class="form-control" name="adminCode" maxlength="5" disabled>
            </div>

            <!-- Photo Upload Field -->
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <small class="form-text text-muted">Please upload an image file (JPG, PNG, GIF).</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="form-text mt-3">Already have an account? <a href="./login.php">Login here</a></p>
        </form>
    </div>

    <script>
        function toggleAdminCode(isAdmin) {
            const adminCodeBox = document.querySelector('#adminCodeBox input[name="adminCode"]');
            adminCodeBox.disabled = !isAdmin;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const isAdmin = document.querySelector('input[name="role"]:checked').value === 'Admin';
            toggleAdminCode(isAdmin);
        });

        window.addEventListener('load', function() {
            const alertBox = document.querySelector('#alertBox');
            if (alertBox) {
                alertBox.classList.add('show');
                setTimeout(function() {
                    alertBox.classList.remove('show');
                }, 3000); // Adjust duration if needed
            }
        });
    </script>
</body>

</html>



<?php
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($_REQUEST['uname'] != '' && $_REQUEST['pass'] != '' && $_REQUEST['email'] && $_REQUEST['role']) {
        $username = $_REQUEST['uname'];
        $password = $_REQUEST['pass'];
        $email = $_REQUEST['email'];
        $role = $_REQUEST['role'];
        $adminCode = isset($_REQUEST['adminCode']) ? (int)$_REQUEST['adminCode'] : 0;

        $image = '../images/user.png'; // Default image path

        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $imageName = basename($_FILES['image']['name']);
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imagePath = '../uploads/' . $imageName;

            $validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['image']['type'], $validTypes)) {
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $image = $imagePath;
                }
            }
        }



        if (($role == 'Admin' && $adminCode == 12345) || ($role == 'User' && $adminCode != 12345)) {
            $sql = "SELECT id FROM user_tb WHERE username = ? OR email = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $userAlready = 1;
            } else {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql1 = "INSERT INTO user_tb (username , password , email , role , admin_code, photo) VALUES (?,?,?,?,?,?)";
                $stmt1 = $con->prepare($sql1);
                $stmt1->bind_param("ssssis", $username, $hashPassword, $email, $role, $adminCode, $image);
                if ($stmt1->execute()) {
                    echo "<script>window.location.href='login.php';</script>";
                } else {
                    echo '
                    <div id="alertBox" class="alert alert-danger fade show" role="alert">
                        <div id="slider"></div>
                        <strong>Something went Wrong!</strong>Enter Data Again.
                    </div>
                    ';
                }
                $stmt->close();
                $con->close();
            }
        } else {
            echo '
            <div id="alertBox" class="alert alert-info fade show" role="alert">
                <div id="slider"></div>
                <strong>Code Error!</strong>There no such code.
            </div>
            ';
        }
    } else {
            echo '
            <div id="alertBox" class="alert alert-warning fade show" role="alert">
                <div id="slider"></div>
                <strong>Check Properly!</strong>Something Empty.
            </div>
            ';
    }
}
?>