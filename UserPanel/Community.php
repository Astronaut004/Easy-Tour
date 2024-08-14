<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .my-bg {
            background-color: #d4ccb1;
        }

        .profile-img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .carousel-item {
            position: relative;
            width: 100%;
            padding-bottom: 55%;
        }

        .main-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .icon-img {
            width: 35px;
            height: 35px;
        }

        .icon-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(1, 1, 1, 0.3);
            /* Adjust the shadow here */
        }

        .centered-text {
            text-align: justify;
        }
    </style>
</head>

<body>
    <?php include "./Header.php" ?>
    <?php
    include "../connection.php";
    $sql = "SELECT p.*, u.photo FROM post_tb p JOIN user_tb u on p.username = u.username";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    // echo "working";
    // }
    $result = $stmt->get_result();
    // print_r($result->fetch_assoc()); 
    ?>
    <div class="container-fluid my-bg">
        <a href="./Community/postForm.php">
            <button type="button" class="btn btn-success mt-3" style="float: right;" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Add a Post">
                POST
            </button>
        </a>
        <div class="container w-50">
            <!-- <p>lwefneof</p> -->
            <!-- <hr class="mt-2"> -->


            <?php
            while ($row = $result->fetch_assoc()) {
                // echo "entered";
                echo '
            <div class="row bg-dark text-light pb-2" style="margin-right: 0px; margin-left: 0px; ">
                <div class="col-md-1 mt-2">
                    <img src="' . $row['photo'] . '" class="profile-img" alt="Profile picture of user">
                </div>
                <div class="col-md-2 mt-2">
                    <p><strong>' . $row['username'] . '<br></strong>' . $row['created_at'] . '</p>
                    <!-- <p>created at</p> -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 custom-border ">

                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">';
            ?>
                <?php
                $images = explode(',', $row['post_img']);
                foreach ($images as $index => $image) {

                    echo '
                        
                            <div class="carousel-item active">
                                <img src="./post_images/' . ($image) . '" alt="Image of Agra" class="main-img mb-2">
                            </div>

                            ';
                } ?>
            <?php
                echo '
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="centered-text">'.$row['post_desc'].'</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="icon-row">
                        <img src="../images/empty_heart.png" alt="Empty heart icon" class="icon-img">
                        <img src="../images/comment.png" alt="Comment icon" class="icon-img">
                        <img src="../images/Empty_save.png" alt="Empty save icon" class="icon-img">
                    </div>
                </div>
            </div>

            ';
            }
            ?>
        </div>
    </div>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
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