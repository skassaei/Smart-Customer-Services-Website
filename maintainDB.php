<!DOCTYPE html>
<html>


 
  <body>
  

    <?php

      // user defined MySQL exceptions
      class MySQLException extends Exception {}
      class MySQLDuplicateKeyException extends MySQLException {}
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "smart_customer_services";

      // Create connection
      $conn = new mysqli($servername, $username, $password,$db);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      echo " You are Connected to the database<br>";

     ?> 

  <div class="db-dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Maintain DB</a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="./DB_Operations/insert.php">insert</a>
      <a class="dropdown-item" href="./DB_Operations/delete.php">delete</a>
      <a class="dropdown-item" href="./DB_Operations/select.php">select</a>
      <a class="dropdown-item" href="./DB_Operations/update.php">update</a>
    </div>
  </div>  
    </body>
</html>