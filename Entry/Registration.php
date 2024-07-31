<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="container">
        <form>
            <h2 class="text-center mb-4 text-dark">Registration</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter your username">
                <small class="form-text text-muted">Pick a nice and unique name for yourself.</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
                <!-- <small class="form-text text-muted">Must have special symbol $,#,&.., number and #one uppercase letter</small> -->
            </div>
            <div class="mb-3">
                <label class="form-label">email</label>
                <input type="email" class="form-control" placeholder="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <div class="d-flex">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="role" id="userRole" value="User" onclick="toggleAdminCode(false)">User
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="adminRole" value="Admin" onclick="toggleAdminCode(true)">Admin
                    </div>
                </div>
            </div>

            <div id="adminCodeBox" class="mb-3" style="display: none;">
                <label class="form-label">Admin Code</label>
                <input type="text" class="form-control" name="adminCode">
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="form-text mt-3">Already have unique name.. <a href="./login.php"> Login </a> here</p>
        </form>
    </div>

    <script>
        function toggleAdminCode(show) {
            const adminCodeBox = document.getElementById('adminCodeBox');
            adminCodeBox.style.display = show ? 'block' : 'none';
        }
    </script>

</body>

</html>