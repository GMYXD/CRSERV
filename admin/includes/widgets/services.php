<div align="center">
<a href="add_service.php" class="btn" style="cursor:default;">Add new service</a>
</div>
<h2 class="sub-header">Services</h2>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th style="width:50px;">Id</th>
<th>Type</th>
<th style="width:100px;">Rate per 100</th>
<th style="width:100px;">Min. order</th>
<th style="width:100px;">Units</th>
<th style="width:96px;">&nbsp;</th>
<th style="width:100px;">&nbsp;
</th>
</tr>
<?php get_services_list($limit); ?>
</table>