<?php
include "./connection.php"; // Include your database connection file

// Fetch all records from the user_tb table
$sql = "SELECT * FROM user_tb";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Data</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="text-center mb-4">User Data</h2>
            <div class="row">';

    // Loop through each row
    while ($row = $result->fetch_assoc()) {
        $username = htmlspecialchars($row['username']);
        $email = htmlspecialchars($row['email']);
        $role = htmlspecialchars($row['role']);
        $adminCode = htmlspecialchars($row['admin_code']);
        $image = htmlspecialchars($row['photo']);

        echo '<div class="col-md-4 mb-4">
                <div class="card">
                    <img src="' . $image . '" class="card-img-top" alt="User Image">
                    <div class="card-body">
                        <h5 class="card-title">Username: ' . $username . '</h5>
                        <p class="card-text">Email: ' . $email . '</p>
                        <p class="card-text">Role: ' . $role . '</p>
                        <p class="card-text">Admin Code: ' . $adminCode . '</p>
                    </div>
                </div>
            </div>';
    }

    echo '  </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>';

} else {
    echo "No records found.";
}

$con->close(); // Close the database connection
?>
