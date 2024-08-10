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
    <title>Add Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        h1 {
            font-family: "Kaushan Script", cursive;
        }

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
    <div class="container">
        <h1 class="text-center">Add New State</h1>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="./images/state.jpg" alt="" width=100% height=100%>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-5 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">State Name*</label>
                        <input type="text" class="form-control" name="sname">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Spiritual Significance</label>
                        <input type="text" class="form-control" name="ssoul">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Wildlife</label>
                        <input type="text" class="form-control" name="swild">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Culture</label>
                        <input type="text" class="form-control" name="sculture">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Famous Food</label>
                        <input type="text" class="form-control" name="sfood">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Description*</label>
                        <textarea type="text" class="form-control" name="sdesc"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Photo*</label>
                        <input type="file" class="form-control" name="simage">
                    </div>
                    <button type="submit" class="btn btn-custom1 w-100">Add new state</button>
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
                }, 3000); // Adjust duration if needed
            }
        });
    </script>
</body>

</html>


<?php

include "../../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        // Check only these three fields
        !empty($_REQUEST['sname']) &&
        !empty($_REQUEST['sdesc']) &&
        !empty($_FILES['simage']['name'])
    ) {
        $name = $_REQUEST['sname'];
        $soul = !empty($_REQUEST['ssoul']) ? $_REQUEST['ssoul'] : "NA";
        $wild =  !empty($_REQUEST['swild']) ? $_REQUEST['swild'] : "NA";
        $culture = !empty($_REQUEST['sculture']) ? $_REQUEST['sculture'] : "NA";
        $food = !empty($_REQUEST['sfood']) ? $_REQUEST['sfood'] : "NA";
        $description = $_REQUEST['sdesc'];
        $simage = $_FILES['simage'];

        $file = "../stateImage/" . basename($simage['name']);
        // Upload image
        if (!move_uploaded_file($simage['tmp_name'], $file)) {
            echo "Image Upload failed";
            die();
        }

        $sql = "SELECT * FROM state_tb WHERE state_name = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>State Already Added!</strong> Please use a different name.
            </div>
            ';            
            die();
        }

        // Insert new state
        $sql1 = "INSERT INTO state_tb (state_name, state_description, state_photo, state_sprituality, state_wildlife, state_culture, state_food) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("sssssss", $name, $description, $simage['name'], $soul, $wild, $culture, $food);
        if ($stmt1->execute()) {
            echo '
            <div id="alertBox" class="alert alert-success fade show" role="alert">
                <div id="slider"></div>
                <strong>Great!</strong> New State has been Added.
            </div>
            <script>window.open("../explore.php", "_self")</script>
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
