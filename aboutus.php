<!DOCTYPE html>
<?php include 'DB_Operations/login.php' ?>
<!DOCTYPE html>
<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./CSS/nav.css?v=<?php echo time(); ?>">
</head>

<html>

    <body>
        <?php include 'nav.php' ?> 
    <div class="container m-4">
      <h1 class="text-center" style="font-size: 8vmin;">Meet Our Team!</h1>
    </div>
    <div class="align-content-center container-fluid">
      <div class="row justify-content-evenly mb-5 mt-3">
        <div class="card col-5 p-2 bg-darkk shadow-lg rounded">
          <img class="card-img-top align-self-center rounded-circle border border-white" src="./aboutUs_images/example_p.jpg" alt="Card image" style="width:40vmin">
          <div class="card-body ">
            <h4 class="card-title text-center">Parmida Azizi</h4>
            <p class="card-text text-center">Some example text some example text. Some example text some example text.</p>
          </div>
        </div>
        <div class="card col-5 p-2 bg-darkk shadow-lg rounded">
          <img class="card-img-top align-self-center rounded-circle border border-white" src="./aboutUs_images/blank.jpg" alt="Card image" style="width:40vmin">
          <div class="card-body ">
            <h4 class="card-title text-center">Sahar Kassaei</h4>
            <p class="card-text text-center">Some example text some example text. Some example text some example text.</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-evenly">
        <div class="card col-5 p-2 bg-darkk shadow-lg rounded">
          <img class="card-img-top align-self-center rounded-circle border border-white" src="./aboutUs_images/blank.jpg" alt="Card image" style="width:40vmin">
          <div class="card-body ">
            <h4 class="card-title text-center">Sina Pahlavan</h4>
            <p class="card-text text-center">Some example text some example text. Some example text some example text.</p>
          </div>
        </div>
        <div class="card col-5 p-2 bg-darkk shadow-lg rounded">
          <img class="card-img-top align-self-center rounded-circle border border-white" src="./aboutUs_images/blank.jpg" alt="Card image" style="width:40vmin">
          <div class="card-body ">
            <h4 class="card-title text-center">Alex Huynh</h4>
            <p class="card-text text-center">Some example text some example text. Some example text some example text.</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
  