<?php 
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model {
	/**
	 * 增加记录,查询id,....并没有什么卵用....
	 * @param [type] $mgr_name [description]
	 * @param [type] $gd_name  [description]
	 * @param [type] $gd_sum   [description]
	 */
	// public function addGoods($mgr_name,$gd_name,$gd_sum) {
	// 	$Goods = M('goods');
	// 	$sql = "insert into goods values(null,'".$mgr_name."','".$gd_name."',null,".$gd_sum.",".$gd_sum.");
	// 			select @@identity;
	// 			UPDATE goods SET gd_pic = @@identity WHERE id = @@identity;";
	// 	$gd = $Goods->execute($sql);
	// 	return $gd;
	// }
	public function update($id) {
		$Goods = M('goods');
		$sql = "UPDATE `goods` SET `time` = ".time()." WHERE `id` = ".$id."; ";
		$sql1 = "UPDATE `goods` SET `being` = 1 WHERE `id` = ".$id."; ";
		$gd = $Goods->execute($sql);
		$gd1 = $Goods->execute($sql1);
		return $gd;           //感觉tp好多bug....save()经常不能用.....
	}
	public function up($id) {
		$Goods = M('goods');
		$sql1 = "UPDATE `goods` SET `being` = 0 WHERE `id` = ".$id."; ";
		$gd1 = $Goods->execute($sql1);
		return $gd1;           
	}
}