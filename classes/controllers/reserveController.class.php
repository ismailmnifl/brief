<?php


class reserveController extends reservation {


    private $userId ;

    private $accommodationId ;
    private $pensionId ;
    private $dateCheckIn ;
    private $dateCheckOut ;

    private $roomVue ;

    private $bedType ;

    private $nombreEnfant;

    private $totalPrice;

    private $buttonType;

    public function __construct () {

        reservation::__construct();

        $this->userId = $_SESSION['userId'] ?? null;

        $this->accommodationId = $_POST['accomodationSelect'] ?? null;
        $this->pensionId = $_POST['pensionSelect'] ?? null;
        $this->dateCheckIn = $_POST['dateCheckIn'] ?? null;
        $this->dateCheckOut = $_POST['dateCheckOut'] ?? null;
    
        $this->roomVue =  $_POST['VueChambreSimple'] ?? 
                    $_POST['VueChambreDoubleLitDouble'] ?? 
                    $_POST['VueChambreDouble2litsimple'] ?? 
                    'NULL';
    
        $this->bedType = $_POST['chambreDoubleLitTypes'] ??  'NULL';

        $this->nombreEnfant = $_POST['NombreEnfant'] ?? null;

        // $this->totalPrice = 0;
        // $this->resevPrice = $_SESSION['reserv_price'] ?? 0;
        // $this->accomPrice = $_SESSION['accom_price'] ?? 0;

        $this->buttonType = $_POST['button_type'] ?? null;
        // $this->calcTotalPrice();
        // $this->calcChildrenCost();
    }

    public function calcChildrenCost() {

        $counter = (int)$this->nombreEnfant;
        $chidrenCost = 0;
        $chambreSimplePrice = $this->getChambreSimplePrice();

        for ($i=0; $i < $counter; $i++) { 
            
           $chidrenOption[$i] =  $_POST["child-".$i];
           $chidrenCost += ($chidrenOption[$i]/100) * $chambreSimplePrice ;         
        }
        
        return $chidrenCost;
    }

    public function calcAccomPrice() {

        $roomPrices = $this->getAccomPrices();
        // $roomPrices = array(
        //     '1' => 400,
        //     '2' => 750,
        //     '3' => 250,
        //     '4' => 300
        // // );
        
        $pensionPrices = $this->getPensionPrices();
        // $pensionPrices = array(
        //     '1' => 400,
        //     '2' => 0,
        //     '3' => 250,
        //     '4' => 250
        // );

        // $vuePercent = array(
        //     'vueInt' => 0,
        //     'vueExt' => 0.2
        // );       

        $totalPrice = 0;
        $roomPrice = $roomPrices[$this->accommodationId];
        $accomPrice = $roomPrice ;
        $accomPrice += $pensionPrices[$this->pensionId];

        $checkin = new datetime($this->dateCheckIn);
        $checkout = new datetime($this->dateCheckOut);
        $noDays = $checkin->diff($checkout)->d;

        $vuePrice = $this->roomVue == 'vueExt' ? 0.2*$roomPrice : 0;
        $ChildrenCost = $this->calcChildrenCost();

        $accomPrice += $vuePrice + $ChildrenCost;

        $totalPrice = $accomPrice*$noDays;
        
        $this->updateTotalPrice($totalPrice, $this->lastReservation());
        return $totalPrice;
    }

    public function calcTotalPrice() {

        switch ($this->buttonType) {

            case 'submit':
                $_SESSION['accom_price'] = $this->calcAccomPrice();
                break;
            
            case 'add':
                $_SESSION['accom_price'] += $this->calcAccomPrice();
                break;

            default:
                # code...
                break;
        }

        // echo $_SESSION['accom_price'].'<br>';

    }

    public function insertReservation() {
    
        $reservationId = $this->insertTReservationTable(
            $this->userId,
            $this->dateCheckIn,
            $this->dateCheckOut
        );

        $this->insertNewAcommodation(
            $this->accommodationId,
            $reservationId,
            $this->pensionId,
            $this->roomVue,
            $this->bedType
        );

        $this->addChildren();
        $this->calcTotalPrice();

        return $reservationId;
    }

    public function addAcommodationToReservation($reservationId) {

        $this->insertNewAcommodation(
            $this->accommodationId,
            $reservationId,
            $this->pensionId,
            $this->roomVue,
            $this->bedType
        );

        $this->addChildren();
        $this->calcTotalPrice();
    }

    public function addChildren() {
        $nombreEnfant = (int)$this->nombreEnfant;
        if(!$nombreEnfant)
            return;
        
        for($i = 0; $i < $nombreEnfant ; $i++){
    
            $childOptions = array(
                'age' => $_POST["ageEnfant-".$i] ?? null,
                'option' => $_POST["child-".$i] ?? null
            );
            
            $age = $childOptions['age'];
            $option = $childOptions['option'];

            $query = "INSERT INTO `child` (`userId`, `age`, `option`) VALUES ($this->userId, $age, $option);";
            $sql = $this->con->query($query);

        }
        
    }

      
}

    

?>