<?php
session_start();
if(isset($_POST["login"])){
    require_once("dbconfig.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $validate = true; 

    $ip = $_SERVER["REMOTE_ADDR"];
    $captcha = $_POST["g-recaptcha-response"];
    $cap_key = "6Lde-bAnAAAAAMdu7h3h57E4elvd6pKyL8GWfvGp";
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = ['secret' => $cap_key, 'response' => $captcha, 'remoteip' => $ip];
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result) {
        $rst_captcha = json_decode($result, TRUE);
        if($rst_captcha["success"]){
            $hashed_password = md5($password);
            $sql = "SELECT * FROM usertbl WHERE email = '".$email."' AND password = '".$hashed_password."';";
            $result = mysqli_query($con, $sql);
            $num_rows = mysqli_num_rows($result);
    
            if($num_rows > 0){
                $_SESSION["session_username"] = $email;
                header("location: intropage.php");
            } else {
                echo "Correo electrónico o contraseña incorrectos.";
            }
            print("validacion Recaptcha OK");
        }
        else{
            print("validacion Recaptcha MAL");
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
    <script src="validate.js"></script> <!-- Include your validate.js file -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100 w-md-75 w-lg-50">
            <form name="loginform" action="login.php" method="POST" class="p-4 border" onsubmit="return validateLoginForm();">
            <h1 class="mb-4">Login</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="g-recaptcha" data-sitekey="6Lde-bAnAAAAAMhTncfJwFR0Cb7cd0zWiJdR1f5A"></div>
            <br/>
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
            </form>
            <div class="mt-3">
                <a href="register.php" class="btn btn-secondary">Register</a>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
