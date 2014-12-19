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
			echo '<div class="alert alert-error">Minimal 100 Per Order!</div>';
		} else if ($error == 3) {
			echo '<div class="alert alert-error">Not Enough Funds!</div>';
		} else if ($error == 4) {
			echo '<div class="alert alert-error">Maximum 50000 Per Order!</div>';
		}
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

function user_payment_messages() {
if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
				echo '<div class="alert alert-error">All Fields Must Be Filled!</div>';
			} else if ($error == 2) {
				echo '<div class="alert alert-error">Username dose not exists!</div>';
			} else if ($error == 3) {
				echo '<div class="alert alert-error">Amount must be in numbers!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">Fund Deposited!</div>';
	}
}

function user_update_messages() {
if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
				echo '<div class="alert alert-error">This username is already exists!</div>';
			} else if ($error == 2) {
				echo '<div class="alert alert-error">Password must be great than 6 characters!</div>';
			}  else if ($error == 3) {
				echo '<div class="alert alert-error">All Fields Must Be Filled!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">User detail updated!</div>';
	}
}

function add_user_messages() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
					echo '<div class="alert alert-error">All Fields Must Be Filled!</div>';
			} else if ($error == 2) {
				echo '<div class="alert alert-error">This username is already exists!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
			echo '<div class="alert alert-success">User Added!</div>';
	}
}

function add_service_messages() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
				echo '<div class="alert alert-error">All fields must be filled!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">Service Created!</div>';
	}
}

function update_service_messages() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
				echo '<div class="alert alert-error">All fields must be filled!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">Service Updated!</div>';
	}
}

function service_status_messages() {
	if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">Service status updated!</div>';
	}
}

function change_order_status_messages() {
	if (isset($_GET['error']) === true) {
		$error = $_GET['error'];
		$error = (int)$error;
		$error = sanitize($error);
			if ($error == 1) {
				echo '<div class="alert alert-error">All fields must be filled!</div>';
			}
	} else if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">Order Status Updated!</div>';
	}
}

function edit_content_messages() {
	if (isset($_GET['success']) AND empty($_GET['success']) === true) {
		echo '<div class="alert alert-success">Content Saved!</div>';
	}
}
?>