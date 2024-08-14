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

        .main-img {
            border-radius: 1%;
            width: 100%;
            height: auto;
        }

        .icon-img {
            width: 35px;
            height: 35px;
        }

        .icon-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .centered-text {
            text-align: justify;
        }
    </style>
</head>

<body>
    <?php include "./Header.php" ?>
    <div class="container-fluid my-bg">
        <a href="./Community/postForm.php">
            <button type="button" class="btn btn-success mt-3" style="float: right;" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Add a Post">
                POST
            </button>
        </a>
        <div class="container w-50">
            <!-- <p>lwefneof</p> -->
            <div class="row mb-2">
                <div class="col-md-1 mt-2">
                    <img src="./stateImage/arunachal.jpg" class="profile-img" alt="Profile picture of user">
                </div>
                <div class="col-md-2 mt-2">
                    <p><strong>Username</strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="./stateImage/AGRA.jpg" alt="Image of Agra" class="main-img mb-2">
                            </div>
                            <div class="carousel-item">
                            <img src="./stateImage/AGRA.jpg" alt="Image of Agra" class="main-img mb-2">
                            </div>
                            <div class="carousel-item">
                            <img src="./stateImage/AGRA.jpg" alt="Image of Agra" class="main-img mb-2">
                            </div>
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
                    <p class="centered-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur atque ipsum aliquam autem, cupiditate ducimus, fugit a accusamus optio omnis, dignissimos sunt nesciunt quae obcaecati ex! Aut perferendis corrupti voluptates odio exercitationem, mollitia ex iure in et illo labore ullam distinctio error ipsam quidem recusandae ipsum repellendus, obcaecati odit suscipit! Neque facilis, sint, ipsum vitae iste deleniti tenetur dolore, animi quasi quis asperiores fugit quidem quod totam at iure porro molestiae officia. Obcaecati id voluptatum earum debitis magnam inventore deleniti, dolorum vero ea repudiandae voluptatem non excepturi voluptas exercitationem quo corrupti tenetur nostrum tempora ab, repellendus sint. Iusto, nisi ex!</p>
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
        </div>
    </div>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>