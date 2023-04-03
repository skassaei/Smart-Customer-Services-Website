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
			//returns true if successfully added
			$password = password_hash($values[0], 
									PASSWORD_DEFAULT); 
			$first_name = $values[1];
			$last_name = $values[2];
			$email = $values[3]; 
			$phone= $values[4];
			$admin = $values[5];
			
			
			$sql = "INSERT INTO `user` ( `password`, `firstName`, `lastName`, `email`, `phone`,`admin`)
						VALUES ('$password', '$first_name', '$last_name', '$email', '$phone',$admin)";
			
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				return true;
			}
			return false;
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
		
		function checkEmailUnique($email){
			$sql = "SELECT userID from user WHERE email = '$email'";
			$query = mysqli_query($this->conn, $sql);
			if(mysqli_num_rows($query) > 0){

				return false;
			}
			return true;
		}
		
		function getUserID($email){
			//finds userID from email
			$query = "SELECT userID FROM user WHERE email = '$email'";
            $userID_run= mysqli_query($this->conn, $query);
            $userID= mysqli_fetch_row($userID_run);
			return $userID[0];
		}
	}
	
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
			
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				return true;
			}
			return false;
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
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				return true;
			}
			return false;
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE discount SET $fields[$i] = $values[$i] WHERE discountID = $id";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					return true;
				}
				return false;
			}
		}
	}
	
	//////////////////////////
	//Items
	///////////////////////////////
	//ADDRESS
	
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
			echo $sql;
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				return true;
			}
			return false;
		}
		
		
		function update($id, array $fields, array $values){
			
			for($i=0; $i<count($fields); $i++) {
				$sql = "UPDATE item SET $fields[$i] = '$values[$i]' WHERE itemID = $id";
				echo $sql;
				$result = mysqli_query($this->conn, $sql);
				if ($result){
					echo "updated successfully";
				}
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
				return true;
			}
			return false;
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
				return true;
			}
			return false;
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
			
			$result = mysqli_query($this->conn, $sql);
			if ($result){
				return true;
			}
			return false;
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
		
		function depCodeExists($depCode){
			$Find_depCode = "SELECT depCode FROM store WHERE depCode = '$depCode'";
            $depCode_run= mysqli_query($this->conn, $Find_depCode);
                if($depCode_run->num_rows>0){
					return true;
				}
				return false;
		}

	}
	
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
				return true;
			}
			return false;
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
				return true;
			}
			return false;
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
				return true;
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
	
	$userTable = new User($conn);
	$addressTable = new Address($conn);
	$discountTable = new Discount($conn);
	$itemTable = new Item($conn);
	$ordersTable = new Orders($conn);
	$storeTable = new Store($conn);
	$itemsInShoppingCartTable = new ItemsInShoppingCart($conn);
	$truckTable = new Truck($conn);
	$review = new Review($conn);
	//$userTable -> insert(array("sinapassword","Sina", "Pahlavan", "sinapah333@gmail.com",123456,0));
	//$userTable -> insert(array("felixpassword","felix","lee","flee@gmail.com",0,123456));
	//$hash = password_hash("admin", PASSWORD_DEFAULT);
	//$userTable -> insert(array($hash,"admin","admin","admin@gmail.com",123456789,1));
	//$addressTable -> insert(array(5, "1L1L1L", "Sina ST", "Vaughan", "Ontario"));
	//$addressTable -> update(5, array("postalCode", "streetName"), array ("L1L1L1","Sina Ave"));
	//$discountTable -> insert(array(2));
	//$discountTable -> update(2,array("itemID"),array(3));
	//$itemTable -> insert(array("Apple Pie", "USA", "https://sweetlycakes.com/wp-content/uploads/2019/12/Apple-Pie-8blog.jpg", 1,10,1));
	//$itemTable -> update(6, array("itemName", "price"), array("Strawberry Pie", 11));
	//$itemsInShoppingCartTable -> insert(array (6,1,2));
	//$itemsInShoppingCartTable -> update(12, array("quantity"), array(5));
	//$ordersTable -> insert(array("00:20:29", 60, "Debit/Credit", 5, 2));
	//$ordersTable -> update(6, array("paymentmethod"), array("Gift Card"));
?>