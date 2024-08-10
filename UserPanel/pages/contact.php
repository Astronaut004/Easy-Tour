<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../Entry/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Kaushan+Script&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            background: url('../resources/coro1.jpg') no-repeat center center fixed;
            /* background: url('../images/contactBack.jpg') no-repeat center center fixed; */
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            max-width: 800px;
        }

        h2.text-center {
            color: rgba(0, 0, 0, 0.8);
        }

        .form-group label,
        .form-check-label,
        .form-text {
            color: #333;
            font-weight: 600;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #555;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        @media (max-width: 576px) {
            .container {
                padding: 1rem;
            }

            .form-group,
            .form-check {
                margin-bottom: 1rem;
            }

            .btn-primary {
                padding: 0.75rem;
            }
        }

        p a {
            text-decoration: none;
            color: blue;
        }

        .btn {
            border-radius: 0.25rem;
            background-color: #90886a;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
            color: white;
        }

        .btn:hover {
            background-color: #484128;
            transform: scale(1.05);
            color: white;
        }

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
    <div class="container">
        <form action="" method="POST">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Your email" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" class="form-control" placeholder="Your email" name="subj">
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="4" placeholder="Your message" name="message"></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
            <p class="form-text mt-3">Need help with something else? <a href="./FAQ.php">Check our FAQ</a></p>
        </form>
    </div>
    <script>
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

<?php
include "../../connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_REQUEST['email'] != '' && $_REQUEST['subj'] != '' && $_REQUEST['message'] != '') {
        $sql = "INSERT INTO contact_tb (username, email, subject, message) VALUES (?,?,?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $_SESSION['username'], $_REQUEST['email'], $_REQUEST['subj'], $_REQUEST['message']);
        if ($stmt->execute()) {
            echo '
                <div id="alertBox" class="alert alert-info fade show" role="alert">
                    <div id="slider"></div>
                    <strong>Message Sent!</strong>.
                </div>
                <script>
                    window.addEventListener("load", function() {
                        setTimeout(function() {
                            window.open("../explore.php", "_self");
                        }, 2000); // Delay in milliseconds (3 seconds)
                    });
                </script>
                ';
        } else {
            echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>Something went wrong!</strong>.
            </div>
            ';
        }
    }
}
?>

</html>