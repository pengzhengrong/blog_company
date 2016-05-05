<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Ddiv XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Ddiv/xhtml1-transitional.ddiv">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>[title]</title>
		<link rel="stylesheet" href="/Public/<?php echo ($module_name); ?>/Css/public.css" />
		<link rel="stylesheet" href="/Public/<?php echo ($module_name); ?>/Css/index.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="/Public/<?php echo ($module_name); ?>/Js/jquery-1.7.2.min.js"></script>
		<?php echo baiduAccount();?>
<script type="text/javascript" charset="utf-8" src="/Public/<?php echo ($module_name); ?>/Js/Editor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/<?php echo ($module_name); ?>/Js/Editor/ueditor.all.min.js"> </script>
<script type="text/javascript">
	$( function(){
		$('#cat_id').click( function(){
			$('input[name=title]').val('');
			var title = $(this).find('option:selected').text().trim() ;
			$('input[name=title]').val( title );
		})
	})
</script>
</head>
<body>
	<form action="<?php echo U(MODULE_NAME.'/Blog/add');?>" method="post" >
	<select name="cat_id" id="cat_id">
	<?php echo W('cat/select',array($rest));?>
	</select>
		<table class="table"> 
			<tr>
				<td>TITLE</td>
				<td><input  name="title"  /></td>
			</tr>
			<tr>
				<td>CLICK</td>
				<td><input  name="click"  /></td>
			</tr>
			<tr>
				<td>SORT</td>
				<td><input  name="sort"  /></td>
			</tr>
			<tr>
				<td>ATTR</td>
				<td>
					<?php if(is_array($attr)): foreach($attr as $key=>$v): ?><input type="checkbox" name="attr_id[]" value="<?php echo ($v["id"]); ?>" />
						<font color="<?php echo ($v["color"]); ?>"><?php echo ($v["title"]); ?></font>&nbsp;&nbsp;<?php endforeach; endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">CONTENT</td>
			</tr>
			<tr>
				<td colspan="2">
					<div>
						<!-- 加载编辑器的容器 -->
						<script id="container" name="content" type="text/plain">这里写你的初始化内容</script>
					</div>
				</td>
			</tr>
		</table>
		<div class="fixed-bottom" >
			<div class="fixed-bottom fixed-but">
				<input   type="submit" value="SUBMIT" />
			</div>
		</div>
	</form>
</body>
<!-- 实例化编辑器 -->
<script type="text/javascript">
	var ue = UE.getEditor('container');
</script>
</html>