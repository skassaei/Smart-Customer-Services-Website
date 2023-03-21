<?php
require 'dbconnect.php';

$tableName = $_GET['tableName'];
$tablePKField = $_GET['tablePKField'];
$tablePKValue = $_GET['tablePKValue'];

$query = "DELETE FROM $tableName WHERE $tablePKField = $tablePKValue ";
$result = mysqli_query($conn, $query);
if ($result) {
    mysqli_close($conn);
    header("location: ../delete.php");
    exit();
} else {
    echo "Error deleting record";
}
?>