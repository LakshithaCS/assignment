

<html>
<head>
  <title>Rajakaruna mudiyanselage lakshitha chathuranga srimal</title>
</head>
<body>
<h1>Adding Profile For UMSI</h1>

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

if(isset($_POST["Fname"]) && isset($_POST["Lname"]) && isset($_POST["email"]) && isset($_POST["headline"]) && isset($_POST["summery"])){
	if(strlen($_POST["Fname"])==0 || strlen($_POST["Lname"])==0 || strlen($_POST["email"])==0 || strlen($_POST["headline"])==0 || strlen($_POST["summery"])==0){
		echo "<font color='red'>All fields are required</font>";}

  else if (!strpos($_POST["email"], '@',0)) {
    echo "<font color='red'>Email address must contain @</font>";

	
	}else{
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "misc";

    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('INSERT INTO Profile
        (user_id, first_name, last_name, email, headline, summary)
        VALUES ( :uid, :fn, :ln, :em, :he, :su)');
    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['Fname'],
        ':ln' => $_POST['Lname'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summery'])
    );

    $_SESSION['success']="profile added";
    header("Location: index.php");
    return;
	}
}



?>



  <form method="POST" action="add.php">

  <label for="Fname">First Name:</label>
  <input type="text" id="Fname" name="Fname" ><br><br>

  <label for="Lname">Last Name:</label>
  <input type="text" id="Lname" name="Lname" ><br><br>

  <label for="email">Email:</label>
  <input type="text" id="email" name="email" ><br><br>

  <label for="headline">Headline:</label>
  <input type="text" id="headline" name="headline" ><br><br>

  <label for="summery">Summary:</label>
  <textarea name="summery" id="summery" rows=6 cols=30></textarea><br><br>

  <input type="submit" value="Add" name="add">
  <input type="submit" value="Cancel" name="cancel"><br>
  </form>

</body>
</html>