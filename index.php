<?php
  session_start();
  ?>
<html>
<head>
<title>Rajakaruna mudiyanselage lakshitha chathuranga srimal</title>
</head>
<body>

<h1>Chuck Severance's Resume Registry</h1>
<?php
if(isset($_SESSION['success'])) {
	echo "<font color='green'>".$_SESSION['success']."</font>";
}

if(isset($_SESSION['name'])) {
?>

<table>
	<tr>
		<td><a href="Logout.php" title="Logout">Logout<br></td>
	</tr>
	<tr>
		<td><?php include 'view.php';?></td>
	</tr>
	<tr>
		<td><a href="add.php" title="add">Add New Entry</td>
	</tr>
</table>
<?php	
}


else {
?>
<a href="login.php" tite="Login">Please log in<br>
<?php include 'view.php';
}?>

</body>
</html>