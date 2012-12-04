<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Billiards Club Mailing List</title>
		<link rel="stylesheet" media="screen" href="" />
	</head>
	<body>
		<?php
			// create a connection to our database
			$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );

			// write a SQL query to get all students
			$sql = "SELECT * FROM persons";

			// execute the query on the database
			$persons = $db->query( $sql );
			
			// check to see if the query returned any rows
			if ( $persons->num_rows > 0 ) {
				// yes! it returned rows
				// diplay the results
				while ( $person = $persons->fetch_assoc() ) {
					echo '<p>' . $person[ 'email' ] . '<p>';
				}
			} else {
				// nope, there were no students in the DB
				echo '<p>No Members.</p>';
			}
		?>
		<a class="button" href="index.html">Go Back to Home Page</a>
	</body>
</html>

