<?php
    session_start();
    require 'dbConnect.php';
    include './classes.php' ;

if(isset($_POST['update_user'])){
    $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
    $firstName = mysqli_real_escape_string( $conn,$_POST["firstName"]);
    $lastName = mysqli_real_escape_string( $conn,$_POST["lastName"]);
    $email = mysqli_real_escape_string( $conn,$_POST["email"]);
    $phone = mysqli_real_escape_string( $conn,$_POST["phone"]);
    $admin = mysqli_real_escape_string( $conn,$_POST["admin"]);
	$userTable = new User($conn);
	$userTable -> update($userID, array("firstName", "lastName", "email", "phone", "admin"), array($firstName ,$lastName ,$email ,$phone ,$admin));
	
    if($userTable){
        //echo "Updated";
        $_SESSION['message'] ="Recorde Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        echo "NOT Updated";
        // $_SESSION['message'] ="NOT Updated. Please Try Again" ;
        // header("Location: ../Forms/display_tables_for_update.php");
        // exit(0);
    }

}

//// Address
elseif(isset($_POST['update_address'])){

    $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
    $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
    $streetName = mysqli_real_escape_string( $conn,$_POST["streetName"]);
    $city = mysqli_real_escape_string( $conn,$_POST["city"]);
    $province = mysqli_real_escape_string( $conn,$_POST["province"]);

	$addressTable = new Address($conn);
	$addressTable -> update($userID, array("postalCode", "streetName", "city", "province"), array($postalCode ,$streetName ,$city ,$province));
	
    if($addressTable){
        $_SESSION['message'] ="Recorde Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        $_SESSION['message'] ="NOT Updated. Please Try Again" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);
    }

    }


/////store
elseif(isset($_POST['update_store'])){
    $depCode = mysqli_real_escape_string( $conn,$_POST["depCode"]);

    $location = mysqli_real_escape_string( $conn,$_POST["location"]);
    $city = mysqli_real_escape_string( $conn,$_POST["city"]);
    $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);

	$storeTable = new Store($conn);
	$storeTable -> update($depCode, array("location", "city", "postalCode"), array($location ,$city ,$postalCode));
	
    if($storeTable){
        //echo "Updated";
        $_SESSION['message'] ="store Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        echo "NOT Updated";
        // $_SESSION['message'] ="store was NOT Updated. Please Try Again" ;
        // header("Location: ../Forms/display_tables_for_update.php");
        // exit(0);
    }
}
// item
elseif(isset($_POST['update_item'])){
    $itemID = mysqli_real_escape_string( $conn,$_POST["itemID"]);
    $itemName = mysqli_real_escape_string( $conn,$_POST["itemName"]);
    $madeIn = mysqli_real_escape_string( $conn,$_POST["madeIn"]);
    $itemPic = mysqli_real_escape_string( $conn,$_POST["itemPic"]);
    $quantity = mysqli_real_escape_string( $conn,$_POST["quantity"]);
    $price = mysqli_real_escape_string( $conn,$_POST["price"]);
    $depCode = mysqli_real_escape_string( $conn,$_POST["depCode"]);
	$itemTable = new Item($conn);
	$itemTable -> update($itemID, array("itemName", "madeIn", "itemPic", "quantity", "price", "depCode"), array($itemName ,$madeIn ,$itemPic ,$quantity ,$price ,$depCode ));
	
    if($itemTable){
        $_SESSION['message'] ="Recorde Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        echo "NOT Updated";
        // $_SESSION['message'] ="NOT Updated. Please Try Again" ;
        // header("Location: ../Forms/display_tables_for_update.php");
        // exit(0);
    }

    }
//// discount
elseif(isset($_POST['update_discount'])){

    $discountID = mysqli_real_escape_string( $conn,$_POST["discountID"]);
    $itemID = mysqli_real_escape_string( $conn,$_POST["itemID"]);

	$discountTable = new Discount($conn);
	$discountTable -> update($discountID, array("itemID"), array($itemID));
	
    if($discountTable){
        $_SESSION['message'] ="Recorde Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        $_SESSION['message'] ="NOT Updated. Please Try Again" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);
    }

    }



//////truck/////
elseif(isset($_POST['update_truck'])){
    $truckID = mysqli_real_escape_string( $conn,$_POST["truckID"]);
    $driverFirstName = mysqli_real_escape_string( $conn,$_POST["driverFirstName"]);
    $driverLastName = mysqli_real_escape_string( $conn,$_POST["driverLastName"]);
    $PlateNum = mysqli_real_escape_string( $conn,$_POST["PlateNum"]);
    $truckTable = new Truck($conn);
	$truckTable -> update($truckID, array("driverFirstName", "driverLastName", "PlateNum"), array($driverFirstName ,$driverLastName ,$PlateNum));
	  
    if($truckTable){
        //echo "Updated";
        $_SESSION['message'] ="truck Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        echo "NOT Updated";
        // $_SESSION['message'] ="truck was NOT Updated. Please Try Again" ;
        // header("Location: ../Forms/display_tables_for_update.php");
        // exit(0);
    }

  }

  ////truckToGo////

  elseif(isset($_POST['update_truckToGo'])){
    $truckID = mysqli_real_escape_string( $conn,$_POST["truckID"]);

        //if 1 => available, 0 => Not available
        $Monday = isset($_POST["Monday"]) ? $_POST["Monday"] : 0; 
        $Tuesday = isset($_POST["Tuesday"]) ? $_POST["Tuesday"] : 0;
        $Wednesday = isset($_POST["Wednesday"]) ? $_POST["Wednesday"] : 0;
        $Thursday = isset($_POST["Thursday"]) ? $_POST["Thursday"] : 0;
        $Friday = isset($_POST["Friday"]) ? $_POST["Friday"] : 0;
        $Saturday = isset($_POST["Saturday"]) ? $_POST["Saturday"] : 0;
        $Sunday = isset($_POST["Sunday"]) ? $_POST["Sunday"] : 0;



    $truckTable = new Truck($conn);
	$truckTable -> update_truck_schedule($truckID, array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"), array($Monday ,$Tuesday ,$Wednesday ,$Thursday , $Friday, $Saturday ,$Sunday));

    if($truckTable){
        $_SESSION['message'] ="truckToGo Was Successfully Updated" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);

    }
    else{ 
        $_SESSION['message'] ="Truck Schedule was NOT Updated. Please Try Again" ;
        header("Location: ../Forms/display_tables_for_update.php");
        exit(0);
    }

  }
    ?>
        