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

<?php
include "../../connection.php";

$name = $_REQUEST['sname'];

// Prepare and execute the select statement
$sql = "SELECT * FROM request_city_tb WHERE city_name = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

// Check if a record was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Extract data from the result
    $sname = $row['city_name'];
    $soul = $row['city_sprit'];
    $description = $row['city_description'];
    // $wild = $row['state_wildlife'];
    $state = $row['city_state'];
    $simage = $row['city_image'];
    // $food = $row['state_food'];
    // $time = $row['created_at'];
    
    // Prepare and execute the insert statement
    $insert_sql = "INSERT INTO city_tb (city_name, city_sprit, city_description, city_state, city_image, username) VALUES (?, ?, ?, ?, ?, ?)";
    $insert_stmt = $con->prepare($insert_sql);
    $insert_stmt->bind_param("ssssss", $sname, $soul, $description, $state,$simage, $_SESSION['username']);
    $insert_stmt->execute();

    $delete_sql = "DELETE FROM request_city_tb WHERE city_name = ?";
    $delete_stmt = $con->prepare($delete_sql);
    $delete_stmt->bind_param("s", $name);
    $delete_stmt->execute();

    echo "<script>window.open('../index.php');</script>";
} else {
    echo "No matching record found in request_tb.";
}

// $conn->close();
?>
