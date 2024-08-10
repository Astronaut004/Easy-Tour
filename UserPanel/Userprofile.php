<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css" class="css">

</head>

<body>
    <?php include "./Header.php" ?>
    <?php
    include "../connection.php";
    $name = $_REQUEST['name'];
    $sql = "SELECT * FROM user_tb WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $image = $row['photo'];
    $user = $row['username'];
    $email = $row['email'];
    ?>
    <div class="container mt-3">
        <h1 class="text-center mb-2 username">User Profile</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $image ?>" class="rounded-circle" alt="" width="150px" height="150px">
            </div>
            <div class="col-md-8" >
                <p><strong>Username:</strong> <?php echo $user ?></p>
                <p><strong>Email:</strong> <?php echo $email ?></< /p>
            </div>
        </div>
        <hr>
        <div class="row mt-5 align-items-start">
            <div class="col-md-5 col-sm-12">
                <h4 class="text-center">User Feedback</h4>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="vertical-line"></div>
            </div>
            <div class="col-md-5 col-sm-12">
                <h4 class="text-center">User Requests</h4>
            </div>
        </div>
        <hr>
    </div>
</body>

</html>