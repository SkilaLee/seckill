<?php 
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class ManageController extends Controller {
	public function index() {
		if (session('mgr_name')) {
			//xxx欢迎你
            $name = session('mgr_name');
            $this->assign('name',$name);

            //奖品内容
            $Goods = M('goods');
            $na['mgr_name'] = $name;
            $all_goods = $Goods->where("being = 1")->select();
            $this->assign('goods',$all_goods);
            $this->display('addGoods');
        }else {
            $this->error('请先登录!');
        	// echo "请先登录!";
        	// $this->display('login');
        }
    }
    /**
     * 注册
     */
    public function register() {
        $this->display('register');
    }
    public function doRegister() {
        $Mgr = M('Manage');
        $username = I('post.username');
        $psw = I('post.password');
        if ($username&&$psw) {
            $salt = rand();
            $data['mgr_name'] = $username;
            $name = $Mgr->where($data)->select();
            if ($name) {
                $this->error('该用户名已被注册!');
                // echo '该用户名已被注册';
                // $this->display('register');
            }else{
                $password = md5($psw.$salt);
                $data['mgr_psw'] = $password;
                $data['mgr_salt'] = $salt;
                $add = $Mgr->data($data)->add();
                $sa = D('Manage')->add($salt,$username);
                if ($sa) {
                    session('mgr_name',$username); 
                    // print_r($sta);        
		      		$this->success('注册成功！',VIEW.'Manage/index');
                }
            }
        }else{
            $this->error('用户名或者密码不可为空!');
            // echo "用户名或者密码不可为空!";
            // $this->display('register');
        }
    }
    /**
     * 登陆
     */
    public function login() {
        $this->display('login');
    }
    public function doLogin() {
        $Mgr = M('Manage');
        $username = I('post.username');
        $psw = I('post.password');
        $data['mgr_name'] = $username;
        $yan = $Mgr->where($data)->select();
        $salt = $yan[0]['mgr_salt'];
        $password = md5($psw.$salt);
        $data['mgr_psw'] = $password;
        $name = $Mgr->where($data)->select();
        if ($name) {
            session('mgr_name',$username);
      		// var_dump( $name);
            header('Location: '.VIEW.'/Manage/index');
        }else{
            $this->error('用户名或密码错误!');
            // echo "用户名或密码错误";
            // $this->display('login');
        }
    }
    /**
     * 退出
     */
    public function outLogin() {
        session('mgr_name',null);
        header('Location: '.VIEW.'User/index');
    }




    public function addGoods() {
        $Goods = M('goods');
        $gd_name = I('post.gd_name');
        $gd_sum = I('post.gd_sum');
        $mgr_name = session('mgr_name');
        $fileInfo=$_FILES['myFile'];
        $data['mgr_name'] = $mgr_name;
        $data['gd_name'] = $gd_name;
        $data['gd_sum'] = $gd_sum;
        $data['gd_remain'] = $gd_sum;
        $data['time'] = time();
        // var_dump($data);exit();
        $add = $Goods->data($data)->add();
        if ($add) {
        	$yoo = D('Goods')->update($add);
        	if ($fileInfo['type']) {
        		$upload = new Upload();
		        $upload->maxSize = 3000000;
		        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'ico');//设置附件上传类型
		        $upload->saveName = $add; 
		        $upload->savepath = 'Uploads'; 
		        $upload->saveExt = 'png'; 
		        // $upload->savePath = ''; //设置附件上传（子）目录
		        //上传文件
		        $info = $upload->upload();
		        if ($info)
		        {
		           $this->success('上传成功！');
		        }
		        else 
		        {
		            $this->error($upload->getError());
		        }
	        }else{
	        	$this->success('添加成功！');
	        }

        }
        
    }
    public function upload() {
    	$gd_id = I('get.id');
        $this->assign('id',$gd_id);
    	$this->display('upload');
    }
    public function doAction() {
    	$gd_id = I('get.id');
    	$fileInfo=$_FILES['myFile'];
    	$upload = new Upload();
        $upload->maxSize = 3000000;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'ico');//设置附件上传类型
        $upload->saveName = $gd_id; 
        $upload->savepath = 'Uploads'; 
        $upload->saveExt = 'png'; 
        // $upload->savePath = ''; //设置附件上传（子）目录
        //上传文件
        $info = $upload->upload();
        if ($info)
        {
           $this->success('上传成功！',VIEW.'Manage/index');
        }
        else 
        {
            $this->error($upload->getError());
        }
    }


    /**
     * 删除奖品
     */
    public function delete() {
        $gd_id = I('get.id');
        $Goods = M('goods');
        $data['id'] = $gd_id;
        
        // $delete = $Goods->where($data)->data('being = 1')->save();
        $delete = D('Goods')->up($gd_id);
        if ($delete) {
            $this->success('删除成功！',VIEW.'Manage/index');
        }
    }
}