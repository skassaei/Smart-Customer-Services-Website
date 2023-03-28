<?php
require 'dbconnect.php';

if(isset($_POST['Save_item'])){
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