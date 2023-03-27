<?php 
  
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
  <body>
    <div class="container">
      <?php include('message.php')?>
      <form class="row g-3" action = "../DB_operations/insert.php" method="post">

            <!-- address info below --> 
            <div class="form-group col-12">
                <h3> Address: </h3>
            </div>
            <div class="form-group col-3">
                    <label for="UserID">UserID:</label>
                    <input type="text" class="form-control" id="UserID" name="userID" required>
            </div>
            <div class="form-group col-3">
                    <label for="unit_num">Unit Number:</label>
                    <input type="text" class="form-control" id="unit_num" name="unitNum" required>
            </div>
            
            <div class="form-group col-6">
                    <label for="street_num">Street Name:</label>
                    <input type="text" class="form-control" id="street_num" name="streetName" required>
            </div>
            <div class="form-group col-3">
                    <label for="Postal">Postal Code:</label>
                    <input type="text" class="form-control" id="street_num" name="postalCode" required>
            </div>
            
            
            <div class="form-group col-6">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" required>
            </div>
            
            <div class="form-group col-6">
                    <label for="province">Province:</label>
                    <input type="text" class="form-control" id="province" name="province" required>
            </div>

        </div>
                <div class="col-3">
                    <a class="btn btn-secondary" href="./display_tables_for_insert.php">Back</a>
                </div>
                <div class="col-9">
                  <button type="submit" name="Save_address" class="btn btn-primary">Save</button>
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