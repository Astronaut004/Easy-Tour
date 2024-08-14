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
        <h1 class="text-center">Request New State</h1>
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
                    <button type="submit" class="btn btn-custom1 w-100">Request new state</button>
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
        $targetDir1 = "../../AdminDashboard/stateImage/";
        $targetDir2 = "../stateImage/";
        $targetFile1 = $targetDir1 . basename($simage['name']);
        $targetFile2 = $targetDir2 . basename($simage['name']);
        if ($simage['error'] !== UPLOAD_ERR_OK) {
            echo "Image Upload failed: " . $simage['error'];
            die();
        }
        if (!move_uploaded_file($simage['tmp_name'], $targetFile1)) {
            echo "Image Upload failed 1";
            die();
        }
        if (!copy($targetFile1, $targetFile2)) {
            echo "Image Upload failed 2";
            die();
        }
        $sql_check_state_tb = "SELECT * FROM state_tb WHERE state_name = ?";
        $stmt_check_state_tb = $con->prepare($sql_check_state_tb);
        $stmt_check_state_tb->bind_param("s", $name);
        $stmt_check_state_tb->execute();
        $result_check_state_tb = $stmt_check_state_tb->get_result();

        if ($result_check_state_tb->num_rows > 0) {
            echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>State Already Exists!</strong>.
            </div>
            ';
        } else {
            // Check if the state already exists in request_tb
            $sql_check_request_tb = "SELECT * FROM request_tb WHERE state_name = ?";
            $stmt_check_request_tb = $con->prepare($sql_check_request_tb);
            $stmt_check_request_tb->bind_param("s", $name);
            $stmt_check_request_tb->execute();
            $result_check_request_tb = $stmt_check_request_tb->get_result();

            if ($result_check_request_tb->num_rows > 0) {
                // State already requested in request_tb
                echo '
                <div id="alertBox" class="alert alert-warning fade show" role="alert">
                    <div id="slider"></div>
                    <strong>Already Requested!</strong> This state has already been requested to the admin.
                </div>
                ';
            } else {
                // Insert new state into request_tb
                $sql = "INSERT INTO request_tb (state_name, state_description, state_photo, state_sprituality, state_wildlife, state_culture, state_food,username) VALUES (?, ?, ?, ?, ?, ?,?, ?)";
                $stmt = $con->prepare($sql);

                $stmt->bind_param("ssssssss", $name, $description, $simage['name'], $soul, $wild, $culture, $food,$_SESSION['username']);

                if ($stmt->execute()) {
                    echo '
                    <div id="alertBox" class="alert alert-success fade show" role="alert">
                        <div id="slider"></div>
                        <strong>Great!</strong> New state has been added to the request list.
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
                        <strong>Oops!</strong> Something went wrong. Error: ' . $stmt->error .
                    '</div>
                    ';
                    die();
                }
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
