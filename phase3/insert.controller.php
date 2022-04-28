<?php
	$host = "localhost:3306";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "art gallery";
	// connect to db
	$conn = new PDO("mysql:host=".$host.";dbname=".$dbname, $dbusername, $dbpassword);
	// check connection
	if(!$conn)
	{
		die("connection failed");
	}
	else
	{
		// get fields
		$stateAb = filter_input(INPUT_POST, "stateab");
		$state = filter_input(INPUT_POST, "state");
		// do query
		$query = "	INSERT INTO state (stateAb, stateName)
					values			  ('$stateAb' , '$state') ";
		if($conn->query($query)) {
			echo "New record is inserted sucessfully";
		}
		else{
			echo "Error: ".$query ."
			". $conn->error;
		}
	}
?>
