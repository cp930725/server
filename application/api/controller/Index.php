<?php


namespace app\api\controller;

use app\index\controller\Base;
use think\Db;
use think\Request;

class Index extends Base
{
    /**
     *  首页
     */
    public function index()
    {
        $config = config('hello.trade');
        $this->assign('config', $config);

        return $this->fetch();
    }

    /**
     * 项目列表
     */
    public function list(Request $req)
    {
        // 查询对象
        $query = Db::table('funding')->alias('f')
            ->leftJoin('profile p', 'p.username = f.owner')
            ->field('f.id, f.title, f.image, f.target, f.current, f.people, f.create_at, p.nickname, p.idcard, p.avatar')
            ->where('f.visible', '=', 1);

        // 查询数据
        $data = $query->limit(0, 3)->order('f.create_at DESC')->select();
        // 数据格式化
        foreach ($data as $key => $item) {
            $item['avatar'] = avatar($item['avatar'], $item['idcard']);
            unset($item['idcard']);
            $data[$key] = $item;
        }
        // 返回数据
        return json([
            'code'		=>	200,
            'message'	=>	'恭喜您、操作成功！',
            'data'		=>	$data,
        ]);
    }

}