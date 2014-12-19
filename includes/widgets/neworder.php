<div align="center">
<div style="width:285px;" align="left">
<form id="order" action="" method="post">
<fieldset>
<div class="control-group">
<label class="control-label" for="Services_name">Type</label>
<div class="controls">
<select name="service" id="OrderService" class="input-xlarge" style="width:285px;">
<?php get_services() ?>
</select>
</div>
<p class="help-block"></p>
</div>

<div class="control-group">
<label class="control-label" for="Services_price">Link</label>
<div class="controls">
<input class="input-xlarge" required="required" name="link" value="" type="text"/>
</div>
<p class="help-block"></p>
</div>
		
<div class="control-group">
<label class="control-label" for="Services_minimum">Quantity</label>
<div class="controls">
<input class="input-xlarge" required="required" name="quantity" value="" type="text" />
</div>
<p class="help-block"></p>
</div>
<input type="submit" name="submit" value="Submit" class="btn" style="margin-top:10px;padding:10px;width:284px;">
</fieldset>
<input type="hidden" name="TargetView" id="TargetView" value="0">
</form>
</div>
</div>
