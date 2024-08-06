<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <?php include "./Header.php"; ?>
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < 29; $i++): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="width: 100%;">
                        <img class="card-img-top" src="../images/location2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Himachal Pradesh <?php echo $i + 1; ?></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="d-flex justify-content-between">
                                <a href="./detail.php" class="btn btn-primary w-100 me-1">View</a>
                                <a href="#" class="btn btn-primary w-100 ms-1">Edit</a>
                            </div>
                            <div class="row mydelete mt-2">
                                <div class="col-md-12">
                                    <a href="#" class="btn btn-danger w-100">DELETE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
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
    </script>
</body>
</html>
