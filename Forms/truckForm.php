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
    <div lass="container">
        <?php include('message.php')?>
            <h3>Truck</h3>
            <form name="storeForm"  class="row g-3" action="../DB_Operations/insert.php"   method= POST>
                
                <div class="form-group col-6">
                    <label for="inlineFormInput">Driver First Name:</label>
                    <input name="driverFirstName" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="driverFirstName" required>
                </div>
                <div class="form-group col-6">
                    <label  for="inlineFormInput">Driver Last Name:</label>
                    <input name="driverLastName" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="driverLastName" required>
                </div>
                <div class="form-group col-12">
                    <label  for="inlineFormInput">Plate Num:</label>
                    <input name="PlateNum" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Plate Number" required>
                </div>
                    <div class="form-group col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="autoSizingCheck2"  name="availabilityCode" value="1">
                        <label class="form-check-label" for="autoSizingCheck2">
                        Is the truck available?
                        </label>
                    </div>
                </div>  
            
                <div class="col-3">
                <a class="btn btn-secondary" href="./chose_Table_for_insert.php">Back</a>
            </div>
                <div class="col-9">
                    <button type="submit" name="Save_truck" class="btn btn-primary">Insert</button>
                </div>
            
                
            </form>


    </div>
	
<?php

	}	
	else{
		header("Location: ../login.html");
	}
    ?>