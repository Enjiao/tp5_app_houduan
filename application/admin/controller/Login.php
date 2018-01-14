<?php
namespace app\admin\controller;

use think\Controller;
use app\common\lib\IAuth;
class Login extends Base
{
    public function _initialize(){

    }
    public function index()
    {
        $isLogin = $this->isLogin();
        //halt($isLogin);
        //已登录则不能再来登录页面
        if($isLogin){
            return $this->redirect('index/index');
        }else{
            return $this->fetch();
        }

    }
    /*
     * 用户登录
     */
	public function check(){

        if(request()->isPost()){

            $data = input('post.');

            if(!captcha_check($data['code'])){
                $this->error('验证码输入有误！');
            }

            $validate = validate('AdminUser');

            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            try {
                $user = model('AdminUser')->get(['username' => $data['username']]);
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }

            if(!$user || $user->status != config('code.status_normal')){
                $this->error('该用户不存在！');
            }

            if(IAuth::setPassword($data['password']) != $user['password']){
                $this->error('密码输入有误！');
            }

            $udata = [
                'last_time' => time(),
                'last_login_ip' => request()->ip(),
            ];

            try {
                model('AdminUser')->save($udata, ['id' => $user->id]);
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }

            session(config('admin.session_user'),$user,config('admin.session_scope'));

            $this->success('登录成功！','index/index');
        }else{
            $this->error('数据输入有误！');
        }
    }

    public function logout(){
        session(null,config('admin.session_scope'));
        $this->redirect('login/index');
    }
}
