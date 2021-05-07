
<?php

// Include database file
include('includes/autoloader.inc.php');

$userObj = new user();

// Insert Record in customer table
if(isset($_POST['submit'])) {
  $userObj->insertData();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sass/register.css">
    <title>Register</title>
</head>
<body>
   <div class="loginFormContainer">
       <div class="imageHolder">
           <img src="images/register.png" alt="">
       </div>
       <div class="loginwraper">
    <form action="register.php" method="POST">
        <div class="headerloginContainer d-flex justify-content-center">
        <a class="loginheader" href="Read.php"><h2>HOTELI</h2></a>
    </div>
        <div class="mb-3">
          <label for="exampleInputFullName1" class="form-label">Full name</label>
          <input name="fullName" type="text" class="form-control" id="exampleInputFullName1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPhoneNumber1" class="form-label">Phone number</label>
            <input name="phone" type="text" class="form-control" id="exampleInputPhoneNumber1">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email adress</label>
          <input name="email" type="email" class="form-control" id="exampleInputEmail1">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Re-enter the password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <div class="mb-3 headerloginContainer d-flex justify-content-center">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="mb-3 form-check">
        <p>Already have an account ? <a href="login.php">Login now</a></p>
        </div>
      </form>
    </div>
   </div>
   <script src="bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>