<!DOCTYPE html>
<html>
<head>
	<title>Rajakaruna mudiyanselage lakshitha chathuranga srimal</title>
</head>
<body>
<h1>Deleteing Profile</h1>

<?php

session_start();

if(!isset($_SESSION['user_id'])){
    die("ACCESS DENIED");
    return;
  }

if(isset($_POST['cancel'])){
    header("Location: index.php");
    return;
  }

	$id  = $_GET['id'] ;

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "misc";

    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   

	if(isset($_POST['delete'])){
		$_SESSION['success']="profile deleted";
		$st = $dbh->prepare('DELETE FROM profile WHERE profile_id="'.$_SESSION['id'].'";');
    	$st->execute();

		header("Location: index.php");
    	return;
  }else{


     $_SESSION['id']=$_GET['id'];
  	 $stmt = $dbh->prepare('SELECT first_name,last_name From profile WHERE profile_id="'.$_SESSION['id'].'";');
     $stmt->execute();
	if($stmt->rowCount()>0){
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		$fname=$row['first_name'];
		$lname=$row['last_name'];

		echo "First Name: ".$fname."<br><br>";
		echo "Last Name: ".$lname."<br><br>";
		}
	}

  }


  	

?>

	<form method="POST" action="delete.php">
		<input type="submit" value="Delete" name="delete">
  		<input type="submit" value="Cancel" name="cancel" ><br>
	</form>

</body>
</html>