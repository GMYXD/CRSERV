<form action="edit_content.php" method="post">
<div align="center">
<div style="width:600px;" align="left">
<div>
<div style="padding-bottom:6px;">
<a class="btn" href="#" id="button_7" style="float:left;margin:0px 5px 4px 0px;font-size:12px;font-family:Arial Black;">Header</a>
<a class="btn" href="#" id="button_1" style="float:left;margin:0px 1px 4px 0px;"><img src="images/icon-1.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_2" style="float:left;margin:0px 1px 4px 0px;"><img src="images/icon-2.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_3" style="float:left;margin:0px 5px 4px 0px;"><img src="images/icon-3.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_4" style="float:left;margin:0px 5px 4px 0px;"><img src="images/icon-9.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_9" style="float:left;margin:0px 1px 4px 0px;"><img src="images/icon-6.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_8" style="float:left;margin:0px 1px 4px 0px;"><img src="images/icon-7.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_10" style="float:left;margin:0px 5px 4px 0px;"><img src="images/icon-8.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_5" style="float:left;margin:0px 1px 4px 0px;"><img src="images/icon-5.png" alt="" border="0"></a>
<a class="btn" href="#" id="button_6" style="float:left;margin:0px 0px 4px 0px;"><img src="images/icon-4.png" alt="" border="0"></a>
<div class="clear"></div>
</div>
</div>
<textarea name="content" required="required" id="text" cols="30" rows="20" style="width:600px;"><?php echo $_SESSION['content']; ?></textarea><br>
<input type="submit" value="Save" name="submit" class="btn" />
</div>
</div>
</form>