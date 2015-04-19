<?php 
/*
 * Frank Petrilli | frank@petril.li | frank.petril.li
 * Language: PHP
 * Returns an array of every data point from this ID.
 * Warning: This is //HEAVY// on I/O for heavy users. Only really useful for exports and the like.
 */
	// Use key as auth.
	require_once('db.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die("You must set an id");
	}

	if (isset($_GET['time'])) {
		$time = $_GET['time'];
		$stmt = $conn->prepare("SELECT * FROM api_torque WHERE id = ? AND time=?");
		$stmt->bind_param("si", $id, $time);
	} else {
		// If we haven't asked for a specific time.
		$stmt = $conn->prepare("SELECT * FROM api_torque WHERE id = ?");
		$stmt->bind_param("s", $id);
	}


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
