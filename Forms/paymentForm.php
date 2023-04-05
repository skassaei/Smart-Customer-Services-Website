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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/contactus.css">

</head>


<html>
    <body>
    <?php 
    include 'nav_admin.php';
    ?>
        <div class="container" >
        <?php include('message.php');
        ?>
            <form  action="../confirm.php"  class="row g-3" method= POST>
            <h3 class="pb-1 d-inline"> Amount: <?php echo '$'.number_format($_SESSION["totalAmount"], 2)?></h3>
            <div class="form-group col-12">
                <label for="Name" >Name On Card</label>
                <div class="col-sm-10">
                <input name="paymentName" type="text" class="form-control" id="Name" placeholder="Name On Card" required>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="cartNum" >Number on Card</label>
                <div class="col-sm-10">
                <input name="paymentNum" type="number" class="form-control"  id="cartNum" placeholder="16 Digit Number" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}"  required>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="monthOnCart">month</label>
                <div class="col-sm-10">
                <input name="monthOnCart" type="number" class="form-control"  id="monthOnCart" min="01" max="12" placeholder="02" required>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="yearOnCart" >year</label>
                <div class="col-sm-10">
                <input name="yearOnCart" type="number" class="form-control"  id="yearOnCart" min="00"  placeholder="23" required>
                </div>
            </div><div class="form-group col-2">
                <label for="yearOnCart" >CVV</label>
                <div class="col-sm-10">
                <input name="yearOnCart" type="number" class="form-control"  id="yearOnCart" min="00"  placeholder="CVV" required>
                </div>
            </div>

            <div class="col-1">
                <button style="background-color:white; color: rgb(33, 17, 55);" class="col-12  bg-darkk shadow-lg rounded total"  type="submit" name="Save_payment" >
                    <a style="text-decoration: none; color: rgb(33, 17, 55);" href="../invoice.php">Back</a>
                </button>   
            </div>

            <div class="col-2">
                <input style="background-color:white; color: rgb(33, 17, 55);" value="Confirm" type="submit" class="col-12  bg-darkk shadow-lg rounded total">
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