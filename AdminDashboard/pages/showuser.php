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
    <title>Show User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<style>
    h1 {
        font-family: 'Poppins', sans-serif;
    }
</style>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Users</h1>
        <div class="row">
        <?php
        include "../../connection.php";
        $sql = "SELECT * FROM user_tb";
        $stmt = $con->prepare($sql);
        // $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $name = $row['username'];
            // $description = $row['state_description'];
            $simage = $row['photo'];
            $role = $row['role'];
            echo '
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="../' . $simage . '" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">' . $name . '</h5>
                    <p class="card-text">' . $role . '</p>
                    <div class="d-flex justify-content-between">
                        <a href="../../UserPanel/UserProfile?name='. $name .'" class="btn btn-custom1 w-100 me-1">View</a>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="./deleteUser.php?sname=' . $name . '" class="btn btn-danger w-100" onclick="return confirmDelete()">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
        }
        ?>
    </div>
    </div>
</body>

</html>