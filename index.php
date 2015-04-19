<?php
/*
 * Frank Petrilli | frank@petril.li | frank.petril.li
 * Language: PHP / HTML
 * Web client for PHP endpoint for Torque Application for Android.
 */
	// Check WordPress login to make sure they're authorized to be here.
	require_once($_SERVER['DOCUMENT_ROOT'] . "/api/wordpress_auth.php");
	if (!is_user_logged_in()) {
		// Redirect the user to a login page with a redirect back here when they're done.
		$newUrl = wp_login_url(site_url($_SERVER['REQUEST_URI']));
		header('Location: ' . $newUrl);
		// In case they don't get redirected.
		echo "<a href='/wp-login.php'>Click here to be redirected to the login</a>";
		die(); // Make sure they don't get any further.
	} else {
		// Get some info about the user.
		$user = wp_get_current_user();
		$name = $user->first_name . " " . $user->last_name;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
  <link rel="stylesheet" type="text/css" href="support/style.css">
  <!--Custom font support. I like Roboto. -->
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

  <title>Torque API Client</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCzmUfVDtXYTIvzxgnRBG5fapSg59dOY8c" type="text/javascript"></script>
  <script src="support/torque-client.js" type="text/javascript"></script>
</head>

<body>
  <h1>Torque Client</h1>
  <h4>Welcome, <?= $name ?> </h4>
  <select id="user_id_dropdown">
	<option value="0">Select a user ID</option>
  </select>
  <button onclick="updateData(getSelectedText('user_id_dropdown'))">Run</button>
  <br>
  <br>
  <div id="googleMap"></div>
  <table id="data">
	  <thead>
		  <th>Category</th>
		  <th>Information</th>
	  </thead>
	  <tr>
		  <td>Timestamp:</td>
		  <td id="time">waiting for data</td>
	  </tr>
	  <tr>
		  <td>RPM:</td>
		  <td id="rpm">waiting for data</td>
	  </tr>
	  <tr>
		  <td>Latitude:</td>
		  <td id="lat">waiting for data</td>
	  </tr>
	  <tr>
		  <td>Longitude:</td>
		  <td id="longitude">waiting for data</td>
	  </tr>
	  <tr>
		  <td>Speed:</td>
		  <td id="speed_obd">waiting for data</td>
	  </tr>
	  <tr>
		  <td>MPG (instant):</td>
		  <td id="mpg_instant">waiting for data</td>
	  </tr>

  </table>
  <div id="options">
  	<h3>Options:</h3>
  	<input type="checkbox" id="should_center" checked="true">Center map on new data</input><br>
  	<input type="checkbox" id="should_zoom" checked="true">Zoom map on new data</input><br>
  	<input type="checkbox" id="kph">Use KP/H instead of MPH</input>
  </div>
</body>
</html>
