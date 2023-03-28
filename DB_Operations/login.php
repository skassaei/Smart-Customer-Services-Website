<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
	
    include 'dbconnect.php';
	$pass = $_POST['pass'];
	
    $sql=mysqli_query($conn,"SELECT * FROM user where email='$email'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
			if  (password_verify($pass, $row['password'])){
				$_SESSION["ID"] = $row['userID'];
				$_SESSION["email"]=$row['email'];
				$_SESSION["first_name"]=$row['firstName'];
				$_SESSION["last_name"]=$row['lastName'];
				$_SESSION['loggedin'] = true;
				if ($row['admin'] != 0){
					$_SESSION['isAdmin'] = true;
				}else{
					unset($_SESSION['isAdmin']);
				}
				

			// Check if user has a receiptID
			$userID = $row['userID'];
			
			$query = "SELECT receiptId FROM shopping_cart WHERE userID = $userID";
			$result = mysqli_query($conn, $query);

			if(mysqli_num_rows($result) == 0){
				// If user doesn't have a receiptID, assign one and add them to shopping_cart table
				//$receiptID = uniqid(); // Generate unique receiptID
				$insert_query = "INSERT INTO shopping_cart (userID) VALUES ($userID)";
				mysqli_query($conn, $insert_query);
			}

			header("Location: ../home.php");
		}
		else {
			echo "<script>
				alert('Invalid Password');
				window.location.href='../login.html';
				</script>";
			}
		
    }
    else
    {
        echo "<script>
				alert('Invalid Email. Please try again');
				window.location.href='../login.html';
				</script>";
			
    }
	exit();
}
?>