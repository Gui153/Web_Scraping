<!DOCTYPE html>
<html>
<head>
	<title>Database Display</title>


</head>
<body>

	<?php
		
	$pid = $_GET['var'];
	?>
	
	<form action="http://localhost/confirm.php" method="post">
	First Name:<input type="text" name="name"/><br>
	Last  Name:<input type="text" name="lname"/><br>
	Address:<input type="text" name="address"/><br>
	Credit Card Number:<input type="text" name="CCN"/><br>
	Date:<input type="date" name="date"/> CVV:<input type="password" name="CVV"/><br>
	<input type="submit"> <a href="http://localhost/index.php"><button type="button">BACK</button></a>
	</form>
	
	</table>
</body>
</html>
