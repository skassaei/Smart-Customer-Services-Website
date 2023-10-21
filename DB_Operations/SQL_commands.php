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
    FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE,
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
    FOREIGN KEY (depCode) REFERENCES store(depCode) ON DELETE CASCADE
    )";

$sql[4] = "CREATE TABLE shopping_cart (
    receiptId int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(receiptId),
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES USER(userID) ON DELETE CASCADE
    )";


$sql[5] = "CREATE TABLE truck (
        truckID INT NOT NULL AUTO_INCREMENT,
        driverFirstName VARCHAR(25) NOT NULL,
        driverLastName VARCHAR(25) NOT NULL,
        PlateNum VARCHAR(25) NOT NULL UNIQUE, 
        PRIMARY KEY(truckID)
    )";


$sql[6] = "CREATE TABLE orders(
    orderID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(orderID),
    dateIssued TIME DEFAULT CURRENT_TIMESTAMP,
    totalPrice INT,
    paymentmethod VARCHAR(25),
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE,
    receiptID INT NOT NULL,
    FOREIGN KEY (receiptID) REFERENCES shopping_cart(receiptID)
 )";
    

$sql[7] = "CREATE TABLE itemsInShoppingCart (
    itemID INT NOT NULL,
    receiptID INT NOT NULL,
    quantity INT,
    FOREIGN KEY (itemID) REFERENCES item(itemID) ,
    FOREIGN KEY (receiptID) REFERENCES shopping_cart(receiptID) ON DELETE CASCADE,
	itemsInShoppingCartID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(itemsInShoppingCartID)
    )";

$sql[8] = "CREATE TABLE trip(
    tripID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(tripID),
    truckID INT NOT NULL,
    FOREIGN KEY (truckID) REFERENCES truck(truckID) ON DELETE CASCADE,    
    orderID INT NOT NULL,
    FOREIGN KEY (orderID) REFERENCES orders(orderID)
 )";

$sql[9] = "CREATE TABLE truckToGo (
    toGoID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(toGoID),
    truckID INT NOT NULL,
    FOREIGN KEY (truckID) REFERENCES truck(truckID) ON DELETE CASCADE,  
    Monday BOOLEAN DEFAULT 1, 
    Tuesday BOOLEAN DEFAULT 1,
    Wednesday BOOLEAN DEFAULT 1,
    Thursday BOOLEAN DEFAULT 1,
    Friday BOOLEAN DEFAULT 1,
    Saturday BOOLEAN DEFAULT 1,
    Sunday BOOLEAN DEFAULT 1
)";

