<?php
session_start();

if (!$_SESSION['username']) {
    header("Location: ../../Entry/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Testimonial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
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
$id = $_REQUEST['id'];

$sql = "SELECT * FROM feedback_tb WHERE feed_id=?"; // Added LIMIT 1 to avoid fetching more rows than needed
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$head = !empty($row['feed_head']) ? $row['feed_head'] : 'NA';
$sub = !empty($row['feed_sub']) ? $row['feed_sub'] : 'NA';
$star = !empty($row['feed_star']) ? $row['feed_star'] : 'NA';
$desc = !empty($row['feed_desc']) ? $row['feed_desc'] : 'NA';


?>

<body>
    <div class="container">
        <h1 class="text-center">Update Your Feedback</h1>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="../FillData/images/state.jpg" alt="" width="100%" height="100%">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-5 ">
                <form id="experienceForm" action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Topic*</label>
                        <input type="text" class="form-control" placeholder="What Topic you want to share" value="<?php echo $head; ?>" name="fhead">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Related</label>
                        <input type="text" class="form-control" placeholder="Enter city or state if any specific" value="<?php echo $sub; ?>" name="frelate">
                    </div>
                    <!-- <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="fimage">
                            </div> -->
                    <div class="mb-3">
                        <label class="form-label">Experience*</label>
                        <textarea class="form-control" rows="3" name="fdesc" placeholder="What have you experienced"><?php echo $desc; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating*</label>
                        <select name="frating" class="form-select">
                            <option value="" disabled selected>Select a rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="w-100">
                        <button type="submit" class="btn btn-custom1 w-100">Submit</button>
                    </div>
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
        !empty($_REQUEST['fhead']) &&
        !empty($_REQUEST['fdesc']) &&
        !empty($_REQUEST['frating']) 
    ) {
        $head = $_REQUEST['fhead'];
        $subHead = !empty($_REQUEST['frelate']) ? $_REQUEST['frelate'] : $sub;
        $description = $_REQUEST['fdesc'];
        $rating = $_REQUEST['frating'];

        // Update the record
        $sql1 = "UPDATE feedback_tb SET feed_head = ?, feed_sub = ?, feed_desc = ?, feed_star = ? WHERE feed_id = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("sssii",$head,$subHead,$description,$rating,$id);

        if ($stmt1->execute()) {
            echo '
            <div id="alertBox" class="alert alert-success fade show" role="alert">
                <div id="slider"></div>
                <strong>Feedback Updated!</strong> Redirecting...
                <script>window.open("../Testimonial.php", "_self")</script>
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