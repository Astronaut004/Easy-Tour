<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../AdminDashboard/style.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .add-btn {
            position: fixed;
            bottom: 7rem;
            right: 20px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            border: none;
        }
    </style>
</head>

<body>
    <?php include "./Navbar.php"; ?>
    <div class="container">

        <h1 class="text-center">Top Location</h1>
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

                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="../AdminDashboard/detail.php?sname='.$name.'" class="card-link">
                            <div class="card-img-top">
                                <img src="../AdminDashboard/stateImage/'.$simage.'" alt="'.$name.'" width="400px" height="200px">
                                <div class="card-img-overlay">
                                    <h5 class="card-title-overlay loc">'.$name.'</h5>
                                    <span>Learn more</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            ';
            }
            ?>

        </div>
    </div>
    <button class="btn btn-danger rounded-circle add-btn mb-3" data-bs-toggle="tooltip" data-bs-placement="right" title="Add More">
        <a href="../Entry/login.php" class="text-white text-decoration-none">+</a>
    </button>

    <?php include "./footer.php"; ?>
    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.myhead');

            if (window.scrollY > 0) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            let buttonText = document.querySelectorAll('[data-bs-toggle="tooltip"]');

            buttonText.forEach((element) => {
                new bootstrap.Tooltip(element);
            });
        })

        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</body>

</html>