
<!DOCTYPE html>
<?php
require 'DB_Operations/dbConnect.php';
include 'DB_Operations/login.php'
?>

<head>
  <title>CPS630 Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./CSS/home2.css?v=<?php echo time(); ?>">
  <script src="https://code.angularjs.org/1.5.0/angular.min.js"></script>
<html>

<body>
  <?php include 'nav.php' ?>
  <div class="container-fluid pb-5 mb-5">

<?php
$rows = [];
$review_rows= [];
$itemID = mysqli_real_escape_string( $conn,$_GET["itemID"]); 

$query = "SELECT * FROM item WHERE itemID = $itemID ";
$review_q = "SELECT * FROM review WHERE itemID = $itemID ";
    $result = mysqli_query($conn, $query);
    $review_result = mysqli_query($conn, $review_q);

    if ($result->num_rows > 0){
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
        
?>

            <div class="container" >

                <div class="item_wraper">
                    <div class="col-6">
                        <picture >
                        <img class="Responsive image" src="<?php echo $row['itemPic']; ?>" />
                        </picture>
                 </div>
                    <div class="col-6">
                        <h5 class="card-title"><?php echo $row['itemName']; ?></h5>
                        <p class="card-text">Color Code: <?php echo $row['madeIn']; ?></p>
                        <p class="card-text">price: $<?php echo number_format($row['price'], 2); ?></p>
                    </div>
                </div>


                <div class="reviews_wraper">

            <?php
            if ($review_result->num_rows > 0){
                $review_rows = $review_result->fetch_all(MYSQLI_ASSOC);
                foreach($review_rows as $review){
?>

                    <div class="review">
                    <p> <?php echo $review['reviewTXT']; ?></p>
                    </div>


                    <?php
                }
            }else{ echo "No Review";}

            ?>
                </div>

            </div>
    </div>

<?php
    }
    }
    else {
    echo "Sth went wrong.Item was NOT found";

    }
?>