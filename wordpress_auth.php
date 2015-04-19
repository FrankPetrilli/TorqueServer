<?php
/*
 * Frank Petrilli | frank@petril.li | frank.petril.li
 * Language: PHP
 * Custom version of WP-Header which doesn't include 404.
 */
	require_once($_SERVER['DOCUMENT_ROOT'] . "/wp-config.php");
	$wp->init();
	$wp->parse_request();
	$wp->query_posts();
	$wp->register_globals();
	$wp->send_headers();
?>
