<?php
include "../connection.php";

$name = $_REQUEST['sname'];

$sql = "SELECT * FROM state_tb WHERE state_name = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s",$name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$sname = $row['state_name'];
$soul = $row['state_sprituality'];
$description = $row['state_description'];
$wild = $row['state_wildlife'];
$culture = $row['state_culture'];
$simage = $row['state_photo'];
$food = $row['state_food'];
$time = $row['created_at'];
$dateTimeObj = new DateTime($time);
$date = $dateTimeObj->format('d-m-Y');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .myimg {
            border-radius: 15px;
        }

        .test-center {
            text-align: justify;
            line-height: 1.6;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include "./Header.php"; ?>

    <div class="container">
        <h1 class="text-center fs-1"><?php echo $sname ?></h1>
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center">
            <img class="myimg" src="./stateImage/<?php echo $simage; ?>" alt="State Image" width="300" height="300">
            </div>
            <div class="col-md-9 test-center fs-6">
                <p><?php echo $description ?></p>

                <p><strong>Famous Food:</strong> <?php echo $food ?></p>
                <p><strong>Spiritual Significance:</strong> <?php echo $soul ?></p>

                <p><strong>Wildlife:</strong> <?php echo $wild ?></p>

                <p><strong>Culture:</strong> <?php echo $culture ?></p>
                <p class="" style="float: right;" ><?php echo $date ?></p>
            </div>
        </div>
        <h2 class="text-center">Famous locations</h2>
        <div class="row">
            <?php for ($i = 0; $i < 5; $i++) : ?>
                <div class="col-md-3 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="../images/location2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Himachal Pradesh <?php echo $i + 1; ?></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="./detail.php" class="btn btn-custom1 w-100">View</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-custom1 w-100">Edit</a>
                                </div>
                            </div>
                            <div class="row mydelete mt-2">
                                <div class="col-md-12">
                                    <a href="#" class="btn btn-danger">DELETE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <script>
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