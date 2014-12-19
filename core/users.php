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
	return (isset($_SESSION['user_id'])) ? true : false;
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

function balance_check($user_id) {
	$user_id = sanitize($user_id);
	$query = mysql_query("SELECT `balance` FROM `users` WHERE `user_id` = '$user_id'");
	$result = mysql_fetch_assoc($query);
	$balance = $result['balance'];
	return $balance;
	//return (mysql_result($query, 0) >= 1) ? true : false;
}

function balance_check_for_rate($user_id, $rate, $quantity) {
	$user_id = sanitize($user_id);
	//$rate = ($rate / 1000);
	//$rate = ($rate * $quantity);
	$query = mysql_query("SELECT `balance` FROM `users` WHERE `user_id` = '$user_id'");
	$result = mysql_fetch_assoc($query);
	$balance = $result['balance'];
	return ($balance >= $rate) ? true : false ;
	//return $balance;
}

function balance_update($user_id, $rate, $quantity) {
	$quantity = sanitize($quantity);
	$rate = sanitize($rate);
	$user_id = sanitize($user_id);
	$balance = "";
	$balance = order_balance_check($balance, $user_id);
	$balance = $balance - $rate;
	$query = mysql_query("UPDATE `users` SET `balance` = '$balance' WHERE `user_id` = '$user_id'") or die(mysql_error());
}

function order_balance_check($balance, $user_id) {
	$query = mysql_query("SELECT `balance` FROM `users` WHERE `user_id` = '$user_id'") or die(mysql_error());
	$result = mysql_fetch_assoc($query);
	$balance = $result['balance'];
	return $balance;
}

function get_services() {
$query = mysql_query("SELECT * FROM `services` WHERE `status` = '1' ORDER by `service_id`");
while ($row = mysql_fetch_assoc($query)) {
echo '<option value="'. $row['service_id'] .'" >'. $row['type'] .'</option>
';
}
}

function get_service_charges($service_id) {
	$query = mysql_query("SELECT `rate` FROM `services` WHERE `service_id` = '$service_id'");
	$result = mysql_fetch_assoc($query);
	$rate = $result['rate'];
	return $rate;
}

function get_service_name($service_id) {
	$query = mysql_query("SELECT `type` FROM `services` WHERE `service_id` = '$service_id'");
	$result = mysql_fetch_assoc($query);
	$type = $result['type'];
	return $type;
}

function creat_order($user_id, $current_date, $link, $rate, $start_count, $quantity, $type, $status, $remains) {
	$user_id = (int)$user_id;
	mysql_query("INSERT INTO `orders` (user_id, date, link, charge, start_count, quantity, service_type, status, remains) VALUES ('$user_id', '$current_date', '$link', '$rate', '$start_count', '$quantity', '$type', '$status', '$remains')") or die(mysql_error());
}

function order_id() {
$query = mysql_query("SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1") or die(mysql_error());
$result = mysql_result($query, 0);
return $result;
}

function orders_history($user_id) {
$user_id = (int)$user_id;
$query = mysql_query("SELECT * FROM `orders` WHERE `user_id` = '$user_id' ORDER BY `order_id` DESC") or die(mysql_error());
while ($row = mysql_fetch_assoc($query)) {
echo '
<tr>
<td width="5%"><a href="track.php?login_hash='.$_SESSION['login_hash'].'&id='.$row['order_id'].'">#'.$row['order_id'].'</a></td>
<td>'.$row['date'].'</td>
<td>'.$row['link'].'</td>
<td>'.$row['charge'].'</td>
<td>'.$row['start_count'].'</td>
<td>'.$row['quantity'].'</td>
<td>'.$row['service_type'].'</td>
<td>'.order_status($row['status']).'</td>
</tr>
';
}
}

function order_track($order_id) {
$order_id = (int)$order_id;
$order_id = sanitize($order_id);
$query = mysql_query("SELECT * FROM `orders` WHERE `order_id` = '$order_id'") or die(mysql_error());
if (mysql_num_rows($query) > 0) {
while ($row = mysql_fetch_assoc($query)) {
echo '
<tr>
<td width="5%">'.$row['order_id'].'</td>
<td>'.$row['date'].'</td>
<td>'.$row['link'].'</td>
<td>'.$row['charge'].'</td>
<td>'.$row['start_count'].'</td>
<td>'.$row['quantity'].'</td>
<td>'.$row['service_type'].'</td>
<td>'.order_status($row['status']).'</td>
</tr>
';
}
} else {
	header("location: neworder.php?login_hash=".$_SESSION['login_hash']);
}

}

