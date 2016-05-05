<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Ddiv XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Ddiv/xhtml1-transitional.ddiv">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>[title]</title>
		<link rel="stylesheet" href="/Public/<?php echo ($module_name); ?>/Css/public.css" />
		<link rel="stylesheet" href="/Public/<?php echo ($module_name); ?>/Css/index.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="/Public/<?php echo ($module_name); ?>/Js/jquery-1.7.2.min.js"></script>
		<?php echo baiduAccount();?>
</head>
<body>
	<form action="<?php echo U(MODULE_NAME.'/Cat/edit');?>" method="post" >
		<table class="table"> 
			<tr>
				<td>TITLE</td>
				<td><input  name="title"  value="<?php echo ($rest["title"]); ?>" /></td>
			</tr>
			<tr>
				<td>SORT</td>
				<td><input  name="sort"  value="<?php echo ($rest["sort"]); ?>"  /></td>
			</tr>
			<tr>
				<td>MULTI</td>
				<td><input  name="multi" value="<?php echo ($rest["multi"]); ?>"  /></td>
			</tr>
		</table>
		<input  type="hidden" value="<?php echo ($rest["id"]); ?>" name="id" />
		<input  type="submit" value="SUBMIT" name="submit" />
	</form>
</body>
</html>