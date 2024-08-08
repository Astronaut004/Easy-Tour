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

<body>
    <?php include "./Header.php"; ?>

    <!-- Carousel -->
    <div class="container-fluid p-0">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="./resources/coro1.jpeg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="./resources/coro2.webp" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./resources/coro3.jpeg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>

    <!-- Hero -->
    <div class="px-4 pt-5 my-5 text-center border-bottom">
        <h1 class="display-4 fw-bold feat">Discover Your<span class="logoHead"> Next Adventure</span></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Discover amazing destinations and experiences tailored to your interests. Our platform offers a wide range of travel guides, local insights, and useful tips to help you plan your perfect trip. Whether you’re looking for a serene getaway or an adventurous journey, we’ve got you covered with up-to-date information and expert recommendations.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <form role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
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
                include "../connection.php";

                $sql = "SELECT * FROM state_tb ORDER BY state_name ASC;";
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
                        <a href="./detail.php?sname='.$name.'" class="card-link">
                            <div class="card-img-top">
                                <img src="./stateImage/'.$simage.'" alt="'.$name.'" width="400px" height="200px">
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
            include "../connection.php";
            $sql = "SELECT * FROM feedback_tb";
            $stmt = $con->prepare($sql);
            // $stmt->bind_param()
            $stmt->execute();
            $result = $stmt->get_result();
            $count=0;
            while ($row = $result->fetch_assoc()) {
                $starRating = '';
                if($count>=3) {
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
                            <img src="'.$row['feed_image'].'" alt="Feedback" class="circular-img" style="width:80px" >
                        </div>
                        <div class="col-md-9">
                        <p class="lead">'.$row['feed_desc'].'</p>
                        <p>'.$starRating.'</p>
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
</body>

</html>
