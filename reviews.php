<!DOCTYPE html>
<?php
session_start();
require './DB_Operations/dbconnect.php';
?>

<head>
  <title>CPS630 Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
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

$query = "SELECT * FROM item WHERE itemID = $itemID ";
    $result = mysqli_query($conn, $query);


 $review_q = "SELECT * FROM review WHERE itemID = $itemID ";   
    $review_result = mysqli_query($conn, $review_q);
 
    if ($result->num_rows > 0){
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
        
?>
  <div class="container-fluid pb-5 mt-5">
            <div class="container" >
            
                <div class="item_wraper">
                    <div class="col-6">
                        <picture >
                        <img class="Responsive image" style="hight:20%; width:20%;" src="<?php echo $row['itemPic']; ?>" />
                        </picture>
                 </div>
                    <div class="col-6">
                        <h5rating class="card-title"><?php echo $row['itemName']; ?></h5>
                        <p class="card-text">Color Code: <?php echo $row['madeIn']; ?></p>
                        <p class="card-text">price: $<?php echo number_format($row['price'], 2); ?></p>
                    </div>
                </div>




                <div class="reviews_wraper">
                    <h5>Reviews:</h5>

            <?php

            if ($review_result->num_rows > 0){
                $review_rows = $review_result->fetch_all(MYSQLI_ASSOC);
                foreach($review_rows as $review){
?>
<!-- Displaying the Reviews for this item: -->
                    <div class="review">
                    <p> userRN: <?php echo $review['userRN']; ?></p>
                    <p> userName: <?php echo $review['userName']; ?></p>
                    <p> userReview:<?php echo $review['userReview']; ?></p>
                    <p>reviewTime: <?php echo $review['reviewTime']; ?></p>
                    </div>


                    <?php
                }
            }else{ echo "<p>No Review yet, Be the first one. </p>";}

            ?>
                </div>


            </div>
            <div class="container reviewForm">
            <?php include('./Forms/message.php')?>
            <form name="reviewForm"  class="row g-3" action="./submitRating.php"  method= POST>
                
        <div class="form-group col-12">
                <div class="form-group col-2">
                    <label for="inlineFormInput">user Name:</label>
                    <input name="userName" type="text" class="form-control mb-2" id="inlineFormInput" required>
                </div>
                <div class="form-group col-1">
                    <label for="inlineFormInput2">Rating</label>
                    <div class="col-sm-10">
                        <p><input name="userRN" type="number" class="form-control"  id="inlineFormInput2" min="01" max="5" required>/5</p>
                    </div>
                </div>
        </div>

                <div hidden class="form-group col-6">
                    <label  for="inlineFormInput">userID:</label>
                    <input value="<?php echo $userID ?>" name="userID" type="text" class="form-control mb-2" id="inlineFormInput" required>
                </div>
                <div hidden class="form-group col-6">
                    <label  for="inlineFormInput">itemID:</label>
                    <input value="<?php echo $itemID ?>" name="itemID" type="text" class="form-control mb-2" id="inlineFormInput" required>
                </div>
                <div class="form-group col-6">
                    <label  for="inlineFormInput">Review:</label>
                    <textarea name="userReview" type="textbox" class="form-control mb-2" id="inlineFormInput" required>
                        
                </textarea>
                </div>

            <div class="form-group col-12">
                <div class="col-3">
                    <a class="btn btn-secondary" href="./home.php">Back</a>
                </div>
                <div class="col-9">
                    <button type="submit" name="Save_review" class="btn btn-primary">Submit</button>
                </div>
        </div>
                
            </form>
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
</html>
