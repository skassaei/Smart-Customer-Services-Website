<?php
    session_start();
    require 'dbConnect.php';


// ---------Saving Store----------
    if(isset($_POST['Save_store'])){

        $location = mysqli_real_escape_string( $conn,$_POST["location"]);
        $city = mysqli_real_escape_string( $conn,$_POST["city"]);
        $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
        echo "location, city, postalCode:" .$location.$postalCode;
        $query = "INSERT INTO store (location, city, postalCode) VALUES ('$location', '$city', '$postalCode');";

        $query_run= mysqli_query($conn,$query);
        if($query_run){

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
        
        //---------------ADDRESS INFO---------------------------------
        $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
        $streetName = mysqli_real_escape_string( $conn,$_POST["streetName"]);
        $city = mysqli_real_escape_string( $conn,$_POST["city"]);
        $province = mysqli_real_escape_string( $conn,$_POST["province"]);
        
        $query = "INSERT INTO user (firstName ,lastName ,email ,phone) VALUE ('$firstName','$lastName','$email','$phone')";
        $query_run= mysqli_query($conn,$query);
        
        if($query_run){
            echo "Was added to USER";
            //Getting the User Id of new user
            $Find_userID = "SELECT userID FROM user WHERE email = '$email'";
            echo "<br/>the Find_userID is:".$Find_userID;
            $userID_run= mysqli_query($conn, $Find_userID);
            $userID= mysqli_fetch_row($userID_run);
            //Saving the address info in address Table
            if($userID[0]){        
                $sava_address = "INSERT INTO address (userID ,postalCode ,streetName ,city ,province) VALUE ('$userID[0]','$postalCode','$streetName','$city','$province')";
                $sava_address_run= mysqli_query($conn,$sava_address);
                if ($sava_address_run){        
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
        $availabilityCode = isset($_POST["availabilityCode"]) ? $_POST["availabilityCode"] : false; //if 1 => available, 0 => Not available

        $query = "INSERT INTO truck (driverFirstName ,driverLastName ,PlateNum,availabilityCode) VALUE ('$driverFirstName','$driverLastName','$PlateNum','$availabilityCode')";
        $query_run= mysqli_query($conn, $query);
       
        if($query_run){

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

            $Find_depCode = "SELECT depCode FROM store WHERE depCode = '$depCode'";
            $depCode_run= mysqli_query($conn, $Find_depCode);
                if($depCode_run->num_rows>0){
                    $query = "INSERT INTO item (itemName ,madeIn,itemPic,quantity,price,depCode) VALUE ('$itemName','$madeIn','$itemPic','$quantity','$price','$depCode')";
                    $query_run= mysqli_query($conn, $query);
                    if($query_run){

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



?>
