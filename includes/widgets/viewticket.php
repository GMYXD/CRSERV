<div align="center">
<table cellpassing="0" cellspacing="0" border="0" style="width:800px;">
<?php get_user_ticket_messages($_SESSION['ticket_id']); ?>
</table>
<table cellpassing="0" cellspacing="0" border="0" style="width:900px;margin-left:-100px;">
<tr>
<td valign="top" align="right" style="width:150px;padding-right:10px;">
<label id="view" class="control-label" for="Services_price">Message:</label>
</td>
<td valign="top" align="right" style="width:790px;">
<div class="control-group">
<div class="controls">
<form action="" method="post">
<textarea class="input-xlarge" required="required" style="width:785px;height:100px;" name="message" id="Services_price"></textarea>
<div>
<button type="submit" name="submit" class="btn" style="float:left; width:80px;">Submit</button>
<div class="clear"></div>
</div>
</form>
</div>
</div>
</td>
</tr>
</table>
</div>
