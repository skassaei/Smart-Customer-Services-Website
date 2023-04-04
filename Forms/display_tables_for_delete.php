<?php include '../DB_Operations/login.php';
if (isset($_SESSION['loggedin']) and isset($_SESSION['isAdmin'])) {

	?>
<!DOCTYPE html>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../CSS/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../CSS/contactus.css">

</head>

<html>

    <body>
        <?php include './nav_admin.php' ?> 
		<?php include '../DB_Operations/display_Table_Class.php' ?>
<?php
	$tableNames = array();
	$tableNames[0] = "user";
	$tableNames[1] = "store";
	$tableNames[2] = "item";
	$tableNames[3] = "discount";
	$tableNames[4] = "truck";
	$tableNames[5] = "review";
	$tableNames[6] = "orders";
	include('message.php');
	foreach ($tableNames as $tn){
		$tableObj = new Table($tn,$conn);
		$tableObj->display_all_rows_delete();
	}



}	
else{
	header("Location: ../login.html");
}
?>