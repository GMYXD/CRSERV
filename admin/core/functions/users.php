<?php
function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
	}
	$fields = '`'.implode('`, `', $func_get_args).'`';
	$query = mysql_query("SELECT $fields FROM `users` WHERE `user_id` = '$user_id'");
	$data = mysql_fetch_assoc($query);
	return $data;
}

function logged_in() {
	return (isset($_SESSION['admin_user_id'])) ? true : false;
}

function logged_in_permission() {
	if (logged_in() === false) {
		header("location: http://suda-tech.com/core");
	}
}

function user_exists($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'") or die(mysql_error());
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'") or die(mysql_error());
	return mysql_result($query, 0, 'user_id');
}

function login($username, $password) {
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = sanitize($password);
	//$password = md5($password);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'") or die(mysql_error());
	return (mysql_result($query, 0) == 1) ? $user_id : false;
}

function admin_permission($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT `permission` FROM `users` WHERE `username` = '$username'") or die(mysql_error());
	return mysql_result($query, 0, 'permission');
}

function change_password($user_id, $password) {
	$user_id = (int)$user_id;
	$password = md5($password);
	mysql_query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = '$user_id'") or die(mysql_error());
}

function get_users_list($limit) {
	$query = mysql_query("SELECT * FROM `users` ORDER BY `user_id` DESC $limit") or die(mysql_error());
	while ($row = mysql_fetch_assoc($query)) {
	echo '
	<tr>
	<td>'.$row['user_id'].'</td>
	<td>'.$row['username'].'</td>
	<td>'.$row['password'].'</td>
	<td>'.$row['balance'].'</td>
	<td>'.$row['spent'].'</td>
	<td>'.$row['registration_date'].'</td>
	<td>'.$row['last_login'].'</td>
	<td>'.$row['ip'].'</td>
	<td style="text-align: center;"><a class="btn btn-mini" href="user_update.php?id='.$row['user_id'].'">Edit Detail</a></td>
	</tr>
	';
	}
}

function balance_check($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT `balance` FROM `users` WHERE `username` = '$username'");
	$result = mysql_fetch_assoc($query);
	$balance = $result['balance'];
	return $balance;
}

function user_payment_update($username, $amount, $detail) {
	$username = sanitize($username);
	$amount = sanitize($amount);
	$detail = sanitize($detail);
	$date = datetime();
	$balance = balance_check($username);
	$balance = $balance + $amount;
	mysql_query("UPDATE `users` SET `balance` = '$balance' WHERE `username` = '$username'") or die(mysql_error());
	mysql_query("INSERT INTO `payment` (username, balance, amount, detail, date) VALUES ('$username', '$balance', '$amount', '$detail', '$date')") or die(mysql_error());
}

function get_user_payment_list($limit) {
	$query = mysql_query("SELECT * FROM `payment` ORDER By `payment_id` DESC $limit");
	while ($row = mysql_fetch_assoc($query)) {
		echo '
		<tr>
		<td width="5%">'.$row['payment_id'].'</td>
		<td>'.$row['username'].'</td>
		<td>'.$row['balance'].'</td>
		<td>'.$row['amount'].'</td>
		<td width="40%">'.$row['detail'].'</td>
		<td>'.$row['date'].'</td>
		</tr>
		';
	}
}

function random_password($length) {
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	return $randomString;
}

function add_user($username, $password, $balance, $spent, $ip, $permission, $date) {
	mysql_query("INSERT INTO `users` (username, password, balance, spent, ip, permission, registration_date) VALUES ('$username', '$password', '$balance', '$spent', '$ip', '$permission', '$date')") or die(mysql_error());
}

function service_status($service_id) {
	$service_id = sanitize($service_id);
	if ($service_id == 1) {
		return "Disable Service";
	} else if ($service_id == 0) {
		return "Enable Service";
	}
}

function get_services_list($limit) {
	$query = mysql_query("SELECT * FROM `services` ORDER by `service_id` DESC $limit");
	while ($row = mysql_fetch_assoc($query)) {
		echo '
		<tr>
		<td>'.$row['service_id'].'</td>
		<td>'.$row['type'].'</td>
		<td>'.$row['rate'].'</td>
		<td>'.$row['min'].'</td>
		<td>'.$row['unit'].'</td>
		<td style="text-align:center;">
		<a href="update_service.php?id='.$row['service_id'].'" class="btn btn-mini">Edit Service</a>
		</td>
		<td style="text-align:center;">
		<a href="service_status.php?id='.$row['service_id'].'" class="btn btn-mini">'.service_status($row['status']).'</a>
		</td>
		</tr>
		';
	}
}

