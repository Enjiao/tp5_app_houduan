<?php
/**
 * Created by PhpStorm.
 * User: TONGFANGPC
 * Date: 2017/12/27
 * Time: 18:33
 */
namespace app\common\lib;
/**
 * IAuth相关
 * Class IAuth
 */
class IAuth {
    /**
     * 密码加密
     * @param $data
     * @return string
     */
    public static function setPassword($data){
        return md5($data.config('app.password_pre_halt'));
    }
}
