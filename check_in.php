<?php

	if ( isset( $_POST[ 'email' ] ) ) {
		
		//create a connection to the database
		$db = new mysqli('localhost', 'root', 'root', 'billiards');

		// create a SQL statement
		$sql = $db->prepare( "INSERT INTO timestamp SET dateStamp = CURDATE() WHERE	email = ?");

		// extract our values from $_POST
		extract( $_POST );

		// bind parameters from our form
		$sql->bind_param( 's', $email);

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
		<title>Time Stamp</title>
		<link rel="stylesheet" media="screen" href="style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h2>Time Stamp</h2>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="email">Email</label></th>
							<td><input type="text" name="email" id="email" /></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" value="Add TimeStamp" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<a class="button" href="">Go Back to Roster</a>
		</div>
	</body>
</html>