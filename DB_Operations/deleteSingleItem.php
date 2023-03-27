<?php
require 'dbconnect.php';

$tableName =  mysqli_real_escape_string( $conn,$_GET["tableName"]); 
$tablePKField = mysqli_real_escape_string( $conn,$_GET["tablePKField"]); 
$tablePKValue =  mysqli_real_escape_string( $conn,$_GET["tablePKValue"]);

$query = "DELETE FROM $tableName WHERE $tablePKField = $tablePKValue ";


    $result = mysqli_query($conn, $query);
    if ($result){
        
    echo"yes";
    mysqli_close($conn);
    header("location: ../Forms/display_tables_for_delete.php");
    exit();
    }
    else {
    echo "Error deleting record";

    }
?>