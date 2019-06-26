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
    /**
     * 新闻列表
     */
    public function news(Request $req)
    {
        // 获取类型
        $type = $req->param('t/d', 1);
        // 查询文章
        $articles = Db::table('article')->where('type', '=', $type)->where('date', '<=', date('Y-m-d H:i:s'))->order('top DESC, sort DESC, date DESC')->select();
        $this->assign('articles', $articles);
        // 显示页面
        return $this->fetch();
    }

    /**
     * 文章详情
     */
    public function article(Request $req, $id)
    {
        // 查询文章
        $article = Db::table('article')->where('id', '=', $id)->find();
        if (empty($article)) {
            $this->error('很抱歉、该信息不存在！');
            exit;
        }
        // 显示页面
        $this->assign('article', $article);
        return $this->fetch();
    }

    /**
     * 联系我们
     */
    public function contact(Request $req)
    {
        // 用户账号
        $username = session('user.account.username');
        // 提交留言
        if ($req->isPost()) {
            try {
                // 开启事务
                Db::startTrans();
                // 获取参数
                $content = $req->param('content');
                if (empty($content)) {
                    return json([
                        'code'      =>  501,
                        'message'   =>  '很抱歉、请填写内容！'
                    ]);
                }
                // 时间间隔
                $interval = config('hello.contact.interval');
                // 判断间隔
                if (!is_null($interval) || $interval > 0) {
                    // 查询记录
                    $date = Db::table('message')->where('username', '=', $username)->order('id DESC')->value('create_at');
                    if (!empty($date)) {
                        $time = strtotime($date);
                        if (time() - $time < $interval) {
                            return json([
                                'code'      =>  502,
                                'message'   =>  '很抱歉、' . $interval . '秒内只能发送一次！'
                            ]);
                        }
                    }
                }
                // 添加记录
                $bool = Db::table('message')->insert([
                    'username'      =>  $username,
                    'content'       =>  $content,
                    'reply'         =>  null,
                    'create_at'     =>  $this->timestamp,
                    'update_at'     =>  $this->timestamp,
                ]);
                if (empty($bool)) {
                    return json([
                        'code'      =>  501,
                        'message'   =>  '很抱歉、请填写内容！'
                    ]);
                }
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                return json([
                    'code'      =>  555,
                    'message'   =>  $e->getMessage()
                ]);
            }
            return json([
                'code'      =>  200,
                'message'   =>  '恭喜您、操作成功！'
            ]);
        }
        // 查询数据
        $messages = Db::table('message')->where('username', '=', $username)->order('create_at DESC')->limit(20)->select();
        $this->assign('messages', $messages);
        // 显示页面
        return $this->fetch();
    }

}