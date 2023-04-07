
<?php include 'DB_Operations/login.php';

if (isset($_SESSION['loggedin'])) {
	?>
<!DOCTYPE html>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./CSS/contactus.css?v=<?php echo time(); ?>">
</head>

<html>

    <body>
        <?php include 'nav.php' ?> 
        <div class="container col d-flex justify-content-center mt-5">
            <div class="card col-6 bg-darkk mainc contC text-center" style="padding: 5vmin">
            <h2 class="pb-4 ">HOW TO CONTACT US</h2>
            <h3>EMAILS:</h3>
            <p>Parmida Azizi: parmida.azizi@torontomu.ca </p>
            <p>Sahar Kassaei: skassaei@torontomu.ca </p>
            <p>Alex Huynh: a10huynh@torontomu.ca</p>
            <p>Sina Pahlavan: spahlavan@torontomu.ca</p>
            <h3 class="pt-3 ">PHONES:</h3>
            <p>Parmida Azizi: </p>
            <p>Sahar Kassaei: </p>
            <p>Alex Huynh: </p>
            <p>Sina Pahlavan: </p>
            </div>
        </div>
    </body>
    <?php

}	
else{
    header("Location: ./login.html");
}
?>
</html>
