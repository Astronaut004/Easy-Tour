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
        .my-box {
            background-color: #d4ccb1;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            text-align: center;
            margin-bottom: 20px;
            transition: transform 0.3s;
            position: relative;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

        .btn-custom img {
            border-radius: 50%;
            width: 140px;
            height: 140px;
        }

        .image-links {
            display: flex;
            justify-content: left;
            gap: 15px;
            margin-top: 20px;
        }

        .image-links a {
            display: block;
            width: 30px;
            height: 30px;
        }

        .image-links img {
            width: 100%;
            height: 100%;
            vertical-align: middle;
        }

        .user-name {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include "./Navbar.php" ?>

    <div class="container mt-5 my-box">
        <!-- First Featurette: Photo on Right, Text on Left -->
        <div class="row featurette mb-5">
            <div class="col-md-8 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">Heading  <span class="text-body-secondary">Location</span></h2>
                <p class="lead">Your Exprience must be here guys</p>
                <div class="image-links">
                    <a href="#" id="like-link">
                        <img src="../images/like.png" alt="Like">
                    </a>
                    <!-- <a href="#" id="comment-link">
                        <img src="../images/comment.png" alt="Comment">
                    </a> -->
                    <a href="#" id="report-link">
                        <img src="../images/report.png" alt="Report">
                    </a>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center order-md-1">
                <a href="#" class="btn btn-custom">
                    <img src="./images/featue1.jpg" class="bg-info" alt="Feature Image">
                </a>
                <p class="user-name">UserName</p>
            </div>
        </div>

        <!-- Second Featurette: Photo on Left, Text on Right -->
        <div class="row featurette mt-5">
            <div class="col-md-8 order-md-1">
                <h2 class="featurette-heading fw-normal lh-1">Heading <span class="text-body-secondary">Location.</span></h2>
                <p class="lead">Your Exprience must be here guys</p>
                <div class="image-links">
                    <a href="#" id="like-link">
                        <img src="../images/like.png" alt="Like">
                    </a>
                    <!-- <a href="#" id="comment-link">
                        <img src="../images/comment.png" alt="Comment">
                    </a> -->
                    <a href="#" id="report-link">
                        <img src="../images/report.png" alt="Report">
                    </a>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center order-md-2">
                <a href="#" class="btn btn-custom">
                    <img src="./images/featue1.jpg" class="bg-info" alt="Feature Image">
                </a>
                <p class="user-name">UserName</p>
            </div>
        </div>
    </div>
</body>

</html>
