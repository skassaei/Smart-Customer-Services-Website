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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/contactus.css">

</head>


<html>
    <body>
    <?php 
    include './nav_admin.php';
    ?>
  <body>
    <div class="container">
      <?php include('message.php')?>
      <form class="row g-3" action = "../DB_operations/insert.php" method="post">
      <h3> User: <br></h3>

        <div class="form-group col-12">
          <label for="first_name">First Name:</label>
          <input type="text" class="form-control" id="first_name" name="firstName" required>
        </div>

        <div class="form-group col-12">
          <label for="last_name">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name="lastName" required>
        </div>

        <div class="form-group col-12">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="row col-12">
        
          <div class="form-group col-6">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
          </div>

          <div class="form-group col-6">
            <label for="phone">phone:</label>
            <input type="tel" class="form-control" id="phone" placeholder="6474576768" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="phone" >
            <br>
          </div>
          <div class="form-group col-6">
          <select name="admin" class="form-select" aria-label="Default select example">
            <option selected>Admin?</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
          </select>
          </div>
  </br>  </br>

            <!-- address info below --> 
            <div class="form-group col-12">
              <h3> Please Enter the Address Information <br></h3>
            </div>
            
            
            <div class="form-group col-4">
                    <label for="street_num">Street Name:</label>
                    <input type="text" class="form-control" id="street_num" name="streetName" required>
            </div>
            
            
            <div class="form-group col-8">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group col-4">
                    <label for="postalCode">Postal Code:</label>
                    <input type="text" class="form-control" id="postalCode" name="postalCode" required>
            </div>
            <div class="form-group col-8">
                    <label for="province">Province:</label>
                    <input type="text" class="form-control" id="province" name="province" required>
            </div>

        </div>
                <div class="col-3">
                    <a class="btn btn-secondary" href="./display_tables_for_insert.php">Back</a>
                </div>
                <div class="col-9">
                  <button type="submit" name="Save_user" class="btn btn-primary">Save</button>
                </div>
              

      </form>
    </div>  
        
        
  </body>

</html>
<?php

	}	
	else{
		header("Location: ../login.html");
	}
  ?>