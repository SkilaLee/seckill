<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<link rel="stylesheet" href="<?php echo (CSS_URL); ?>/style.css">
	<script type="text/javascript" src="<?php echo (JS_URL); ?>/mouse.js"></script>
</head>
<body>
	<div id="body">
		<div id="header">
			<p id="head">
				<a href="#"><?php echo ($name); ?>,欢迎你</a>
				<a href="outlogin">退出</a>
			</p>
		</div>
		<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gd): $mod = ($i % 2 );++$i;?><div class="goods">
				<a href="delete?id=<?php echo ($gd["id"]); ?>" class="cha">&times;</a>
				<a href="upload?id=<?php echo ($gd["id"]); ?>"><img src="<?php echo (PIC_URL); ?>/<?php echo (date("Y-m-d",$gd["time"])); ?>/<?php echo ($gd["id"]); ?>.png" alt="暂无图片  点击上传" class="gd_pic"></a>
				<p><a href="#"><?php echo ($gd["gd_name"]); ?></a></p>
				<p>
					<a href="#">总数:<?php echo ($gd["gd_sum"]); ?></a>
					<a href="#">剩余:<?php echo ($gd["gd_remain"]); ?></a>
				</p>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		
		<div class="goods">
			<p>添加奖品</p>
			<form action="addGoods" method="post" enctype="multipart/form-data">
				<span>名称：</span><br>
				<input type='text' name='gd_name'><br>
				<span>总数：</span>
				<input type='text' name='gd_sum'><br>
				<span>上传图片:</span><br>
				<input type="file" name='myFile' id="file" />
				<input type='submit' value='提交' id="submit">
			</form>
		</div>
	</div>
</body>
</html>