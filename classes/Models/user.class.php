<?php

// include 'connetion.php';


	class user extends connetion {
		// Insert customer data into customer table
		public function insertData()
		{
			$fullName = $this->con->real_escape_string($_POST['fullName']);
			$phone = $this->con->real_escape_string($_POST['phone']);
			$email = $this->con->real_escape_string($_POST['email']);
			$password = $this->con->real_escape_string(($_POST['password']));
			$query="INSERT INTO user(fullName,phone,email,password) VALUES('$fullName','$phone','$email','$password')";
			$sql = $this->con->query($query);
			if ($sql==true) {
				header("Location:login.php");
			}else{
				echo "Registration failed try again!";
			}
		}

		// Fetch customer records for show listing
		public function displayData()
		{
			$query = "SELECT * FROM customers";
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

		// Fetch single data for edit from customer table
		public function displyaRecordById($id)
		{
			$query = "SELECT * FROM customers WHERE id = '$id'";
			$result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}

		// Update customer data into customer table
		public function updateRecord()
		{
			$name = $this->con->real_escape_string($_POST['uname']);
			$email = $this->con->real_escape_string($_POST['uemail']);
			$username = $this->con->real_escape_string($_POST['upname']);
			$id = $this->con->real_escape_string($_POST['id']);
			if (!empty($id)) {
				$query = "UPDATE customers SET name = '$name', email = '$email', username = '$username' WHERE id = '$id'";
				$sql = $this->con->query($query);
				if ($sql==true) {
					header("Location:index.php?msg2=update");
				}else{
					echo "Registration updated failed try again!";
				}
			}
			
		}


		// Delete customer data from customer table
		public function deleteRecord($id)
		{
			$query = "DELETE FROM customers WHERE id = '$id'";
			$sql = $this->con->query($query);
			if ($sql==true) {
				header("Location:index.php?msg3=delete");
			}else{
				echo "Record does not delete try again";
			}
		}

		public function userAutontification($email,$Pass){

			$query = "SELECT * FROM user where user.email = '$email' and user.password = '$Pass'";
				$result = $this->con->query($query);
			return $result;
		
		}
		public function AdminAutontification($email,$Pass){

			$query = "SELECT * FROM admin where admin.email = '$email' and admin.password = '$Pass'";
                $result = $this->con->query($query);
			return $result;
		}

	}
?>