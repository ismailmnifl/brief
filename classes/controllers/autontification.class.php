<?php
session_start();


// include 'connetion.php';
class autontification extends user {

    
    public function authontification()
    {
	$email = $_POST['email'];
    $Pass = $_POST['password'];
    
    // Insert iformation to Database 
     
                $res=$this->userAutontification($email,$Pass);
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $_SESSION['LogOut']='reservation.php?logoutPress=1';
                $_SESSION['fullName']= $row['fullName'];
                $_SESSION['userId'] = $row['userId'];
                $_SESSION['userEmail'] = $row['email'];
                header('Location: reservation.php');
                exit();
            }else{
                $res=$this->AdminAutontification($email,$Pass);
                if ($res->num_rows > 0) {
                   $row = $res->fetch_assoc();
                    $_SESSION['LogOut']='adminDash.php?logoutPress=1';
                    $_SESSION['fullName']= $row['fullName'];
                    $_SESSION['adminId'] = $row['adminId'];
                    $_SESSION['userEmail'] = $row['email'];
                    header('Location: adminDash.php');
            }
        }
    }
}
?>