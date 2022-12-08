<!DOCTYPE html>
<html>
<head>
	<title>Database Display</title>


</head>
<body>
	<?php
		echo "<p>".$_POST['name']."</p>";
		echo "<p>".$_POST['lname']."</p>";
		echo "<p>".$_POST['address']."</p>";
		echo "<p>".$_POST['CCN']."</p>";
		echo "<p>".$_POST['date']."</p>";
		echo "<p>".$_POST['CVV']."</p>";
		
		$cnx = new mysqli('localhost','root','WWP6happygoldcranes','HW7');
		if($cnx->connect_error)
			die('Connection failed: '.$cnx->connect_error);
		$query = 'insert into client ( first_name, last_name, address, ccn, exp_date, cvv ) values ( "'.$_POST['name'].'","'.$_POST['lname'].'","'.$_POST['address'].'","'.$_POST['CCN'].'","'.$_POST['date'].'",'.$_POST['CVV'].')';
		echo"<p>".$query."</p>";
		$cursor = $cnx->query($query);
		$cnx->close();
		header("Location: http://localhost/index.php")
	?>
</body>
</html>
