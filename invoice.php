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
</head>
<html>
    <?php include 'nav.php' ?> 
    <body>
        <div class="container mr-4 mt-1 mb-4 ml-5">
        <h1 style="font-size: 7vmin;">Invoice Summary</h1>
        <h4>Please review the invoice and Confirm the information before payment.</h4>
        </div>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $postalCode = $_POST["branchAdd"]; 
                $_SESSION["branch_PC"]=$_POST["branchAdd"];
            } else{
                $postalCode = $_SESSION["branch_PC"];
            }
            
            
            $email = $_SESSION["email"];
            include './DB_Operations/dbconnect.php';

            $Find_userID = "SELECT userID FROM user WHERE email = '$email'";
            $userID_run= mysqli_query($conn, $Find_userID);
            $userID= mysqli_fetch_row($userID_run);

            $Find_userFname = "SELECT firstName FROM user WHERE email = '$email'";
            $userFname_run= mysqli_query($conn, $Find_userFname);
            $userFname= mysqli_fetch_row($userFname_run);

            $Find_userLname = "SELECT lastName FROM user WHERE email = '$email'";
            $userLname_run= mysqli_query($conn, $Find_userLname);
            $userLname= mysqli_fetch_row($userLname_run);

            $Find_userPC = "SELECT postalCode FROM address WHERE userID = '$userID[0]'";
            $userPC_run= mysqli_query($conn, $Find_userPC);
            $userPC= mysqli_fetch_row($userPC_run);

            $Find_userStreet = "SELECT streetName FROM address WHERE userID = '$userID[0]'";
            $userStreet_run= mysqli_query($conn, $Find_userStreet);
            $userStreet= mysqli_fetch_row($userStreet_run);

            $Find_userCity = "SELECT city FROM address WHERE userID = '$userID[0]'";
            $userCity_run= mysqli_query($conn, $Find_userCity);
            $userCity= mysqli_fetch_row($userCity_run); 
            $i=1;
            $d=strtotime("+".$i." Days");
            $deliveryDate = date("Y-m-d h:i:sa", $d);
            $deliveryDateWeek= date("l", $d+1); //1-7

            $Find_avTruck = "SELECT truckID FROM trucktogo WHERE $deliveryDateWeek = 1";
            $avTruck_run= mysqli_query($conn, $Find_avTruck);
            $avTruck= mysqli_fetch_row($avTruck_run);
            




            while(empty($avTruck)){
              $i+=1;
              $d=strtotime("+".$i." Days");
              $deliveryDate = date("Y-m-d h:i:sa", $d);
              $deliveryDateWeek= date("l", $d); //1-7

              $Find_avTruck = "SELECT truckID FROM trucktogo WHERE $deliveryDateWeek = 1";
              $avTruck_run= mysqli_query($conn, $Find_avTruck);
              $avTruck= mysqli_fetch_row($avTruck_run);
            }

            $Update_Truck = "UPDATE trucktogo SET $deliveryDateWeek = 0 WHERE truckID= '$avTruck[0]'";
            mysqli_query($conn, $Update_Truck);
            $_SESSION['truck_togo']=$avTruck[0];
            $_SESSION['dayToDeliver']=date("l jS \of F Y ",$d);


            $Find_branchStreet = "SELECT location FROM store WHERE postalCode = '$postalCode' ";
            $branchStreet_run= mysqli_query($conn, $Find_branchStreet);
            $branchStreet= mysqli_fetch_row($branchStreet_run);

            $Find_branchCity = "SELECT city FROM store WHERE postalCode = '$postalCode'";
            $branchCity_run= mysqli_query($conn, $Find_branchCity);
            $branchCity= mysqli_fetch_row($branchCity_run);


            $Find_rcptID = "SELECT MAX(receiptID) FROM shopping_cart WHERE userID = '$userID[0]'";
            $rcptID_run= mysqli_query($conn, $Find_rcptID);
            $rcptID= mysqli_fetch_row($rcptID_run);

            $Find_items = "SELECT itemID FROM itemsInShoppingCart WHERE receiptID = '$rcptID[0]'";
            $items_run= mysqli_query($conn, $Find_items);


            
        ?>
        <div class="align-content-center container-fluid">
        <div class="row justify-content-evenly mb-3 mt-3">
            <div class="card col-5 bg-darkk shadow-lg rounded">
            <h2>Branch information</h2>
            <hr class="rounded m-0">
            <div class="card-body">
                <h4 class="card-title branchName"><?php echo $branchCity[0] ?>'s Branch</h4>
                <p class="card-text "><b>Address: </b><?php echo $branchStreet[0].", ".$branchCity[0]; ?></p>
                <p class="card-text "><b>Postal Code: </b><?php echo "$postalCode"; ?></p>

            </div>
            </div>
            <div class="card col-6 col-s-5 bg-darkk shadow-lg rounded">
            <h2>Recipient Delivery Information</h2>
            <hr class="rounded m-0">
            <div class="card-body ">
                <h4 class="card-title CustomerName"><?php echo $userFname[0]." ".$userLname[0]; ?></h4>
                <p class="card-text CustomerAddress"><b>Address: </b><?php echo $userStreet[0].", ".$userCity[0]; ?></p>
                <p class="card-text CustomerPC"><b>Postal Code: </b><?php echo $userPC[0]; ?></p>
                <p class="card-text CustomerDate"><b>Delivery Date: </b><?php echo $_SESSION['dayToDeliver']; ?></p>

            </div>
            </div>
        </div>
        <div class="row mb-3 justify-content-evenly">
            <div class="card col-sm-12 col-md-11 d-none d-md-block d-lg-block col-lg-6 p-2 bg-darkk shadow-lg rounded overflow-hidden">
                <h4 class="card-title"><b>Order ID:</b> #<?php echo $rcptID[0]; ?></h4>
                <hr class="rounded m-0">
                <table class="col-12">
                    <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Tax</th>
                    <th>Total</th>
                    </tr>
                    <?php
                        $total=0.0;
                        $t_tax=0.0;
                        while ($itemsID= mysqli_fetch_row($items_run)){

                            // if($itemID)

                            $Find_itemN = "SELECT itemName FROM item WHERE itemID = '$itemsID[0]'";
                            $itemN_run= mysqli_query($conn, $Find_itemN);
                            $itemN= mysqli_fetch_row($itemN_run);
          
                            
                            $Find_price = "SELECT price FROM item WHERE itemID = '$itemsID[0]'";
                            $price_run= mysqli_query($conn, $Find_price);
                            $price= mysqli_fetch_row($price_run);
                            
                            $Find_quantity = "SELECT quantity FROM itemsInShoppingCart WHERE itemID = '$itemsID[0]'";
                            $quantity_run= mysqli_query($conn, $Find_quantity);
                            $quantity = mysqli_fetch_row($quantity_run);
                        }
                        
                        foreach ($_SESSION["shopping_cart"] as $keys => $values) {

                          echo '  
                                         <tr>  
                                              <td>' . $values["item_name"] . '</td>  
                                              <td> x' . $values["item_price"] . '</td>  
                                              <td>' . $values["item_quantity"] . '</td>  
                                              <td>' . $values["item_price"]*0.13 . '</td>  
                                              <td>' . $values["item_price"]*$values["item_quantity"] . '</td>  
                                              <td><a href="#" class="remove_product" id="' . $values["item_id"] . '"><span class="text-danger">Remove</span></a></td>  
                                         </tr>  
                                    ';
                        }
                        // works!
                        $total = 0;
                        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                          $total = $total + (((int)($values["item_quantity"]) * ((int)$values["item_price"])));
                        }
                        $t_tax=$total*0.13;
                    ?>
                </table>
            </div>
            <div class=" col-lg-5 col-sm-11 col-md-11 p-0 mt-sm-2 mt-md-2">
                <div class=" card col-12 p-3 m-0 align-content-center container-fluid align-self-sm-center bg-darkk shadow-lg  rounded total">
                    <P class="m-0"><b>Total: </b>$<?php echo $total; ?></P>
                    <hr class="rounded m-2">
                    <P class="m-0"><b>Total Tax: </b>$<?php echo $t_tax; ?></P>
                    <hr class="rounded m-2">
                    <p class="m-0"><b>Online Service Charges: </b> $2.50</p>
                    <hr class="rounded m-2">
                    <p class="m-0"><b>Shipping Fees: </b>$7.00</p>
                    <hr class="rounded m-2">
                    <p class="m-0"><b>Shipping Tax: </b>$0.91</p>
                    <hr class="rounded m-2">
                    <?php $_SESSION["totalAmount"] = ($total+$t_tax+7+0.91+2.5); ?>
                    <p class="m-0"><b>Net Total: </b>$<?php echo $_SESSION["totalAmount"]; ?></p>
                </div>
                <?php             
                ?>
                
                <div class="col-12 mt-3 total align-content-center container-fluid " style="position: relative;" >
                    <form action = "./Forms/paymentForm.php" method="post">
                        <input style="background-color:white; color: rgb(33, 17, 55);" value="Confirm" type="submit" class="col-12  bg-darkk shadow-lg rounded total">
                </div>

            </div>
            <p><?php echo $avTruck[0] . " - ".$deliveryDateWeek ?></p>
            
        </div>
    </body>
  

