<?php
  session_start();

  if(!$_SESSION['username']) {
    header("Location: ../../Entry/login.php");
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



