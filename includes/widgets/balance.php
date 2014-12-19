<div align="center">
<h4>Balance: <?php echo money_format('$%i', $user_data['balance']); ?></h4>
</div>
<div class="guide" align="center">
<form action="" method="post">
<div class="text">
<ul class="payment">
<li  class="active">
<input type="radio" name="group1" value="1" class="rad" style="display:none;"  checked="checked">
<label class="payment">PayPal</label>
<div class="clr"></div>
<div class="payment-form p1" style="display:block;">
<div class="border b1"></div>
<h4>Amount:</h4>
<div class="control-group">
<div class="controls">
<input class="input-xlarge" name="amount" type="text" required="required" class="amountbalance" />
</div>
</div>
<input type="submit" value="Pay" class="btn" style="float:right;">
<div class="clr"></div>
</div>
</li>
</ul>
</div>
</form>
</div>
