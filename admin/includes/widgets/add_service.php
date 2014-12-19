<form id="yw0" action="add_service.php" method="post">
<fieldset>
<div class="control-group">
<label class="control-label" for="Services_name">Type</label>
<div class="controls">
<input class="input-xlarge" required="required" name="type" id="Services_name" type="text" maxlength="300" />
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Rate</label>
<div class="controls">
<input class="input-xlarge" required="required" name="rate" id="Services_price" type="text" maxlength="10" />
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_min">Min. order</label>
<div class="controls">
<input class="input-xlarge" required="required" name="min" id="Services_min" type="text" />
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_fans">Units</label>
<div class="controls">
<input class="input-xlarge" required="required" name="unit" id="Services_fans" type="text" maxlength="100" />
</div>
<p class="help-block"></p>
</div>
<button type="submit" name="submit" class="btn" style="margin-top:10px;padding:10px;width:284px;">Save</button>
</fieldset>
</form>
