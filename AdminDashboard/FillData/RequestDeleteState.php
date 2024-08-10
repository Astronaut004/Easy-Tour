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

        $sql = "DELETE FROM request_tb WHERE state_name=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        if (mysqli_affected_rows($con) > 0) {
            echo " 
                <script>
                window.open('../Dashboard.php','_self');
                </script>
            ";
        } else {
            echo " 
            <script>
            window.open('../Dashboard.php','_self');
            </script>
        ";
        }

?>