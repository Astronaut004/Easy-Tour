<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>

<body>


<!-- <a href="../explore.php"></a> -->
<?php
include "../../connection.php";
        $name = $_REQUEST['sname'];

        $sql = "DELETE FROM state_tb WHERE state_name=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        if (mysqli_affected_rows($con) > 0) {
            echo " 
                <script>
                window.open('../explore.php','_self');
                </script>
            ";
        } else {
            echo " 
            <script>
            window.open('../explore.php','_self');
            </script>
        ";
        }

?>
</body>

</html>