<!-- Same JS code as in home.php the only difference is location.reload(); after the remove action -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function(data) {
    $('.product_drag_area').on('dragover', function() {
      $(this).addClass('product_drag_over');
      return false;
    });
    $('.product_drag_area').on('dragleave', function() {
      $(this).removeClass('product_drag_over');
      return false;
    });
    $('.product_drag').on('dragstart', function(e) {
      e.originalEvent.dataTransfer.setData("id", $(this).data("id"));
      e.originalEvent.dataTransfer.setData("name", $(this).data("name"));
      e.originalEvent.dataTransfer.setData("price", $(this).data("price"));
      e.originalEvent.dataTransfer.setData("quantity", $(this).data("quantity"));
      e.originalEvent.dataTransfer.setData("size", $(this).data("size"));
    });
    $('.product_drag_area').on('drop', function(e) {
      e.preventDefault();
      $(this).removeClass('product_drag_over');
      var id = e.originalEvent.dataTransfer.getData('id');
      var name = e.originalEvent.dataTransfer.getData('name');
      var price = e.originalEvent.dataTransfer.getData('price');
      var quantity = e.originalEvent.dataTransfer.getData('quantity');
      var size = e.originalEvent.dataTransfer.getData('size');
      var action = "add";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          id: id,
          name: name,
          price: price,
          quantity: quantity,
          size: size,
          action: action
        },
        success: function(data) {
          $('#draggable_product_order').html(data);
        }
      })
    });
    $(document).on('click', '.remove_product', function() {
      if (confirm("Are you sure you want to remove this product?")) {
        var id = $(this).attr("id");
        var action = "delete";
        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            id: id,
            action: action
          },
          success: function(data) {
            $('#draggable_product_order').html(data);
          }
        });
        location.reload();
      } else {
        return false;
      }
    });
  });
</script>
</html>
