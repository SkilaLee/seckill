<?php 
namespace Home\Model;
use Think\Model;
class ManageModel extends Model {
	public function add($salt,$username) {
        $Mgr = M('Manage');
		$sql = "UPDATE `manage` SET `mgr_salt` = ".$salt." WHERE `mgr_name` = '".$username."'";
        $sta = $Mgr->execute($sql);
        return $sta;
	}
}