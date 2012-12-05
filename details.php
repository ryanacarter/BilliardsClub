<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );

	// get the id of the student passed in
	$id = $_GET[ 'id' ];

	// create a SQL statement
	$sql = "SELECT * FROM persons WHERE pID = $id";

	// execute the query
	$result = $db->query( $sql );

	// get the data for this student
	$person = $result->fetch_assoc();

	// format the home phone
	$phone = '(' . substr( $person[ 'phone' ], 0, 3 ) . ') ' .
				 substr( $person[ 'phone' ], 3, 3 ) . '-' .
				 substr( $person[ 'phone' ], 6, 4 );
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Details for <?php echo $person[ 'first_name' ] . ' ' .$person[ 'last_name' ]; ?></title>
		<link rel="stylesheet" media="screen" href="style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h2>Details for <?php echo $person[ 'first_name' ] . ' ' .$person[ 'last_name' ]; ?></h2>
			<table>
				<tbody>
					<tr>
						<th scope="row"><label for="fn">First Name</label></th>
						<td><?php echo $person[ 'first_name' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="ln">Last Name</label></th>
						<td><?php echo $person[ 'last_name' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="phone">Phone</label></th>
						<td><?php echo $phone; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="relation">Relation</label></th>
						<td><?php echo $person[ 'relation' ]?></td>
					</tr>
				</tbody>
			</table>
			<?php
				$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );
				
				$email = $person[ 'email' ];
				
				$sqlTime = "SELECT * FROM timestamp WHERE email = $email";
			
				$resultTime = $db->query( $sqlTime);
			
				$time = $resultTime->fetch_assoc();
			?>
			<table>
				<tr>
					<th scope="col">Last Time Stamp</th>
				</tr>
				<tbody>
					<td>
						<?php echo $time[ 'dateStamp' ]; ?>
					</td>
				</tbody>
			</table>
			<p>
				<a class="button" href='roster.php'>Back to Student Listing</a>
			</p>
		</div>
	</body>
</html>