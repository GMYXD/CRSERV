<?php
$query1 = mysql_query("SELECT COUNT(`user_id`) FROM `users`") or die(mysql_error());
$row = mysql_fetch_row($query1);
$rows = $row['0'];
$page_rows = 10;
$last = ceil($rows/$page_rows);
if ($last < 1) {
	$last = 1;
}

$pagenum = 1;
if (isset($_GET['pn']) === true) {
	$pagenum = $_GET['pn'];
	$pagenum = (int)$pagenum;
}

if ($pagenum < 1) {
	$pagenum = 1;
} else if ($pagenum > $last) {
	$pagenum = $last;
}

$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
$pg_ctr = '';

if ($last != 1) {
	if ($pagenum > 1) {
		$previous = $pagenum - 1;
		$pg_ctr .= '<li class="prev"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"><span class="glyphicon glyphicon-step-backward"></span> Prev </a></li>';
		for($i = $pagenum - 4; $i < $pagenum; $i++) {
			if ($i > 0) {
				$pg_ctr .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
			}
		}
	}
	
	$pg_ctr .= '<li class="active"><a>'.$pagenum.'</a></li>';
	for ($i = $pagenum + 1; $i <= $last; $i++) {
		$pg_ctr .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
		if ($i >= $pagenum + 4) {
			break;
		}
	}
	
	if ($pagenum != $last) {
		$next = $pagenum + 1;
		$pg_ctr .= '<li class="next"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><span class="glyphicon glyphicon-step-backward"></span> Next </a></li>';
	}
}
?>
<div align="center">
<div style="width:400px;" align="left">
<form enctype="multipart/form-data" id="yw0" action="add_user.php" method="post">
<div class="clear"></div>
<div class="control-group" style="float:left;margin-right:10px;">
<div class="controls">
<input class="input-xlarge" required="required" placeholder="Username" name="username" id="Users_login" type="text" maxlength="32" />
</div>
</div>
<button type="submit" name="submit" class="btn" style="float:left;">Add user</button>
<div class="clear" style="clear:both;"></div>
</form>
</div>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th>Username</th>
<th>Password</th>
<th>Balance</th>
<th>Spent</th>
<th>Registration date</th>
<th>Last login</th>
<th>IP</th>
<th>&nbsp;</th>
</tr>
<?php get_users_list($limit); ?>
</table>
<?php 
if ($rows > $page_rows) {
	echo '<ul class="pagination pagination-right">';
	echo $pg_ctr;
	echo '</ul>';
	echo '<p>Page '.$pagenum.' of '.$last.', showing '.$page_rows.' records out of '.$rows.' total.</p>';
}
?>
</div>