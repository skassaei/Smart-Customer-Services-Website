<!DOCTYPE html>
<?php
require 'DB_Operations/dbConnect.php';
include 'DB_Operations/login.php'
?>
<?php
session_start();
?>

<head>
  <title>CPS630 Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./CSS/home2.css?v=<?php echo time(); ?>">
  <script src="https://code.angularjs.org/1.5.0/angular.min.js"></script>
  <!-- <link rel="stylesheet" href="./CSS/map.css"> -->
</head>
<html>

<body style="padding:0; height:100%" class="">
  <?php include 'nav.php' ?>
  <div class="container-fluid mt-3" style="height:100%; ">
    <div class="row justify-content-evenly" style="height:90vh; ">
      <div class="col-8 rounded grid-container">
        <?php
        if (isset($_GET['search'])) {
          $filterValue = $_GET['search'];
          $query = "SELECT * FROM item WHERE CONCAT(itemName) LIKE '%$filterValue%' ";
          $query_run = mysqli_query($conn, $query);
          if ($query_run->num_rows > 0) {
            foreach ($query_run as $row) {
        ?>
              <div class="grid-item">
                <div class="card" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px;  width: 17rem; cursor:move" align="center">
                  <img src="<?php echo $row["itemPic"]; ?>" data-id="<?php echo $row['itemID']; ?>" data-name="<?php echo $row['itemName']; ?>" data-price="<?php echo $row['price']; ?>" data-quantity="<?php echo $row['quantity']; ?>" data-size="<?php echo $row['size']; ?>" class="img-responsive product_drag" />
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['itemName']; ?></h5>
                    <p class="card-text">madeIn: <?php echo $row['madeIn']; ?></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">price: <?php echo $row['price']; ?></li>


                  </ul>
                </div>
              </div>
            <?php
            }
          } else {
            echo "<p>No Record Found</p>";
          }
        } else {
          $sql = "SELECT * FROM item";
          $result = ($conn->query($sql));
          $rows = [];
          if ($result->num_rows > 0) {
            // fetch all data from db into array 
            $rows = $result->fetch_all(MYSQLI_ASSOC);
          }
          if (!empty($rows)) {
            foreach ($rows as $row) {
            ?>
              <div class="grid-item">
                <div class="card" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px;  width: 17rem; cursor:move" align="center">
                  <div class="card" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px;  width: 17rem; cursor:move" align="center">
                    <img src="<?php echo $row["itemPic"]; ?>" data-id="<?php echo $row['itemID']; ?>" data-name="<?php echo $row['itemName']; ?>" data-price="<?php echo $row['price']; ?>" data-quantity="<?php echo $row['quantity']; ?>" data-size="<?php echo $row['size']; ?>" class="img-responsive product_drag" />
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['itemName']; ?></h5>
                      <p class="card-text">madeIn: <?php echo $row['madeIn'] ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">price: <?php echo $row['price']; ?></li>


                    </ul>
                  </div>
                </div>
            <?php }
          } ?>
            <div class="shopping cart">
            </div>
          <?php } ?>
              </div>
              <div class=" col-4 col-s-5 ">
                <div class="product_drag_area col-12 bg-darkk rounded pt-5 pb-5 text-center">Drop Product Here To Add To Cart</div>
                <div id="draggable_product_order" class=""></div>
              </div>
      </div>
    </div>
    <footer class="fixed-bottom bg-darkk shadow-lg" style="height:10vh">
      <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a>
      </div>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Company</a></li>
        <li class="list-inline-item"><a href="#">Career</a></li>
        <li class="list-inline-item"><a href="#">Help</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
      </ul>
      <p class="copyright">Company Name © 2023</p>
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

</html>