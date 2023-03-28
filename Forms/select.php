<?php
require '../DB_Operations/dbconnect.php';

if(isset($_POST['select_table'])){
$tableName =  mysqli_real_escape_string( $conn,$_POST["tableName"]); 
$attribute = mysqli_real_escape_string( $conn,$_POST[$tableName]); 
$value =  mysqli_real_escape_string( $conn,$_POST["value"]);
 echo "tableName: ".$tableName."</br>";
 echo "attribute: ".$attribute."</br>";
 echo "value: ".$value."</br>";

$query = "SELECT * FROM $tableName WHERE $attribute = '$value' ";


    $result = mysqli_query($conn, $query);
               // making HTML table
               echo "<div class='container' > 
               <h3>$tableName</h3>
               <div class='table_wrapper'>
                   <table class='table table-striped'>
                       <thead>
                       <tr>";
               $rows = [];
               $firstRow=[];
               if(mysqli_num_rows($result) > 0){
                   $rows = $result->fetch_all(MYSQLI_ASSOC);
       
                   if(!empty($rows)){
                       $firstRow =  $rows[0] ;
                       foreach($firstRow as $head => $value){
       
                               if($head != "password"){
                                       echo "<th scope='col'>$head</th>";
                                       }
                           }
       
                       foreach($rows as $row){
                           echo"<tr>";
                           foreach($row as $head => $value){
       
                               if ($head != "password"){
                               echo "<td>$value</td>";
                           }
       
                       }
                    
                    }
                }
            }
    else {
    echo "No Recordes were found  ";

    }
}
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
    
    <style>
        .non_show{
            display: none;
        }
    </style>
</head>

<html>

  <body>
  
    <?php
    //class="form-select"
    //class="form-control mb-2" action="../DB_Operations/selectTable.php"  
     include './nav_admin.php';
    //require '../DB_Operations/dbConnect.php';
     ?>
        <div class="container col-12">
        <p> Display 

        <form method="POST"   >
            <select name="tableName" id="table" onchange="enableBrand(this)"  aria-label="Default select example">
                <option selected>Select a Table</option>
                <option value="user">Users</option>
                <option value="store">Stores</option>
                <option value="truck">Trucks</option>
            </select>
            with
            <select name="user" id="user" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="userID">ID</option>
                <option value="firstName">Name</option>
                <option value="lastName">LastName</option>
                <option value="email">email</option>
                <option value="phone">phone</option>
            </select>
            <select name="store" id="store" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="depCode">ID</option>
                <option value="location">location</option>
                <option value="city">city</option>
            </select>
            <select name="truck" id="truck" class="non_show " aria-label="Default select example">
                <option selected>Select</option>
                <option value="truckID">ID</option>
                <option value="driverFirstName">Name</option>
                <option value="driverLastName">Lastname</option>
                <option value="PlateNum">plateNum</option>
                <option value="availabilityCode">availability</option>

            </select>
            equal to 
                 <input  name="value" type="text" id="inlineFormInput"  required>

            </p>

                <div class="col-9">
                    <button type="submit" name="select_table" class="btn btn-primary">Select</button>
                </div>         
                
    </form>
        </div>


        <script type="text/javascript">
            function enableBrand(answer){
               console.log(answer.value);  
               if(answer.value == "user"){
                document.getElementById('user').classList.remove('non_show');
               }else{
                document.getElementById('user').classList.add('non_show');
               }
               if(answer.value == "store"){
                document.getElementById('store').classList.remove('non_show');
               }else{
                document.getElementById('store').classList.add('non_show');
               }
               if(answer.value == "truck"){
                document.getElementById('truck').classList.remove('non_show');
               }else{
                document.getElementById('truck').classList.add('non_show');
               }
            };
           

            </script>
  </body>
</html>