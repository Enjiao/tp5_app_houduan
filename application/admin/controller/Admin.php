<?php
namespace app\admin\controller;

use think\Controller;
use app\common\lib\IAuth;
class Admin extends Controller
{
    public function add()
    {
        //判断是否是post提交
        if(request()->isPost()){

            $data = input('post.');
            //validate
            $validate = validate('AdminUser');

            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            $data['password'] = IAuth::setPassword($data['password']);
            $data['status'] = config('code.status_normal');
            //$data['create_time'] = time();

            try {
                $id = model('AdminUser')->add($data);
            }catch(\Exception $e) {
                $this->error($e->getMessage());
            }

            if($id){
                $this->success('id='.$id.'用户添加成功！');
            }else{
                $this->error('error');
            }

        }else{
            return $this->fetch();
        }

    }
	
	
}
