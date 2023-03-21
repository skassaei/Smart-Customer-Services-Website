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
    include '../nav_admin.php';
    ?>
        <div class="container" >
        <?php include('message.php')?>
            <form  action="../DB_Operations/insert.php"  class="row g-3" method= POST>
            <h3> Item: <br></h3>
            <div class="form-group col-12">
                <label for="Name" >Name On Cart</label>
                <div class="col-sm-10">
                <input name="itemName" type="text" class="form-control" id="Name" placeholder="Name On Cart" required>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="cartNum" >cart Number</label>
                <div class="col-sm-10">
                <input name="cartNum" type="number" class="form-control"  id="cartNum" placeholder="6474-5767-6832-3913" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}"  required>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="monthOnCart" >month</label>
                <div class="col-sm-10">
                <input name="monthOnCart" type="number" class="form-control"  id="monthOnCart" min="01" max="12" placeholder="02" required>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="yearOnCart" >year</label>
                <div class="col-sm-10">
                <input name="yearOnCart" type="number" class="form-control"  id="yearOnCart" min="00"  placeholder="23" required>
                </div>
            </div>

            <div class="col-3">
                    <a class="btn btn-secondary" href="./chose_Table_for_insert.php">Back</a>
                </div>

            <div class="col-9">
                    <button type="submit" name="Save_payment" class="btn btn-primary">Insert</button>
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