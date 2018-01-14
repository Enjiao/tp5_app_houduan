<?php
/**
 * Created by PhpStorm.
 * User: TONGFANGPC
 * Date: 2017/12/28
 * Time: 13:18
 */
namespace app\admin\controller;
use think\Controller;
/**
 *后台基础类库
 * Class Base
 * @package app\admin\controller
 */
class Base extends controller {

    /**
     * 初始化的方法
     */
    public function _initialize(){
        $isLogin = $this->isLogin();
        if(!$isLogin){
            return $this->redirect('login/index');
        }
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public function isLogin(){
        $user = session(config('admin.session_user'),'',config('admin.session_scope'));
        if($user && $user->id){
            return true;
        }
        return false;

    }
}