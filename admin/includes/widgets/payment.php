<div align="center">
<div style="width:400px;" align="left">
<form enctype="multipart/form-data" id="yw0" action="payments.php" method="post">
<div class="clear"></div>
<div class="control-group" style="float:left;margin-right:10px;">
<div class="controls">
<input class="input-xlarge" required="required" style="width:225px;" placeholder="User" name="username" type="text" maxlength="1000" />
</div>
</div>
<div class="control-group" style="float:left;margin-right:10px;">
<div class="controls">
<input class="input-xlarge" required="required" style="width:75px;" placeholder="Amount" name="amount" type="text" maxlength="1000" />
</div>
</div>
<div class="clear" style="clear:both;"></div>
<div class="control-group" >
<div>
<input class="input-xlarge" required="required" style="width:263px;float:left;margin-right:10px;" placeholder="Details" name="detail" type="text" maxlength="1000" />     
<input type="submit" name="submit" class="btn " value="Add" style="float:left;" />
<div class="clear" style="clear:both;"></div>
</div>
</div>
</form>
</div>
</div>
<h2 class="sub-header">Payments</h2>
<div align="center">
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th>User</th>
<th>Balance</th>
<th>Amount</th>
<th width="40%">Details</th>
<th>Date</th>
</tr>
<?php get_user_payment_list($limit); ?>
</table>
</div>