<?php
    session_start();
    require 'dbConnect.php';

if(isset($_POST['update_user'])){
    $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
    $firstName = mysqli_real_escape_string( $conn,$_POST["firstName"]);
    $lastName = mysqli_real_escape_string( $conn,$_POST["lastName"]);
    $email = mysqli_real_escape_string( $conn,$_POST["email"]);
    $phone = mysqli_real_escape_string( $conn,$_POST["phone"]);
    $admin = mysqli_real_escape_string( $conn,$_POST["admin"]);
    $query = "UPDATE user SET firstName = '$firstName', lastName = '$lastName', email='$email' , phone='$phone', admin='$admin'   WHERE userID= $userID ";
    $query_run= mysqli_query($conn,$query);
    if($query_run){
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

// Address
elseif(isset($_POST['update_address'])){

    $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
    $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
    $streetName = mysqli_real_escape_string( $conn,$_POST["streetName"]);
    $city = mysqli_real_escape_string( $conn,$_POST["city"]);
    $province = mysqli_real_escape_string( $conn,$_POST["province"]);

    $query = "UPDATE address SET postalCode = '$postalCode', streetName = '$streetName', city='$city' , province='$province'   WHERE userID= $userID ";
    $query_run= mysqli_query($conn,$query);
    if($query_run){
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
//store
elseif(isset($_POST['update_store'])){
    $depCode = mysqli_real_escape_string( $conn,$_POST["depCode"]);
    $location = mysqli_real_escape_string( $conn,$_POST["location"]);
    $city = mysqli_real_escape_string( $conn,$_POST["city"]);
    $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
   
    $query = "UPDATE store SET location = '$location', city = '$city',postalCode='$postalCode' WHERE depCode= $depCode ";
    $query_run= mysqli_query($conn,$query);
    if($query_run){
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

    $query = "UPDATE item SET itemName = '$itemName', itemPic = '$itemPic',madeIn='$madeIn', quantity='$quantity' , price='$price', depCode='$depCode'   WHERE itemID= $itemID ";
    $query_run= mysqli_query($conn,$query);
    if($query_run){
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


///////truck
elseif(isset($_POST['update_truck'])){
    $truckID = mysqli_real_escape_string( $conn,$_POST["truckID"]);
    $driverFirstName = mysqli_real_escape_string( $conn,$_POST["driverFirstName"]);
    $driverLastName = mysqli_real_escape_string( $conn,$_POST["driverLastName"]);
    $PlateNum = mysqli_real_escape_string( $conn,$_POST["PlateNum"]);
    $availabilityCode = mysqli_real_escape_string( $conn,$_POST["availabilityCode"]);
   
    $query = "UPDATE truck SET driverFirstName = '$driverFirstName', driverLastName = '$driverLastName',PlateNum='$PlateNum', availabilityCode='$availabilityCode' WHERE truckID= $truckID ";
    $query_run= mysqli_query($conn,$query);
    if($query_run){
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

    ?>
        