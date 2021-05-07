<?php
    
  include('addON/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="fontAwsome/all.css">
    <link rel="stylesheet" href="sass/main.css">
    <title>Home</title>
    </head>
    <body>
    
     
    <main>
         <!-- slider -->
         <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button id="slideID" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button id="slideID" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button id="slideID" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/h1.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/h2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/h3.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <div class="buttonWrapper">
            <button class="navigationButton left" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="navigationButton right" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
          </div>
          
           <!-- slider end -->

          <!--card over the slider-->
          <div class="sliderCard">
              <h1>Let your spirit of adventure be free</h1>
              <a href="reservation.php"><button>check out our services</button></a>

          </div>
          <!--card over the slider end-->
          <!--large card-->
          <div class="card m-3">
            <div style="background-color: #8ab6d6;" class="card-header">
             <h1> check out some of out amazing offering !</h1>
            </div>
            <div class="card-body">
              <h4 class="card-title">Special deals </h4>
              <p class="card-text">we offer special deals this time of the year so do waist
                 time and use some of our services.
                 just a reminder we the offer is limited so hurry up
              </p>
              <button class="btnSebarator">Go somewhere</button>
            </div>
          </div>
          <!--large card end -->
          
           <!-- Gallery -->
          <div class="container-fluid mt-4 mb-4">
<div class="row">
    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
      <img
        src="images/apartement3.jpg"
        class="w-100 shadow-1-strong rounded mb-4"
        alt=""
      />
  
      <img
        src="images/house3.jpg"
        class="w-100 shadow-1-strong rounded mb-4"
        alt=""
      />
    </div>
  
    <div class="col-lg-4 mb-4 mb-lg-0">
      <img
        src="images/house2.jpg"
        class="w-100 shadow-1-strong rounded mb-4"
        alt=""
      />
  
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg"
        class="w-100 shadow-1-strong rounded mb-4"
        alt=""
      />
    </div>
  
    <div class="col-lg-4 mb-4 mb-lg-0">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
        class="w-100 shadow-1-strong rounded mb-4"
        alt=""
      />
  
      <img
        src="images/house1.jpg"
        class="w-100 shadow-1-strong rounded mb-4"
        alt=""
      />
    </div>
  </div>
</div>
</div>
  <!-- Gallery end --> 
    </main>
  
        <?php
        include 'addON/footer.php';
        ?>
    <script src="Bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>