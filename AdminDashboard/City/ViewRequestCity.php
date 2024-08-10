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

<?php
include "../../connection.php";

$city = $_REQUEST['sname'];

$citySql = "SELECT * FROM request_city_tb WHERE city_name = ?";
$cityStmt = $con->prepare($citySql);
$cityStmt->bind_param("s", $city);
$cityStmt->execute();
$cityResult = $cityStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .myimg {
            border-radius: 15px;
        }

        .test-center {
            text-align: justify;
            line-height: 1.6;
        }

        .container {
            padding: 20px;
        }
        .add-btn {
            position: fixed;
            bottom: 7rem;
            right: 20px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            border: none;
        }
    </style>
</head>

<body>
    
    <div class="container">
        <h1 class="text-center fs-1">City Details</h1>
        
        <?php $row = $cityResult->fetch_assoc(); ?>
            <div class="row mb-4">
                <div class="col-md-3 d-flex justify-content-center">
                    <img class="myimg" src="../stateImage/<?php echo $row['city_image']; ?>" alt="City Image" width="200" height="200">
                </div>
                <div class="col-md-9 test-center fs-6">
                    <h2><?php echo $row['city_name']; ?></h2>
                    <p><?php echo $row['city_description']; ?></p>
                    <p><strong>Spiritual Significance:</strong> <?php echo $row['city_sprit']; ?></p>
                    <!-- Add any other details you want to display -->
                </div>
            </div>

        <button class="btn btn-success mt-3" style="float: right;"><a href="./AddRequest.php?sname=<?php echo $row['city_name']; ?>" style="text-decoration: none; color: white;">Add</a></button>
    </div>
    
    <script>
        // You can add any JavaScript you need here
    </script>
</body>

</html>
