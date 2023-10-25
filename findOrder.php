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
include 'navHome.php';




$userID = $_SESSION["ID"];
$rows = [];
$order_rows= [];
$orderTable = new Orders($conn);
$order_rows = $orderTable -> getUserOrders($userID);

       
?>
    <div class="container mr-4 mt-1 mb-4 ml-5 mt-5">
        <div class="row mb-3 justify-content-evenly">
            
            <div class="card col-6 p-4 bg-darkk shadow-lg rounded">
            <h3>Write a review</h3> 
            <form name="reviewForm"  class="row g-3" action="findOrder.php"  method= POST>
                
                <div class="form-group col-12">
                        <div class="form-group col-12 ">
                            <label for="inlineFormInput">Choose your orderID:</label>
                            <select class=" p-1" id="inlineFormInput2" type="number" name="orderID" required>
                                 <option value=0 disabled selected >Order#</option>
                                 <?php

                                if(count($order_rows) > 0){
                                    foreach($order_rows as $row){
                                        echo "<option value='".$row['orderID']."'>".$order['orderID']."</option>";
                                    }
                                     ?>
                                        </select>
                                    </div>
    
                                    <div class="mt-2">
                                        <button style="background-color:white; color: rgb(33, 17, 55);" type="submit" value="Display Order" name="Find_Order"  class="col-12  bg-darkk shadow-lg rounded total">Display Order</button> 
                                    </div>

                                <?php    
                                    } else{
                                    echo'<div class="mt-2">
                                   <p> You have not tried our cakes yet!</p>
                                    </div>';
                                    }
                                    ?>

                            <div hidden class="form-group col-12">
                                <input  value="<?php echo $userID ?>" name="userID" type="text" class="form-control mb-2" id="inlineFormInput" required disabled hidden>
                            </div>
                        
