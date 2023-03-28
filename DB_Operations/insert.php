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
        $admin = mysqli_real_escape_string( $conn,$_POST["admin"]);
        //---------------ADDRESS INFO---------------------------------
        $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
        $streetName = mysqli_real_escape_string( $conn,$_POST["streetName"]);
        $city = mysqli_real_escape_string( $conn,$_POST["city"]);
        $province = mysqli_real_escape_string( $conn,$_POST["province"]);
        


        ///// makeing sure the email  to be unique////
        $Find_userID = "SELECT userID FROM user WHERE email = '$email'";
        $Find_userID_run= mysqli_query($conn, $Find_userID);

        if(mysqli_num_rows($Find_userID_run) > 0){

            $_SESSION['message'] ="User with this Email already exist. please use another Email." ;
            header("Location: ../Forms/userForm.php");
            exit(0);

        }else{
               
                $query = "INSERT INTO user (firstName ,lastName ,email ,phone,admin) VALUE ('$firstName','$lastName','$email','$phone','$admin')";
                $query_run= mysqli_query($conn,$query);
                
                if($query_run){

                    //Getting the User Id of new user
                    $Find_userID = "SELECT userID FROM user WHERE email = '$email'";

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
}

//---------Saving address------------
if(isset($_POST['Save_address'])){

      $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
      $postalCode = mysqli_real_escape_string( $conn,$_POST["postalCode"]);
      $streetName = mysqli_real_escape_string( $conn,$_POST["streetName"]);
      $city = mysqli_real_escape_string( $conn,$_POST["city"]);
      $province = mysqli_real_escape_string( $conn,$_POST["province"]);
      
      $query = "INSERT INTO address (postalCode ,streetName ,city,province) VALUE ('$postalCode','$streetName','$city','$province') WHERE userID = '$userID' ";
      $query_run= mysqli_query($conn,$query);
      
      
      if($query_run){

            $_SESSION['message'] ="Address Was Added Successfully" ;
            header("Location: ../Forms/chose_Table_for_insert.php");
            exit(0);
            }
            else{
                $_SESSION['message'] ="User ID does not exit OR already has address.Please try with different ID. " ;
                header("Location: ../Forms/addressForm.php");
                exit(0);
            }
    }
      

// ----------------Saving Truck----------
    if(isset($_POST['Save_truck'])){
        $driverFirstName = mysqli_real_escape_string( $conn,$_POST["driverFirstName"]);
        $driverLastName = mysqli_real_escape_string( $conn,$_POST["driverLastName"]);
        $PlateNum = mysqli_real_escape_string( $conn,$_POST["PlateNum"]);
        
        //if 1 => available, 0 => Not available
        $Monday = isset($_POST["Monday"]) ? $_POST["Monday"] : 0; 
        $Tuesday = isset($_POST["Tuesday"]) ? $_POST["Tuesday"] : 0;
        $Wednesday = isset($_POST["Wednesday"]) ? $_POST["Wednesday"] : 0;
        $Thursday = isset($_POST["Thursday"]) ? $_POST["Thursday"] : 0;
        $Friday = isset($_POST["Friday"]) ? $_POST["Friday"] : 0;
        $Saturday = isset($_POST["Saturday"]) ? $_POST["Saturday"] : 0;
        $Sunday = isset($_POST["Sunday"]) ? $_POST["Sunday"] : 0;


            ///// makeing sure the plate number to be unique////
        $Find_truckID = "SELECT truckID FROM truck WHERE PlateNum = '$PlateNum'";
        echo "<br/>the Find_userID is:".$Find_truckID;
        $Find_truckID_run= mysqli_query($conn, $Find_truckID);
        //$result= $Find_truckID_run->fetch_assoc();
        if(mysqli_num_rows($Find_truckID_run) > 0){
            $_SESSION['message'] ="Truck with this plate number already exist. please change the plate number." ;
             header("Location: ../Forms/truckForm.php");
            exit(0);
        }else{

            // Saving the truck 
            $query = "INSERT INTO truck (driverFirstName ,driverLastName ,PlateNum) VALUE ('$driverFirstName','$driverLastName','$PlateNum')";
            $query_run= mysqli_query($conn, $query);
            if($query_run){

                /// Finding the truck ID to add the schedual for it
                $Find_truckID = "SELECT truckID FROM truck WHERE PlateNum = '$PlateNum'";

                $truckID_run= mysqli_query($conn, $Find_truckID);
                $truckID= mysqli_fetch_row($truckID_run);

                //Saving the schedual in truckToGo
                if($truckID[0]){        
                    $sava_truckToGo ="INSERT INTO truckToGo (truckID,Monday ,Tuesday ,Wednesday,Thursday,Friday,Saturday,Sunday ) VALUE ('$truckID[0]','$Monday','$Tuesday','$Wednesday','$Thursday','$Friday','$Saturday','$Sunday')";
                    $sava_truckToGo_run= mysqli_query($conn,$sava_truckToGo);
                    if ($sava_truckToGo_run){        
                        $_SESSION['message'] ="User Was Added Successfully" ;
                        header("Location: ../Forms/truckForm.php");
                        exit(0);
                        }
                        else{
                            $_SESSION['message'] ="We Couldn NOT add The schedual. Please, Add the schedual in truckToGo separately" ;
                            header("Location: ../Forms/truckForm.php");
                            exit(0);
                        }
                } else{
                    $_SESSION['message'] ="Truck Was NOT Found. Please, Add the schedual in truckToGo separately" ;
                    header("Location: ../Forms/truckForm.php");
                    exit(0);
                }
            

        } else{
            $_SESSION['message'] ="Truck Was NOT Added. Please, Try Again." ;
            header("Location: ../Forms/truckForm.php");
            exit(0);
            }


    }
}

// ---------Saving Item----------
    if(isset($_POST['Save_item'])){
        $itemName = mysqli_real_escape_string( $conn,$_POST["itemName"]);
        $madeIn = mysqli_real_escape_string( $conn,$_POST["madeIn"]);
        $itemPic = mysqli_real_escape_string( $conn,$_POST["itemPic"]);
        $price = mysqli_real_escape_string( $conn,$_POST["price"]);
        $depCode = mysqli_real_escape_string( $conn,$_POST["depCode"]);
        $quantity = mysqli_real_escape_string( $conn,$_POST["quantity"]); 

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