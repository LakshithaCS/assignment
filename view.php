<!DOCTYPE html>
<html>
<head>
	<title>Rajakaruna mudiyanselage lakshitha chathuranga srimal</title>
</head>

<body>

	<?php 		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "misc";

			$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$sth = $dbh->prepare("SELECT profile_id,first_name	,last_name, headline FROM profile");
			$sth->execute();
				

			if($sth->rowCount()>0){
				echo "<table align ='left' border=1 cellpadding=0 cellspacing=0 bordercolor='black'>
						<tr>
						<th>Name</th>
						<th>headline</th>";
				if(isset($_SESSION['name'])){

				echo "<th>Action</th>";
				}

				echo "</tr>";

				
				while($row = $sth->fetch(PDO::FETCH_ASSOC)){

				?>
					<tr>
    				<td><?php echo $row["first_name"]." ".$row["last_name"]; ?></td>
    				<td><?php echo $row["headline"]; ?></td>

  				    <?php
  				    if(isset($_SESSION['name'])){
  				    ?>

   					<td><a href="edit.php?id=<?php echo $row['profile_id']; ?>">Edit</a> <a href="delete.php?id=<?php echo $row['profile_id']; ?>">Delete</a></td>

    				<?php
    				}
    				?>

  					</tr>	

				<?php	
				}

					echo "</table><br>";
			
				}
			

	?>

</body>
</html>

