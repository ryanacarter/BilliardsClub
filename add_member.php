<?php
	// check to see if we're coming to this page after having
	// submitted the form
	if ( isset( $_POST[ 'first_name' ] ) ) {

		// we have values, let's try to insert new student into the db
		// connect
		$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );
	
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}

		// create a SQL statement
		$sql = $db->prepare(
			"INSERT INTO persons (first_name,last_name,email,phone,relation) 
			 VALUES (?,?,?,?,?)");

		// extract our values from $_POST
		extract( $_POST );

		// get rid of non-digits in our home phone number
		$phone = preg_replace( '/\D/', '', $phone );

		// bind parameters from our form
		$sql->bind_param( 'sssss', $first_name, $last_name, $email, $phone, $relation );

		// execute the query
		$sql->execute();

		// redirect back to the list of students page
		header( "Location: roster.php" );
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Add a Member</title>
		<link rel="stylesheet" media="screen" href="style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Add Member</h1>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="first_name">First Name</label></th>
							<td><input type="text" name="first_name" id="first_name" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="last_name">Last Name</label></th>
							<td><input type="text" name="last_name" id="last_name" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="email">Email</label></th>
							<td><input type="text" name="email" id="email" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="phone">Phone</label></th>
							<td><input type="text" name="phone" id="phone" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="relation">Relation</label></th>
							<td>
								<select>
									<option value="">Select a Relation...</option>
									<option value="A Team">A Team</option>
									<option value="B Team">B Team</option>
									<option value="Member">Member</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" value="Add Student" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<a class="button" href="roster.php">Go Back to Roster</a>
		</div>
	</body>
</html>