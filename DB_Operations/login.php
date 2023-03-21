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
			$_SESSION["ID"] = $row['ID'];
			$_SESSION["email"]=$row['Email'];
			$_SESSION["first_name"]=$row['firstName'];
			$_SESSION["last_name"]=$row['lastName'];
			$_SESSION["username"]=$row['username'];
			$_SESSION['loggedin'] = true;
			if ($row['admin'] != 0){
				$_SESSION['isAdmin'] = true;
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