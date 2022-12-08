<!DOCTYPE html>
<html>
<head>
	<title>Database Display</title>


</head>
<body>
	<table align="center" border="1">
			<tr>
			<td>product_id</td>
			<td>relation</td>
			<td>Product Name</td>
			<td>Product Description</td>
			<td>Remote Image</td>
			<td>Product Price</td>
			<td>Review Score</td>
			<td>Button</td>
			</tr>
	<?php
		$cnx = new mysqli('localhost','root','pass','database');
		if($cnx->connect_error)
			die('Connection failed: '.$cnx->connect_error);
		$query = 'select * from products';
		$cursor = $cnx->query($query);
		
		while($row = $cursor->fetch_assoc()){
			
			echo '<tr>';
			echo '<td>' . $row['product_id'] . '</td>';
			echo '<td>' . $row['relation'] . '</td>';
			echo '<td>' . $row['Product Name'] . '</td>';
			echo '<td>' . $row['Product Description'] . '</td>';
			echo '<td><img src="'.$row['Remote Image URL'].'" width="90" height="90"></td>';
			echo '<td>$'. number_format($row['Product Price'] *1.05 + .005,2). '</td>';
			echo '<td>'. $row['Review Score'] . '</td>';
			echo '<td><a href="http://localhost/comp.php?var='.$row['relation'].'"><button>BUY</button> </a></td>';
			echo '</tr>';
		}
		$cnx->close();
	?>
	</table>
</body>
</html>
