<?php
    session_start();
    //require 'dbConnect.php';
	include 'classes.php';

// ---------Saving Store----------
    if(isset($_POST['Save_store'])){

        $location = mysqli_real_escape_string( $conn,$_POST["location"]);
        $city = mysqli_real_escape_string( $conn,$_POST["city"]);
        $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
        
        if($storeTable -> insert(array($location, $city, $postalCode))){

            $_SESSION['message'] ="The New Store Was Added Successfully" ;
            header("Location: ../Forms/storeForm.php");
            exit(0);

        }
        else{ 
            $_SESSION['message'] ="Store Was NOT Added Please Try Again" ;
            header("Location: ../Forms/storeForm.php");
            exit(0);
        }

    }


// ---------Saving USER----------
    if(isset($_POST['Save_user'])){
        
        $firstName = mysqli_real_escape_string( $conn,$_POST["firstName"]);
        $lastName = mysqli_real_escape_string( $conn,$_POST["lastName"]);
        $email = mysqli_real_escape_string( $conn,$_POST["email"]);
        $phone = mysqli_real_escape_string( $conn,$_POST["phone"]);
        $password = mysqli_real_escape_string( $conn,$_POST["password"]);
		$admin = mysqli_real_escape_string( $conn,$_POST["admin"]);
        //---------------ADDRESS INFO---------------------------------
        $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
        $streetName = mysqli_real_escape_string( $conn,$_POST["streetName"]);
        $city = mysqli_real_escape_string( $conn,$_POST["city"]);
        $province = mysqli_real_escape_string( $conn,$_POST["province"]);
        
        //$query = "INSERT INTO user (firstName ,lastName ,email ,phone) VALUE ('$firstName','$lastName','$email','$phone')";
        //$query_run= mysqli_query($conn,$query);
        $query_run = $userTable -> insert(array($password, $firstName, $lastName, $email, $phone, $admin));
        if($query_run){
            echo "Was added to USER";
            //Getting the User Id of new user
            $userID = $userTable -> getUserID($email);
            //Saving the address info in address Table
                    
			$address_query_run = $addressTable -> insert(array($userID, $postalCode, $streetName, $city, $province));
			if ($address_query_run){        
				$_SESSION['message'] ="User Was Added Successfully" ;
				header("Location: ../Forms/userForm.php");
				exit(0);
				}
				else{
					$_SESSION['message'] ="We Couldn NOT add The Address. Please, Add the Address separately" ;
					header("Location: ../Forms/userForm.php");
					exit(0);
				}
            
        
        }
        else{ 
            $_SESSION['message'] ="User Was NOT Added. Please, Try Again." ;
            header("Location: ../Forms/userForm.php");
            exit(0);
        }

    }

// ---------Saving Truck----------
    if(isset($_POST['Save_truck'])){
        $driverFirstName = mysqli_real_escape_string( $conn,$_POST["driverFirstName"]);
        $driverLastName = mysqli_real_escape_string( $conn,$_POST["driverLastName"]);
        $PlateNum = mysqli_real_escape_string( $conn,$_POST["PlateNum"]);

        if($truckTable -> insert(array($driverFirstName,$driverLastName,$PlateNum))){

            $_SESSION['message'] ="Truck Was Added Successfully" ;
            header("Location: ../Forms/truckForm.php");
            exit(0);
        }
        else{
            $_SESSION['message'] ="Truck Was NOT Added. Please, Try Again." ;
            header("Location: ../Forms/truckForm.php");
            exit(0);
            }

    }

// ---------Saving Item----------
    if(isset($_POST['Save_item'])){
        $itemName = mysqli_real_escape_string( $conn,$_POST["itemName"]);
        $madeIn = mysqli_real_escape_string( $conn,$_POST["madeIn"]);
        $itemPic = mysqli_real_escape_string( $conn,$_POST["itemPic"]);
        $price = mysqli_real_escape_string( $conn,$_POST["price"]);
        $depCode = mysqli_real_escape_string( $conn,$_POST["depCode"]);
        $quantity = mysqli_real_escape_string( $conn,$_POST["quantity"]); //might use it later

           
                if($storeTable -> depCodeExists($depCode)){
                    
                    if($itemTable -> insert(array($itemName,$madeIn, $itemPic, $quantity, $price, $depCode))){

                        $_SESSION['message'] ="Item Was Added Successfully" ;
                        header("Location: ../Forms/itemForm.php");
                        exit(0);
                    }
                    else{ 

                        $_SESSION['message'] ="Item Was NOT Added. Please, Try Again." ;
                        header("Location: ../Forms/itemForm.php");
                        exit(0);
                    }
                    
                }
                else{
                    
                   $_SESSION['message'] ="The Department Code Does NOT exist. Please, Try Again with another Code." ;
                   header("Location: ../Forms/itemForm.php");
                   exit(0);
                    }

    }
	// ---------Saving Discount----------
	if(isset($_POST['Save_discount'])){
        $itemID = mysqli_real_escape_string( $conn,$_POST["itemID"]);
           
				if($discountTable -> insert(array($itemID))){

					$_SESSION['message'] ="Discount Was Added Successfully" ;
					header("Location: ../Forms/discountForm.php");
					exit(0);
				}
				else{ 

					$_SESSION['message'] ="Discount Was NOT Added. Please, Try Again." ;
					header("Location: ../Forms/discountForm.php");
					exit(0);
				}
                         

    }
	
	// ---------Saving Itemsinshoppingcart----------
	if(isset($_POST['Save_itemsinshoppingcart'])){
        $itemID = mysqli_real_escape_string( $conn,$_POST["itemID"]);
        $receiptID = mysqli_real_escape_string( $conn,$_POST["receiptID"]);
		$quantity = mysqli_real_escape_string( $conn,$_POST["quantity"]);
		
		if($itemsInShoppingCartTable -> insert(array($itemID, $receiptID, $quantity ))){

			$_SESSION['message'] ="Item Was Added Successfully to Shopping Cart" ;
			header("Location: ../Forms/discountForm.php");
			exit(0);
		}
		else{ 

			$_SESSION['message'] ="Itemt Was NOT Added to Shopping Cart. Please, Try Again." ;
			header("Location: ../Forms/itemsInShoppingCartForm.php");
			exit(0);
		}
                         

    }
	
	



?>