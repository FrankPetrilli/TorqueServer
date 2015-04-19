<?php
/*
 * Frank Petrilli | frank@petril.li | frank.petril.li
 * Language: PHP
 * Where the Torque application should be pointed at. This file takes in the data from the user and collects it into a DB.
 */
	require_once('db.php');
	if (isset($_GET['v'])) {
		$version = $_GET['v'];
	}

	if (isset($_GET['session'])) {
		$session= $_GET['session'];
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	if (isset($_GET['time'])) {
		$time = $_GET['time'];
	}

	if (isset($_GET['kff1005'])) {
		$longitude = $_GET['kff1005'];
	}

	if (isset($_GET['kff1006'])) {
		$lat = $_GET['kff1006'];
	}

	if (isset($_GET['kd'])) {
		$speed_obd = $_GET['kd'];
	}

	if (isset($_GET['k11'])) {
		$throttle_position = $_GET['k11'];
	}

	if (isset($_GET['kc'])) {
		$rpm = $_GET['kc'];
	}

	if (isset($_GET['kff1201'])) {
		$mpg_instant = $_GET['kff1201'];
	}

	if (isset($_GET['kff5201'])) {
		$mpg_average = $_GET['kff5201'];
	}

	if (isset($_GET['kff1001'])) {
		$speed_gps = $_GET['kff1001'];
	}

	if (isset($_GET['k5'])) {
		$coolant_temp = $_GET['k5'];
	}

	// Prepare an SQL statement
	$stmt = $conn->prepare("INSERT INTO api_torque (v, session, id, time, lat, longitude, speed_obd, speed_gps, throttle_position, rpm, mpg_instant, mpg_average, coolant_temp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	// Bind our data into it.
	$stmt->bind_param('iisiddddddddd', $version, $session, $id, $time, $lat, $longitude, $speed_obd, $speed_gps, $throttle_position, $rpm, $mpg_instant, $mpg_average, $coolant_temp);
	$stmt->execute();
	// Thanks to https://github.com/econpy/torque/blob/master/web/data/torque_keys.csv for an explanation of what some of these mean...
	$stmt->close();
	$conn->close();
?>
OK!
