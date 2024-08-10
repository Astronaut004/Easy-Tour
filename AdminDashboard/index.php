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
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
            margin: 0;
        }

        .sidebar {
            width: 280px;
            flex-shrink: 0;
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow: auto;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .content {
            padding: 0;
        }

        .bg {
            background-color: #484128;
        }
        .active, .dropdown-menu {
            background-color: #d4ccb1 !important;
        }
    </style>
</head>

<body>
<?php
    include "../connection.php";
    $sql = "SELECT * FROM user_tb WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s",$_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $image = $row['photo'];
?>
<div class="sidebar bg text-white">
        <div class="d-flex flex-column flex-shrink-0 p-3">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Admin Dashboard</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="./Dashboard.php" class="nav-link active text-white" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="./explore.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Different state
                    </a>
                </li>
                <li>
                    <a href="./pages/location.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Location
                    </a>
                </li>
                <li>
                    <a href="Testimonial.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Feedback
                    </a>
                </li>
                <li>
                    <a href="./pages/showuser.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                        User
                    </a>
                </li>
                <li>
                    <a href="./adminSetting.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                        Setting
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $image ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong> <?php echo $_SESSION['username']; ?> </strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <!-- <li><a class="dropdown-item" href="#"></a></li> -->
                    <!-- <li><a class="dropdown-item" href="./adminSetting.php">Settings</a></li> -->
                    <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                    <li><a class="dropdown-item" href="../Entry/logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content container-fluid">
        <iframe id="main-content" src="./Dashboard.php" name="content-frame"></iframe>
    </div>
    <script>
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));

                link.classList.add('active');

                const url = link.getAttribute('href');
                document.getElementById('main-content').src = url;
            });
        });
    </script>
</body>

</html>