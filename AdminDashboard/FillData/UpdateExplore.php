<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Explore</title>
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
<?php

include "../../connection.php";
// $unn = $_REQUEST['un'];
$name = $_REQUEST['sname'];

$sql = "SELECT * FROM state_tb WHERE state_name=?"; // Added LIMIT 1 to avoid fetching more rows than needed
$stmt = $con->prepare($sql);
$stmt->bind_param("s",$name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$name = $row['state_name'];
$soul = $row['state_sprituality'];
$description = $row['state_description'];
$wild = $row['state_wildlife'];
$culture = $row['state_culture'];
$simage = $row['state_photo'];
$food = $row['state_food'];

?>

<body>
    <div class="container">
        <h1 class="text-center">Update State</h1>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="./images/state.jpg" alt="" width="100%" height="100%">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-5 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">State Name*</label>
                        <input type="text" class="form-control" name="sname" value="<?php echo $name; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Spiritual Significance</label>
                        <input type="text" class="form-control" name="ssoul" value="<?php echo $soul; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Wildlife</label>
                        <input type="text" class="form-control" name="swild" value="<?php echo $wild; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Culture</label>
                        <input type="text" class="form-control" name="sculture" value="<?php echo $culture; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Famous Food</label>
                        <input type="text" class="form-control" name="sfood" value="<?php echo $food; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Description*</label>
                        <textarea class="form-control" name="sdesc"><?php echo $description; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State Photo*</label>
                        <input type="file" class="form-control" name="simage" >
                            <img src="../stateImage/<?php echo $simage; ?>" alt="Current State Photo" width="100" height="100">
                    </div>
                    <button type="submit" class="btn btn-custom1 w-100">Update State Information</button>
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
        !empty($_REQUEST['sdesc'])
    ) {
        $name = $_REQUEST['sname'];
        $soul = !empty($_REQUEST['ssoul']) ? $_REQUEST['ssoul'] : "NA";
        $wild = !empty($_REQUEST['swild']) ? $_REQUEST['swild'] : "NA";
        $culture = !empty($_REQUEST['sculture']) ? $_REQUEST['sculture'] : "NA";
        $food = !empty($_REQUEST['sfood']) ? $_REQUEST['sfood'] : "NA";
        $description = $_REQUEST['sdesc'];
        $simage = $_FILES['simage'];

        $sql = "SELECT state_photo FROM state_tb WHERE state_name = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $currentImage = $row['state_photo'];

        if (!empty($simage['name'])) {
            $file = "../stateImage/" . basename($simage['name']);
            if (!move_uploaded_file($simage['tmp_name'], $file)) {   
                die();
            }
            $imagePath = $simage['name'];
        } else {
            // No new image uploaded, retain the existing one
            $imagePath = $currentImage;
        }

        // Update the record
        $sql1 = "UPDATE state_tb SET state_description = ?, state_photo = ?, state_sprituality = ?, state_wildlife = ?, state_culture = ?, state_food = ? WHERE state_name = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("sssssss", $description, $imagePath, $soul, $wild, $culture, $food, $name);

        if ($stmt1->execute()) {
            echo '
            <div id="alertBox" class="alert alert-success fade show" role="alert">
                <div id="slider"></div>
                <strong>State Data Updated!</strong> Redirecting.
                <script>window.open("../explore.php", "_self")</script>
            </div>
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
            <strong>All Fields Required!</strong> Please fill all fields before submitting.
        </div>
        ';        
    }
}
?>
