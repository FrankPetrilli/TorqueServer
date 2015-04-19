<?php
/*
 * Frank Petrilli | frank@petril.li | frank.petril.li
 * Language: PHP
 * Gets the list of IDs which have sent data to our server.
 */

// Check WordPress login, since this retrieves auth keys.
require_once($_SERVER['DOCUMENT_ROOT'] . "/api/wordpress_auth.php");
if (!is_user_logged_in()) {
	// Manually construct a JSON failure because I'm lazy.
	echo '[{"id":"not logged in"}]';
	die();
} else {
	// In case I want them.
	//$user = wp_get_current_user();
	//$name = $user->first_name . " " . $user->last_name;
}

require_once("db.php");

$stmt = $conn->prepare("SELECT id FROM api_torque GROUP BY id");
$stmt->execute();

$result = $stmt->get_result();

$results = array();
while ($row = $result->fetch_object()) {
	$results[] = $row;
}

// Send the data back as a JSON array of objects.
echo json_encode($results);

$stmt->close();
$result->close();
$conn->close();

?>
