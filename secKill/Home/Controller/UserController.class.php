<?php 
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        if (session('user_name')) {
            $name = session('user_name');
            $header = "<a href='#'>".$name.",欢迎你</a>&nbsp;<a href='outlogin'>退出</a>";
        } elseif (session('mgr_name')) {
            header('Location: '.VIEW.'Manage/index');
        }
        else {
            $header = "<a href='login'>用户登陆</a>&nbsp;<a href='register'>注册</a>&nbsp;
                       <a href='".VIEW."Manage/Login'>后台管理</a>";
        }

        $this->assign('name',$name);
        $this->assign('header',$header);
        
        //奖品内容
        $Goods = M('goods');
        $all_goods = $Goods->where("being = 1")->select();
        $this->assign('goods',$all_goods);
        $this->display('index');
    }
    /**
     * 注册
     */
    public function register() {
        $this->display('register');
    }
    public function doRegister() {
        $User = M('user');
        $username = I('post.username');
        $psw = I('post.password');
        if ($username&&$psw) {
            $salt = rand();
            $data['user_name'] = $username;
            $name = $User->where($data)->select();
            if ($name) {
                $this->error('该用户名已被注册!');
                // echo '改用户名已被注册';
                // $this->display('register');
            }else{
                $password = md5($psw.$salt);
                $data['salt'] = $salt;
                $data['user_psw'] = $password;
                // $data['status'] = 1;       //写入status不行.....写入id就可以...郁闷
                $add = $User->data($data)->add();
                if ($add) {
                    session('user_name',$username); 
                    $sql = "UPDATE `user` SET `user_status` = 1 WHERE `user_name` = '".$username."'";
                    $sta = $User->execute($sql);
                    $this->success('注册成功!',VIEW.'User/index');
                    // echo "注册成功";   
                    // // print_r($sta);                 
                    // header('Location: '.VIEW.'/User/index');
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
        $User = M('user');
        $username = I('post.username');
        $psw = I('post.password');
        $data['user_name'] = $username;
        $yan = $User->where($data)->select();
        $salt = $yan[0]['salt'];
        $password = md5($psw.$salt);
        $data['user_psw'] = $password;
        $name = $User->where($data)->select();
        if ($name) {
            session('user_name',$username);
            // $user_name['user_name'] = $username;
            // $da['status'] = 1;
            // $sta = $User->where($user_name)->save($da);   //一直有问题.....
            $sql = "UPDATE `user` SET `user_status` = 1 WHERE `user_name` = '".$username."'";
            $sta = $User->execute($sql);
            // var_dump($sta);
            header('Location: '.VIEW.'/User/index');
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
        $username = session('user_name');
        session('[destroy]');
        $User = M('user');
        $sql = "UPDATE `user` SET `user_status` = 0 WHERE `user_name` = '".$username."'";
        $sta = $User->execute($sql);
        // var_dump($sta);
        header('Location: index');
    }


    /**
     * 秒杀
     */
    public function secKill() {
        if (session('user_name')) {
            $username = session('user_name');
            $gd_id = I('post.gd_id');
            $Goods = M('goods');
            $User = M('user');
            $name['user_name'] = $username;
            $da['id'] = $gd_id;
            $gd = $Goods->where($da)->select();   //查询奖品剩余数量
            $data['user_gain'] = $gd_id;
            $user_gain = $User->where($name)->select();  //查询是否已经抽过奖
            if ($user_gain[0]['user_gain']) {
                echo '<a href="" id="cha1">&times;</a><h1 style="text-align:center;margin-top:140px;">:(</h1><p>你已经秒杀过了！不能太贪心哦</p>';
            }else {
                if ($gd[0]['gd_remain'] > 0) {
                    $Goods->where($data)->lock(true)->setDec('gd_remain',1);
                    $save = $User->where($name)->lock(true)->data($data)->save();
                    echo '<a href="" id="cha1">&times;</a><h1 style="text-align:center;margin-top:140px;">:)</h1><p>手速真快！'.$gd[0]['gd_name'].'就是你的喽！</p>';
                    // echo '手速真快！'.$gd[0]['gd_name'].'就是你的喽！<a href="" id="cha1">&times;</a>';
                }else {
                    echo '<a href="" id="cha1">&times;</a><h1 style="text-align:center;margin-top:140px;">:(</h1><p>你来晚了！已经被抢光了！</p>';
                    // echo '你来晚了！已经被抢光了！<a href="" id="cha1">&times;</a>';
                }
            }
        }else {
            echo '请先登录!';
        }
    }

    // /*/**
    //  * 用户信息(包括已秒杀到的奖品)
    //  */
    // public function userInfo() {
    //     $username = session('user_name');

    // }*/
}