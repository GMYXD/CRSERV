<form id="yw0" action="update_service.php" method="post">
<fieldset>
<div class="control-group">
<label class="control-label" for="Services_name">Type</label>
<div class="controls">
<input class="input-xlarge" required="required" value="<?php echo $_SESSION['type']; ?>" name="type" id="Services_name" type="text" maxlength="300" />
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Rate</label>
<div class="controls">
<input class="input-xlarge" required="required" value="<?php echo $_SESSION['rate']; ?>" name="rate" id="Services_price" type="text" maxlength="10" />
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_name">Min. order</label>
<div class="controls">
<input class="input-xlarge" required="required" value="<?php echo $_SESSION['min']; ?>" name="min" id="Services_name" type="text" maxlength="300" />
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_name">Unit</label>
<div class="controls">
<input class="input-xlarge" required="required" value="<?php echo $_SESSION['unit']; ?>" name="unit" id="Services_name" type="text" maxlength="300" />
</div>
<p class="help-block"></p>
</div>

<button type="submit" name="submit" class="btn" style="margin-top:10px;padding:10px;width:284px;">Save</button>
</fieldset>
</form>
</div>
