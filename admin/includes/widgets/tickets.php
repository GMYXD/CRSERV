<h2 class="sub-header">Tickets</h2>
<div align="center">
<table class="table table-striped table-bordered table-condensed">
<tr>
<th style="width:50px;">Id</th>
<th style="width:120px;">User</th>
<th>Subject</th>
<th style="width:50px;">Status</th>
<th style="width:100px;">Last Update</th>
<th style="width:60px;">Change Status</th>
<th style="width:60px;">Update Ticket</th>
</tr>
<?php get_all_users_tickets($limit); ?>
</table>
</div>
