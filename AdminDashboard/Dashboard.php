<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../Entry/login.php");
    exit();
}
if ($_SESSION['role'] != "Admin") {
    header("Location: ../UserPanel");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASYTOUR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<style>
    .container-fluid {
        position: relative;
    }

    .notification-bar {
        display: flex;
        background-color: #484128;
        padding: 10px;
        justify-content: center;
    }

    .notification-btn {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        margin: 0 10px;
        cursor: pointer;
        padding: 10px;
        border-radius: 5px;
    }

    .notification-btn.active {
        background-color: #ffffff;
        color: #484128;
        font-weight: bold;
    }

    .notification-content {
        display: none;
        padding: 10px;
        background-color: #F6EED4;
        border-top: 1px solid #ddd;
    }

    .notification-content.active {
        display: block;
    }
</style>

<body>
    <?php
    include "../connection.php";
    $view = 0;

    $sql1 = "SELECT COUNT(*) AS user_count FROM user_tb WHERE view = 0";
    $result1 = $con->query($sql1);
    $userCount = 0;

    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $userCount = $row1['user_count'];
    } else {
        $userCount = '';
    }

    $sql = "SELECT * FROM user_tb WHERE view = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $view);
    $stmt->execute();
    $result = $stmt->get_result();

    ?>
    <?php
    $view = 0;
    $sql2 = "SELECT COUNT(*) AS feed_count FROM feedback_tb WHERE view = 0";
    $result2 = $con->query($sql2);
    $feedCount = 0;

    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $feedCount = $row2['feed_count'];
    } else {
        $feedCount = '';
    }


    $sql3 = "SELECT * FROM feedback_tb WHERE view = ?";
    $stmt3 = $con->prepare($sql3);
    $stmt3->bind_param("i", $view);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    // Fetch City
    $sqlcity = "SELECT rc.*, u.photo FROM request_city_tb rc 
    JOIN user_tb u ON rc.username = u.username";
    $stmtcity = $con->prepare($sqlcity);
    $stmtcity->execute();
    $resultcity = $stmtcity->get_result();
    // count city
    $countCitysql = "SELECT COUNT(*) AS city_count FROM request_city_tb";
    $resultCountCity = $con->query($countCitysql);
    $CityCount = 0;

    if ($resultCountCity->num_rows > 0) {
        $row2 = $resultCountCity->fetch_assoc();
        $CityCount = $row2['city_count'];
    } else {
        $CityCount = '';
    }

    // fetch state
    $countstatesql = "SELECT COUNT(*) AS request FROM request_tb";
    $resultCountstate = $con->query($countstatesql);
    $stateCount = 0;

    if ($resultCountstate->num_rows > 0) {
        $row2 = $resultCountstate->fetch_assoc();
        $stateCount = $row2['request'];
    } else {
        $stateCount = '';
    }

    $sqlstate = "SELECT rc.*, u.photo FROM request_tb rc 
    JOIN user_tb u ON rc.username = u.username";
    $stmtstate = $con->prepare($sqlstate);
    $stmtstate->execute();
    $resultstate = $stmtstate->get_result();

    //count contact
    $countcontact = "SELECT COUNT(*) AS request FROM contact_tb";
    $resultContact = $con->query($countcontact);
    $contactCount = 0;

    if ($resultContact->num_rows > 0) {
        $row2 = $resultContact->fetch_assoc();
        $contactCount = $row2['request'];
    } else {
        $contactCount = '';
    }


    ?>
    <div class="container-fluid p-0 bg-info">
        <div class="notification-bar">
            <button class="notification-btn" data-target="note1">New User <span class="badge text-bg-danger"> <?php echo $userCount; ?> </span></button>
            <button class="notification-btn" data-target="note2">New Feedback <span class="badge text-bg-danger"> <?php echo $feedCount; ?> </span></button>
            <button class="notification-btn" data-target="note3">Request City <span class="badge text-bg-danger"><?php echo $CityCount; ?> </span></button>
            <button class="notification-btn" data-target="note4">Request State <span class="badge text-bg-danger"> <?php echo $stateCount; ?> </span></button>
            <button class="notification-btn" data-target="note5">Contact <span class="badge text-bg-danger"> <?php echo $contactCount ?> </span></button>
        </div>

        <!-- New User Section -->
        <div id="note1" class="notification-content">
            <?php if ($userCount > 0) {
                echo '            
            <form action="./Notification/markUserSeen.php" method="post">
                <input type="submit" class="btn btn-success" style="float: right;" value="Mark as seen">
            </form>';
            } ?>
            <div class="container">
                <?php if ($userCount > 0) {
                    echo '<h1 class="text-center mt-3">New Users</h1>';
                } else {
                    echo '<h1 class="text-center mt-3">No new User</h1>';
                } ?>
                <?php while ($row =  $result->fetch_assoc()) {
                    echo '
        <div class="row mt-5">
            <div class="col-md-2"><img src="' . $row['photo'] . '" alt="" class="rounded-circle" width="130px"></div>
            <div class="col-md-10">
                <p><strong>Username: </strong> ' . $row['username'] . '</p>
                <p><strong>Email: </strong> ' . $row['email'] . '</p>
                <p><strong>Role: </strong> ' . $row['role'] . '</p>
                <p><strong>Join Date: </strong> ' . $row['created_at'] . '</p>
            </div>
        </div>
        <hr>';
                } ?>
            </div>
        </div>

        <!-- New Feedback Section -->
        <div id="note2" class="notification-content">
            <?php if ($feedCount > 0) {
                echo '            
            <form action="./Notification/markfeedSeen.php" method="post">
                <input type="submit" class="btn btn-success" style="float: right;" value="Mark as seen">
            </form>';
            } ?>
            <div class="container">
                <?php if ($feedCount > 0) {
                    echo '<h1 class="text-center mt-3">Recent Feedback</h1>';
                } else {
                    echo '<h1 class="text-center mt-3">No new Feedback</h1>';
                } ?>
                <?php while ($row =  $result3->fetch_assoc()) {
                    echo '
        <div class="row mt-5">
            <div class="col-md-2"><img src="' . $row['feed_image'] . '" alt="" class="rounded-circle" width="130px"></div>
            <div class="col-md-10">
                <p><strong>Heading: </strong> ' . $row['feed_head'] . '</p>
                <p><strong>Description: </strong> ' . $row['feed_desc'] . '</p>
                <p><strong>Username: </strong> ' . $row['feed_username'] . '</p>
                <p><strong>Join Date: </strong> ' . $row['created_at'] . '</p>
            </div>
        </div>
        <hr>';
                } ?>
            </div>
        </div>

        <!-- Request City Section -->
        <div id="note3" class="notification-content">
            <div class="container mt-3">
                <?php
                while ($row = $resultcity->fetch_assoc()) {
                    $id = $row['city_id'];
                    $city = $row['city_name'];
                    $soul = $row['city_sprit'];
                    $desc = $row['city_description'];
                    $image = $row['city_image'];
                    $state = $row['city_state'];
                    $user = $row['username'];
                    $userPhoto = $row['photo'];
                    $date = $row['created_at'];
                    echo '
            <div class="row mb-3">
                <div class="col-md-2">
                    <img src="' . $userPhoto . '" alt="" class="rounded-circle" width="130px">
                    <p class="mt-2"><strong>User:</strong> ' . $user . '</p>
                </div>
                <div class="col-md-6">
                    <p class="mt-2"><strong>City:</strong> ' . $city . '</p>
                    <p class="mt-2"><strong>State:</strong> ' . $state . '</p>
                    <p class="mt-2"><strong>Description:</strong> ' . $desc . '</p>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary"><a style="text-decoration: none; color: white;" href="./City/ViewRequestCity.php?sname=' . $city . '">View</a></button>
                    <button class="btn btn-danger"><a style="text-decoration: none; color: white;" href="./City/DeleteRequestCity.php?sname=' . $city . '">Delete</a></button>
                    <p style="float: bottom;" >' . $date . '</p>
                </div>
            </div>
            ';
                }
                ?>
                <hr>
            </div>
        </div>
    </div>

    <!-- Request State Section -->
    <div id="note4" class="notification-content">
        <!-- //note 4 -->
        <div class="container">
            <?php
            while ($row = $resultstate->fetch_assoc()) {
                $state = $row['state_name'];
                // $soul = $row['city_sprit'];
                $desc = $row['state_description'];
                $image = $row['state_photo'];
                // $state = $row['city_state'];
                $user = $row['username'];
                $name = $user;
                $userPhoto = $row['photo'];
                $date = $row['created_at'];
                echo '
            <div class="row mb-3">
                <div class="col-md-2">
                    <img src="' . $userPhoto . '" alt="" class="rounded-circle" width="130px">
                    <p class="mt-2"><strong>User:</strong> ' . $user . '</p>
                </div>
                <div class="col-md-6">
                    <p class="mt-2"><strong>City:</strong> ' . $state . '</p>
                    <p class="mt-2"><strong>State:</strong> ' . $desc . '</p>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary"><a style="text-decoration: none; color: white;" href="./FillData/RequestViewState.php?sname=' . $state . '">View</a></button>
                    <button class="btn btn-danger"><a style="text-decoration: none; color: white;" href="./FillData/RequestDeleteState.php?sname=' . $state . '">Delete</a></button>
                </div>
            </div>
            ';
            }
            ?>
        </div>
        <hr>
    </div>
    <div id="note5" class="notification-content">
        <?php
        include "../connection.php";
        $sql = "SELECT * FROM contact_tb";
        $stmt = $con->prepare($sql);
        // $stmt->bind_param()
        $stmt->execute();
        $result = $stmt->get_result();

        ?>
        <div class="container mt-4">
            <?php
            if($contactCount > 0){
                echo '
            <form action="./pages/contactSeen.php" method="POST">
                <input type="submit" style="float: right;" class="btn btn-danger" value="Delete">
            </form>
                ';
            }
            ?>


            <?php while ($row = $result->fetch_assoc()) {
                echo '    <div class="container mt-4">
        <h3>' . $row['subject'] . '</h3>
        <h4>' . $row['message'] . '</h4>
        <h6><strong>Username:</strong> ' . $row['username'] . '</h6>
        <h5 style="float: right;" >' . $row['created_at'] . '</h5>
        <br>
        <hr>
    </div>
    ';
            } ?>
        </div>
    </div>

    <!-- <a href="./FillData/RequestDeleteState.php"></a> -->
    <!-- Hero -->
    <h1 class="text-center mt-3">Easy<span class="logoHead">Tour</span></h1>
    <div class="px-4 pt-3 my-3 text-center border-bottom">
        <h1 class="display-4 fw-bold feat">Discover Your<span class="logoHead"> Next Adventure</span></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Discover amazing destinations and experiences tailored to your interests. Our platform offers a wide range of travel guides, local insights, and useful tips to help you plan your perfect trip. Whether you’re looking for a serene getaway or an adventurous journey, we’ve got you covered with up-to-date information and expert recommendations.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <!-- <form role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form> -->
            </div>
        </div>
        <div class="overflow-hidden" style="max-height: 30vh;">
            <div class="container px-5">
                <img src="./resources/taj.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
            </div>
        </div>
    </div>

    <!-- Popular Destinations Section -->
    <div class="container">
        <section class=" my-5">
            <h2 class="text-center mb-4 feat">Popular Locations</h2>
            <div class="row">


                <?php

                $sql = "SELECT * FROM state_tb ORDER BY state_name ASC;";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($count >= 4) {
                        break;
                    }
                    $name = $row['state_name'];
                    $description = $row['state_description'];
                    $simage = $row['state_photo'];

                    echo '
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="./detail.php?sname=' . $name . '" class="card-link">
                            <div class="card-img-top">
                                <img src="./stateImage/' . $simage . '" alt="' . $name . '" width="400px" height="200px">
                                <div class="card-img-overlay">
                                    <h5 class="card-title-overlay loc">' . $name . '</h5>
                                    <span>Learn more</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                    ';
                    $count++;
                }
                ?>
                <!-- View More Link -->
                <div class="text-center mylink">
                    <a href="./explore.php" class="view-more-link">
                        View more
                        <img src="../images/viewmore.png" alt="View more" width="12" height="10">
                    </a>
                </div>
            </div>
        </section>
    </div>


    <!-- Testimonials Carousel -->
    <div class="mycarousel container">
        <h1 class="text-center feat">Testimonials</h1>
        <div id="carouselExampleDark2" class="carousel carousel-dark slide mb-5">
            <div class="carousel-inner" style="background-color: #f6eed4;">

                <?php
                $sql = "SELECT * FROM feedback_tb";
                $stmt = $con->prepare($sql);
                // $stmt->bind_param()
                $stmt->execute();
                $result = $stmt->get_result();
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $starRating = '';
                    if ($count >= 3) {
                        break;
                    }
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
                    echo '
                <div class="carousel-item active" data-bs-interval="1000">
                    <div class="row align-items-center m-5">
                        <div class="col-md-3 text-center">
                            <img src="' . $row['feed_image'] . '" alt="Feedback" class="circular-img" style="width:80px" >
                        </div>
                        <div class="col-md-9">
                        <p class="lead">' . $row['feed_desc'] . '</p>
                        <p>' . $starRating . '</p>
                        </div>
                    </div>
                </div>
                ';
                    $count++;
                }
                ?>


            </div>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    </div>

    <?php include "./footer.php"; ?>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.myhead');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    <script src="script.js"></script>
</body>

</html>