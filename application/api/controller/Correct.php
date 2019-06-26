<?php

namespace app\api\controller;

use think\Db;
use think\Request;

class Correct extends Base
{

	/**
	 * 找祖宗，更新算力
	 */
	public function sync_power_inviter($username, $power, $index, &$data)
	{
	    // 最多8级
	    if ($index <= 8) {
	        // 查找上级
	        $inviter = Db::table('account')->where('username', '=', $username)->value('inviter');
	        if (!empty($inviter)) {
	            // 存在上级，上级的实名认证人数增加
	            if (array_key_exists($inviter, $data)) {
	                $data[$inviter] += $power;
	            } else {
	                $data[$inviter] = $power;
	            }
	            // 继续找上级
	            $this->sync_power_inviter($inviter, $power, $index + 1, $data);
	        }
	    }
	}

	/**
	 * 修正上级算力
	 */
	public function power(Request $req)
	{
	    // 最终数据
	    $data = [];
	    // 找出所有的矿机
	    $machines = Db::table('machine')->field('username, power')->select();
	    foreach ($machines as $key => $item) {
	        // 给他上级统计算力
	        $this->sync_power_inviter($item['username'], $item['power'], 1, $data);
	    }
	    var_dump($power);
	    exit;
	    // 更新数据
	    /*$update = 'UPDATE `dashboard` SET `authen` = CASE ';
	    foreach ($data as $username => $count) {
	        $update .= " WHEN `username` = '$username' THEN " . $count . " ";
	    }
	    $update .= ' ELSE `authen` END ';*/
	    // 执行语句
	    // Db::startTrans();
	    // $bool = Db::execute($update);
	    // if ($bool != count($data)) {
	    //     Db::rollback();
	    //     throw new \think\Exception($bool. ':' . count($data));
	    // }
	    // Db::commit();
	    // print_r($data);
	    // echo $bool;
	}
}