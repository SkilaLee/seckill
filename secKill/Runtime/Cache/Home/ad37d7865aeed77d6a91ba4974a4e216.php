<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>秒杀抽奖</title>
	<link rel="stylesheet" href="<?php echo (CSS_URL); ?>/style.css">
	<link rel="stylesheet" href="<?php echo (CSS_URL); ?>/index_style.css">
	<script type="text/javascript" src="<?php echo (JS_URL); ?>/sec_kill.js"></script>
</head>
<body>
	<div id="nav">
		
	</div>
	<div id="body">
		<div id="header">
			<p id="head">
				<?php echo ($header); ?>
			</p>
		</div>
		<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gd): $mod = ($i % 2 );++$i;?><div class="goods">
				<a href="#"><img src="<?php echo (PIC_URL); ?>/<?php echo (date("Y-m-d",$gd["time"])); ?>/<?php echo ($gd["id"]); ?>.png" alt="暂无图片" class="gd_pic"></a>
				<p><a href="#"><?php echo ($gd["gd_name"]); ?></a></p>
				<p>
					<a href="#">总数:<?php echo ($gd["gd_sum"]); ?></a>
					<a href="#">剩余:<?php echo ($gd["gd_remain"]); ?></a>
				</p><div class="gd_id" style="display:none;"><?php echo ($gd["id"]); ?></div>
				
				<p class="seckill">秒杀</p>
				
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</body>
</html>