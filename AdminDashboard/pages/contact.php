<?php
  session_start();

  if(!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../Entry/login.php");
    exit();
}
if($_SESSION['role'] != "Admin") {
    header("Location: ../UserPanel");
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
    </style>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Your email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="4" placeholder="Your message" name="message" required></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
            <p class="form-text mt-3">Need help with something else? <a href="./FAQ.php">Check our FAQ</a></p>
        </form>
    </div>
</body>

</html>
