<?php
include "../connection.php";

$name = $_REQUEST['sname'];

$sql = "SELECT * FROM state_tb WHERE state_name = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $name);
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

        #main-content {
            width: 100%;
            /* Full width of the column */
            height: 500px;
            /* Adjust the height as needed */
            border: none;
            /* Remove border if not needed */
        }

        #main-content1 {
            width: 100%;
            /* Full width of the column */
            height: 500px;
            /* Adjust the height as needed */
            border: none;
            /* Remove border if not needed */
        }

        .iframe-container {
            height: 100%;
        }
    </style>
</head>

<body>
    <?php include "./Header.php"; ?>

    <!-- Weather -->


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
                <!-- <p class="" style="float: right;" ><?php echo $date ?></p> -->
                <div class="row bg-light">
                    <div class="col-lg-4 col-md-4 col-sm-6 fw-bold text-dark" style="padding-top: 10px;"><a id="main-content" style="text-decoration: none; color:white;" href=""><img src="../images/food.png" alt="" width="30px" ></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 fw-bold text-dark" style="padding-top: 10px;"><a id="main-content1" style="text-decoration: none;" href=""><img src="../images/hotel.png" alt="" width="30px" ></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 fw-bold text-dark">Weather: &nbsp; <span id="weather"></span></div>
                </div>
            </div>
        </div>
        <h2 class="text-center mt-5">Famous locations</h2>
        <div class="row">

            <?php
            $statename = $sname;
            // echo "$statename";
            $sql1 = "SELECT * FROM city_tb WHERE city_state = ?";
            $stmt1 = $con->prepare($sql1);
            $stmt1->bind_param("s", $statename);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            while ($row = $result1->fetch_assoc()) {
                $city = $row['city_name'];
                $soul = $row['city_sprit'];
                $desc = $row['city_description'];
                $image = $row['city_image'];
                $user = $row['username'];
                $date = $row['created_at'];
                // echo $_SESSION['username'];
                $isUser = 0;
                $user1 = strtolower(trim($row['username']));
                $user2 = strtolower(trim($_SESSION['username']));

                if ($user1 === $user2) {
                    $isUser = 1;
                }
                echo '
                    <div class="col-md-3 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="./stateImage/' . $image . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . $city . '</h5>
                            <p class="card-text">' . substr($desc, 0, 95) . '...</p>
                            <div class="row">
   
                                <div class="col-md-12">
                                    <a href="#" class="btn btn-custom1 w-100">View</a>
                                </div>
                 </div>
                
                        </div>
                    </div>
                </div>
                        
                        ';
            }
            // $sql1 = 
            ?>
        </div>
        <button type="button" class="btn btn-secondary rounded-circle add-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Request more City">
            <a href="./City/Request.php" class="text-white text-decoration-none">+</a>
            </button>
    </div>
    <?php include "./footer.php" ?>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        document.addEventListener("DOMContentLoaded", () => {
            const city = '<?php echo $sname; ?>';
            const food = document.getElementById('main-content');
            const accommodation =document.getElementById('main-content1');
            if (food) {
                food.href = `https://www.google.com/maps/search/best+food+near+${city}/@15.3500845,73.347191,9z?entry=ttu`;
            }
            if (accommodation) {
                accommodation.href = `https://www.google.com/maps/search/accommodation+near+${city}/@15.3500845,73.347191,9z?entry=ttu`;
            }
        });



        const getWeather = async (city) => {
            const weather = document.getElementById('weather');
            weather.innerHTML = `<p>Fetching...</p>`;
            const API_KEY = '192698a3e3e1170a18f988509d1fafa3';

            try {
                const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric`;
                const response = await fetch(url);
                const data = await response.json();
                console.log(data);
                const weatherIcon = `<img src="https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="Weather Icon" width=50px height=50px> `;
                weather.innerHTML = `${data.main.temp} ℃ ${weatherIcon}`;

            } catch {
                weather.innerHTML = `<p>Error fetching the weather data. Please try again later ${sname} .</p>`;
            }
        };
        
        const city = '<?php echo $sname; ?>';
        getWeather(city);

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