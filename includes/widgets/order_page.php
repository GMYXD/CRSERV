<div align="center">
<a href="order_status.php?status=0" class="btn" style="cursor:default;">Pending (0)</a>
<a href="order_status.php?status=1" class="btn" style="cursor:default;">In progress (0)</a>
<a href="order_status.php?status=2" class="btn" style="cursor:default;">Completed (0)</a>
<a href="order_status.php?status=3" class="btn" style="cursor:default;">Partially completed (0)</a>
<a href="order_status.php?status=4" class="btn" style="cursor:default;">Cancelled (0)</a>
<a href="order_status.php?status=5" class="btn" style="cursor:default;">Processing (0)</a>
<a href="order_status.php?status=6" class="btn" style="cursor:default;">Error (0)</a>
</div>
<br>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th width="5%">Re</th>
<th>User</th>
<th width="30%">Link</th>
<th>Charge</th>
<th>Start count</th>
<th>Quantity</th>
<th>Type</th>
<th>Status</th>
<th>Remains</th>
<th>Date</th>
</tr>
<?php get_orders_by_status($_SESSION['status']); ?>
</table>