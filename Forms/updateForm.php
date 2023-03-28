
<?php 
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
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/contactus.css">

</head>

<?php
require '../DB_Operations/dbconnect.php';
$tableName =  mysqli_real_escape_string( $conn,$_GET["tableName"]); 
$tablePKField = mysqli_real_escape_string( $conn,$_GET["tablePKField"]); 
$PKValue =  mysqli_real_escape_string( $conn,$_GET["tablePKValue"]);


// ---------------updating USER------------------------------
if ($tableName =="user"){
    $query = "SELECT * FROM $tableName WHERE userID = $PKValue ";
    $query_run= mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($query_run);

    ?>
    <div class="container">
    <form class="row g-3" action = "../DB_operations/updateSingleRow.php" method="post">
    <h3> User: <br></h3>

      <div class="form-group col-12">
        <label for="first_name">First Name:</label>
        <input value="<?php echo $row['firstName']; ?>" type="text" class="form-control" id="first_name" name="firstName" required>
      </div>

      <div class="form-group col-12">
        <label for="last_name">Last Name:</label>
        <input value="<?php echo $row['lastName']; ?>" type="text" class="form-control" id="last_name" name="lastName" required>
      </div>

      <div class="form-group col-12">
        <label for="email">Email:</label>
        <input  value="<?php echo $row['email']; ?>" type="email" class="form-control" id="email" name="email">
      </div>

      <div class="row col-12">
      
        <div hidden class="form-group col-6">
          <label for="password">Password:</label>
          <input value="<?php echo $row['password']; ?>"  type="password" class="form-control" id="password" name="password" minlength="8" >
        </div>

        <div class="form-group col-6">
          <label for="phone">phone:</label>
          <input value="<?php echo $row['phone']; ?>" type="tel" class="form-control" id="phone" placeholder="6474576768" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="phone" >
          <br>
        </div>
        <div hidden  class="form-group col-12">
            <input value="<?php echo $PKValue?>"  type="text"  name="userID" required>
         </div>
      </div>
              <div class="form-check">
                  <!-- <input value="<?php // echo $row["admin"]?>"  class="form-check-input" type="checkbox" id="autoSizingCheck2"  name="admin" >
                  <label class="form-check-label" for="autoSizingCheck2">
                  Admin?
                  </label> -->

				  <select  value="<?php echo $row["admin"]?>" name="admin" class="form-select col-12" aria-label="Size">
                	<option selected>Admin?</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>

                </select>
              </div>
              <div class="col-3">
                  <a class="btn btn-secondary" href="./display_tables_for_update.php">Back</a>
              </div>
              <div class="col-9">
                <button type="submit" name="update_user" class="btn btn-primary">Update</button>
              </div>
            

    </form>
  </div>  
  <?php   
// ---------------updating Address------------------------------
}elseif($tableName =="address"){
  $query = "SELECT * FROM address WHERE userID = $PKValue ";
  $query_run= mysqli_query($conn,$query);
  $row = mysqli_fetch_assoc($query_run);

  
  ?>
    <div class="container">
    <h3>Address</h3>
      <form class="row g-3" action = "../DB_operations/updateSingleRow.php" method="post">


            <div class="form-group col-3">
                    <label for="street_num">Street Name:</label>
                    <input value="<?php echo $row["streetName"]?>" type="text" class="form-control" id="street_num" name="streetName" required>
            </div>
            
			<div class="form-group col-3">
                    <label for="unit_num">Postal Code:</label>
                    <input value="<?php echo $row["postalCode"]?>" type="text" class="form-control" id="unit_num" name="postalCode" required>
            </div>

            <div class="form-group col-6">
                    <label for="city">City:</label>
                    <input value="<?php echo $row["city"]?>" type="text" class="form-control" id="city" name="city" required>
            </div>
            
            <div class="form-group col-6">
                    <label for="province">Province:</label>
                    <input value="<?php echo $row["province"]?>"  type="text" class="form-control" id="province" name="province" required>
            </div>
            <div hidden  class="form-group col-12">
                 <input value="<?php echo $PKValue?>"  type="text"  name="userID" required>
            </div>

        </div>
                <div class="col-3">
                    <a class="btn btn-secondary" href="./display_tables_for_update.php">Back</a>
                </div>
                <div class="col-9">
                  <button type="submit" name="update_address" class="btn btn-primary">Update</button>
                </div>
              

      </form>
<?php
  }
