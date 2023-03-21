<?php 
require './DB_Operations/dbConnect.php';
include 'DB_Operations/login.php' 

?>

<!DOCTYPE html>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
    <script src="https://code.angularjs.org/1.5.0/angular.min.js" ></script>

</head>

<html>
    <body>
     <?php include 'nav.php' ?> 
     <div class="col-9">
        <div class="grid-container" >  
     <?php
      if(isset($_GET['search'])){
        $filterValue=$_GET['search'];
        $query= "SELECT * FROM item WHERE CONCAT(itemName) LIKE '%$filterValue%' ";
        $query_run = mysqli_query($conn,$query);

        if($query_run->num_rows > 0){
            foreach($query_run as $row){
            ?>
                <div class="grid-item">
                <div class="card "  style="width: 14rem;">
                    <img class="card-img-top" src="<?php echo $row['itemPic']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['itemName']; ?></h5>
                        <p class="card-text"><?php echo $row['madeIn']; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">price: $<?php echo $row['price']; ?></li>
                        <li class="list-group-item">size: <?php echo $row['size']; ?></li>
                    </ul>
                </div>
            </div>
           
            <?php
            }
        }else{
            echo "<p>No Record Found</p>";
        }

      }else{
         $sql= "SELECT * FROM item";
                    $result = ($conn->query($sql));
                    $rows = []; 
    
                    if ($result->num_rows > 0) 
                        {
                            // fetch all data from db into array 
                            $rows = $result->fetch_all(MYSQLI_ASSOC);  
                        }
            
                    if(!empty($rows)){
                        foreach($rows as $row){
                ?>
                <div class="grid-item">
                    <div class="card "  style="width: 14rem;">
                        <img class="card-img-top" src="<?php echo $row['itemPic']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['itemName']; ?></h5>
                            <p class="card-text"><?php echo $row['madeIn']; ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">price: $<?php echo $row['price']; ?></li>
                            <li class="list-group-item">size: <?php echo $row['size']; ?></li>
                        </ul>
                    </div>
                </div>
                    <?php }} ?>
        </div>
            <div class="shopping cart">
            </div>
<?php } ?>
      
                  
         </div>

            <div class="col-2">
                
            <div style="clear:both"></div>
            <br />
            <div align="center">
            <div class="product_drag_area">Drop Product Here</div>
            </div>
            <div id="dragable_product_order">
            </div>


            </div>






<div class="footer-basic">
    <footer>
      <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Company</a></li>
        <li class="list-inline-item"><a href="#">Career</a></li>
        <li class="list-inline-item"><a href="#">Help</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
      </ul>
      <p class="copyright">Company Name © 2023</p>
    </footer>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
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
    });
    $('.product_drag_area').on('drop', function(e) {
      e.preventDefault();
      $(this).removeClass('product_drag_over');
      var id = e.originalEvent.dataTransfer.getData('id');
      var name = e.originalEvent.dataTransfer.getData('name');
      var price = e.originalEvent.dataTransfer.getData('price');
      var action = "add";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          id: id,
          name: name,
          price: price,
          action: action
        },
        success: function(data) {
          $('#dragable_product_order').html(data);
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
            $('#dragable_product_order').html(data);
          }
        });
      } else {
        return false;
      }
    });
  });
</script>

