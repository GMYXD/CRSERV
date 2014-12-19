<?php
function protected_pages() {
	if (logged_in() === false) {
		header("location: http://suda-tech.com/core");
	}
}

function current_date(){
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	if ($date < 9) {
		$date = "0$date";
	} else if ($month < 9) {
		$month = "0$month";
	}
	$current_date = "$year-$month-$date";
	return $current_date;
}

function current_time(){
	$info = getdate();
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	if ($sec < 9) {
		$sec = "0$sec";
	}
	$current_time = "$hour:$min:$sec";
	return $current_time;
}

function sanitize($data) {
	return mysql_real_escape_string($data);
}

function user_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		return $_SERVER['REMOTE_ADDR'];
	}
}

function datetime() {
	$date = current_date();
	$time = current_time();
	$result = "$date $time";
	return $result;
}
?>