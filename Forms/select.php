<?php
require '../DB_Operations/dbconnect.php';
include '../DB_Operations/login.php';

if (isset($_SESSION['loggedin']) and isset($_SESSION['isAdmin'])) {


?>
<!DOCTYPE html>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/contactus.css">
    
    <style>
        .non_show{
            display: none;
        }
    </style>
</head>

<html>

  <body>
  
    <?php
    include './nav_admin.php';
     ?>
        <div class="container col-12">
        <p> Display 

        <form method="POST"   >
            <select name="tableName" id="table" onchange="enableBrand(this)"  aria-label="Default select example">
                <option selected>Select a Table</option>
                <option value="user">Users</option>
                <option value="address">address</option>
                <option value="store">store</option>
                <option value="item">item</option>
                <option value="truck">truck</option>
                <option value="orders">orders</option>
                <option value="truckToGo">truckToGo</option>
                <option value="discount">discount</option>
                <option value="review">review</option>
            </select>

            With

            <select name="user" id="user" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="userID">ID</option>
                <option value="firstName">Name</option>
                <option value="lastName">LastName</option>
                <option value="email">email</option>
                <option value="phone">phone</option>
            </select>
            <select name="address" id="address" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="userID">userID</option>
                <option value="postalCode">postalCode</option>
                <option value="streetName">streetName</option>
                <option value="city">city</option>
                <option value="province">province</option>
            </select>
            <select name="store" id="store" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="depCode">ID</option>
                <option value="location">location</option>
                <option value="city">city</option>
                <option value="postalCode">postalCode</option>
            </select>
            <select name="item" id="item" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="itemID">ID</option>
                <option value="itemName">Name</option>
                <option value="quantity">quantity</option>
                <option value="price">price</option>
                <option value="depCode">Departmetn Code</option>
            </select>
            <select name="truck" id="truck" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="truckID">ID</option>
                <option value="driverFirstName">Name</option>
                <option value="driverLastName">Lastname</option>
                <option value="PlateNum">plateNum</option>
            </select>
            <select name="truckToGo" id="truckToGo" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="truckID">ID</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <select name="review" id="review" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="userID">userID</option>
                <option value="userName">Name</option>
                <option value="itemID">itemID</option>
                <option value="userRN">userRN</option>
                <option value="userReview">userReview</option>
            </select>
            <select name="orders" id="orders" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="orderID">orderID</option>
                <option value="totalPrice">totalPrice</option>
                <option value="paymentmethod">paymentmethod</option>
                <option value="userID">userID</option>
                <option value="receiptID">receiptID</option>
            </select>

            equal to 
                 <input  name="value" type="text" id="inlineFormInput"  required>

            </p>

                <div class="col-9">
                    <button type="submit" name="select_table" class="btn btn-primary">Select</button>
                </div>         
                
    </form>
        </div>
        <div class="container">

            <?php
            
            if(isset($_POST['select_table'])){
                    $tableName =  mysqli_real_escape_string( $conn,$_POST["tableName"]); 
                    $attribute = mysqli_real_escape_string( $conn,$_POST[$tableName]); 
                    $value =  mysqli_real_escape_string( $conn,$_POST["value"]);

                    $query = "SELECT * FROM $tableName WHERE $attribute = '$value' ";


                        $result = mysqli_query($conn, $query);
 // making HTML table
?>
                          
                          <div class='container' > 
                           <div class='table_wrapper'>
                               <table class='table table-hover align-middle'>
                                   <thead>
                                   <tr>

                                    <?php
                           $rows = [];
                           $firstRow=[];
                           if($result){
                               $rows = $result->fetch_all(MYSQLI_ASSOC);
                   
                               if(!empty($rows)){
                                   $firstRow =  $rows[0] ;
                                   foreach($firstRow as $head => $value){
                   
                                           if($head != "password"){
                                                   echo "<th scope='col'>$head</th>";
                                                   }
                                       }
                   
                                   foreach($rows as $row){
                                       echo"<tr>";
                                       foreach($row as $head => $value){
                   
                                           if ($head != "password"){
                                            if($head == "itemPic"){
                                                echo "<td>
                                                <picture>
                                                        <img alt=' $value' style='width: 30%; height: 10%;' src='$value' />
                                                    </picture>
                                                </td>";
                                            }else{
                                                echo "<td>$value</td>";
                                            }
                                           
                                       }
                   
                                   }
                                
                                }
                            }
                        }
                else {
                echo "No Recordes were found  ";
            
                }
            }
            ?>
    </div>


        <script type="text/javascript">
            function enableBrand(answer){
               console.log(answer.value);  
               if(answer.value == "user"){
                document.getElementById('user').classList.remove('non_show');
               }else{
                document.getElementById('user').classList.add('non_show');
               }
               if(answer.value == "address"){
                document.getElementById('address').classList.remove('non_show');
               }else{
                document.getElementById('address').classList.add('non_show');
               }
               if(answer.value == "store"){
                document.getElementById('store').classList.remove('non_show');
               }else{
                document.getElementById('store').classList.add('non_show');
               }
               if(answer.value == "truck"){
                document.getElementById('truck').classList.remove('non_show');
               }else{
                document.getElementById('truck').classList.add('non_show');
               }
               if(answer.value == "truckToGo"){
                document.getElementById('truckToGo').classList.remove('non_show');
               }else{
                document.getElementById('truckToGo').classList.add('non_show');
               }
  
               if(answer.value == "item"){
                document.getElementById('item').classList.remove('non_show');
               }else{
                document.getElementById('item').classList.add('non_show');
               }
      
               if(answer.value == "review"){
                document.getElementById('review').classList.remove('non_show');
               }else{
                document.getElementById('review').classList.add('non_show');
               }
               if(answer.value == "orders"){
                document.getElementById('orders').classList.remove('non_show');
               }else{
                document.getElementById('orders').classList.add('non_show');
               }
            };
           

            </script>
  </body>
</html>

<?php
        }
	else{
		header("Location: ../login.html");
	}
    ?>