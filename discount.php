<!DOCTYPE html>
<?php
require 'DB_Operations/dbConnect.php';
include 'DB_Operations/login.php';

if (isset($_SESSION['loggedin'])) {
	
?>

<head>
  <title>CPS630 Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./CSS/discount.css?v=<?php echo time(); ?>">
  <script src="https://code.angularjs.org/1.5.0/angular.min.js"></script>
<html>

<body>
  <?php include 'nav_offer.php' ?>
  <div class="container-fluid pb-5 mb-5">
    <div class="d-flex justify-content-around col-7 pt-5">
      <h1 class="pb-0">Time Limitted offers</h1>
      <h1 id="demo2"></h1>
    </div>
    <div class="row col-12 justify-content-center">
      <div id="mainP" class="col-lg-8 mt-lg-5 col-md-12 col-sm-12 order-2 order-md-2 rounded justify-content-center d-flex flex-wrap align-self-center">
        <?php
        if (isset($_GET['search'])) {
          $filterValue = $_GET['search'];
          $query = "SELECT * FROM item WHERE CONCAT(itemName) LIKE '%$filterValue%' ";
          $query_run = mysqli_query($conn, $query);
          if ($query_run->num_rows > 0) {
            foreach ($query_run as $row) {
        ?>
              <div class="grid-item p-2 align-self-center"  id="cardholder">
                <div class="card " style="border:1px solid rgb(166, 0, 55); background-color:#f1f1f1; border-radius:5px;  width:33vh; cursor:move" align="center">
                  <img src="<?php echo $row["itemPic"]; ?>" data-id="<?php echo $row['itemID']; ?>" data-name="<?php echo $row['itemName']; ?>" data-price="<?php echo $row['price']; ?>" data-quantity="<?php echo $row['quantity']; ?>" class="img-responsive product_drag" />
                  <div class="card-body">
                    <h5 class="card-title" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $row['itemName']; ?></h5>
                    <p class="card-text" style="color:#aaa">Color Code: <?php echo $row['madeIn'] ?></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="color:crimson">original price: $<?php echo number_format($row['price'], 2); ?></li>
                  </ul>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">discounted price: $<?php echo number_format($row['price']*0.93, 2); ?></li>
                  </ul>
                </div>
              </div>
            <?php
            }
          } else {
            echo "<p>No Record Found</p>";
          }
        } else {

          $Find_itemID = "SELECT itemID FROM discount";
          $itemID_run= mysqli_query($conn, $Find_itemID);
          while ($itemID= mysqli_fetch_row($itemID_run)){
            $sql = "SELECT * FROM item WHERE itemID = $itemID[0]";
            $result = ($conn->query($sql));
          $rows = [];
          if ($result->num_rows > 0) {
            // fetch all data from db into array 
            $rows = $result->fetch_all(MYSQLI_ASSOC);
          }
          if (!empty($rows)) {
            foreach ($rows as $row) {
            ?>
            <div class="grid-item p-2 align-self-center"  id="cardholder">
                <div class="card " style="border:1px solid indigo; background-color:#f1f1f1; border-radius:5px;  width:33vh; cursor:move" align="center">
                  <img src="<?php echo $row["itemPic"]; ?>" data-id="<?php echo $row['itemID']; ?>" data-name="<?php echo $row['itemName']; ?>" data-price="<?php echo $row['price']; ?>" data-quantity="<?php echo $row['quantity']; ?>" class="img-responsive product_drag" />
                  <div class="card-body">
                    <h5 class="card-title" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $row['itemName']; ?></h5>
                    <p class="card-text" style="color:#aaa">Color Code: <?php echo $row['madeIn'] ?></p>
                  </div>
                  <ul class="list-group list-group-flush pb-0 mb-0">
                    <li class="list-group-item" style=" color:indigo"><b>price: </b><s style=" color:grey">$<?php echo number_format($row['price'], 2); ?></s><b> $<?php echo number_format($row['price']*0.93, 2); ?></b></li>
                  </ul>
                </div>
              </div>
            <?php }
          }

          }
           ?>
            <div class="shopping cart">
            </div>
          <?php } ?>
              </div>
              
              <div class="col-lg-4 col-md-12 col-s-12  order-1 order-md-1 newp sticky-top">
                <div class="product_drag_area col-12 bg-darkk rounded text-center newp sticky-top">Drop Product Here To Add To Cart</div>
                <div id="draggable_product_order" class=""></div>
              </div>
      </div>
    </div>
    <footer class="fixed-bottom bg-darkk shadow-lg" >
          <div class="d-none d-lg-flex row m-2  d-flex justify-content-evenly">
            <div class=" col-5 social d-flex justify-content-around">
              <a class="m-1" href="#">Instagram</a>
              <a class="m-1" href="#">Snapchat</a>
              <a class="m-1" href="#">Twitter</a>
              <a class="m-1" href="#">Facebook</a>
            </div>
            <div class="col-5 d-flex justify-content-around">
                <a class="m-1" href="#">Company</a>
                <a class="m-1" href="#">Career</a>
                <a class="m-1" href="#">Help</a>
                <a class="m-1" href="#">Terms</a>
                <a class="m-1" href="#">Privacy Policy</a>
            </div>
          </div>
          <hr class="rounded d-none d-lg-block mt-1 mb-1">
          
          <p class="text-center m-0 p-0 copyright">Company Name © 2023</p>
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function(data) {
    $('.product_drag_area').on('dragover', function() {
      $(this).addClass('product_drag_over');
      return false;
    });
    $('.product_drag_area').on('dragleave', function() {
      $(this).removeClass('product_drag_over');
      return false;
    });
    $('.product_drag').on('dragstart', function(e) {
      e.originalEvent.dataTransfer.setData("id", $(this).data("id"));
      e.originalEvent.dataTransfer.setData("name", $(this).data("name"));
      e.originalEvent.dataTransfer.setData("price", $(this).data("price"));
      e.originalEvent.dataTransfer.setData("quantity", $(this).data("quantity"));
      e.originalEvent.dataTransfer.setData("size", $(this).data("size"));
    });
    $('.product_drag_area').on('drop', function(e) {
      e.preventDefault();
      $(this).removeClass('product_drag_over');
      var id = e.originalEvent.dataTransfer.getData('id');
      var name = e.originalEvent.dataTransfer.getData('name');
      var price = e.originalEvent.dataTransfer.getData('price');
      var quantity = e.originalEvent.dataTransfer.getData('quantity');
      var size = e.originalEvent.dataTransfer.getData('size');
      var action = "add";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          id: id,
          name: name,
          price: price,
          quantity: quantity,
          size: size,
          action: action
        },
        success: function(data) {
          $('#draggable_product_order').html(data);
        }
      })
    });
    $(document).on('click', '.remove_product', function() {
      if (confirm("Are you sure you want to remove this product?")) {
        var id = $(this).attr("id");
        var action = "delete";
        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            id: id,
            action: action
          },
          success: function(data) {
            $('#draggable_product_order').html(data);
          }
        });
      } else {
        return false;
      }
    });
  });
</script>
<script>

var div=document.getElementById("demo");
var div2=document.getElementById("demo2");

setInterval(function(){ 

  var toDate=new Date();
  var tomorrow=new Date();
  tomorrow.setHours(24,0,0,0);

  var diffMS=tomorrow.getTime()/1000-toDate.getTime()/1000;
  var diffHr=Math.floor(diffMS/3600);

  diffMS=diffMS-diffHr*3600;
  var diffMi=Math.floor(diffMS/60);

  diffMS=diffMS-diffMi*60;
  var diffS=Math.floor(diffMS);

  var result=((diffHr<10)?"0"+diffHr:diffHr);
  result+=":"+((diffMi<10)?"0"+diffMi:diffMi);
  result+=":"+((diffS<10)?"0"+diffS:diffS);

  div.innerHTML=result;
  div2.innerHTML=result;
  
},1000);

</script>
<?php

}	
else{
  header("Location: ./login.html");
}
  ?>
</html>
