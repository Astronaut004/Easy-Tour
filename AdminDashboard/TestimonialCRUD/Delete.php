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
        $id = $_REQUEST['id'];

        $sql = "DELETE FROM feedback_tb WHERE feed_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if (mysqli_affected_rows($con) > 0) {
            echo " 
                <script>
                window.open('../Testimonial.php','_self');
                </script>
            ";
        } else {
            echo " 
            <script>
            window.open('../Testimonial.php','_self');
            </script>
        ";
        }



