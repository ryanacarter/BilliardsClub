<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );
	
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
