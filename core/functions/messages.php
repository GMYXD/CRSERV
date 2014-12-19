<?php
function login_errors() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
		if ($error == 1) {
		echo '
		<div style="width:285px;" align="left">
		<div class="alert alert-error">Incorrect username or password!</div>
		</div>
		';
		} else if ($error == 2) {
		echo '
		<div style="width:285px;" align="left">
		<div class="alert alert-error">Ooops your login token has been expire, please login!</div>
		</div>
		';
		}
	}
}

function order_error() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
		if ($error == 1) {
			echo '<div class="alert alert-error">Incorrect Link!</div>';
		} else if ($error == 2) {
			echo '<div class="alert alert-error">Minimal order '.$_SESSION['min'].' '.$_SESSION['unit'].'</div>';
		} else if ($error == 3) {
			echo '<div class="alert alert-error">Not Enough Funds!</div>';
		} else if ($error == 4) {
			echo '<div class="alert alert-error">Maximum 50000 Per Order!</div>';
		}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success" style="width:234px;" >Hurry your order has been created, check your order status <a href="track.php?login_hash='.$_SESSION['login_hash'].'&id='.$_SESSION['order_id'].'">#'.$_SESSION['order_id'].'</a></div>';
	}
}

function change_password_message() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
				echo '<div class="alert alert-error">All Fields Must Be Filled!</div>';
			} else if ($error == 2) {
				echo '<div class="alert alert-error">Your current is an incorrect!</div>';
			} else if ($error == 3) {
				echo '<div class="alert alert-error">Your New Password Do Not Match!</div>';
			} else if ($error == 4) {
				echo '<div class="alert alert-error">Your password must be at least 6 characters!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success" style="width:234px;" >Password Changed!</div>';
	}
}

function ticket_message() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
		if ($error == 1) {
			echo '<div style="width: 300px;" class="alert alert-error">Your ticket is already open!</div>';
		}
	}
}

function ticket_created_message() {
	if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success" style="width:234px;" >Your ticket opened!</div>';
	}
}
?>