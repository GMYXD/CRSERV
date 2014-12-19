<div class="container-fluid">
<div align="center">
<div style="width:400px;" align="left">
<form enctype="multipart/form-data" id="yw0" action="/admin/payments/" method="post">			<div class="clear"></div>
<div class="control-group"  style="float:left;margin-right:10px;">
<div class="controls">
<input class="input-xlarge" style="width:225px;" placeholder="User" name="email" type="text" maxlength="1000" />      </div>
</div>
<div class="control-group"  style="float:left;margin-right:10px;">
<div class="controls">
<input class="input-xlarge" style="width:75px;" placeholder="Amount" name="amount" type="text" maxlength="1000" />      </div>
</div>
<div class="clear" style="clear:both;"></div>
<div class="control-group" >
<div>
<!--select name="status" style="width:80px;float:left;">
<option value="1">Income</option>
<option value="2">Refund</option>
<option value="3">Cancellation</option>
</select-->
<input class="input-xlarge" style="width:263px;float:left;margin-right:10px;" placeholder="Details" name="comment" type="text" maxlength="1000" />     
<button type="submit" class="btn "  disabled style="float:left;"> Add</button>
<div class="clear" style="clear:both;"></div>
</div>
</div>
</form>
</div>
</div>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th>User</th>
<th>Balance</th>
<!--th>&nbsp;Status <div class="btn-group" style="float:right;">
<a class="btn dropdown-toggle btn-mini" data-toggle="dropdown" href="#">
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a href="/admin/payments/index/status/1">Income</a></li>
<li><a href="/admin/payments/index/status/2">Refund</a></li>
<li><a href="/admin/payments/index/status/3">Cancellation</a></li>
</ul>
</div>
<div class="clear"></div>
</th-->
<th>Amount</th>
<th>Details</th>
<th style="width:140px;">Date</th>
</tr>
</table>