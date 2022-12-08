<!DOCTYPE html>
<html>
<head>
	<title>Database Display</title>


</head>
<body>

	<?php
		
	$rel = $_GET['var'];
	?>
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
		$cnx = new mysqli('localhost','root','WWP6happygoldcranes','HW7');
		if($cnx->connect_error)
			die('Connection failed: '.$cnx->connect_error);
		$query = 'select * from products where relation = '.$rel;
		
		$cursor = $cnx->query($query);
		$row1 = $cursor->fetch_assoc();
		$row2 = $cursor->fetch_assoc();
			
		echo '<tr>';
		echo '<td>' . $row1['product_id'] . '</td>';
		echo '<td>' . $row1['relation'] . '</td>';
		echo '<td>' . $row1['Product Name'] . '</td>';
		echo '<td>' . $row1['Product Description'] . '</td>';
		echo '<td><img src="'.$row1['Remote Image URL'].'" width="90" height="90"></td>';
		if( $row1['Product Price']<$row2['Product Price']){
			echo '<td><font color="green">$'. number_format($row1['Product Price'] *1.05 + .005,2). '</font></td>';
		}
		else
			echo '<td>$'. number_format($row1['Product Price'] *1.05 + .005,2). '</td>';
		echo '<td>'. $row1['Review Score'] . '</td>';
		echo '<td><a href="http://localhost/buy.php?var='.$row1['product_id'].'"><button>BUY</button> </a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>' . $row2['product_id'] . '</td>';
		echo '<td>' . $row2['relation'] . '</td>';
		echo '<td>' . $row2['Product Name'] . '</td>';
		echo '<td>' . $row2['Product Description'] . '</td>';
		echo '<td><img src="'.$row2['Remote Image URL'].'" width="90" height="90"></td>';
		if( $row1['Product Price']>$row2['Product Price']){
			echo '<td ><font color="green">$'. number_format($row2['Product Price'] *1.05 + .005,2). '</font></td>';
		}
		else
			echo '<td>$'. number_format($row2['Product Price'] *1.05 + .005,2). '</td>';
		echo '<td>'. $row2['Review Score'] . '</td>';
		echo '<td><a href="http://localhost/buy.php?var='.$row2['product_id'].'"><button>BUY</button> </a></td>';
		echo '</tr>';
		
		
		$cnx->close();
	?>
	</table>
	<a href="http://localhost/index.php"><button>BACK</button> </a>
</body>
</html>
