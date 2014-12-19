<div class="ticket">
<div align="center">
<div class="All_tickets" align="left">
<div align="center">
<form action="" method="post" id="ticketsend">
<input type="hidden" name="type" value="1">
<a href="newticket.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>" class="btn save sendt">Submit new ticket</a>
</form>
</div>
</div>
</div>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th>Subject</th>
<th width="80px">Status</th>
<th width="140px">Last update</th>
</tr>
<?php get_user_tickets($user_data['user_id'], $limit); ?>
</table>
</div>
