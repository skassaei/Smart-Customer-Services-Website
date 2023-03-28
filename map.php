<!DOCTYPE html>
<?php
session_start();
?>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/nav.css">
    <link rel="stylesheet" href="./CSS/map.css">
</head>
<html>
  <?php include 'nav.php' ?> 
  <body>
    <div class="container mr-4 mt-1 mb-4 ml-5">
      <h1 style="font-size: 7vmin;">Branch Options</h1>
      <h4>Please choose a branch for your orders to be shipped from.</h4>
    </div>
    <div class="row justify-content-evenly mt-3 overflow-hidden">
      <div class="mb-5 card col-10 p-4 bg-darkk shadow-lg rounded align-items-center">
        <h2>The Delivery Route</h2>
        <?php
        $email = $_SESSION["email"];
        include './DB_Operations/dbconnect.php';
        $Find_userID = "SELECT userID FROM user WHERE email = '$email'";
        $userID_run= mysqli_query($conn, $Find_userID);
        $userID= mysqli_fetch_row($userID_run);
        $Find_userAdd = "SELECT postalCode FROM address WHERE userID = '$userID[0]'";
        $userAdd_run= mysqli_query($conn, $Find_userAdd);
        $userAdd= mysqli_fetch_row($userAdd_run);
        ?>

        <form class="col-12" action = "invoice.php" method="post">
        <div id="floating-panel mapf">
          <div class="row">
            <div class="col-11">
              <b>Branch: </b>
              <select class=" p-1" id="start" name="branchAdd" required>
                <option value="" disabled selected >Choose a Branch</option>
                <?php
                  $Find_storePC = "SELECT postalCode FROM store";
                  $storePC_run= mysqli_query($conn, $Find_storePC);   
                                
                  while ($storePC= mysqli_fetch_row($storePC_run)){
                    $Find_storeCity = "SELECT city FROM store WHERE postalCode = '$storePC[0]'";
                    $storeCity_run= mysqli_query($conn, $Find_storeCity); 
                    $storeCity= mysqli_fetch_row($storeCity_run);
                    echo "<option value='".$storePC[0]."'>".$storeCity[0]."</option>";
                  }
                ?>
              </select>
              <b class="visually-hidden col-7">End: </b>
              <select id="end" class="visually-hidden">
                <option value="<?php echo $userAdd[0] ?>">Customer Address</option>
              </select>
            </div>
            <div class="col-1">
              <input type="submit" class="btn btn-outline-light mb-2 mt-1 pt-1 pb-1 pr-2 pl-2" >
            </div>
          </div>
          <div id="map"></div>
        </div>
        </form>
      </div>
    </div>
    <script>
		function initMap() {
			const directionsService = new google.maps.DirectionsService();
			const directionsRenderer = new google.maps.DirectionsRenderer();
			const map = new google.maps.Map(document.getElementById("map"), {
				zoom: 11,
				center: { lat: 43.75, lng: -79.36 },
			});

			directionsRenderer.setMap(map);

			const onChangeHandler = function () {
				calculateAndDisplayRoute(directionsService, directionsRenderer);
			};
			
			document.getElementById("start").addEventListener("change", onChangeHandler);
			document.getElementById("end");
		}

		function calculateAndDisplayRoute(directionsService, directionsRenderer) {
			directionsService
				.route({
				origin: {
					query: document.getElementById("start").value,
				},
				destination: {
					query: document.getElementById("end").value,
				},
				travelMode: google.maps.TravelMode.DRIVING,
				})
				.then((response) => {
				directionsRenderer.setDirections(response);
				})
				.catch((e) => window.alert("Directions request failed due to " + status));
		}
		window.initMap = initMap;
	</script>

	<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh2dqXcuimTN834D5gv8p8sPxOxLMMTXc&callback=initMap&v=weekly"
	defer
	></script>
  </body>
</html>
  