<br>

                    <div>
                        <button type="button" style="background-color:white; color: rgb(33, 17, 55);" class="col-12  bg-darkk shadow-lg rounded total"    >
                        <a style="text-decoration: none; color: rgb(33, 17, 55);" href="./home.php">Back</a>
                        </button>   
                    </div>
                    

                        
            </form>
            <?php include('./Forms/message.php')?>
            </div>

        </div>
        <?php
        if(isset($_POST['Find_Order'])) 
        { 
            $userID = mysqli_real_escape_string( $conn,$_POST["userID"]);
            $orderID = mysqli_real_escape_string( $conn,$_POST["orderID"]);

            $_SESSION["first_name"];
            $_SESSION["last_name"];
            $_SESSION["totalAmount"];
            $orderDate = date("Y-m-d");
            $method = "Debit/Credit";


            $Find_userPC = "SELECT postalCode FROM address WHERE userID = '{$_SESSION["ID"]}'";
            $userPC_run= mysqli_query($conn, $Find_userPC);
            $userPC= mysqli_fetch_row($userPC_run);

            $Find_userStreet = "SELECT streetName FROM address WHERE userID = '{$_SESSION["ID"]}'";
            $userStreet_run= mysqli_query($conn, $Find_userStreet);
            $userStreet= mysqli_fetch_row($userStreet_run);

            $Find_userCity = "SELECT city FROM address WHERE userID = '{$_SESSION["ID"]}'";
            $userCity_run= mysqli_query($conn, $Find_userCity);
            $userCity= mysqli_fetch_row($userCity_run); 

            // $Find_branchStreet = "SELECT location FROM store WHERE postalCode = '{$_SESSION["branch_PC"]}'";
            // $branchStreet_run= mysqli_query($conn, $Find_branchStreet);
            // $branchStreet= mysqli_fetch_row($branchStreet_run);

            // $Find_branchCity = "SELECT city FROM store WHERE postalCode = '{$_SESSION["branch_PC"]}'";
            // $branchCity_run= mysqli_query($conn, $Find_branchCity);
            // $branchCity= mysqli_fetch_row($branchCity_run);


            $Find_rcptID = "SELECT receiptID FROM orders WHERE orderID = $orderID";
            $rcptID_run= mysqli_query($conn, $Find_rcptID);
            $RcptID= mysqli_fetch_row($rcptID_run);
            
            ?>
            <div class="card-body">
                <!-- <h2>Branch information</h2>
                <hr class="rounded m-0">
                <h4 class="card-title branchName"><?php //echo $branchCity[0] ?>'s Branch</h4>
                <p class="card-text "><b>Address: </b><?php // echo $branchStreet[0].", ".$branchCity[0]; ?></p>
                <p class="card-text "><b>Postal Code: </b><?php  // echo $_SESSION["branch_PC"]; ?></p>
                <p class="card-text "><b>Truck ID: </b><?php // echo '#'.$_SESSION['truck_togo']; ?></p>
                <hr class="rounded m-0 mt-3"> -->
                <h2>Recipient Delivery Information</h2>
                <hr class="rounded m-0">
                
                <h4 class="card-title CustomerName"><?php echo $_SESSION["first_name"]." ".$_SESSION["last_name"]; ?></h4>
                <p class="card-text CustomerAddress"><b>Address: </b><?php echo $userStreet[0].", ".$userCity[0]; ?></p>
                <p class="card-text CustomerPC"><b>Postal Code: </b><?php echo $_SESSION["branch_PC"]; ?></p>
                <p class="card-text CustomerDate"><b>Delivery Date: </b><?php echo $_SESSION['dayToDeliver']; ?></p>
                <p class="card-text CustomerDate"><b>Order Confirmation Date: </b><?php echo $orderDate; ?></p>

                <hr class="rounded m-0 mt-3">

                <h4 class="card-title"><b>Order ID:</b> #<?php echo $orderID[0]; ?></h4>
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
  
                            
                            $Find_itemID = "SELECT itemID FROM itemsInShoppingCart WHERE receiptID = $RcptID[0]";
                            $itemID_run= mysqli_query($conn, $Find_itemID);
                            
                            
          
                            $total=0.0;
                            while ($itemID = mysqli_fetch_row($itemID_run)) {

                                
                            $Find_quantity = "SELECT quantity FROM itemsInShoppingCart WHERE receiptID = $RcptID[0] and itemID=$itemID[0]";
                            $quantity_run= mysqli_query($conn, $Find_quantity);
                            $quantity = mysqli_fetch_row($quantity_run);

                                $Find_price = "SELECT price FROM item WHERE itemID = '$itemID[0]'";
                                $price_run= mysqli_query($conn, $Find_price);
                                $price= mysqli_fetch_row($price_run);
                                $Find_itemN = "SELECT itemName FROM item WHERE itemID = '$itemID[0]'";
                                $itemN_run= mysqli_query($conn, $Find_itemN);
                                $itemN= mysqli_fetch_row($itemN_run);
                                $Find_discountItemID = "SELECT itemID FROM discount WHERE itemID='$itemID[0]'";
                                $discountItemID_run= mysqli_query($conn, $Find_discountItemID);
                                
                                  if($discountItemID=mysqli_fetch_row($discountItemID_run)){
                                    $thePrice=$price[0]*0.93;
                                    $total+=$thePrice;
                                    echo '  
                                               <tr>  
                                               <td>' . $itemN[0] . '</td>  
                                                    <td> x' . $thePrice . ' (%7 Sale)</td>  
                                                    <td>' . $quantity[0] . '</td>  
                                                    <td>' . $thePrice*0.13 . '</td>  
                                                    <td>' . $thePrice*$quantity[0]  . '</td>  
                                                                                                   </tr>  
                                          ';
                                  } else{
                                    $thePrice=$price[0];
                                    $total+=$thePrice;
                                    echo '  
                                               <tr>  
                                                    <td>' . $itemN[0] . '</td>  
                                                    <td> x' . $thePrice . '</td>  
                                                    <td>' . $quantity[0]  . '</td>  
                                                    <td>' . $thePrice*0.13 . '</td>  
                                                    <td>' . $thePrice*$quantity[0] . '</td>  
                                                                                                   </tr>  
                                          ';
                
                                  
                                
                              }
                        }   
                        
                    ?>
                                    

                </table>
                <hr class="rounded m-0 mt-3 d-none d-md-block d-lg-block">
                <?php   

                    $t_tax=$total*0.13;

                $_SESSION["totalAmount"] = ($total+$t_tax+7+0.91+2.5);
                   echo '                
                <P class="m-1">Total: $'. $total.'</P>

                <P class="m-1">Total Tax: $'.$t_tax.'</P>

                <p class="m-1">Online Service Charges:  $2.50</p>

                <p class="m-1">Shipping Fees: $7.00</p>

                <p class="m-1">Shipping Tax: $0.91</p>

                <p class="m-2"><b>Net Total: $'.$_SESSION["totalAmount"].'</b></p>';
                unset($_SESSION['shopping_cart']);
                        }
                        


            ?>
                </div>
            </div>
</body>
<?php

                }	
	else{
		header("Location: ./login.html");
	}
    ?>
</html>
