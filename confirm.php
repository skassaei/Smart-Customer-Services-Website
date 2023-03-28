<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['loggedin'])) {
	
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
    <style>
        td, th{
            width:100rem;
        }
    </style>
</head>
<html>
    <?php include 'nav.php' ;
    include './DB_Operations/dbconnect.php';
    ?> 
    <body>
    <?php
            $_SESSION["ID"];
            $_SESSION["first_name"];
            $_SESSION["last_name"];
            $_SESSION["totalAmount"];
            $orderDate = date("Y-m-d");
            $method = "Debit/Credit";

            // $Find_truck = "SELECT truckID FROM truck WHERE availabilityCode > 0";
            // $truck_run= mysqli_query($conn, $Find_truck);
            // $truck= mysqli_fetch_row($truck_run);

            $Find_userPC = "SELECT postalCode FROM address WHERE userID = '{$_SESSION["ID"]}'";
            $userPC_run= mysqli_query($conn, $Find_userPC);
            $userPC= mysqli_fetch_row($userPC_run);

            $Find_userStreet = "SELECT streetName FROM address WHERE userID = '{$_SESSION["ID"]}'";
            $userStreet_run= mysqli_query($conn, $Find_userStreet);
            $userStreet= mysqli_fetch_row($userStreet_run);

            $Find_userCity = "SELECT city FROM address WHERE userID = '{$_SESSION["ID"]}'";
            $userCity_run= mysqli_query($conn, $Find_userCity);
            $userCity= mysqli_fetch_row($userCity_run); 

            $Find_branchStreet = "SELECT location FROM store WHERE postalCode = '{$_SESSION["branch_PC"]}'";
            $branchStreet_run= mysqli_query($conn, $Find_branchStreet);
            $branchStreet= mysqli_fetch_row($branchStreet_run);

            $Find_branchCity = "SELECT city FROM store WHERE postalCode = '{$_SESSION["branch_PC"]}'";
            $branchCity_run= mysqli_query($conn, $Find_branchCity);
            $branchCity= mysqli_fetch_row($branchCity_run);


            $Find_rcptID = "SELECT MAX(receiptID) FROM shopping_cart WHERE userID = '{$_SESSION["ID"]}'";
            $rcptID_run= mysqli_query($conn, $Find_rcptID);
            $currentRcptID= mysqli_fetch_row($rcptID_run);

            $Find_items = "SELECT itemID FROM itemsInShoppingCart WHERE receiptID = '$currentRcptID[0]'";
            $items_run= mysqli_query($conn, $Find_items);
            if(isset($_SESSION['shopping_cart'])){
                
                $insert_query = "INSERT INTO shopping_cart (userID) VALUES ('{$_SESSION["ID"]}')";
                mysqli_query($conn, $insert_query);
    
                $add_order = "INSERT INTO orders (dateIssued, totalPrice, paymentmethod, userID, receiptID)  VALUES ('$orderDate', '{$_SESSION["totalAmount"]}', '$method', '{$_SESSION["ID"]}', '$currentRcptID[0]' )";
                $add_order_run= mysqli_query($conn, $add_order);

                $Find_orderID = "SELECT orderID FROM orders WHERE receiptID = '$currentRcptID[0]' AND userID='{$_SESSION["ID"]}'";
                $orderID_run= mysqli_query($conn, $Find_orderID);
                $orderID= mysqli_fetch_row($orderID_run);
                $_SESSION['orderNum'] = $orderID[0];

                $Update_Truck = "UPDATE trucktogo SET {$_SESSION['deliveryDateWeek']} = ({$_SESSION['dec']}-1) WHERE truckID= '{$_SESSION["truck_togo"]}'";
                mysqli_query($conn, $Update_Truck);

                $add_order = "INSERT INTO trip (truckID, orderID)  VALUES ('{$_SESSION["truck_togo"]}','$orderID[0]')";
                $add_order_run= mysqli_query($conn, $add_order);

            }



            
            
        ?>
        <div class="container mr-4 mt-1 mb-4 ml-5 text-center">
        <h1 class="text-center" style="font-size: 7vmin;">Order Confirmed!</h1>

        <h4 class="text-center mb-3">Receipt Number #<?php echo $currentRcptID[0];?></h4>
        <a href="home.php" class="mt-2 mb-0"><button class="mt-2 mb-0">Go Back to Main Page</button></a>
        </div>

        
        <div class="align-content-center container-fluid col-11">
        <div class="row text-center justify-content-evenly mb-3 mt-3">
            
            <div class="card col-10 col-sm-12 bg-darkk shadow-lg rounded">
            <h4 class="p-2">Your Receipt</h4>
            <hr class="rounded m-0 p-0">

                <div class="card-body">
                <h2>Branch information</h2>
                <hr class="rounded m-0">
                <h4 class="card-title branchName"><?php echo $branchCity[0] ?>'s Branch</h4>
                <p class="card-text "><b>Address: </b><?php echo $branchStreet[0].", ".$branchCity[0]; ?></p>
                <p class="card-text "><b>Postal Code: </b><?php echo $_SESSION["branch_PC"]; ?></p>
                <p class="card-text "><b>Truck ID: </b><?php echo '#'.$_SESSION['truck_togo']; ?></p>
                <hr class="rounded m-0 mt-3">
                <h2>Recipient Delivery Information</h2>
                <hr class="rounded m-0">
                
                <h4 class="card-title CustomerName"><?php echo $_SESSION["first_name"]." ".$_SESSION["last_name"]; ?></h4>
                <p class="card-text CustomerAddress"><b>Address: </b><?php echo $userStreet[0].", ".$userCity[0]; ?></p>
                <p class="card-text CustomerPC"><b>Postal Code: </b><?php echo $_SESSION["branch_PC"]; ?></p>
                <p class="card-text CustomerDate"><b>Delivery Date: </b><?php echo $_SESSION['dayToDeliver']; ?></p>
                <p class="card-text CustomerDate"><b>Order Confirmation Date: </b><?php echo $orderDate; ?></p>

                <hr class="rounded m-0 mt-3">

                <h4 class="card-title"><b>Order ID:</b> #<?php echo $_SESSION['orderNum'];?></h4>
                <hr class="rounded m-0">
                <table class="col-12 d-none d-md-block d-lg-block ">
                    <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Tax</th>
                    <th>Total</th>
                    </tr>
                    <?php
  
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
                        if (isset($_SESSION['shopping_cart'])){
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
                        }
                        
                    ?>
                                    

                </table>
                <hr class="rounded m-0 mt-3 d-none d-md-block d-lg-block">
                <?php   
                $total = 0;
                $t_tax=0;
                if (isset($_SESSION['shopping_cart'])){
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
                    $t_tax=$total*0.13;

                }  
                } 
                $_SESSION["totalAmount"] = ($total+$t_tax+7+0.91+2.5);
                   echo '                
                <P class="m-1">Total: $'. $total.'</P>

                <P class="m-1">Total Tax: $'.$t_tax.'</P>

                <p class="m-1">Online Service Charges:  $2.50</p>

                <p class="m-1">Shipping Fees: $7.00</p>

                <p class="m-1">Shipping Tax: $0.91</p>

                <p class="m-2"><b>Net Total: $'.$_SESSION["totalAmount"].'</b></p>';
                unset($_SESSION['shopping_cart']);


            ?>
                </div>
            </div>

            <?php

}	
else{
    header("Location: ./login.html");
}
?>
            
</html>
