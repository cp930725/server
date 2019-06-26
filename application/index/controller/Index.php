<?php


namespace app\index\controller;


use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function book()
    {
        return $this->fetch();
    }
}

