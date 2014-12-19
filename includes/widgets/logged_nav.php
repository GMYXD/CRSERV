<div class="nav-collapse">
<ul class="nav" id="user_nav">
<li><a href="./neworder.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>">New Order</a></li>
<li><a href="./history.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>">Orders History</a></li>
<li><a href="./balance.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>">Balance</a></li>
<li><a href="./faq.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>">F.A.Q</a></li>
<li><a href="./tickets.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>">Tickets</a></li>
</ul>
<p class="navbar-text pull-right">You logged as <a href="./settings.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>"><b><?php echo $user_data['username']; ?></b></a>
<a href="./logout.php" class="btn btn-mini" style="margin:-3px 0px 0px 10px;cursor:default;">Logout</a>
</p>
</div>
