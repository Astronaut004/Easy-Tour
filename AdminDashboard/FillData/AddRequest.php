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
$sql = "SELECT * FROM request_tb WHERE state_name = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

// Check if a record was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Extract data from the result
    $sname = $row['state_name'];
    $soul = $row['state_sprituality'];
    $description = $row['state_description'];
    $wild = $row['state_wildlife'];
    $culture = $row['state_culture'];
    $simage = $row['state_photo'];
    $food = $row['state_food'];
    $time = $row['created_at'];
    
    // Prepare and execute the insert statement
    $insert_sql = "INSERT INTO state_tb (state_name, state_sprituality, state_description, state_wildlife, state_culture, state_photo, state_food, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $con->prepare($insert_sql);
    $insert_stmt->bind_param("ssssssss", $sname, $soul, $description, $wild, $culture, $simage, $food, $time);
    $insert_stmt->execute();

    $delete_sql = "DELETE FROM request_tb WHERE state_name = ?";
    $delete_stmt = $con->prepare($delete_sql);
    $delete_stmt->bind_param("s", $name);
    $delete_stmt->execute();

    echo "<script>window.open('../index.php');</script>";
} else {
    echo "No matching record found in request_tb.";
}

// $conn->close();
?>
