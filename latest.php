<?php 
/*
 * Frank Petrilli | frank@petril.li | frank.petril.li
 * Language: PHP
 * Used to retrieve the latest data point collected by our API.
 * Still returns an array of JSON objects, because consistency. :)
 */
	require_once('db.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die("You must set an id");
	}

	$stmt = $conn->prepare("SELECT * FROM api_torque WHERE id = ? AND time=(SELECT MAX(time) FROM api_torque WHERE id = ?)");
	$stmt->bind_param("ss", $id, $id);
	$stmt->execute();

	$result = $stmt->get_result();

	$results = array();
	while ($row = $result->fetch_object()) {
		$results[] = $row;
	}

	echo json_encode($results);
	$stmt->close();
	$result->close();
	$conn->close();
?>
