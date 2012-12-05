<?php

	if ( isset( $_POST[ 'email' ] ) ) {
		
		//create a connection to the database
		$db = new mysqli('localhost', 'root', 'root', 'billiards');

		// create a SQL statement
		$sql = $db->prepare(
			"INSERT INTO timestamp ( email, dateStamp) " . "
			 VALUES (?,?)");
		// extract our values from $_POST
		extract( $_POST );

		// bind parameters from our form
		$sql->bind_param( 'ss', $email, $dateStamp);
		
		$success = $sql->execute();
		
		if ( $success ) {
			// redirect back to the listing of restaurants
			$message = "<h2>Thank You!!!</h2>";
			header( 'location: check_in.php?message=' . urlencode( $message ) );
		} else {
			// go back to the form and give an error message
			$message = "<h2>Please Enter A Valid Email Address!</h2>";
			header( 'location: check_in.php?message=' . urlencode( $message ) );
		}
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
			<?php
	            if ( isset( $_GET[ 'message' ] ) ) {
	                echo urldecode( $_GET[ 'message' ] );
	            }
	        ?>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<table>
					<input type="hidden" name="dateStamp" value= <?php echo date("m.d.y");?> />
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
			<a class="button" href="index.html">Go Back to Homepage</a>
		</div>
	</body>
</html>