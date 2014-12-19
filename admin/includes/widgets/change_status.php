<form id="order" action="change_status.php" method="post">
<fieldset>
<div class="control-group">
<label class="control-label" for="Services_price">Type</label>
<div class="controls">
<input class="input-xlarge" name="type" disabled value="<?php echo $_SESSION['service_type']; ?>" type="text"/>
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Link</label>
<div class="controls">
<input class="input-xlarge" name="link" disabled value="<?php echo $_SESSION['link']; ?>" type="text"/>
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Quantity</label>
<div class="controls">
<input class="input-xlarge" name="quantity" disabled value="<?php echo $_SESSION['quantity']; ?>" type="text"/>
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Current Status</label>
<div class="controls">
<input class="input-xlarge" name="current_status" disabled value="<?php echo order_status($_SESSION['status']); ?>" type="text"/>
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_name">Change Status</label>
<div class="controls">
<select name="change_status" id="OrderService" class="input-xlarge" style="width:285px;">
<option value="0" >Pending</option>
<option value="1" >In progress</option>
<option value="2" >Completed</option>
<option value="3" >Partially completed</option>
<option value="4" >Cancelled</option>
<option value="5" >Processing</option>
<option value="6" >Error</option>
</select>
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Start Count</label>
<div class="controls">
<input class="input-xlarge" required="required" name="start_count" value="<?php echo $_SESSION['start_count']; ?>" type="text"/>
</div>
<p class="help-block"></p>
</div>

<input type="submit" name="submit" value="Update" class="btn" style="margin-top:10px;padding:10px;width:284px;">
</fieldset>
</form>
