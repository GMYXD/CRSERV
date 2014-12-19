<div style="width:285px;" align="left">
<form enctype="multipart/form-data" id="yw0" action="" method="post">
<fieldset>
<div class="control-group">
<label class="control-label" for="Users_login">Username</label>
<div class="controls">
<input class="input-xlarge" required="required" value="<?php echo $_SESSION['username']; ?>" name="username" id="Users_login" type="text" maxlength="32" />
</div>
<p class="help-block"></p>
</div>
<div class="control-group">
<label class="control-label" for="Users_key">Password</label>
<div class="controls">
<input class="input-xlarge" required="required" value="<?php echo $_SESSION['password']; ?>" name="password" id="Users_key" type="text" maxlength="32" />
</div>
<p class="help-block"></p>
</div>
<button type="submit" name="submit" class="btn" style="margin-top:10px;padding:10px;width:284px;">Save</button>
</fieldset>
</form>
</div>
