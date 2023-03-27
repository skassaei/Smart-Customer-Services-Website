<?php
session_start();
if ($_POST["action"] == "delete") {
  foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    if ($values['item_id'] == $_POST["id"]) {
      unset($_SESSION["shopping_cart"][$keys]);
      echo make_cart_table();
    }
  }
}

if (empty($_SESSION["shopping_cart"])) {
  echo '<div class="container mt-5">
          <h3 class="text-center">You have no items in your shopping cart. Please continue shopping!</h3>
        </div>';
  exit;
}

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
                          <td> x' . $values["item_price"] . '</td>  
                          <td><a href="#" class="remove_product" id="' . $values["item_id"] . '"><span class="text-danger">Remove</span></a></td>  
                     </tr>  
                ';
      $total = $total + (int)($values["item_quantity"] * (int)$values["item_price"]);
    }
    $output .= '  
                <tr>  
                     <td colspan="3" align="right">Total</td>  
                     <td>$ <span id="total_price">' . number_format($total, 2) . '</span></td> 
                     <td>
                     <a href="map.php" class="btn btn-primary">Go to Checkout</a>
                     
                     </td>
                </tr> 
                </table>  
                
           ';
  }
  return $output;
}
