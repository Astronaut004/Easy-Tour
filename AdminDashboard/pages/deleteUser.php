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

$name = $_REQUEST['sname'];

include "../../connection.php";
$delete = 1;
$sql = "DELETE FROM user_tb WHERE username = ? AND allowdelete = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("si",$name,$delete);
if($stmt->execute()) {
    echo " 
    <script>
    window.open('./showuser.php','_self');
    </script>
";
}
else {
    echo " 
    <script>
    window.open('./showuser.php','_self');
    </script>
";
}
?>