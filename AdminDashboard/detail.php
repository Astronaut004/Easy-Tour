<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .myimg {
            border-radius: 15px; /* Adds rounded corners to the image */
        }
        .test-center {
            text-align: justify; /* Makes text justify-align in the container */
            line-height: 1.6; /* Increases line height for readability */
        }
        .container {
            padding: 20px; /* Adds padding around the container */
        }
    </style>
</head>

<body>
    <?php include "./Header.php"; ?>

    <div class="container">
        <h1 class="text-center fs-1">State Name</h1>
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center">
                <img class="myimg" src="../images/location3.jpg" alt="State Image" width="300" height="300">
            </div>
            <div class="col-md-9 test-center fs-6">
                <p>Uttarakhand is a picturesque state in northern India, often called the "Land of the Gods" due to its numerous temples and spiritual significance. Here are some highlights:</p>

                <p><strong>Geography:</strong> Uttarakhand is located in the Himalayan region, offering breathtaking views of the mountains. It's known for its diverse landscapes, from lush forests and rolling hills to high-altitude peaks.</p>

                <p><strong>Popular Destinations:</strong></p>
                <ul>
                    <li><strong>Dehradun:</strong> The capital city known for its pleasant weather and educational institutions.</li>
                    <li><strong>Nainital:</strong> A beautiful hill station famous for its lake and pleasant climate.</li>
                    <li><strong>Rishikesh:</strong> Known as the "Yoga Capital of the World," it's a hub for spirituality and adventure sports like white-water rafting.</li>
                    <li><strong>Haridwar:</strong> A sacred city on the banks of the Ganges, known for the Ganga Aarti and its spiritual atmosphere.</li>
                    <li><strong>Mussoorie:</strong> Another charming hill station known for its colonial architecture and panoramic views.</li>
                </ul>

                <p><strong>Tourism:</strong> Uttarakhand is a popular destination for trekking, camping, and other adventure activities. Notable trekking routes include the Valley of Flowers, Roopkund, and Kedarkantha.</p>

                <p><strong>Spiritual Significance:</strong> The state is home to several important Hindu pilgrimage sites, including the Char Dham (Yamunotri, Gangotri, Kedarnath, and Badrinath) and the sacred rivers like the Ganges.</p>

                <p><strong>Wildlife:</strong> The state boasts several national parks and wildlife sanctuaries, including Jim Corbett National Park, which is known for its tiger population and rich biodiversity.</p>

                <p><strong>Culture:</strong> Uttarakhand's culture is a blend of traditional Himalayan lifestyles and modern influences. The local cuisine, festivals, and handicrafts reflect its rich heritage.</p>
            </div>
        </div>

        <h2 class="text-center" >Famous locations</h2>
        <div class="row">
            <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="col-md-3 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="../images/location2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Himachal Pradesh <?php echo $i + 1; ?></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="./detail.php" class="btn btn-primary">View</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-primary">Edit</a>
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
</body>

</html>
