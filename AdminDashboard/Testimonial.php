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

    </style>
</head>

<body>
    <?php include "./Header.php" ?>

    <!-- Button to Open Form Modal -->
    <div class="fixed-button">
        <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#updateFormModal">
            <span class="d-flex align-items-center justify-content-center" style="height: 100%; width: 100%; font-size: 0.875rem; text-align: center;">Add Your Experience</span>
        </button>
    </div>


    <div class="container mt-5 my-box">
        <!-- Form Modal -->
<!-- Modal -->
<div class="modal fade" id="updateFormModal" tabindex="-1" aria-labelledby="updateFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFormModalLabel">Update Your Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="experienceForm">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userExperience" class="form-label">Experience</label>
                        <textarea class="form-control" id="userExperience" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="userRating" class="form-label">Rating</label>
                        <select class="form-select" id="userRating" required>
                            <option value="" disabled selected>Select a rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-custom1" form="experienceForm">Submit</button>
            </div>
        </div>
    </div>
</div>


        <!-- Content -->
        <?php for ($i = 0; $i < 29; $i++) : ?>
            <div class="row featurette mb-5">
                <div class="col-md-8 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Heading <span class="text-body-secondary">Sub Heading</span></h2>
                    <p>Stars here</p>
                    <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam minus libero iste asperiores amet earum cumque quis eaque. Autem nesciunt dolore blanditiis ut quaerat, vero cum quis enim voluptas aperiam laudantium et repudiandae? Voluptatum, vel!</p>
                    <div class="image-links">
                        <a href="#" id="like-link">
                            <img src="../images/like.png" alt="Like">
                        </a>

                        <a href="#" id="report-link">
                            <img src="../images/report.png" alt="Report">
                        </a>
                    </div>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-center order-md-1">
                    <a href="#" class="btn btn-custom">
                        <img src="./resources/taj.jpg" class="circular-img" alt="Feature Image">
                    </a>
                    <p class="user-name">UserName</p>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <script>
        window.addEventListener('load', function() {
            window.scrollTo(0, document.body.scrollHeight);
        });

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