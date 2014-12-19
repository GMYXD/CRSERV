<h3 align="center"><?php echo $_SESSION['type']; ?></h3>
<h4 align="center">Status: <?php echo $_SESSION['status']; ?></h4>
<div style="width:285px;" align="left">
<form id="yw0" action="" method="post">
<select name="status" id="OrderService" class="input-xlarge" style="width:285px;">
<option value="Enable">Enable</option>
<option value="Disable">Disable</option>
</select>
<center>
<input type="submit" name="submit" class="btn" value="Change Status" />
</center>
</form>
</div>