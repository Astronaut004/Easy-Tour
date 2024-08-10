<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        #alertBox {
            position: fixed;
            top: 80px;
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
    <?php include "./Header.php" ?>

    <!-- Button to Open Form Modal -->
    <div class="fixed-button">
        <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#updateFormModal">
            <span class="d-flex align-items-center justify-content-center" style="height: 100%; width: 100%; font-size: 0.875rem; text-align: center;">Add Your Experience</span>
        </button>
    </div>


    <div class="container mt-5 my-box">
        <!-- Form Modal -->
        <!-- Modal -->
        <div class="modal fade" id="updateFormModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateFormModalLabel">Tell us about Your Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- <div class="container w-100"> -->
                    <div class="modal-body">
                        <form id="experienceForm" action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Topic*</label>
                                <input type="text" class="form-control" placeholder="What Topic you want to share" name="fhead">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Related</label>
                                <input type="text" class="form-control" placeholder="Enter city or state if any specific" name="frelate">
                            </div>
                            <!-- <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="fimage">
                            </div> -->
                            <div class="mb-3">
                                <label class="form-label">Experience*</label>
                                <textarea class="form-control" rows="3" name="fdesc" placeholder="What have you Experienced"></textarea>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-custom1">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>

        <?php
        include "../connection.php";
        
        // echo $_SESSION['username'];

        $sql = "SELECT * FROM feedback_tb";
        $stmt = $con->prepare($sql);
        // $stmt->bind_param()
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $starRating = '';
            switch ($row['feed_star']) {
                case 1:
                    $starRating = '★☆☆☆☆';
                    break;
                case 2:
                    $starRating = '★★☆☆☆';
                    break;
                case 3:
                    $starRating = '★★★☆☆';
                    break;
                case 4:
                    $starRating = '★★★★☆';
                    break;
                case 5:
                    $starRating = '★★★★★';
                    break;
            }
            $isUser = 0;
            $user1 = strtolower(trim($row['feed_username']));
            $user2 = strtolower(trim($_SESSION['username']));
            
            if ($user1 === $user2) {
                $isUser = 1;
            }
            

            echo '
    <div class="row featurette mb-5">
        <div class="col-md-8 order-md-2">
            <h2 class="featurette-heading fw-normal lh-1">' . $row['feed_head'] . ' <span class="text-body-secondary">' . $row['feed_sub'] . '</span></h2>
            <p>' . $starRating . '</p>
            <p class="lead">' . $row['feed_desc'] . '</p>
            <div class="image-links">';
            if ($isUser) {
                echo '
            <a href="./TestimonialCRUD/update.php?id=' . $row['feed_id'] . '" id="like-link">
                <img src="../images/edit.png" alt="edit">
            </a>
            <a href="./TestimonialCRUD/delete.php?id=' . $row['feed_id'] . '" id="report-link">
                <img src="../images/trash.png" alt="trash">
            </a>';
            }
            echo '
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center order-md-1">
            <a href="#" class="btn btn-custom">
                <img src="' . $row['feed_image'] . '" class="circular-img" alt="Feature Image">
            </a>
            <p class="user-name">' . $row['feed_username'] . '</p>
        </div>
    </div>';
        }
        ?>


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
        window.addEventListener('load', function() {
            window.scrollTo(0, document.body.scrollHeight);
        });

        window.addEventListener('scroll', function() {
            const header = document.querySelector('.myhead');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>

<?php
// include "../connection.php";
$uname = $_SESSION['username'];
// echo "$uname";
$sql = "SELECT * FROM user_tb WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $uname);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$image = $row['photo'];
// echo "$image";
$user = $row['username'];
if ($user == '' || $image == '') {
    echo '
            <div id="alertBox" class="alert alert-danger fade show" role="alert">
                <div id="slider"></div>
                <strong>Here is error is backend!</strong>.
            </div>
            ';
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_REQUEST['fhead'] != '' && $_REQUEST['fdesc'] != '' && $_REQUEST['frating']) {

            $head = $_REQUEST['fhead'];
            $desc = $_REQUEST['fdesc'];
            $rating = $_REQUEST['frating'];
            $sub = !empty($_REQUEST['frelate']) ? $_REQUEST['frelate'] : "NA";


            $sql = "INSERT INTO feedback_tb (feed_head, feed_sub, feed_username, feed_image, feed_star, feed_desc) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssis", $head, $sub, $user, $image, $rating, $desc);
            if ($stmt->execute()) {
                echo '
                        <div id="alertBox" class="alert alert-success fade show" role="alert">
                            <div id="slider"></div>
                            <strong>Your feedback Added!</strong>Thank you.
                        </div>
                        <script>window.open("Testimonial.php","_self")</script>
                        ';
            } else {
                echo '
                        <div id="alertBox" class="alert alert-danger fade show" role="alert">
                            <div id="slider"></div>
                            <strong>Something went wrong!</strong>.
                        </div>
                        ';
            }

            // $culture = !empty($_REQUEST['sculture']) ? $_REQUEST['sculture'] : "NA";
        } else {
            echo '
                    <div id="alertBox" class="alert alert-danger fade show" role="alert">
                        <div id="slider"></div>
                        <strong>Fill up!</strong>* field cannot be empty.
                    </div>
                    ';
        }
    }
}


?>