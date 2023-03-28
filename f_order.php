<?php

require "./DB_Operations/dbconnect.php";
include './DB_Operations/login.php';


if (isset($_SESSION['loggedin'])) {
	
if(isset($_POST['Find_Order'])) 
{ 
    $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
    $orderID = mysqli_real_escape_string( $conn,$_POST["orderID"]);


    $query = "INSERT INTO review (userName, itemID, userRN,userReview,userID,reviewTime) VALUES ('$userName', '$itemID', '$userRN','$userReview','$userID',CURRENT_TIMESTAMP);";

    $query_run= mysqli_query($conn,$query);
    if($query_run){

        $_SESSION['message'] ="The New Store Was Added Successfully" ;
        header("Location: ./reviews.php?itemID=$itemID");
        exit(0);


    }
    else{ 
        $_SESSION['message'] ="Store Was NOT Added Please Try Again" ;
        header("Location: ./reviews.php?itemID=$itemID");
        exit(0);
    }

}


}	
else{
    header("Location: ./login.html");
}
?>