function order_creading($user_id, $current_date, $link, $rate, $spent, $start_count, $quantity, $type, $status, $remains) {
	$rate = ($rate / 1000);
	$rate = ($rate * $quantity);
	$query1 = mysql_query("SELECT `balance` FROM `users` WHERE `user_id` = '$user_id'") or die(mysql_error());
	$result = mysql_fetch_assoc($query1);
	$balance = $result['balance'];
	if ($balance < $rate) {
		header("location: neworder.php?login_hash=".$_SESSION['login_hash']."&error=3");
	} else {
		$balance = $balance - $rate;
		$spent = $spent + $rate;
		mysql_query("UPDATE `users` SET `balance` = '$balance' WHERE `user_id` = '$user_id'") or die(mysql_error());
		mysql_query("INSERT INTO `orders` (user_id, date, link, charge, start_count, quantity, service_type, status, remains) VALUES ('$user_id', '$current_date', '$link', '$rate', '$start_count', '$quantity', '$type', '$status', '$remains')") or die(mysql_error());
		mysql_query("UPDATE `users` SET `spent` = '$spent' WHERE `user_id` = '$user_id'") or die(mysql_error());
		$_SESSION['order_id'] = order_id();
		header("location: neworder.php?login_hash=".$_SESSION['login_hash']."&success");
	}
}

function change_password($user_id, $password) {
	$user_id = (int)$user_id;
	mysql_query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = '$user_id'");
}

function login_update($user_id) {
	$ip = user_ip();
	$last_login = datetime();
	mysql_query("UPDATE `users` SET `ip` = '$ip', `last_login` = '$last_login' WHERE `user_id` = '$user_id'") or die(mysql_error());
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
		return "Canceled";
	} else if ($order_id == 5) {
		return "Processing";
	} else if ($order_id == 6) {
		return "Error";
	}
}

function random_password($length) {
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	return $randomString;
}

function login_hash($login_hash) {
	if (isset($_SESSION['login_hash']) === true) {
		if ($login_hash != $_SESSION['login_hash']) {
			session_destroy();
			header("location: http://suda-tech.com/core/login.php?error=2");
		}
	} else {
		session_destroy();
		header("location: http://suda-tech.com/core/login.php?error=2");
	}
}

function get_content($page_id) {
	$page_id = (int)$page_id;
	$query = mysql_query("SELECT `content` FROM `pages` WHERE `page_id` = '$page_id'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['content'];
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

function ticket_status($status) {
	$status = (int)$status;
	if ($status == 0) {
		return "Pending";
	} else if ($status == 1) {
		return "Open";
	} else if ($status == 2) {
		return "Closed";
	}
}

function get_user_tickets($user_id) {
	$user_id = (int)$user_id;
	$query = mysql_query("SELECT * FROM `tickets` WHERE `user_id` = '$user_id' ORDER by `ticket_id` DESC") or die(mysql_error());
	while ($row = mysql_fetch_assoc($query)) {
	echo '
	<tr>
	<td>'.$row['ticket_id'].'</td>
	<td><a href="viewticket.php?login_hash='.$_SESSION['login_hash'].'&id='.$row['ticket_id'].'#view">'.$row['subject'].'</a></td>
	<td class="gray"><strong>'.ticket_status($row['status']).'</strong></td>
	<td>'.ago($row['last_update']).'</td>
	</tr>
	';
	}
}

function user_id_to_username($user_id) {
	$user_id = (int)$user_id;
	$query = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$user_id'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['username'];
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

function ticket_message_submit($message, $ticket_id, $user_id, $last_update) {
	$message = sanitize($message);
	$ticket_id = (int)$ticket_id;
	$user_id = (int)$user_id;
	$last_update = sanitize($last_update);
	mysql_query("INSERT INTO `messages` (ticket_id, user_id, message, last_update) VALUES ('$ticket_id', '$user_id', '$message', '$last_update')") or die(mysql_error());
	mysql_query("UPDATE `tickets` SET `last_update` = '$last_update' WHERE `ticket_id` = '$ticket_id'") or die(mysql_error());
}

function get_latest_ticket() {
	$query = mysql_query("SELECT `ticket_id` FROM `tickets` ORDER by `ticket_id` DESC") or die(mysql_error());
	$result = mysql_fetch_assoc($query);
	return $result['ticket_id'];
}

function create_ticket($subject, $message, $user_id, $last_update) {
	$subject = sanitize($subject);
	$message = sanitize($message);
	$user_id = (int)$user_id;
	$last_update = sanitize($last_update);
	$status = 1;
	mysql_query("INSERT INTO `tickets` (user_id, subject, status, last_update) VALUES ('$user_id', '$subject', '$status', '$last_update')") or die(mysql_error());
	$ticket_id = get_latest_ticket();
	mysql_query("INSERT INTO `messages` (ticket_id, user_id, message, last_update) VALUES ('$ticket_id', '$user_id', '$message', '$last_update')") or die(mysql_error());
}
?>