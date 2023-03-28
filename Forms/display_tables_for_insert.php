<?php
require '../DB_Operations/dbConnect.php';
include '../DB_Operations/login.php';

if (isset($_SESSION['loggedin'])) {
	
?>
<!DOCTYPE html>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/contactus.css">

</head>

<html>

  <body>
  
    <?php
    include './nav_admin.php';

     ?> 

 <!-----1) Truck----->
  <div class="container" >
        <h3>Trucks</h3>
        <div class="table_wrapper">
            <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">Truck ID</th>
                    <th scope="col">Driver's Name</th>
                    <th scope="col">Driver's Last Name</th>
                    <th scope="col">Plate Number</th>
                    <th scope="col">
                    <a class="btn btn-secondary" href="truckForm.php">Insert</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    $sql= "SELECT * FROM truck";
                    $result = ($conn->query($sql));
                    //declare array to store the data of database
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                     ?>


                        <tr>
            
                            <td><?php echo $row['truckID']; ?></td>
                            <td><?php echo $row['driverFirstName']; ?></td>
                            <td><?php echo $row['driverLastName']; ?></td>
                            <td><?php echo $row['PlateNum']; ?></td>
                            <td></td>
   
            
                        </tr>
                    <?php
                    }}
                    ?>
                </tbody>
            </table>

        </div>
    </div>


<!-------------------2) Stores TABLE ----------------------->
    
<div class="container">
            <h3>Stores</h3>
            <div  class="table_wrapper col-12">
            <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">Department Cod</th>
                    <th scope="col">Street</th>
                    <th scope="col">City</th>
                    <th scope="col">postalCode</th>
                    <th scope="col">
                    <a class="btn btn-secondary" href="storeForm.php">Insert</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql= "SELECT * FROM store";
                        $result = ($conn->query($sql));
                        $rows = []; 
    
                        if ($result->num_rows > 0) 
                            {
                                // fetch all data from db into array 
                                $rows = $result->fetch_all(MYSQLI_ASSOC);  
                            }
                
                        if(!empty($rows)){
                            foreach($rows as $row){
                    ?>

                    <tr>
                        <td><?php echo $row['depCode']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['postalCode']; ?></td>
                        <td></td>

                    </tr>
                    <?php }} ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-------------------3) ITEMS TABLE ----------------------->
        <div class="container">
            <h3>Items</h3>
            <div  class="table_wrapper col-12">
            <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Pic</th>
                    <th scope="col">price</th>
                    <th scope="col">madeIn</th>
                    <th scope="col">Department</th>
                    <th scope="col">quantity</th>
                    <th scope="col">
                    <a class="btn btn-secondary" href="itemForm.php">Insert</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql= "SELECT * FROM item";
                    $result = ($conn->query($sql));
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                ?>
                <tr>
    
                    <td><?php echo $row['itemID']; ?></td>
                    <td><?php echo $row['itemName']; ?></td>
                    <td><picture>
                        <img alt="<?php echo $row['itemPic']; ?>" style="width: 20%; height: 10%;" src="<?php echo $row['itemPic']; ?> "/>
                        </picture></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['madeIn']; ?></td>
                    <td><?php echo $row['depCode']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td></td>
                </tr>
                    <?php }} ?>
                </tbody>
            </table>
                
            </div>
        </div>








<!-------------------4) User TABLE ----------------------->
    <div class="container">
        <h3>Users</h3>
        <div  class="table_wrapper">
            <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">userID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">Admin</th>
                    <th scope="col">
                    <a class="btn btn-secondary" href="userForm.php">Insert</a>
                    </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql= "SELECT * FROM user";
                    $result = ($conn->query($sql));
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                    ?>
                    <tr>
        
                        <td><?php echo $row['userID']; ?></td>
                        <td><?php echo $row['firstName']; ?></td>
                        <td><?php echo $row['lastName']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['admin']; ?></td>
                        
                        <td></td>
        
                    </tr>
                        <?php }} ?>
                </tbody>
            </table>
                
        </div>
    </div>
<!-------------------5) Address TABLE ----------------------->
        <div class="container">
            <h3>Address</h3>
            <div class="table_wrapper col-12">
                <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">userID</th>
                    <th scope="col">postalCode</th>
                    <th scope="col">streetName</th>
                    <th scope="col">City</th>
                    <th scope="col">province</th>
                    <th scope="col">
                    <a class="btn btn-secondary" href="addressForm.php">Insert</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql= "SELECT * FROM address";
                    $result = ($conn->query($sql));
                    //declare array to store the data of database
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                ?>
                <tr>
    
                    <td><?php echo $row['userID']; ?></td>
                    <td><?php echo $row['postalCode']; ?></td>
                    <td><?php echo $row['streetName']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['province']; ?></td>
                    <td></td>
    
                </tr>
                    <?php }}            ?>
                </tbody>
                </table>
                
            </div>
        </div>
<!-------------------6) discount TABLE ----------------------->
<div class="container">
            <h3>Discount Items</h3>
            <div class="table_wrapper col-12">
                <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">discountID</th>
                    <th scope="col">itemID</th>

                    <th scope="col">
                    <a class="btn btn-secondary" href="addressForm.php">Insert</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql= "SELECT * FROM discount";
                    $result = ($conn->query($sql));
                    //declare array to store the data of database
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                ?>
                <tr>
    
                    <td><?php echo $row['discountID']; ?></td>
                    <td><?php echo $row['itemID']; ?></td>
                    <td></td>
    
                </tr>
                    <?php }}            ?>
                </tbody>
                </table>
                
            </div>
        </div>


<!-------------------7) itemsInShoppingCart TABLE ----------------------->

<div class="container">
            <h3>items In Users ShoppingCart</h3>
            <div class="table_wrapper col-12">
                <table  class="table table-hover align-middle">
                <thead>
                    <tr>
                    <th scope="col">itemID</th>
                    <th scope="col">receiptID</th>
                    <th scope="col">quantity</th>
                    <th scope="col">
                    <a class="btn btn-secondary" href="itemsInShoppingCartForm.php">INSERT</a>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql= "SELECT * FROM itemsInShoppingCart";
                    $result = ($conn->query($sql));
                    //declare array to store the data of database
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                ?>
                <tr>
    
                    <td><?php echo $row['itemID']; ?></td>
                    <td><?php echo $row['receiptID']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td></td>
    
                </tr>
                    <?php }}
                    $conn -> close(); ?>
                </tbody>
                </table>
                
            </div>
        </div>




    </body>
</html>
<?php

	}	
	else{
		header("Location: ../login.html");
	}
    ?>