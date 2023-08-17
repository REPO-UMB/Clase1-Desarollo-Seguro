<?php
if(isset($_POST["register"])){
    require_once("dbconfig.php");
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $tyc = isset($_POST["tyc"]) ? $_POST["tyc"] : 0;
    if($tyc == 'on'){
        $tyc = 1;
    }
    $valid = true;
    $error_messages = array();

    // Validate full name: only letters and spaces allowed
    if (!preg_match("/^[A-Za-z\s]+$/", $full_name)) {
        $valid = false;
        $error_messages[] = "Invalid name format.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error_messages[] = "Invalid email format.";
    }

    // Validate username: only letters and digits allowed
    if (!preg_match("/^[A-Za-z0-9]+$/", $username)) {
        $valid = false;
        $error_messages[] = "Invalid username format.";
    }

    // Validate password strength
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/", $password)) {
        $valid = false;
        $error_messages[] = "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 6 characters long.";
    }

    if ($valid) {
        // Encrypt the password using MD5 (not recommended for security purposes)
        $hashed_password = md5($password);

        $sql = "INSERT INTO usertbl (id, fullname, email, username, password, tyc)".
                " VALUES (NULL, '".$full_name."', '".$email."', '".$username."', '".$hashed_password."', '".$tyc."');";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "Insert new user!";
            echo '<script>
                setTimeout(function() {
                    window.location.href = "login.php";
                    }, 3000); // 3000 milliseconds = 3 seconds
            </script>';
        } else {
            echo "Error inserting user: " . mysqli_error($con);
        }
    } else {
        foreach ($error_messages as $error) {
            echo $error . "<br>";
        }
    }
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guia 1 demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="validate.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100 w-md-75 w-lg-50">
            <form id="registerform" name="registerform" action="register.php" method="POST" class="p-4 border" onsubmit="return validateRegisterForm();">
                <h1 class="mb-4">Sign Up</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="full_name">
                    <div class="form-text">Enter your complete Name.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">User</label>
                    <input type="text" class="form-control" id="username" name="username">
                    <div class="form-text">Enter your machine user.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="tyc">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary" name="register">Submit</button>
            </form>
            <div class="mt-3">
                <a href="login.php" class="btn btn-secondary">Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
