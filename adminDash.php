<?php
session_start();
include('includes/autoloader.inc.php');
if (!isset($_SESSION['LogOut'])) {
    header('Location: login.php');
}
$reservationObj = new reservation();
// display selection accomodation informations
if(isset($_GET['editAccommodationId'])) {
  $editAccomId = $_GET['editAccommodationId'];
  $displayedaccomodation = $reservationObj->displayAccomodationRecordById($editAccomId);

}
// display selection pension informations
if(isset($_GET['editPensionId'])) {
  $editPensionId = $_GET['editPensionId'];
  $displayedPension = $reservationObj->displayPensionRecordById($editPensionId);

}


//updating accomodation record
if(isset($_POST['Aupdate'])) {

  $Aprice = $_POST['Aprice'];
  $accomId = $_POST['Aid'];

  echo 'accomodation id is : '. $accomId . ' and the price is : ' . $Aprice;
  
  $reservationObj->updateAccomodationRecord($accomId,$Aprice);
}

//updating pension record
if(isset($_POST['Pupdate'])) {

  $Pprice = $_POST['Pprice'];
  $PensId = $_POST['Pid'];

  echo 'Pension id is : '.  $PensId . ' and the price is : ' . $Pprice;
  
  $reservationObj->updatePensionRecord($PensId,$Pprice);
}
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'les Ventes des acommodations'],
          ['Apartement',     11],
          ['Bangalow',      2],
          ['chambre Simple',  2],
          ['chambre double', 2],
          
        ]);

        var options = {
          title: 'les Ventes'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
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
 $test =  number_format((float)$AVGcustomer['AV'], 2, '.', '');


 ?>
 <div class="mainstoff">
   <div class="statistics">
        <div class="squar numofcustomers"><h3>Number of costomers : <br><?php echo $nCustemers['NC']; ?></h3></div>
        <div class="squar totalRevenue"><h3>total net Revenue : <br><?php echo $totalRevenue['SM'];?>$</h3></div>
        <div class="squar numofreservation"><h3> Current reservations : <br><?php echo $nReservations['RC'];?></h3></div>
        <div class="squar avgreservationprice"><h3>Averge reservation : <br> <?php echo $test;?>$</h3></div>
  </div>
  <div class="chartWrapper">
  <div class="apartementCount"></div>
  <div class="bangalowCount"></div>
  <div class="chambreSimpleCount"></div>
  <div class="chambreDoubleCount"></div>
  
  <div id="piechart" style="width: 900px; height: 500px;"></div>
  </div>
  <h2 style="margin: 20px;">Table of Customers</h2>
<table id="table-res" class="table table-striped table-hover">
    <thead>
      <tr>
        <th class="toHideInMobile">user ID</th>
        <th>Full name</th>
        <th>Phone</th>
        <th>check in</th>
        <th>chack out</th>
        <th class="toHideInMobile">Email</th>
        <th class="toHideInMobile">Password</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $reservations = $reservationObj->displayData(); 
          foreach ($reservations as $reservation) {
        ?>
        <tr>
          <td class="toHideInMobile"><?php echo $reservation['userId'] ?></td>
          <td><?php echo $reservation['fullName'] ?></td>
          <td><?php echo $reservation['phone'] ?></td>
          <td><?php echo $reservation['dateCheckIn'] ?></td>
          <td><?php echo $reservation['dateCheckOut'] ?></td>
          <td class="toHideInMobile"><?php echo $reservation['email'] ?></td>
          <td class="toHideInMobile"><?php echo $reservation['password'] ?></td>
          <td style="color: red;"><?php echo $reservation['totalPrice'] ?></td>
          
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <h2 style="margin: 20px;">Tarifs Operations</h2>

  <div class="containerTarifs">
  <!--pension price update form-->
  <div class="Pensiontable viewtable">
  <table class="table-res table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Pension</th>
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
            <a href="adminDash.php?editPensionId=<?php echo  $pension['pensionId'] ?>">
              <img width="20px" src="images/update.png"></a>
            <a style ="margin-left : 10px" onclick="confirm('Are you sure want to delete this record')">
            <img width="20px" src="images/remove.png">
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="pensionForm">
  <form action="adminDash.php" method="POST">
    <div class="form-group">
      <label for="Atype">Pension Type : </label>
      <input type="text" class="form-control" name="Ptype" value="<?php echo isset($displayedPension['type']) ? $displayedPension['type'] : "" ?>" required="">
    </div>
    <div class="form-group">
      <label for="Aprice">Price :</label>
      <input type="text" class="form-control" name="Pprice" value="<?php echo isset($displayedPension['price']) ? $displayedPension['price'] : "" ?>" required="">
    </div>
    <div class="form-group">
      <input type="hidden" name="Pid" value="<?php echo $displayedPension['pensionId']; ?>">
      <input type="submit" name="Pupdate" class="btn" style="float:right;" value="Update">
    </div>
  </form>
</div>
  </div>
  <!--Accomodation price update form-->
    <div class="acommodationTable viewtable">
  <table id="table-res" class="table-res table table-striped table-hover">
    <thead>
      <tr>
        <th>Id </th>
        <th>Acommodation</th>
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
            <a href="adminDash.php?editAccommodationId=<?php echo $accomodation['accommodationId'] ?>">
              <img width="20px" src="images/update.png"></a>
            <a style ="margin-left : 10px" onclick="confirm('Are you sure want to delete this record')">
            <img width="20px" src="images/remove.png">
            </a>
          </td>
          
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="acommodationForm">
  <form action="adminDash.php" method="POST">
    <div class="form-group">
      <label for="Atype">Acommodation Type : </label>
      <input type="text" class="form-control" name="Atype" value="<?php echo isset($displayedaccomodation['accomodationType']) ? $displayedaccomodation['accomodationType'] : "" ?>" required="">
    </div>
    <div class="form-group">
      <label for="Aprice">Price :</label>
      <input type="text" class="form-control" name="Aprice" value="<?php echo isset($displayedaccomodation['price']) ? $displayedaccomodation['price'] : "" ?>" required="">
    </div>
    <div class="form-group">
      <input type="hidden" name="Aid" value="<?php echo $displayedaccomodation['accommodationId']; ?>">
      <input type="submit" name="Aupdate" class="btn" style="float:right;" value="Update">
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