function add_service($type, $rate, $min, $unit) {
	$type = sanitize($type);
	$rate = sanitize($rate);
	$min = sanitize($min);
	$unit = sanitize($unit);
	$status = 1;
	mysql_query("INSERT INTO `services` (type, rate, min, unit, status) VALUES ('$type', '$rate', '$min', '$unit', '$status')") or die(mysql_error());
}

function update_service($service_id, $type, $rate, $min, $unit) {
	$service_id = (int)$service_id;
	$type = sanitize($type);
	$rate = sanitize($rate);
	$min = sanitize($min);
	$unit = sanitize($unit);
	mysql_query("UPDATE `services` SET `type` = '$type', `rate` = '$rate', `min` = '$min', `unit` = '$unit' WHERE `service_id` = '$service_id'");
}

function service_status_update($service_id) {
	$service_id = (int)$service_id;
	$query = mysql_query("SELECT `status` FROM `services` WHERE `service_id` = '$service_id'");
	if (mysql_result($query, 0) == 0) {
		$status = 1;
	} else if (mysql_result($query, 0) == 1) {
		$status = 0;
	}
	mysql_query("UPDATE `services` SET `status` = '$status' WHERE `service_id` = '$service_id'");
} 

function order_status($order_id) {
	$order_id = sanitize($order_id);
	if ($order_id == 0) {
		return "Pending";
	} else if ($order_id == 1) {
		return "In progress";
	} else if ($order_id == 2) {
		return "Completed";
	} else if ($order_id == 3) {
		return "Partially completed";
	} else if ($order_id == 4) {
		return "Cancelled";
	} else if ($order_id == 5) {
		return "Processing";
	} else if ($order_id == 6) {
		return "Error";
	}
}

function username_by_user_id($user_id) {
	$user_id = (int)$user_id;
	$query = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$user_id'") or die(mysql_error());
	return mysql_result($query, 0, 'username');
}

function pending_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '0'") or die(mysql_error());
	return mysql_result($query, 0);
}

function in_progress_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '1'") or die(mysql_error());
	return mysql_result($query, 0);
}

function completed_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '2'") or die(mysql_error());
	return mysql_result($query, 0);
}

function partially_completed_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '3'") or die(mysql_error());
	return mysql_result($query, 0);
}

function cancelled_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '4'") or die(mysql_error());
	return mysql_result($query, 0);
}

function processing_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '5'") or die(mysql_error());
	return mysql_result($query, 0);
}

function error_orders() {
	$query = mysql_query("SELECT COUNT(`status`) FROM `orders` WHERE `status` = '6'") or die(mysql_error());
	return mysql_result($query, 0);
}

function get_orders_by_status($status, $limit) {
	$status = (int)$status;
	$query = mysql_query("SELECT * FROM `orders` WHERE `status` = '$status' ORDER by `order_id` DESC $limit") or die(mysql_error());
	if (mysql_num_rows($query) > 0) {
		while ($row = mysql_fetch_assoc($query)) {
			echo '
			<tr>
			<td>'.$row['order_id'].'</td>
			<td>'.username_by_user_id($row['user_id']).'</td>
			<td>'.$row['link'].'</td>
			<td>'.$row['charge'].'</td>
			<td>'.$row['start_count'].'</td>
			<td>'.$row['quantity'].'</td>
			<td>'.$row['service_type'].'</td>
			<td>'.order_status($row['status']).'</td>
			<td>'.$row['date'].'</td>
			<td style="text-align: center;"><a class="btn btn-mini" href="change_status.php?id='.$row['order_id'].'">Change</a></td>
			</tr>
			';
		}
	} else {
		header("location: order_status.php?status=0");
	}
}

function change_order_status($order_id, $change_status, $start_count) {
	$order_id = (int)$order_id;
	$change_status = (int)$change_status;
	$start_count = (int)$start_count;
	mysql_query("UPDATE `orders` SET `status` = '$change_status', `start_count` = '$start_count' WHERE `order_id` = '$order_id'") or die(mysql_error());
}

