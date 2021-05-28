
<?php
session_start();
 
if (!isset($_SESSION['LogOut'])) {
    header('Location: Read.php');
}
include('includes/autoloader.inc.php');
// include('classes/controllers/reservationController.class.php');

$reservationObj = new reservation();
$reservationControllerObj = new reserveController();


if(isset($_POST['button_type'])) {

    $buttonType = $_POST['button_type'];
    switch($buttonType) {
        case 'submit':
            // if(!isset($_SESSION['current_reservation']))
            $_SESSION['current_reservation'] = $reservationControllerObj->insertReservation();
            break;

        case 'add':
            $reservationControllerObj->addAcommodationToReservation($_SESSION['current_reservation']);
            break;

        case 'cancel':
            //.......
            unset($_SESSION['current_reservation']);
            break;
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sass/reservation.css">
    <!--ajax-->

<?php
    include 'addON/header.php';
?>
    <div class="container mt-2 mb-2">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div id="cardimage" class="card h-100">
            <div class="card-body">
                <div class="account-settings">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <img id="avatarImage" src="images/apartement1.jpg" alt="Maxwell Admin">
                        </div>
                        
                        <button style="width:250px;" id="btnSubmitRes0" class="mt-2 btn btn-primary">Submit reservation</button><br>
                        <button style="width:250px;" id="btnSubmitRes1" class="mt-2 btn btn-success">Ajouter un autre bien</button><br>
                        <button style="width:250px;" id="btnSubmitRes2" class="mt-2 btn btn-danger">Annuler la reservation</button>

                        <h1 style="margin-left : 60px" ><?php echo isset($_SESSION['current_reservation']) ? $reservationObj->getTotalPrice($_SESSION['current_reservation']) : ""; ?> MAD</h1> 
                        
                    </div>

                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
            <form action=""  id="main_form" method="post">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mb-2 text-primary">Reservation Details</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                             <label for="fullName">Accomodation</label>
                            <select name="accomodationSelect" class="form-select selectedBien">
                            <option selected="" disabled value="">--choisie votre accomodation--</option>
                            <?php 
                                $accomodations = $reservationObj->displayAccomodations(); 
                                foreach ($accomodations as $accomodation) {
                                ?>
                                <option value="<?php echo $accomodation['accommodationId'] ?>"><?php echo $accomodation['accomodationType'] ?></option>
                            <?php } ?>
                            </select>
                            
                            
					</select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                        <label for="pension">Pension</label>
                            <select name = "pensionSelect" class="form-select selectedPension">
                            <option selected="" disabled value="">--choisie la pension qui vous convient--</option>

                            <?php 
                                $accomodations = $reservationObj->displayPension(); 
                                foreach ($accomodations as $accomodation) {
                                ?>
                                <option value="<?php echo $accomodation['pensionId'] ?>"><?php echo $accomodation['type'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group sectionB">
                        </div>
                    </div>
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group sectionC">
                        </div>
                    </div>
                </div>
                <hr>
                
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Reservation date</h6>
                    </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group ">
                        <label for="pension">Date checkIn</label>
                        <input name="dateCheckIn" class="form-control" type="date">
                        </div>
                    </div>
                   
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group ">
                        <label for="pension">Date checkOut</label>
                        <input name="dateCheckOut" class="form-control" type="date" >
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Personal Details</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input onclick="No()" class="form-check-input" type="radio" name="flexRadioDefault" id="noEnfants" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Vous n'avez pas d'enfants
                                </label>
                            </div>
                            <div class="form-check">
                                <input onchange="Yes()" class="form-check-input" type="radio" name="flexRadioDefault" id="haveEnfants">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Vous avez des enfants
                                </label>
                            </div>                          
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div style="display:none;" class="form-group sectionE">
                        <label for="ciTy">Nombre d'enfants</label>
                        <input name="NombreEnfant" onkeyup="nenfantAge()" type="number" class="form-control" id="nEnfant" placeholder="Enter combien vous avez d'enfants">

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group sectionF">

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group sectionG">
                        
                        </div>
                    </div>
                </div>
                <div class="mt-3 row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="button_type" name="button_type" value="">
                </form>
            </div>
        </div>
        </div>
        </div>
        </div>
    <?php
    include 'addON/footer.php';
?>
    <script src="Bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/reservation.js"></script>

</body>
</html>