// ---------------updating STORE------------------------------
  elseif($tableName =="store"){
    $query = "SELECT * FROM store WHERE depCode = $PKValue ";
    $query_run= mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($query_run);
?>
    <div class="container">

        <h3>Store</h3>

        <form name="storeForm" class="row g-3" action="../DB_Operations/updateSingleRow.php"   method= POST>

            <div class="form-group col-12">
                <label class="sr-only" for="inlineFormInput">Street</label>
                <input value="<?php echo $row["location"]?>"  name="location" type="text" class="form-control mb-2" id="inlineFormInput"  required>
            </div>
			<div class="form-group col-12">
                <label class="sr-only" for="inlineFormInput">Postal Code</label>
                <input value="<?php echo $row["postalCode"]?>"  name="postalCode" type="text" class="form-control mb-2" id="inlineFormInput"  required>
            </div>
            <div class="form-group col-12">
                <label class="sr-only" for="inlineFormInput">City</label>
                <input value="<?php echo $row["city"]?>" name="city" type="text" class="form-control mb-2" id="inlineFormInput"  required>
            </div>
            <div hidden  class="form-group col-12">
                 <input value="<?php echo $PKValue?>"  type="text"  name="depCode" required>
            </div>

            <div class="col-3">
            <a class="btn btn-secondary" href="./display_tables_for_update.php">Back</a>
            </div>
            <div class="col-9">
                <button type="submit" name="update_store" class="btn btn-primary">Update</button>
            </div>
        
            
        </form>
    </div>

<?php
  }
// ---------------updating ITEM------------------------------
  elseif($tableName =="item"){
    $query = "SELECT * FROM item WHERE itemID = $PKValue ";
    $query_run= mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($query_run);
?>
        <div class="container" >
        <?php include('message.php')?>
            <form  action="../DB_Operations/updateSingleRow.php"  class="row g-3" method= POST>
            <h3> Item: <br></h3>
            <div class="form-group col-12">
                <label for="Name" >Name</label>
                <div class="col-sm-10">
                <input value="<?php echo $row["itemName"]?>"   name="itemName" type="text" class="form-control" id="Name" required>
                </div>
            </div>
			<div class="form-group col-12">
                <label for="Picurl"  >Pic url</label>
                <div class="col-sm-10">
                <input  value="<?php echo $row["itemPic"]?>"  name="itemPic" type="url" class="form-control" id="Picurl" required>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="madeIn" >madeIn</label>
                <div class="col-sm-10">
                <input  value="<?php echo $row["madeIn"]?>"  name="madeIn" type="text" class="form-control" id="madeIn"  >
                </div>
            </div>

            <div class="form-group col-6">
                <label for="price" >price</label>
                <div class="col-sm-10">
                <input value="<?php echo $row["price"]?>"   name="price" type="text" class="form-control" id="price" required>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="DepartmentCode" >Department Code</label>
                <div class="col-sm-10">
                <input  value="<?php echo $row["depCode"]?>"  name="depCode" type="number" class="form-control"  id="DepartmentCode"  min="1"  required>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="availableNum" >Quantity</label>
                <div class="col-sm-10">
                <input value="<?php echo $row["quantity"]?>"  name="quantity" type="number" class="form-control"  id="availableNum"  min="1" placeholder="Quantity" required>
                </div>
            </div>
            <div hidden  class="form-group col-12">
                 <input value="<?php echo $PKValue?>"  type="text"  name="itemID" required>
            </div>
                <div class="col-3">
                    <a class="btn btn-secondary" href="./display_tables_for_update.php">Back</a>
                </div>

            <div class="col-9">
                    <button type="submit" name="update_item" class="btn btn-primary">Update</button>
                </div>


            </form>
        </div>

<?php
  }
// ---------------updating TRUCK------------------------------
  elseif($tableName =="truck"){
    $query = "SELECT * FROM truck WHERE truckID = $PKValue ";
    $query_run= mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($query_run);
?>

<div lass="container">
            <h3>Truck</h3>
            <form name="storeForm"  class="row g-3" action="../DB_Operations/updateSingleRow.php"   method= POST>
                
                <div class="form-group col-6">
                    <label for="inlineFormInput">Driver First Name:</label>
                    <input value="<?php echo $row["driverFirstName"]?>"  name="driverFirstName" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="driverFirstName" required>
                </div>
                <div class="form-group col-6">
                    <label  for="inlineFormInput">Driver Last Name:</label>
                    <input value="<?php echo $row["driverLastName"]?>"   name="driverLastName" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="driverLastName" required>
                </div>
                <div class="form-group col-12">
                    <label  for="inlineFormInput">Plate Num:</label>
                    <input value="<?php echo $row["PlateNum"]?>"  name="PlateNum" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Plate Number" required>
                </div>
                <div hidden  class="form-group col-12">
                 <input value="<?php echo $PKValue?>"  type="text"  name="truckID" required>
               </div>
                    <div class="form-group col-12">
                    <div class="form-check">
                        <input value="<?php echo $row["availabilityCode"]?>"  class="form-check-input" type="checkbox" id="autoSizingCheck2"  name="availabilityCode" >
                        <label class="form-check-label" for="autoSizingCheck2">
                        Is the truck available?
                        </label>
                    </div>
                </div>  
            
                <div class="col-3">
                <a class="btn btn-secondary" href="./display_tables_for_update.php">Back</a>
            </div>
                <div class="col-9">
                    <button type="submit" name="update_truck" class="btn btn-primary">Update</button>
                </div>         
                
            </form>
    </div>


<?php
  }
// ---------------updating ORDER------------------------------
  elseif($tableName =="orders"){
    $query = "SELECT * FROM orders WHERE orderID = $PKValue ";
    $query_run= mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($query_run);
?>


<?php 
  }
?>
<?php

}	
else{
  header("Location: ../login.html");
}
  ?>