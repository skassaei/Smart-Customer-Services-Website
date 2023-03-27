<!DOCTYPE html>

<head>
    <title>CPS630 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/nav.css">
    <link rel="stylesheet" href="./CSS/contactus.css">
</head>
<html>
    <body>
<?php

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

// sql to create table
$sql =array();

$sql[0] = "CREATE TABLE user (
    firstName VARCHAR(25) NOT NULL,
    lastName VARCHAR(25) NOT NULL,
    userID INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(25) NOT NULL UNIQUE,
	admin BOOLEAN,
    password VARCHAR(255) NOT NULL,
    phone INT UNSIGNED,
    PRIMARY KEY(userID)
    )";
    
$sql[1] = "CREATE TABLE address (
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES user(userID),
    PRIMARY KEY(userID),
    postalCode VARCHAR(25) NOT NULL,
    streetName VARCHAR(25) NOT NULL,
    city VARCHAR(25) NOT NULL,
    province VARCHAR(25) NOT NULL
)";

$sql[2] = "CREATE TABLE store (
    location VARCHAR(25) NOT NULL,
    city VARCHAR(25) NOT NULL,
    postalCode VARCHAR(20) NOT NULL,
    depCode INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(depCode)
     )";

$sql[3] = "CREATE TABLE item (
    itemName VARCHAR(25) NOT NULL,
    madeIn VARCHAR(25),
    itemPic VARCHAR(300) ,
    itemID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(itemID),
    quantity INT UNSIGNED NOT NULL,
    price INT UNSIGNED NOT NULL,
    depCode INT NOT NULL,
    FOREIGN KEY (depCode) REFERENCES store(depCode)

    )";

$sql[4] = "CREATE TABLE shopping_cart (
    receiptId int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(receiptId),
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES USER(userID)
    )";


$sql[5] = "CREATE TABLE truck (
        truckID INT NOT NULL AUTO_INCREMENT,
        driverFirstName VARCHAR(25) NOT NULL,
        driverLastName VARCHAR(25) NOT NULL,
        PlateNum VARCHAR(25) NOT NULL, 
        PRIMARY KEY(truckID)
    )";


$sql[6] = "CREATE TABLE orders(
    orderID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(orderID),
    dateIssued TIME DEFAULT CURRENT_TIMESTAMP,
    totalPrice INT,
    paymentmethod VARCHAR(25),
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES user(userID),
    receiptID INT NOT NULL,
    FOREIGN KEY (receiptID) REFERENCES shopping_cart(receiptID)
 )";
    

$sql[7] = "CREATE TABLE itemsInShoppingCart (
    itemID INT NOT NULL,
    receiptID INT NOT NULL,
    quantity INT,
    FOREIGN KEY (itemID) REFERENCES item(itemID),
    FOREIGN KEY (receiptID) REFERENCES shopping_cart(receiptID),
	itemsInShoppingCartID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(itemsInShoppingCartID)
    )";

$sql[8] = "CREATE TABLE trip(
    tripID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(tripID),
    truckID INT NOT NULL,
    FOREIGN KEY (truckID) REFERENCES truck(truckID),    
    orderID INT NOT NULL,
    FOREIGN KEY (orderID) REFERENCES orders(orderID),
    depCode INT NOT NULL,
	FOREIGN KEY (depCode) REFERENCES store(depCode),
    destinationID INT NOT NULL,
	FOREIGN KEY (destinationID) REFERENCES address(userID)
 )";

$sql[9] = "CREATE TABLE truckToGo (
    toGoID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(toGoID),
    truckID INT NOT NULL,
    FOREIGN KEY (truckID) REFERENCES truck(truckID),  
    Monday BOOLEAN DEFAULT 1, 
    Tuesday BOOLEAN DEFAULT 1,
    Wednesday BOOLEAN DEFAULT 1,
    Thursday BOOLEAN DEFAULT 1,
    Friday BOOLEAN DEFAULT 1,
    Saturday BOOLEAN DEFAULT 1,
    Sunday BOOLEAN DEFAULT 1
)";

$sql[8] = "CREATE TABLE discount(
    discountID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(discountID),
    itemID INT NOT NULL,
    FOREIGN KEY (itemID) REFERENCES item(itemID)  
 )";

     
    foreach($sql as $sql){
    if ($conn->query($sql)) {
        echo "Table Records created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
    $conn -> close();
?>
    </body>
</html>
