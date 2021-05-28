

<?php

class reservation extends connetion{
// display accomodations
    public function displayAccomodations()
    {
        $query = "SELECT * FROM accommodation";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            echo "No found records";
        }
    }
// display pensions

    public function displayPension()
    {
        $query = "SELECT * FROM pension";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            echo "No found records";
        }
    }
    public function lastReservation(){

        $query = "
        SELECT reservationId FROM reservation ORDER BY reservationId DESC LIMIT 1;
        ";
        $result = $this->con->query($query);
        $lastId = $result->fetch_assoc();
        return $lastId['reservationId'];

    }

    public function displayData()
		{
			$query = "SELECT user.userId,user.fullName,user.phone,reservation.dateCheckIn,
            reservation.dateCheckOut,user.email,reservation.totalPrice,user.password
             FROM reservation INNER JOIN
              user on reservation.userId = user.userId";
			$result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$data = array();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				echo "No found records";
			}
		}
        public function NumberOfCostomers(){
            $query = 'SELECT COUNT(user.userId) as NC FROM user';
            $result = $this->con->query($query);
            $row = $result->fetch_assoc();
            return $row;
        }

        public function reservationCount(){

            $query = 'SELECT COUNT(reservation.reservationId) as RC FROM reservation';
            $result = $this->con->query($query);
            $row = $result->fetch_assoc();
            return $row;
        }
        public function TotalRevenue(){

            $query = 'SELECT SUM(reservation.totalPrice) AS SM FROM reservation';
            $result = $this->con->query($query);
            $row = $result->fetch_assoc();
            return $row;
        }
        public function AVGcustomerSpending(){

            $query = 'SELECT AVG(reservation.totalPrice) AS AV FROM reservation';
            $result = $this->con->query($query);
            $row = $result->fetch_assoc();
            return $row;
        }

        public function retraivePension(){
            $query = 'SELECT * FROM pension';
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
				$data = array();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				echo "No found records";
			}
        }
        public function retraiveAcommodations(){
            $query = 'SELECT * FROM accommodation';
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
				$data = array();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				echo "No found records";
			}
        }

        public function insertTReservationTable($userId,$dateCheckIn,$dateCheckOut){
            $query = "
                INSERT INTO reservation (userId, dateCheckIn, dateCheckOut)
                values ($userId,'$dateCheckIn','$dateCheckOut')
                ";
                $this->con->query($query);

            return $this->lastReservation();

        }

        public function insertNewAcommodation($accommodationId,$reservationId,$pensionId,$roomVue,$bedType){
            echo $reservationId."<br>";
            echo "----------------<br>";
            echo $accommodationId."<br>";
            echo $pensionId."<br>";
            echo $roomVue."<br>";
            echo $bedType."<br>";
            $query = "
            INSERT INTO reservationaccomodation 
            (`accommodationId`,`reservationId`,`pensionId`,`roomVue`,`bedType`)
             VALUES ($accommodationId,$reservationId,$pensionId,'$roomVue','$bedType')
             ";
            $res = $this->con->query($query);
            echo($res ? "inserted!" : "couldnt insert anything");
            return $res;

        }

        public function getChambreSimplePrice() {
            $query = "
            SELECT price FROM `accommodation` WHERE `accomodationType`= 'chambre simple';
            ";
            $result = $this->con->query($query);
            $result = $result->fetch_assoc();
            return $result['price'];
        }

        public function getAccomPrices(){
            $query = "
            SELECT `accommodationId`, `price` FROM `accommodation`;
            ";
            $result = $this->con->query($query);
            // $result = $result->fetch_assoc();
            // return $result;
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[$row['accommodationId']] = (int)$row['price'];
            }
            return $data;
        }

        public function getPensionPrices(){
            $query = "
            SELECT `pensionId`, `price` FROM `pension`;
            ";
            $result = $this->con->query($query);
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[$row['pensionId']] = (int)$row['price'];
            }
            return $data;
        }
        
        public function updateTotalPrice($totalPrice,$reservationId) {
            $query = "
            UPDATE reservation SET totalPrice = $totalPrice WHERE reservationId = $reservationId;
            ";
            $result = $this->con->query($query);
        }

        public function getTotalPrice($reservationId) {
            $query = "
            select `totalPrice` from reservation where reservationId = $reservationId;
            ";
            $result = $this->con->query($query);
            
            return $result->fetch_assoc()['totalPrice'];
        } 
 
        //admindash operation

        public function displayAccomodationRecordById($id)
		{
			$query = "SELECT * FROM accommodation WHERE accommodationId = '$id'";
			$result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}
        public function displayPensionRecordById($id)
		{
			$query = "SELECT * FROM pension WHERE pensionId = '$id'";
			$result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}
        public function updateAccomodationRecord($id,$Aprice)
		{
				$query = "UPDATE accommodation SET price = '$Aprice' WHERE accommodationId = '$id'";
				$sql = $this->con->query($query);
			
		}
        public function updatePensionRecord($id,$Pprice)
		{
				$query = "UPDATE pension SET price = '$Pprice' WHERE pensionId = '$id'";
				$sql = $this->con->query($query);
			
		}

         public function statistic($id)
		{
			$query = "SELECT * from reservation INNER JOIN reservationaccomodation on reservationaccomodation.reservationId = reservation.reservationId WHERE reservation.userId = '$id'";
			$result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		} 
}
    


?>