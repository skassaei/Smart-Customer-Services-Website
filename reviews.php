<!DOCTYPE html>
<?php
session_start();
require './DB_Operations/dbconnect.php';
include './DB_Operations/classes.php' ;

if (isset($_SESSION['loggedin'])) {
	
?>

<head>
  <title>CPS630 Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../CSS/contactus.css">

  
    <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./CSS/home2.css?v=<?php echo time(); ?>">
</head>

<html>

<body>


<?php
include 'nav.php';




$userID = $_SESSION["ID"];

$rows = [];
$review_rows= [];
$itemID = mysqli_real_escape_string( $conn , $_GET["itemID"]); 

    $ReviewTable = new Review($conn);
    $ItemTable = new Item($conn);
    $item_rows = $ItemTable -> getItemById($itemID);
// $query = "SELECT * FROM item WHERE itemID = $itemID ";
//     $result = mysqli_query($conn, $query);
//  $review_q = "SELECT * FROM review WHERE itemID = $itemID ";   
//     $review_result = mysqli_query($conn, $review_q);
 
    if (count($item_rows) >0){
        foreach($item_rows as $row){
         
?>
    <div class="container mr-4 mt-1 mb-4 ml-5 mt-5">
        <div class="row mb-3 justify-content-evenly">
            <div class="card col-4 p-4 bg-darkk shadow-lg rounded">
                <img class="card-img-top m-3 align-self-center border border-white Responsive image" style=" width:40%;" src="<?php echo $row['itemPic']; ?>">
                <h4 class="card-title text-center"><?php echo $row['itemName']; ?></h4>
                <div class="card-body text-center pt-0">
                <p class="card-text p-0 m-0">Color Code: <?php echo $row['madeIn']; ?></p>
                <p class="card-text p-0 m-0">price: $<?php echo number_format($row['price'], 2); ?></p>
                </div>
            </div>
            <div class="card col-6 p-4 bg-darkk shadow-lg rounded">
                <h3>Write a review</h3> 
                <div class="card-body">
                <form name="reviewForm"  class="row g-3" action="./submitRating.php"  method= POST>
                    
                    <div class="form-group col-12">
                            <div class="form-group col-12 ">
                                <label for="inlineFormInput">Your Name:</label>
                                <input name="userName" type="text" class="form-control mb-2" id="inlineFormInput" required>
                            </div>
                                <select class=" p-1" id="inlineFormInput2" type="number" name="userRN" required>
                                    <option value=0 disabled selected >Rating</option>
                                    <option value=1>1 Stars</option>
                                    <option value=2>2 Stars</option>
                                    <option value=3>3 Stars</option>
                                    <option value=4>4 Stars</option>
                                    <option value=5>5 Stars</option>
                                </select>

                                <div hidden class="form-group col-12">
                                        <label  for="inlineFormInput">userID:</label>
                                        <input value="<?php echo $userID ?>" name="userID" type="text" class="form-control mb-2" id="inlineFormInput" required>
                                    </div>
                                <div hidden class="form-group col-6">
                                    <label  for="inlineFormInput">itemID:</label>
                                    <input value="<?php echo $itemID ?>" name="itemID" type="text" class="form-control mb-2" id="inlineFormInput" required>
                                </div>
                            <div class="form-group col-12">
                                <label  for="inlineFormInput">Review:</label>
                                <textarea name="userReview"  class="form-control mb-2" id="inlineFormInput" required></textarea>
                            </div>

                        <div>
                            <input style="background-color:white; color: rgb(33, 17, 55);" type="submit" class="col-12  bg-darkk shadow-lg rounded total" name="Save_review">
                           
                            <a style="text-decoration:none; color: rgb(33, 17, 55); background-color:white; " class=" btn col-12 bg-darkk shadow-lg rounded total " href="./home.php" > Back </a>  
                           
                        </div>
                        
                        
                            <!-- <button style="background-color:white; color: rgb(33, 17, 55);" class="col-12  bg-darkk shadow-lg rounded total" >
                            </button>  
                        <a style="text-decoration: none; background-color:white; color: rgb(33, 17, 55);" class="btn col-12 " href="./home.php" > Back </a>    -->

                            
                </form>
            </div>


            </div>
            
        </div>

        </div>
        
        <hr class="rounded mt-3" style="color:rgb(33, 17, 55); border-width:3">
        <h2>Reviews</h2>
        <div class="d-flex flex-wrap ">
        <?php

        // if ($review_result->num_rows > 0){
        //     $review_rows = $review_result->fetch_all(MYSQLI_ASSOC);

        $review_rows = $ReviewTable -> diplayItemReview($itemID);
        if (count($review_rows) > 0){
            foreach($review_rows as $review){
?>
                    <div class="card m-3" style="border:1px solid indigo; background-color:#fdf4fc; border-radius:5px;  width:110em; cursor:move" >
                        <h4 class="card-title p-2 pt-2 pb-2 mb-0 bg-darkk shadow-lg" >userName: <b> <?php echo htmlspecialchars( $review['userName'] ); ?></b></h4>
                        <p class="card-text p-2 pb-0 pt-0 m-0"><?php echo htmlspecialchars( $review['userRN'] ); ?>/5 Stars</p>
                        
                        <div class="card p-3 rounded">
                            <p class="card-text p-0 m-0"><?php echo htmlspecialchars( $review['userReview'] ); ?></p>
                        </div>
                        <p class="card-text p-0 m-0" align="right"><?php echo  $review['reviewTime']; ?></p>
                    </div>

                    <?php
                }
            }else{ echo "<p>No Review yet, Be the first one. </p>";}
?>


            
            </div>
        </div>
        



    





<?php
    }
    }
    else {
    echo "Sth went wrong.Item was NOT found";

    }
?>

</body>
<?php

	}	
	else{
		header("Location: ./login.html");
	}
    ?>
</html>
