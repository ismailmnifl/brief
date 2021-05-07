<?php
session_start();
include('includes/autoloader.inc.php');
if (!isset($_SESSION['LogOut'])) {
    header('Location: login.php');
}
$reservationObj = new reservation();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sass/adminDash.css">
    <title>Admin Dashoard</title>
    </head>
    <body>
<?php
include('addON/header.php');
?>
 <!--sidebar-->
            <div class="fullpagecontainer">
            <div class="sidebarDash d-flex flex-column">
            <div class="sidebaricone">
                <div><img src="images/list.png" alt=""></div>
                <span class="titlesidebar fs-4"></span>
            </div>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item dashboard_Tab">
      <a href="#" class="nav-link link-light">
        DashBoard
      </a>
    </li>
    <li class="tarif_Tab">
      <a href="#" class="nav-link link-light">
        Tarifs
      </a>
    </li>
    <li class="reservation_Tab">
      <a href="#" class="nav-link link-light">
        Reservation
      </a>
    </li>
    <li class="customers_Tab">
      <a href="#" class="nav-link link-light">
        Customers
      </a>
    </li>
  </ul>
</div>
 <!--sidebar end-->
 <?php
 
 $nCustemers = $reservationObj->NumberOfCostomers();
 $nReservations = $reservationObj->reservationCount();
 $totalRevenue = $reservationObj->TotalRevenue();
 $AVGcustomer = $reservationObj->AVGcustomerSpending();
 ?>
 <div class="mainstoff">
   <div class="statistics">
        <div class="squar numofcustomers"><h3>Number of costomers : <br><?php echo $nCustemers['NC']; ?></h3></div>
        <div class="squar totalRevenue"><h3>total net Revenue : <br><?php echo $totalRevenue['SM'];?>$</h3></div>
        <div class="squar numofreservation"><h3> Current reservations : <br><?php echo $nReservations['RC'];?></h3></div>
        <div class="squar avgreservationprice"><h3>Averge reservation : <br> <?php echo $AVGcustomer['AV'];?>$</h3></div>
  </div>
  <h2 style="margin: 20px;">Table of Customers</h2>
<table id="table-res" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>user ID</th>
        <th>Full name</th>
        <th>reservation ID</th>
        <th>check in date</th>
        <th>chack out dtae</th>
        <th>accomodation type</th>
        <th>penstion type</th>
        <th>child age</th>
        
      </tr>
    </thead>
    <tbody>
        <?php 
          $reservations = $reservationObj->displayData(); 
          foreach ($reservations as $reservation) {
        ?>
        <tr>
          <td><?php echo $reservation['userId'] ?></td>
          <td><?php echo $reservation['fullName'] ?></td>
          <td><?php echo $reservation['reservationId'] ?></td>
          <td><?php echo $reservation['dateCheckIn'] ?></td>
          <td><?php echo $reservation['dateCheckOut'] ?></td>
          <td><?php echo $reservation['accomodationType'] ?></td>
          <td><?php echo $reservation['type'] ?></td>
          <td><?php echo $reservation['age'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <h2 style="margin: 20px;">Tarifs Operations</h2>

  <div class="containerTarifs">
  <div class="Pensiontable viewtable">
  <table class="table-res table table-striped table-hover">
    <thead>
      <tr>
        <th>Pension ID</th>
        <th>Pension Option</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $pensions = $reservationObj->retraivePension();
          foreach ($pensions as $pension) {
        ?>
        <tr>
          <td><?php echo $pension['pensionId'] ?></td>
          <td><?php echo $pension['type'] ?></td>
          <td><?php echo $pension['price'] ?></td>
          <td>
            <a href="#">
              <img width="20px" src="images/update.png"></a>
            <a style ="margin-left : 10px" href="#" onclick="confirm('Are you sure want to delete this record')">
            <img width="20px" src="images/remove.png">
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="pensionForm">
  <form action="edit.php" method="POST">
    <div class="form-group">
      <label for="Atype">Acommodation Type : </label>
      <input type="text" class="form-control" name="Atype" value="" required="">
    </div>
    <div class="form-group">
      <label for="Aprice">Price :</label>
      <input type="text" class="form-control" name="Aprice" value="" required="">
    </div>
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
      <input type="submit" name="update" class="btn" style="float:right;" value="Update">
    </div>
  </form>
</div>
  </div>
            <div class="acommodationTable viewtable">
  <table id="table-res" class="table-res table table-striped table-hover">
    <thead>
      <tr>
        <th>Acommodation ID</th>
        <th>Acommodation Option</th>
        <th>Price</th>
        <th>Actions</th>
        
      </tr>
    </thead>
    <tbody>
        <?php 
          $accomodations = $reservationObj->retraiveAcommodations(); 
          foreach ($accomodations as $accomodation) {
        ?>
        <tr>
          <td><?php echo $accomodation['accommodationId'] ?></td>
          <td><?php echo $accomodation['accomodationType'] ?></td>
          <td><?php echo $accomodation['price']?></td>
          <td>
            <a href="#">
              <img width="20px" src="images/update.png"></a>
            <a style ="margin-left : 10px" href="#" onclick="confirm('Are you sure want to delete this record')">
            <img width="20px" src="images/remove.png">
            </a>
          </td>
          
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="acommodationForm">
  <form action="edit.php" method="POST">
    <div class="form-group">
      <label for="Atype">Acommodation Type : </label>
      <input type="text" class="form-control" name="Atype" value="" required="">
    </div>
    <div class="form-group">
      <label for="Aprice">Price :</label>
      <input type="text" class="form-control" name="Aprice" value="" required="">
    </div>
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
      <input type="submit" name="update" class="btn" style="float:right;" value="Update">
    </div>
  </form>
</div>
  </div>
  
  </div>
  
<!---->
</div>
</div>
<?php
include 'addON/footer.php'
?>
    <script src="Bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/adminDash.js"></script>
</body>
</html>