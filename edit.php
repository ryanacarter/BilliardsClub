<?php
		// connect to the DB
		$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );

	if ( isset( $_POST[ 'first_name' ] ) ) {
			// we have values, let's try to insert new student into the db
			// create a SQL statement
			$sql = $db->prepare( "UPDATE persons 
								  SET 	 first_name = ?,
										 last_name = ?,
										 email = ?,
										 phone = ?,
										 relation = ?
								  WHERE  pID = ?" );

			// extract our values from $_POST
			extract( $_POST );

			// get rid of non-digits in $phone
			$phone = preg_replace( '/\D/', '', $phone );

			// bind parameters from our form
			$sql->bind_param( 'sssssi', $first_name, $last_name, $email, $phone, $relation, $pID );

			// execute the query
			$sql->execute();

			// redirect back to the list of students page
			header( "Location: roster.php" );
		} else {
			// get the id of the student passed in
			$id = $_GET[ 'id' ];
		
			// create a SQL statement
			$sql = "SELECT * FROM persons WHERE pID = $id";
		
			// execute the query
			$result = $db->query( $sql );
		
			// get the data for this student
			$persons = $result->fetch_assoc();
		
			// format the home phone
			$phone = '(' . substr( $persons[ 'phone' ], 0, 3 ) . ') ' .
						 substr( $persons[ 'phone' ], 3, 3 ) . '-' .
						 substr( $persons[ 'phone' ], 6, 4 );			
		}
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
			<h2>Update <?php echo $persons[ 'first_name' ]?> <?php echo $persons[ 'last_name' ]?></h2>
			<form method="post" action="update.php">
				<input type="hidden" name="pID" value="<?php echo $persons[ 'pID' ]; ?>" />
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="fn">First Name</label></th>
							<td><input type="text" name="first_name" id="fn" value="<?php echo $persons[ 'first_name' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="last_name">Last Name</label></th>
							<td><input type="text" name="last_name" id="last_name" value="<?php echo $persons[ 'last_name' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="email">Email</label></th>
							<td><input type="text" name="email" id="email" value="<?php echo $persons[ 'email' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="phone">Phone</label></th>
							<td><input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="relation">Relation</label></th>
							<td>
								<select name="relation" id="relation">
									<option value="A Team"<?php echo ( 'A Team' == $persons[ 'relation' ] ) ? ' selected="selected"' : ''; ?>>A Team</option>
									<option value="B Team"<?php echo ( 'B Team' == $persons[ 'relation' ] ) ? ' selected="selected"' : ''; ?>>B Team</option>
									<option value="Member"<?php echo ( 'Member' == $persons[ 'relation' ] ) ? ' selected="selected"' : ''; ?>>Member</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" name="submit" value="Update" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>
</html>