$sql[10] = "CREATE TABLE discount(
    discountID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(discountID),
    itemID INT NOT NULL,
    FOREIGN KEY (itemID) REFERENCES item(itemID) ON DELETE CASCADE
 )";
 $sql[11] = "CREATE TABLE review(
    reviewID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(reviewID),
    userID INT NOT NULL ,
    FOREIGN KEY (userID) REFERENCES user(userID),
    userName  VARCHAR(300),
    itemID INT NOT NULL,
    FOREIGN KEY (itemID) REFERENCES item(itemID),
    userRN INT(1) NOT NULL  ,
    reviewTime DATETIME NOT NULL,
    userReview VARCHAR(300)
 )";



    $sql[12]="INSERT INTO `truck` (`truckID`, `driverFirstName`, `driverLastName`, `PlateNum`) VALUES
        (3, 'Mickey', 'Mouse', 'ABC-1234'),
        (4, 'Goofy', 'NoLastName', 'BCD-2345'),
        (5, 'Donald', 'Duck', 'CDE-3456'),
        (6, 'Tom', 'Holland', 'HKD_382'),
        (7, 'Dave', 'Mccary', 'XZR-1773')";

    $sql[13]= "INSERT INTO `trucktogo` (`toGoID`, `truckID`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`) VALUES
        (3, 3, 0, 0, 0, 1, 0, 0, 0),
        (4, 4, 1, 1, 0, 1, 1, 1, 1),
        (5, 5, 1, 1, 1, 1, 1, 1, 1),
        (6, 6, 0, 1, 0, 1, 0, 0, 1),
        (7, 7, 1, 1, 1, 0, 0, 0, 0)";

    $sql[14]="INSERT INTO `store` (`location`, `city`, `postalCode`, `depCode`) VALUES
        ('Markham St', 'Markham', 'L4K 5A9', 1),
        ('130 Spadina Avenue', 'Toronto', 'M5V 2K8', 2),
        ('925 Bloor St W', 'Toronto', 'M6H 1L5', 3),
        ('Mississauga St.', 'Mississauga', 'L5C 2V2', 4),
        ('Concord St.', 'Concord', 'L3R 3L5', 5),
        ('1422 Gerrard St E', 'Toronto', 'M4L 1Z6', 6),
        ('2681 Danforth Ave', 'Toronto', 'M4C 1L4', 7)";
    
    $sql[15]="INSERT INTO `item` (`itemName`, `madeIn`, `itemPic`, `itemID`, `quantity`, `price`, `depCode`) VALUES
    ('Blue-Gold Paint Cake', 'Blue', 'https://img.ltwebstatic.com/images3_pi/2022/10/09/1665298032ac95d0cf86ee7d5047e4e55a8700752e_thumbnail_900x.webp', 2, 12, 60, 3),
    ('Pastel Balloons Cake', 'Pink ', 'https://img.ltwebstatic.com/images3_pi/2022/03/08/164671221468f8b0c6dae874cd2cc89a30daad7f2a_thumbnail_900x.webp', 3, 6, 87, 3),
    ('Mermaid Tail Cake', 'Yellow', 'https://img.ltwebstatic.com/images3_pi/2022/09/06/166245183706fe96793373d924ea00129fbe6c58b4_thumbnail_900x.webp', 4, 2, 94, 1),
    ('Under The Sea Cupcake (5p', 'Purple', 'https://img.ltwebstatic.com/images3_pi/2022/05/18/1652858929ea4ef56e54b36403b040226960d2485c_thumbnail_900x.webp', 5, 5, 75, 1),
    ('Teddy Bear Cake', 'Brown, White', 'https://img.ltwebstatic.com/images3_pi/2023/02/02/167530179665b010fde6777e1599552f4a3de85830_thumbnail_900x.webp', 6, 3, 85, 2),
    ('Black Pearl Cake', 'Black', 'https://img.ltwebstatic.com/images3_pi/2023/01/08/1673148933cb78c2db0ac6c29073b49a377812f6ce_thumbnail_900x.webp', 7, 2, 120, 5),
    ('Little Animals Cake', 'Orange', 'https://img.ltwebstatic.com/images3_pi/2021/11/04/1635996040e84771fe7bc06d050492150308fe49fb_thumbnail_900x.webp', 8, 5, 65, 2),
    ('Pearl Crown Cake', 'Pink', 'https://img.ltwebstatic.com/images3_pi/2021/08/19/1629370399d40fbec401d56413fff146e29fbfa741_thumbnail_900x.webp', 9, 2, 75, 1)";
    
    
    $sql[15]="INSERT INTO `discount` (`discountID`, `itemID`) VALUES
    (2, 2),
    (4, 4),
    (5, 5),
    (3, 6),
    (1, 9)";

    $sql[16]="INSERT INTO `user` (`firstName`, `lastName`, `email`,`admin`, `password`,`phone`) VALUES
    (RegularUser, 'User', 'RegularUser@gmail.com', '0','RegularUser11','6476837294'),
    (RegularUser2, 'User2', 'RegularUser2@gmail.com', '0','RegularUser2','6476837292'),
    (AdminUser1, 'Admin', 'AdminUser1@gmail.com', '0','AdminUser1','64768374592')";




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
