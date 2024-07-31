<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <!-- Import the Poppins font from Google Fonts -->
</head>

<body>
    <div class="myback" >
        <?php include "./Navbar.php" ?>

        <!-- Carousel -->
        <div class="container-fluid" style="padding-left: 0; padding-right: 0;">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="height: 550px;">
                    <div class="carousel-item active" data-bs-interval="1000">
                        <img src="./images/coro1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="1000">
                        <img src="./images/coro2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="1000">
                        <img src="./images/coro3.jpg" class="d-block w-100" alt="...">
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
        <section class="container my-5">
            <h2 class="text-center mb-4 feat">Popular Locations</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="newly">
                            <div class="card-img-overlay">
                                <h5 class="card-title-overlay loc">Goa</h5>
                            </div>
                            <img src="./images/location1.jpg" class="card-img-top" alt="Goa" width="400px" height="200px">
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100">Learn more</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="newly">
                            <div class="card-img-overlay">
                                <h5 class="card-title-overlay loc">Himachal Pradesh</h5>
                            </div>
                            <img src="./images/location4.jpg" class="card-img-top" alt="Himachal Pradesh" width="400px" height="200px">
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100">Learn more</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="newly">
                            <div class="card-img-overlay">
                                <h5 class="card-title-overlay loc">Jammu & <br> Kashmir</h5>
                            </div>
                            <img src="./images/location2.jpg" class="card-img-top" alt="Jammu & Kashmir" width="400px" height="200px">
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100">Learn more</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="newly">
                            <div class="card-img-overlay">
                                <h5 class="card-title-overlay loc">UttraKhand</h5>
                            </div>
                            <img src="./images/location3.jpg" class="card-img-top" alt="UttraKhand" width="400px" height="200px">
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100">Learn more</button>
                        </div>
                    </div>
                </div>

                <div class="text-center mylink">
                    <a href="#" class="view-more-link">
                        View more
                        <img src="./images/viewmore.png" alt="View more" width="12" height="10">
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <div class="container mt-4 mb-5">
            <div class="row">
                <h2 class="text-center mb-4 feat">Contact Us</h2>
                <div class="col-lg-6">
                    <div class="image-wrapper">
                        <h2 class="con-text mr-5">Hello If you Still have any doubts. Click one more and <span class="my-data-con"> we can help you Anytime... </span></h2>
                        <!-- <img src="./images/contact.jpg" alt="Contact" width="300px" height="400px"> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-section">
                        <div class="container">
                            <div class="contact-form">
                                <form>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"  placeholder="Your Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email"  placeholder="Your Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message"  rows="4" placeholder="Your Message" required></textarea>
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
        
        <!-- Footer -->
        <!-- <div class="container-fluid bg-dark"> -->
            <?php include "./footer.php" ?>
        <!-- </div> -->
        <script src="./script.js"></script>
</body>

</html>
