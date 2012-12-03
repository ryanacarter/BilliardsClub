<?php
	// connect to DB
	$db = new mysqli( 'localhost', 'root', 'root', 'billiards' );
	
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
	// write our query
	$sql = "DELETE FROM persons WHERE pID = " . $_GET[ 'id' ];
	
	// execute the query
	$db->query( $sql );
	
	// redirect back to the student listing
	header( 'location: roster.php' );