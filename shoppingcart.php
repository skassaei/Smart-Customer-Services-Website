<!DOCTYPE html>
<?php
session_start();
?>

<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/nav.css">
    <link rel="stylesheet" href="./CSS/map.css">
    <link rel="stylesheet" href="./CSS/table.css">

</head>
<html>
<?php include 'nav.php' ?>

<body>
  <div class="container mr-4 mt-1 mb-4 ml-5">
    <h1 class="text-center" style="font-size: 7vmin;">Shopping Cart</h1>
  </div>
  <?php


  $email = $_SESSION["email"];
  include './DB_Operations/dbconnect.php';

  $Find_userID = "SELECT userID FROM user WHERE email = '$email'";
  $userID_run = mysqli_query($conn, $Find_userID);
  $userID = mysqli_fetch_row($userID_run);

  $Find_rcptID = "SELECT MAX(receiptID) FROM shopping_cart WHERE userID = '$userID[0]'";
  $rcptID_run = mysqli_query($conn, $Find_rcptID);
  $rcptID = mysqli_fetch_row($rcptID_run);

  $Find_items = "SELECT itemID FROM itemsInShoppingCart WHERE receiptID = '$rcptID[0]'";
  $items_run = mysqli_query($conn, $Find_items);



  ?>
  <div class="align-content-center container-fluid">
    <div class="row mb-3 justify-content-evenly">
      <div id="cart_details" class="card col-sm-12 col-md-11 col-lg-8 p-2 bg-darkk shadow-lg rounded overflow-hidden">
        <hr class="rounded mt-1">
        <table class="col-12 ">
          <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
          <?php
          if (empty($_SESSION["shopping_cart"])) {
            echo '</table>
        <hr class="rounded mt-2 mb-2">
        <div class="container mt-5 mb-5">
                    <h3 class="text-center">You have no items in your shopping cart.</br> Please continue shopping!</h3>
                  </div>';
            exit;
          } else {

            while ($itemsID = mysqli_fetch_row($items_run)) {

              $Find_itemN = "SELECT itemName FROM item WHERE itemID = '$itemsID[0]'";
              $itemN_run = mysqli_query($conn, $Find_itemN);
              $itemN = mysqli_fetch_row($itemN_run);


              $Find_price = "SELECT price FROM item WHERE itemID = '$itemsID[0]'";
              $price_run = mysqli_query($conn, $Find_price);
              $price = mysqli_fetch_row($price_run);

              $Find_quantity = "SELECT quantity FROM itemsInShoppingCart WHERE itemID = '$itemsID[0]'";
              $quantity_run = mysqli_query($conn, $Find_quantity);
              $quantity = mysqli_fetch_row($quantity_run);
            }

            foreach ($_SESSION["shopping_cart"] as $keys => $values) {

                $Find_discountItemID = "SELECT itemID FROM discount WHERE itemID='{$values["item_id"]}'";
                $discountItemID_run= mysqli_query($conn, $Find_discountItemID);
                
                  if($discountItemID=mysqli_fetch_row($discountItemID_run)){
                    $thePrice=$price[0]*0.93;
                    echo '  
                               <tr>  
                                    <td>' . $values["item_name"] . '</td>  
                                    <td> x' . $thePrice . ' (%7 Sale)</td>  
                                    <td>' . $values["item_quantity"] . '</td>  
                                    <td>' . $thePrice*0.13 . '</td>  
                                    <td>' . $thePrice*$values["item_quantity"] . '</td>  
                                    <td><a href="#" class="remove_product" id="' . $values["item_id"] . '"><span class="text-danger">Remove</span></a></td>  
                               </tr>  
                          ';
                  } else{
                    $thePrice=$price[0];
                    echo '  
                               <tr>  
                                    <td>' . $values["item_name"] . '</td>  
                                    <td> x' . $thePrice . '</td>  
                                    <td>' . $values["item_quantity"] . '</td>  
                                    <td>' . $thePrice*0.13 . '</td>  
                                    <td>' . $thePrice*$values["item_quantity"] . '</td>  
                                    <td><a href="#" class="remove_product" id="' . $values["item_id"] . '"><span class="text-danger">Remove</span></a></td>  
                               </tr>  
                          ';

                  }
                
              }

              $total = 0;
              foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                $Find_discountItemID = "SELECT itemID FROM discount WHERE itemID='{$values["item_id"]}'";
                $discountItemID_run= mysqli_query($conn, $Find_discountItemID);
                if($discountItemID=mysqli_fetch_row($discountItemID_run)){
                  $thePrice=$values["item_price"]*0.93;
                  $total = $total + (((int)($values["item_quantity"]) * $thePrice));
              } else{ 
                $thePrice=$values["item_price"];
                $total = $total + (((int)($values["item_quantity"]) * $thePrice));
              }
            }
          }
          echo '</table>
            <hr class="rounded mt-1 mb-1">
            <div class="col-11 d-flex justify-content-end justify-content-end " >
            <span id="total_price" align="right" ><b> Total: $'.number_format($total, 2) . '</b></span>


            </div>
            <div class="col-12 d-flex justify-content-end mt-3 justify-content-end ">

            
            <a href="map.php" class="mb-2 mt-3 "><button>Checkout</button></a>
            </div>

            '; 
          ?>

        
      </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).on('click', '.remove_product', function() {
      if (confirm("Are you sure you want to remove this product?")) {
        var id = $(this).attr("id");
        var action = "delete";
        $.ajax({
          url: "remove.php",
          method: "POST",
          data: {
            id: id,
            action: action
          },
          success: function(data) {
            $('#cart_details').html(data);
          }
        });
      } else {
        return false;
      }
    });
</script>

</html>