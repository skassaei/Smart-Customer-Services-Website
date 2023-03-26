<?php
session_start();
require 'DB_Operations/dbConnect.php';

$email = $_SESSION["email"];
$Find_userID = "SELECT userID FROM user WHERE email = '$email'";
$userID_run = mysqli_query($conn, $Find_userID);
$userID = mysqli_fetch_row($userID_run);


$Find_rcptID = "SELECT receiptID FROM shopping_cart WHERE userID = '$userID[0]'";
$rcptID_run= mysqli_query($conn, $Find_rcptID);
$rcptID= mysqli_fetch_row($rcptID_run);


if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
  $total = get_total();
} else {
  $total = 0;
}

/* We check if shopping cart exists */
if ($_POST["action"] == "add") {



  if (isset($_SESSION['shopping_cart'])) {

    /* array_column to get array of all item IDs in shopping cart */
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");

    /* Check if item we want is already in the cart using in_array, if not then we add it to the end of the cart */
    if (!in_array($_POST["id"], $item_array_id)) {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'       => $_POST["id"],
        'item_name'     => $_POST["name"],
        'item_price'    => $_POST["price"],
        'item_quantity' => $_POST["quantity"],
        'size'    => $_POST["size"]
      );

      $_SESSION["shopping_cart"][$count] = $item_array;
    } else {

      /* if item exists in cart, we can find the index using arra_search and increment the quantity of that item */
      $key = array_search($_POST["id"], $item_array_id);
      $_SESSION["shopping_cart"][$key]["item_quantity"]++;
    }

    /* if shopping cart does not exist, we create a new item array with qty 1 and add it to the cart */
  } else {
    $item_array = array(
      'item_id'       => $_POST["id"],
      'item_name'     => $_POST["name"],
      'item_price'    => $_POST["price"],
      'item_quantity' => $_POST["quantity"],
      'size'    => $_POST["size"]
    );
    $_SESSION["shopping_cart"][0] = $item_array;
  }
   #$sql = "INSERT INTO shopping_cart (userID) VALUES ('$userID[0]')";
  #$result = mysqli_query($conn, $sql);



  $sql = "INSERT INTO itemsinshoppingcart (itemID, receiptID, quantity, size) VALUES ('{$_POST["id"]}', $rcptID[0] ,{$_POST["quantity"]}, '{$_POST["size"]}')";
  $result = mysqli_query($conn, $sql); 

  echo make_cart_table();
}

if ($_POST["action"] == "delete") {
  foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    if ($values['item_id'] == $_POST["id"]) {
      unset($_SESSION["shopping_cart"][$keys]);
      echo make_cart_table();
    }
  }
}

/* Creates a table that displays items in a shopping cart.
Checks total price and looks  */
function make_cart_table()
{
  $output = '';
  if (!empty($_SESSION["shopping_cart"])) {
    $total = 0;
    $output .= '  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="20%">Action</th>  
                          </tr>  
           ';
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {

      $output .= '  
                     <tr>  
                          <td>' . $values["item_name"] . '</td>  
                          <td>' . $values["item_quantity"] . '</td>  
                          <td>' . $values["item_price"] . '</td>  
                          <td><a href="#" class="remove_product" id="' . $values["item_id"] . '"><span class="text-danger">Remove</span></a></td>  
                     </tr>  
                ';
      $total = $total + (int)($values["item_quantity"] * (int)$values["item_price"]);
    }
    $output .= '  
                <tr>  
                     <td colspan="3" align="right">Total</td>  
                     <td>$ <span id="total_price">' . number_format($total, 2) . '</span></td>  
                </tr>  
           </table>  
           ';
  }
  return $output;
}

function get_total()
{
  $total = 0;
  foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    $total = $total + (int)($values["item_quantity"] * (int)$values["item_price"]);
  }
  return $total;
}
