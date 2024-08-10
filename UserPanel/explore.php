<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .add-btn {
            position: fixed;
            bottom: 7rem;
            right: 20px;
            width: 60px;
            height: 60px;
            font-size: 24px;
            border: none;
        }
    </style>
</head>

<body>
    <?php include "./Header.php"; ?>
    <div class="container">

        <h1 class="text-center">Different States</h1>
        <div class="row">
            <!-- HERE COMES THE DATA FROM DATABASE -->
            <?php

            include "../connection.php";

            $sql = "SELECT * FROM state_tb";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $name = $row['state_name'];
                $description = $row['state_description'];
                $simage = $row['state_photo'];
                echo '
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="width: 100%;">
                        <img class="card-img-top" src="./stateImage/' . $simage . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . $name . '</h5>
                            <p class="card-text">' . substr($description, 0, 100) . '...</p>
                            <div class="d-flex justify-content-between">
                                <a href="./detail.php?sname=' . $name . '" class="btn btn-custom1 w-100 me-1">View</a>
                              <!--  <a href="./FillData/UpdateExplore.php?sname=' . $name . '" class="btn btn-custom1 w-100 ms-1">Edit</a>-->
                            </div>
                        <!--<div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="./FillData/DeleteExplore.php?sname=' . $name . '" class="btn btn-danger w-100" onclick="return confirmDelete()">Delete</a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            ';
            }
            ?>
            <button type="button" class="btn btn-secondary rounded-circle add-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Request more State">
            <a href="./FillData/Request.php" class="text-white text-decoration-none">+</a>
            </button>


        </div>
    </div>  


    <?php include "./footer.php"; ?>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.myhead');

            if (window.scrollY > 0) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>