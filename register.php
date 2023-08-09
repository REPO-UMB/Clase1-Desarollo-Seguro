<?php
if(isset($_POST["register"])){
    require_once("dbconfig.php");
    $full_name = $_POST["full_name"];
    $email     = $_POST["email"];
    $username  = $_POST["username"];
    $password  = $_POST["password"];


    $sql = "INSERT INTO usertbl (id, fullname, email, username, password, tyc)".
            " VALUES (NULL, '".$full_name."', '".$email."', '".$username."', '".$password."', '1');";
    $result = mysqli_query($con,$sql);
    print("Insert new user!");

}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guia 1 demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1>Sing Up</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 
    <form id="registerform" name="registerform" action="register.php" method="POST" >
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="full_name">
        <div id="name" class="form-text">Enter your complete Name.</div>
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">User</label>
        <input type="text" class="form-control" id="name" name="username">
        <div id="name" class="form-text">Enter your machine user.</div>
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
</body>
</html>