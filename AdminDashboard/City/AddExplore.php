<?php
  session_start();

  if(!$_SESSION['username']) {
    header("Location: ../../Entry/login.php");
    exit();
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        h1 {
            font-family: "Kaushan Script", cursive;
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
<?php
        include "../../connection.php";

        $sql = "SELECT * FROM state_tb";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>



    <div class="container">
        <h1 class="text-center mt-4">Add New City</h1>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="../FillData/images/state.jpg" alt="" width=100% height=100%>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-5 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">City Name*</label>
                        <input type="text" class="form-control" name="cname">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City Spiritual Significance</label>
                        <input type="text" class="form-control" name="csoul">
                    </div>

                    <div class="mb-3">
                        <label >State Name*:</label>
                        <select name="stateName" class="form-control" >
                            <option value="">Select a State</option>
                            <?php
                                while($row = $result->fetch_assoc()) {
                                    $state = $row['state_name'];
                                    echo '<option value="'.$state.'">'.$state.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City Description*</label>
                        <textarea type="text" class="form-control" name="cdesc"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City Photo*</label>
                        <input type="file" class="form-control" name="cimage">
                    </div>
                    <button type="submit" class="btn btn-custom1 w-100">Add new City</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            const alertBox = document.querySelector('#alertBox');
            if (alertBox) {
                alertBox.classList.add('show');
                setTimeout(function() {
                    alertBox.classList.remove('show');
                }, 3000);
            }
        });
    </script>
</body>

</html>



<?php

//session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($_REQUEST['cname']) &&
        !empty($_REQUEST['cdesc']) &&
        !empty($_REQUEST['stateName']) &&
        !empty($_FILES['cimage']['name'])
    ) {
        $name = $_REQUEST['cname'];
        $soul = !empty($_REQUEST['csoul']) ? $_REQUEST['csoul'] : "NA";
        $description = $_REQUEST['cdesc'];
        $state = $_REQUEST['stateName'];
        $simage = $_FILES['cimage'];

        $file = "../stateImage/" . basename($simage['name']);
        if (!move_uploaded_file($simage['tmp_name'], $file)) {
            echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>Image Upload failed!</strong> Please try again.
            </div>
            ';
            die();
        }

        $sql = "SELECT * FROM city_tb WHERE city_name = ? AND city_state = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $name, $state);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_affected_rows($con) > 0) {
            echo "already pre...";
            echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>City Already Added!</strong> Please either change the state or city name.
            </div>
            ';            
            die();
        }
        else{
        echo "code here.......";
        
        
//session_start();        
        $sql1 = "INSERT INTO city_tb (city_name, city_sprit, city_description, city_state, city_image, username) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("ssssss", $name, $soul, $description, $state, $simage['name'], $_SESSION['username']);
        if ($stmt1->execute()) {
            echo '
            <div id="alertBox" class="alert alert-success fade show" role="alert">
                <div id="slider"></div>
                <strong>Great!</strong> New City has been Added.
            </div>
            <script>window.open("../explore.php","_self")</script>
            ';
        } else {
            echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>Oops!</strong> Something went wrong. Please try again.
            </div>
            ';
            die();
        
        }
    }
    } else {
        echo '
        <div id="alertBox" class="alert alert-info fade show" role="alert">
            <div id="slider"></div>
            <strong>All Fields Required!</strong> Please complete all fields before submitting.
        </div>
        ';        
    }
}

?>
