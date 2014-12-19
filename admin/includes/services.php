<div align="center">
<a href="add_service.php" class="btn" style="cursor:default;">Add new service</a>
</div>
<h2 class="sub-header">Services</h2>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th>Id</th>
<th>Type</th>
<th>Rate per 1000</th>
<th>Min. order</th>
<th>Units</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
<?php get_services_list(); ?>
</table>