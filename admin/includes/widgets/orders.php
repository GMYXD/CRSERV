<a href="orders.php?status=0" class="btn" style="cursor:default;">Pending (<?php echo pending_orders(); ?>)</a>
<a href="orders.php?status=1" class="btn" style="cursor:default;">In progress (<?php echo in_progress_orders(); ?>)</a>
<a href="orders.php?status=2" class="btn" style="cursor:default;">Completed (<?php echo completed_orders(); ?>)</a>
<a href="orders.php?status=3" class="btn" style="cursor:default;">Partially completed (<?php echo partially_completed_orders(); ?>)</a>
<a href="orders.php?status=4" class="btn" style="cursor:default;">Cancelled (<?php echo cancelled_orders(); ?>)</a>
<a href="orders.php?status=5" class="btn" style="cursor:default;">Processing (<?php echo processing_orders(); ?>)</a>
<a href="orders.php?status=6" class="btn" style="cursor:default;">Error (<?php echo error_orders(); ?>)</a>
</div>
<br />
<h2 class="sub-header">Orders</h2>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th>Id</th>
<th>User</th>
<th>Link</th>
<th>Charge</th>
<th>Start count</th>
<th>Quantity</th>
<th>Type</th>
<th>Status</th>
<th>Date</th>
<th>Change Status</th>
</tr>
<?php get_orders_by_status($_GET['status'], $limit); ?>
</table>
