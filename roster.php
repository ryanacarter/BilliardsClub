<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Billiards Club</title>
		<link rel="stylesheet" media="screen" href="style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h2>Billiards Club Members</h2>
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
			?>
					<table>
						<thead>
							<tr>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Email</th>
								<th scope="col">Phone</th>
								<th scope="col">Status</th>
								<th scope="col">Options</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while ( $person = $persons->fetch_assoc() ) {
								
								$phone = '(' . substr( $person[ 'phone' ], 0, 3 ) . ') ' .
											 substr( $person[ 'phone' ], 3, 3 ) . '-' .
											 substr( $person[ 'phone' ], 6, 4 );
											
								echo '<tr>';
								echo '<td>' . $person[ 'first_name' ] . '</td>
								<td>' . $person[ 'last_name' ] . '</td>
								<td>' . $person[ 'email' ] . '</td>
								<td>' . $phone . '</td>
								<td>' . $person[ 'relation'] . '</td>';
								echo '<td>';
								echo '<a href="edit.php?id=' . $person[ 'pID' ] . '">Edit</a> ';
								echo '<a onclick="return confirm( \'Are you sure?\' );" href="delete.php?id=' . $person[ 'pID' ] . '">Delete</a>';
								echo '</td>';
								echo '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php
				} else {
					// nope, there were no students in the DB
					echo '<p>No Members.</p>';
				}
			?>
			<p>
				<a class="button" href="add_member.php">Add New Member</a>
				<a class="button" href="index.html">Go Back to Home Page</a>
			</p>
		</div>
	</body>
</html>