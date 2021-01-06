<html>
<head>
  <title>Rajakaruna mudiyanselage lakshitha chathuranga srimal</title>
</head>
<body>

  <h1>Please Log In</h1>

<?php

  session_start();
  unset($_SESSION['name']);
  unset($_SESSION['user_id']);
  unset($_SESSION['success']);

  if(isset($_POST['cancel'])){
    header("Location: index.php");
    return;
  }

  $salt='XxZz12*_';

  if(isset($_POST["email"]) && isset($_POST["password"])){
    if(strlen($_POST['email'])<1 || strlen($_POST['password'])<1){
      $_SESSION['error']="Email and password are required";
      header("Location: login.php");
      return;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "misc";

    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT user_id , name FROM users WHERE email=:em AND password=:pw');
    $stmt->execute(array(':em'=>$_POST['email'], ':pw' =>$_POST['password']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row!=false){
      $_SESSION['name']=$row['name'];
      $_SESSION['user_id']=$row['user_id'];
      header("Location: index.php");
      return;
    }else{
      echo "<font color='red'>Incorrect Password</font>";
    }

  }

?>

  <form method="POST" action="login.php">

  <label for="email">Email</label>
  <input type="text" id="email" name="email" ><br><br>

  <label for="password">Password</label>
  <input type="Password" id="password" name="password"><br><br>

  <input type="submit" value="Login" name="login" onclick="doValidate()">
  <input type="submit" value="Cancel" name="cancel"><br>
  </form>



  <script type="text/javascript">
    function doValidate() {
      console.log('Validating...');
      try {
        email=document.getElementById('email').value;
          pw = document.getElementById('password').value;
          console.log("Validating email="+email+ "email=" +pw);
        if (email == null || email == "" || pw == null || pw == "") {
            alert("Both fields must be filled out");
            return false;
        }
        if(email.indexOf('@')==-1){
          alert("Invalid email address");
            return false;
        }
        return true;
       } catch(e) {

        return false;
        }
       return false;
    }
  </script>

</body>
</html>