function edit_content($page_id, $content) {
	$page_id = (int)$page_id;
	$content = sanitize($content);
	mysql_query("UPDATE `pages` SET `content` = '$content' WHERE `page_id` = '$page_id'") or die(mysql_error());
}

function get_content($page_id) {
	$page_id = (int)$page_id;
	$query = mysql_query("SELECT `content` FROM `pages` WHERE `page_id` = '$page_id'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['content'];
}

function ticket_status($status) {
	$status = (int)$status;
	if ($status == 1) {
		return "Open";
	} else if ($status == 2) {
		return "Closed";
	}
}

function user_id_to_username($user_id) {
	$user_id = (int)$user_id;
	$query = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$user_id'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['username'];
}

function ago($time) {
	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");

	$now = time();
	$difference     = $now - $time;
	$tense         = "ago";

	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if($difference != 1) {
		$periods[$j].= "s";
	}

	return "$difference $periods[$j] ago ";
}

function get_all_users_tickets($limit) {
	$query = mysql_query("SELECT * FROM `tickets` ORDER by `ticket_id` DESC $limit") or die(mysql_error());
		while ($row = mysql_fetch_assoc($query)) {
			echo '
			<tr>
			<td width="5%">'.$row['ticket_id'].'</td>
			<td>'.user_id_to_username($row['user_id']).'</td>
			<td>'.$row['subject'].'</td>
			<td>'.ticket_status($row['status']).'</td>
			<td>'.ago($row['last_update']).'</td>
			<td style="text-align: center;"><a class="btn btn-mini" href="update_status.php?id='.$row['ticket_id'].'">Change</a></td>
			<td style="text-align: center;"><a class="btn btn-mini" href="update_ticket.php?id='.$row['ticket_id'].'">Update</a></td>
			</tr>
			';
		}
}

function ticket_message_submit($message, $ticket_id, $user_id, $last_update) {
	$message = sanitize($message);
	$ticket_id = (int)$ticket_id;
	$user_id = 0;
	$last_update = sanitize($last_update);
	mysql_query("INSERT INTO `messages` (ticket_id, user_id, message, last_update) VALUES ('$ticket_id', '$user_id', '$message', '$last_update')") or die(mysql_error());
	mysql_query("UPDATE `tickets` SET `last_update` = '$last_update' WHERE `ticket_id` = '$ticket_id'") or die(mysql_error());
}

function get_user_ticket_messages($ticket_id) {
	$ticket_id = (int)$ticket_id;
	$query1 = mysql_query("SELECT `subject` FROM `tickets` WHERE `ticket_id` = '$ticket_id' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($query1);
	echo '
	<tr>
	<td valign="top" align="left" colspan="2" style="border:#abadb3 1px solid; border-width:0px 0px 1px 0px;padding-bottom:10px;">
	<h3 style="color:#616060;">'.$row['subject'].'</h3>
	</td>
	</tr>
	';
	$query2 = mysql_query("SELECT * FROM `messages` WHERE `ticket_id` = '$ticket_id' ORDER by `message_id` ASC") or die(mysql_error());
	while ($row = mysql_fetch_assoc($query2)) {
	echo '
	<tr>
	<td style="padding-top:10px;" valign="top" align="left">
	<strong style="color:#616060;">'.user_id_to_username($row['user_id']).'</strong>
	</td>
	<td style="padding-top:10px;" valign="top" align="right">
	<strong style="color:#616060;font-size:12px;font-weight:normal;">'.ago($row['last_update']).'</strong>
	</td>
	</tr>
	<tr>
	<td valign="top" align="left" colspan="2">
	<p class="muted" style="color:#373638;border:#abadb3 1px solid; border-width:0px 0px 1px 0px;padding:10px 0px 10px 0px;">'.$row['message'].'</p>
	</td>
	</tr>
	';
	}
}

function ticket_status_update($ticket_id, $status) {
	$ticket_id = (int)$ticket_id;
	$status = (int)$status;
	$last_update = time();
	mysql_query("UPDATE `tickets` SET `status` = '$status', `last_update` = '$last_update' WHERE `ticket_id` = '$ticket_id'");
}
?>