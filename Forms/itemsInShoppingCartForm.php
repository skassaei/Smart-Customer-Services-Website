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


<html>
    <body>
    <?php 
    include './nav_admin.php';
    ?>
        <div class="container" >
        <?php include('message.php')?>
            <form  action="../DB_Operations/insert.php"  class="row g-3" method= POST>
            <h3> Items In Shopping Cart: <br></h3>
            <div class="form-group col-12">
                <label for="itemID" >Item ID</label>
                <div class="col-sm-10">
                <input name="itemID" type="text" class="form-control" id="itemID" placeholder="itemID" required>
                </div>
            </div>
            <div class="form-group col-12">
                <label for="receiptID"  >Receipt ID </label>
                <div class="col-sm-10">
                <input name="receiptID" type="text" class="form-control" id="receiptID" placeholder="receiptID" required>
                </div>
            </div>
            <div class="form-group col-12">
                <label for="quantity" >Quantity: </label>
                <div class="col-sm-10">
                <input name="quantity" type="text" class="form-control" id="quantity"  placeholder="quantity">
                </div>
            </div>

  
    </br>

                <div class="col-3">
                    <a class="btn btn-secondary" href="./display_tables_for_insert.php">Back</a>
                </div>
                <div class="col-9">
                        <button type="submit" name="Save_itemsinshoppingcart" class="btn btn-primary">Insert</button>
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