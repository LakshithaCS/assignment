
<html>
<head>
  <title>Rajakaruna mudiyanselage lakshitha chathuranga srimal</title>
</head>
<body>

  <h1>Editing Profile For UMSI</h1>


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



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "misc";

    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  

  if(isset($_POST['update'])){

    $fname= $_POST['Fname'];
    $lname=$_POST['Lname'];
    $email=$_POST['email'];
    $headline=$_POST['headline'];
    $summary=$_POST['summery'];

    if(strlen($_POST["Fname"])==0 || strlen($_POST["Lname"])==0 || strlen($_POST["email"])==0 || strlen($_POST["headline"])==0 || strlen($_POST["summery"])==0){
    echo "<font color='red'>All fields are required</font>";}

    else if (!strpos($_POST["email"], '@',0)) {
    echo "<font color='red'>Email address must contain @</font>";

  
    }else{
     $_SESSION['success']="profile updated";
     $st = $dbh->prepare('UPDATE profile 
      SET user_id=:uid, first_name=:fn, last_name=:ln, email=:em, headline=:he, summary=:su
      WHERE profile_id="'.$_SESSION['id'].'";');

    echo $_POST['Fname'];

    $st->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['Fname'],
        ':ln' => $_POST['Lname'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summery']));

    header("Location: index.php");
      return;
    }

  }else{
    $_SESSION['id']=$_GET['id'];
    $stmt = $dbh->prepare('SELECT * From profile WHERE profile_id="'.$_GET['id'].'";');
    $stmt->execute(); 
    if($stmt->rowCount()>0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $fname=$row['first_name'];
    $lname=$row['last_name'];
    $email=$row['email'];
    $headline=$row['headline'];
    $summary=$row['summary'];
    }

  }
  }


?>


  <form method="POST" action="edit.php">

  <label for="Fname">First Name:</label>
  <input type="text" id="Fname" name="Fname" value=<?php echo $fname; ?> ><br><br>

  <label for="Lname">Last Name:</label>
  <input type="text" id="Lname" name="Lname" value=<?php echo $lname; ?>><br><br>

  <label for="email">Email:</label>
  <input type="text" id="email" name="email" value=<?php echo $email; ?>><br><br>

  <label for="headline">Headline:</label>
  <input type="text" id="headline" name="headline" value=<?php echo $headline; ?>><br><br>

  <label for="summery" >Summary:</label>
  <textarea name="summery" id="summery" rows=6 cols=30><?php echo $summary; ?></textarea><br><br>

   <input type="submit" value="Update" name="update">
  <input type="submit" value="Cancel" name="cancel"><br>
  </form>

</body>
</html>