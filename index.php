<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<style>

</style>

<body>
    <div class="myback">
        <?php include "./Navbar.php" ?>

        <!-- Carousel -->
        <div class="container-fluid p-0" style="padding-left: 0; padding-right: 0;">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="height: 550px;">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="./images/coro5.jpg" class="d-block w-100" alt="..." loading="lazy">
                    </div>
                    <div class="carousel-item" data-bs-interval="8000">
                        <img src="./images/coro4.jpg" class="d-block w-100" alt="..." loading="lazy">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="./images/coro1.jpg" class="d-block w-100" alt="..." loading="lazy" >
                    </div>
                    <div class="carousel-caption-overlay"></div>
                    <div class="carousel-caption-custom">
                        <h1 class="myheading visible">Easy<span class="logoHead">Tour</span></h1>
                        <h1 class="my-scroll-heading hidden">Welcome <span class="logoHead">Aboard</span></h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature -->
        <div class="container-fluid main-features">
            <div class="container">
                <h2 class="text-center mt-5 feat">Features</h2>
                <div class="row mt-5">
                    <div class="col-lg-4 text-center">
                        <a href="#" class="btn btn-custom">
                            <img src="./images/feature1.jpg" alt="Feedback" width="140" height="140">
                            <h2 class="fw-normal mt-2">Feedback</h2>
                        </a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="#" class="btn btn-custom">
                            <img src="./images/feature2.jpg" alt="Guide" width="140" height="140">
                            <h2 class="fw-normal mt-2">Guide</h2>
                        </a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="#" class="btn btn-custom">
                            <img src="./images/feature3.jpg" alt="Chatbot" width="140" height="140">
                            <h2 class="fw-normal mt-2">Chatbot</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Destinations Section -->
<!-- Popular Destinations Section -->
<div class="container">
        <section class=" my-5">
            <h2 class="text-center mb-4 feat">Popular Locations</h2>
            <div class="row">
                <!-- Location 1 -->
                <?php
                include "./connection.php";

                $sql = "SELECT * FROM state_tb";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count=0;
                while ($row = $result->fetch_assoc()) {
                    if($count >= 4) {
                        break;
                    }
                    $name = $row['state_name'];
                    $description = $row['state_description'];
                    $simage = $row['state_photo'];

                    echo '
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="./AdminDashboard/detail.php?sname='.$name.'" class="card-link">
                            <div class="card-img-top">
                                <img src="./AdminDashboard/stateImage/'.$simage.'" alt="'.$name.'" width="400px" height="200px">
                                <div class="card-img-overlay">
                                    <h5 class="card-title-overlay loc">'.$name.'</h5>
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
                    <a href="./Entry/login.php" class="view-more-link" style="text-decoration: none; color: #484128; " >
                        View more
                        <img src="./images/viewmore.png" alt="View more" width="12" height="10">
                    </a>
                </div>
            </div>
        </section>
    </div>


        <!-- Contact Section -->
        <div class="container mt-4 mb-5">
            <div class="row">
                <h2 class="text-center mb-4 feat">Contact Us</h2>
                <div class="col-lg-6">
                    <div class="image-wrapper">
                        <h2 class="con-text mr-5">Hello If you Still have any doubts.<span class="my-data-con"> we can help you Anytime... </span></h2>
                        <!-- <img src="./images/contact.jpg" alt="Contact" width="300px" height="400px"> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-section">
                        <div class="container">
                            <div class="contact-form contact">
                            <form action="mailto:your-email@example.com" method="post" enctype="text/plain">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" rows="4" placeholder="Your Message" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "./footer.php" ?>
    <script src="./script.js"></script>
</body>

</html>