<?php

require "./DB_Operations/dbconnect.php";
include './DB_Operations/login.php';


if (isset($_SESSION['loggedin'])) {
	
if(isset($_POST['Save_review'])) 
{ 
    $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
    $userName = mysqli_real_escape_string( $conn,$_POST["userName"]);
    $itemID = mysqli_real_escape_string( $conn,$_POST["itemID"]);
    $userRN = mysqli_real_escape_string( $conn,$_POST["userRN"]);
    $userReview = mysqli_real_escape_string( $conn,$_POST["userReview"]);

    $query = "INSERT INTO review (userName, itemID, userRN,userReview,userID,reviewTime) VALUES ('$userName', '$itemID', '$userRN','$userReview','$userID',CURRENT_TIMESTAMP);";

    $query_run= mysqli_query($conn,$query);
    if($query_run){

        $_SESSION['message'] ="Thank you for your review." ;
        header("Location: ./reviews.php?itemID=$itemID");
        exit(0);


    }
    else{ 
        $_SESSION['message'] ="Can Not submit,Please Try Again." ;
        header("Location: ./reviews.php?itemID=$itemID");
        exit(0);
    }

}


}	
else{
    header("Location: ./login.html");
}
?>


