<?php
	include 'dbConnect.php';
	abstract class Table
	{
		public $conn;
			public function __construct($conn) {
			$this->conn = $conn;
		  }
		abstract function insert(array $values);
		abstract function update($id, array $fields, array $values);

	}
	
	class User extends Table{
		
		function insert(array $values){
			$password = $values[0]; 
			$first_name = $values[1];
			$last_name = $values[2];
			$email = $values[3]; 
			$admin= $values[4];
			$phone = $values[5];
			
			
			$sql = "INSERT INTO `user` ( `password`, `firstName`, `lastName`, `email`, `phone`,`admin`)
						VALUES ('$password', '$first_name', '$last_name', '$email', '$phone',0)";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE user SET $fields[$i] = '$values[$i]' WHERE userID = $id";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
			}
		}

		function does_email_exist($email){

			$Find_userID = "SELECT userID FROM user WHERE email = '$email'";
			$Find_userID_run= mysqli_query($this->conn, $Find_userID);

			if (mysqli_num_rows($Find_userID_run) > 0){
				return true;
			}else return false;
		}

		function find_by_email($email){

               $Find_userID = "SELECT userID FROM user WHERE email = '$email'";

               $userID_run= mysqli_query($this->conn, $Find_userID);
               $userID= mysqli_fetch_row($userID_run);
			if ($userID[0]){
				return $userID[0];

			}else return;
		}

	}
	
	// $userTable = new User($conn);
	//$userTable -> insert(array("sinapassword","Sina", "Pahlavan", "sinapah333@gmail.com",123456,0));
	//$userTable -> insert(array("janepassword","Jane", "Doe", "janedoe@gmail.com",1234567,0));
	//$userTable -> update(5, array("firstName", "lastName"), array("Sinaaaa", "Pahli"))
	//$userTable -> update(6, array("email"), array("janedoe@gmail.com"))
	// $userTable -> insert(array("felixpassword","felix","lee","flee@gmail.com",0,123456));

	
		///////////////////////////////
	//ADDRESS
	
	class Address extends Table{
		
		function insert(array $values){
			$userID = $values[0]; 
			$postalCode = $values[1];
			$streetName = $values[2];
			$city = $values[3]; 
			$province = $values[4];
			
			
			$sql = "INSERT INTO `address` ( `userID`, `postalCode`, `streetName`, `city`, `province`)
						VALUES ('$userID', '$postalCode', '$streetName', '$city', '$province')";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE address SET $fields[$i] = '$values[$i]' WHERE userID = $id";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
			}
		}
	}
	
	/////////////////////
	//DISCOUNT
	class Discount extends Table{
		
		function insert(array $values){
			$itemID = $values[0]; 
			
			
			$sql = "INSERT INTO `discount` ( `itemID`)
						VALUES ('$itemID')";
			//echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE discount SET $fields[$i] = $values[$i] WHERE discountID = $id";
				//echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
			}
		}
	}
	
	//////////////////////////
	//Items
	
	class Item extends Table{
		
		function insert(array $values){
			$itemName = $values[0]; 
			$madeIn = $values[1];
			$itemPic = $values[2];
			$quantity = $values[3]; 
			$price = $values[4];
			$depCode = $values[5];
			
			
			$sql = "INSERT INTO `item` ( `itemName`, `madeIn`, `itemPic`, `quantity`, `price`, `depCode`)
						VALUES ('$itemName', '$madeIn', '$itemPic', '$quantity', '$price', '$depCode')";
			//echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				//echo "added successfully";
				return true;
			}else{
				return false;
			}
		}
		
		
		function update($id, array $fields, array $values){
			
			for( $i = 0; $i<count($fields); $i++ ) {
				$sql = "UPDATE item SET $fields[$i] = '$values[$i]' WHERE itemID = $id";
				//echo $sql;
				$result = mysqli_query($this->conn, $sql);

			}
		}
	}
	
	/////////////////////////
	//ItemInShoppingCart
	class ItemsInShoppingCart extends Table{
		
		function insert(array $values){
			$itemID = $values[0]; 
			$receiptID = $values[1];
			$quantity = $values[2];
		
			
			$sql = "INSERT INTO `itemsinshoppingcart` ( `itemID`, `receiptID`, `quantity`)
						VALUES ($itemID, $receiptID, $quantity)";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE `itemsinshoppingcart` SET $fields[$i] = '$values[$i]' WHERE itemsInShoppingCartID = $id";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
			}
		}
	}
	
	/////////////////
	//Orders
	class Orders extends Table{
		
		function insert(array $values){
			$dateIssued = $values[0]; 
			$totalPrice = $values[1];
			$paymentmethod = $values[2];
			$userID = $values[3]; 
			$receiptID = $values[4];
			
			
			$sql = "INSERT INTO `orders` ( `dateIssued`, `totalPrice`, `paymentmethod`, `userID`, `receiptID`)
						VALUES ('$dateIssued', '$totalPrice', '$paymentmethod', '$userID', '$receiptID')";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE orders SET $fields[$i] = '$values[$i]' WHERE orderID = $id";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
			}
		}
	}
	
