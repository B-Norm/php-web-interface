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
		if
		($query = "	SELECT c.*
					FROM state as s JOIN customer as c ON s.stateAb = c.stateAb
					WHERE s.stateAb = :stateAb or s.stateName = :state ")
		{
			if($query == null)
			{
				echo "No Record Availible";
				die();
			}
			else
			{
				$stmt= $conn->prepare($query);
				$stmt->execute(array(":stateAb" => $stateAb, ":state" => $state));
				$rows=$stmt->fetchALL(PDO::FETCH_ASSOC);
			}
		}
	}
	
?>

<html>
	<head>
		<title> Display Table</title>
		<style type="text/css">
			table{
				border-collapse: collapse;
				width:70%;
				color: #d96400;
				font-family:monospace;
				font-size: 20px;
				text-align: left;
			}
			th{
				background-color: #d9640
				color: white;
			}
			tr:nth-child(even){backgroud-color:#f2f2f2}
		</style>
	</head>
	<body>
		<table>
			<tr>
				<th> Customer Id</th>
				<th> Name</th>
				<th> Street</th>
				<th> City</th>
				<th> State</th>
				<th> Zipcode</th>
			</tr>
			<?php
			foreach($rows as $row) {
				echo "<tr><td>".$row["cID"]."</td><td>".$row["name"]."</td><td>".$row["street"]."</td><td>".$row["city"]."</td><td>".$row["stateAb"]."</td><td>".$row["zipcode"];
			}
			echo "</table>";
			
			?>
		</table>
	</body>
</html>
