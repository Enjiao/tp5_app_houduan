<?php
namespace app\common\model;

use think\Model;

class AdminUser extends Model
{
    //插入时间

    protected $autoWriteTimestamp = true;

    /**
     *新增
     * @param $data
     * @return mixed
     */
    public function add($data){

        if(!is_array($data)){
            exception('传递的数据不合法！');
        }
        $this->allowField(true)->save($data);

        return $this->id;
    }
}
