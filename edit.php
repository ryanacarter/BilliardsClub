<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );
	
	// check to see if we're coming to this page after having
	// submitted the form
	if ( isset( $_POST[ 'firstname' ] ) ) {
	
		// we have values, let's try to insert new student into the db
		// create a SQL statement
		$sql = $db->prepare( "UPDATE students 
							  SET 	 firstname = ?,
									 lastname = ?,
									 email = ?,
									 phone = ?,
									 relation = ?,
							  WHERE  pID = ?" );
							  
		// extract our values from $_POST
		extract( $_POST );
		
		// get rid of non-digits in our home phone number
		$phone = preg_replace( '/\D/', '', $phone );
		
		// bind parameters from our form
		$sql->bind_param( 'sssssssssi', $first_name, $last_name, $email, $phone, $relation, $pID );
		
		// execute the query
		$sql->execute();
		
		// redirect back to the list of students page
		header( "Location: /340/index.php" );
	} else {
		// get the id of the student passed in
		$pID = $_GET[ 'id' ];
		
		// create a SQL statement
		$sql = "SELECT * FROM persons WHERE pID = $pID";
		
		// execute the query
		$result = $db->query( $sql );
		
		// get the data for this student
		$persons = $result->fetch_assoc();
		
		// format the home phone
		$phone = '(' . substr( $persons[ 'phone' ], 0, 3 ) . ') ' .
					 substr( $persons[ 'phone' ], 3, 3 ) . '-' .
					 substr( $persons[ 'phone' ], 6, 4 );
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Update a Member</title>
		<link rel="stylesheet" media="screen" href="style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Update a Member</h1>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<input type="hidden" name="id" value="<?php echo $persons[ 'pID' ]; ?>" />
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="first_name">First Name</label></th>
							<td><?php echo $persons[ 'first_name' ]; ?></td>
						</tr>
						<tr>
							<th scope="row"><label for="last_name">Last Name</label></th>
							<td><?php echo $persons[ 'last_name' ]; ?></td>
						</tr>
						<tr>
							<th scope="row"><label for="phone">Phone</label></th>
							<td><?php echo $persons[ 'phone' ]; ?></td>
						</tr>
						<tr>
							<th scope="row"><label for="relation">Relation</label></th>
							<td><?php echo $persons[ 'relation' ]?></td>
						</tr>
					</tbody>
				</table>
				<p>
					<a class="button" href='roster.php'>Back to Student Listing</a>
				</p>
			</div>
		</body>
	</html>