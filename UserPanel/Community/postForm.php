<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include "./Header.php"; ?>

    <div class="container mt-3 w-50">
        <h1 class="text-center">Post Your Journey</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="images[]" multiple>
                <div class="form-text">Upload your images here.</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="desc" id="description"></textarea>
            </div>
            <input type="submit" class="w-100 btn btn-success" value="POST">
        </form>
    </div>
</body> 
</html>

<?php
    include "../../connection.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $hasFiles = false;
            foreach ($_FILES['images']['name'] as $name) {
                if (!empty($name)) {
                    $hasFiles = true;
                    break;
                }
            }
            $image = $_FILES['images'];
        
        if($hasFiles && $_REQUEST['desc'] != ''){
            $path = "../post_images/";
            $filepath = [];
            foreach($image['name'] as $key => $name) {
                if(!empty($name)) {
                    
                    $targetedFile = $path . basename($name);
                    if(move_uploaded_file($image['tmp_name'][$key],$targetedFile)){
                        $filepath[] = basename($name);
                    }
                }
            }
            $description = $_REQUEST['desc'];
            $image = implode(',',$filepath);

            $sql = "INSERT INTO post_tb (post_desc,post_img,username) VALUES (?,?,?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss",$description,$image,$_SESSION['username']);
            if ($stmt->execute()) {
                echo "Post successfully added.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        }
    }
?>
