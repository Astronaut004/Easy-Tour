<?php
  session_start();

  if(!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../Entry/login.php");
    exit();
}
if($_SESSION['role'] != "Admin") {
    header("Location: ../UserPanel");
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
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
    </style>
</head>

<body>


        <h2 class="text-center mt-5">Famous locations</h2>
        <div class="row">

            <?php
            include "../../connection.php";

            $sql1 = "SELECT * FROM city_tb ";
            $stmt1 = $con->prepare($sql1);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            while ($row = $result1->fetch_assoc()) {
                $city = $row['city_name'];
                $soul = $row['city_sprit'];
                $desc = $row['city_description'];
                $image = $row['city_image'];
                $user = $row['username'];
                $date = $row['created_at'];

                echo '
                    <div class="col-md-3 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="../stateImage/' . $image . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . $city . '</h5>
                            <p class="card-text">' . substr($desc, 0, 95) . '...</p>
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
                        
                        ';
            }
            // $sql1 = 
            ?>
        </div>
        <button class="btn btn-danger rounded-circle add-btn mb-3" data-bs-toggle="tooltip" data-bs-placement="right" title="Add More City">
            <a href="./City/AddExplore.php" class="text-white text-decoration-none">+</a>
        </button>

    </div>
    <script>
        const getWeather = async (city) => {
            const weather = document.getElementById('weather');
            weather.innerHTML = `<p>Please wait While we load data</p>`;
            const API_KEY = '192698a3e3e1170a18f988509d1fafa3';

            try {
                const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric`;
                const response = await fetch(url);
                const data = await response.json();
                console.log(data);
                const weatherIcon = `<img src="https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="Weather Icon" width=50px height=50px> `;
                weather.innerHTML = `${data.main.temp} ℃ ${weatherIcon}`;

            } catch {
                weather.innerHTML = '<p>Error fetching the weather data. Please try again later.</p>';
            }
        };

        const city = '<?php echo $name; ?>';
        getWeather(city);

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
    </script>
</body>

</html>