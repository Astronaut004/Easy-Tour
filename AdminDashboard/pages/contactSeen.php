<?php
include "../../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare and execute the DELETE statement
        $sql = "DELETE FROM contact_tb";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        // Redirect to Dashboard after successful deletion
        echo "<script>window.location.href='../Dashboard.php';</script>";

}
?>