/////////////////
	//Store
	class Store extends Table{
		
		function insert(array $values){
			$location = $values[0]; 
			$city = $values[1];
			$postalCode = $values[2];
			
			
			$sql = "INSERT INTO `store` ( `location`, `city`, `postalCode`)
						VALUES ('$location', '$city', '$postalCode')";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($depCode, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE store SET $fields[$i] = '$values[$i]' WHERE depCode = $depCode";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
			}
		}

	}


	//1422 Gerrard St E, Toronto, ON M4L 1Z6
	//2681 Danforth Ave, Toronto, ON M4C 1L4
	// $storeTable -> insert(array("1422 Gerrard St E","ON", "M4L 1Z6"));
	// $storeTable -> insert(array("2681 Danforth Ave","Toronto", "M4C 6L9"));
	// $storeTable -> update(7, array("location", "city","postalCode"), array("2681 Danforth Ave", "Toronto","M4C 1L4"));
	// $storeTable -> update(6, array("city"), array("Toronto"));


/////////////////
	//Truck
	class Truck extends Table{
		
		function insert(array $values){
			$driverFirstName = $values[0]; 
			$driverLastName = $values[1];
			$PlateNum = $values[2];

			
			$sql = "INSERT INTO `truck` ( `driverFirstName`, `driverLastName`, `PlateNum`)
						VALUES ('$driverFirstName', '$driverLastName', '$PlateNum')";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "added successfully";
			}
		}
		
		
		function update($truckID, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE truck SET $fields[$i] = '$values[$i]' WHERE truckID = $truckID";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "truck updated successfully";
				}
			}
		}
		public function ID_exist($truckID){
			$Find_truckID= "SELECT truckID FROM truck WHERE truckID = '$truckID'";
			$Find_truckID_run=mysqli_query($this->conn, $Find_truckID);


			if(mysqli_num_rows($Find_truckID_run) > 0){
				$truckID= mysqli_fetch_row($Find_truckID_run);
				echo "truckID exists ";
				return true;

			}else{
				echo "dose not exist ";
				return false;
			}
		}
		function findByPlateNumber($PlateNum){
			$Find_truckID= "SELECT truckID FROM truck WHERE PlateNum = '$PlateNum'";
			$Find_truckID_run=mysqli_query($this->conn, $Find_truckID);


			if(mysqli_num_rows($Find_truckID_run) > 0){
				$truckID= mysqli_fetch_row($Find_truckID_run);

				echo "truckID:".$truckID[0];
				return $truckID[0];
	
				// $_SESSION['message'] ="User with this Email already exist. please use another Email." ;
				// header("Location: ../Forms/userForm.php");
				// exit(0);
	
			}else{
				echo "truck does not exist";
			}

		}
		function insert_truck_schedule($truckID,array $values){
			$Monday = $values[0]; 
			$Tuesday = $values[1];
			$Wednesday = $values[2];
			$Thursday = $values[3]; 
			$Friday = $values[4];
			$Saturday = $values[5];
			$Sunday = $values[6];

			
			$sql = "INSERT INTO `truckToGo` ( `truckID`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`)
						VALUES ('$truckID', '$Monday', '$Tuesday', '$Wednesday', '$Thursday', '$Friday', '$Saturday', '$Sunday')";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo "schedule added successfully";
			}
		}
		function update_truck_schedule($truckID, array $fields,array $values){

			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE truckToGo SET $fields[$i] = '$values[$i]' WHERE truckID = $truckID";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "truck updated successfully";
				}
			}
		}

	}

/////////////////
	//Review
	class Review extends Table{
		public function ID_exist($userID){
			$Find_userID= "SELECT userID FROM user WHERE userID = '$userID'";
			$Find_userID_run=mysqli_query($this->conn, $Find_userID);


			if(mysqli_num_rows($Find_userID_run) > 0){
				$found_userID= mysqli_fetch_row($Find_userID_run);
				if($found_userID[0]){
				echo "truckID exists ";
				return true;
				}


			}else{
				echo "dose not exist ";
				return false;
			}
		}
		function insert(array $values){
			$userID = $values[0]; 
			$userName = $values[1];
			$itemID = $values[2];
			$userRN = $values[3]; 
			$reviewTime= $values[4];
			$userReview = $values[5];
			
			
			$sql = "INSERT INTO `review` ( `userID`, `userName`, `itemID`, `userRN`, `reviewTime`,`userReview`)
						VALUES ('$userID', '$userName', '$itemID', '$userRN', '$reviewTime','$userReview')";
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				echo " review added successfully";
			}
			return false;
		}
		
		
		function update($reviewID, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE review SET $fields[$i] = '$values[$i]' WHERE reviewID = $reviewID";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "review updated successfully";
				}
			}
		}
	}


	
?>