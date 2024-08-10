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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE feed_back SET view = 1";

    if ($con->query($sql) === TRUE) {
        header("Location: ../test.php");
    } else {
        echo "Error updating records: " . $con->error;
    }
}
?>
