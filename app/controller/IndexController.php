<?php

namespace app\controller;
class IndexController
{

    public function index(): string
    {
        return 'Today is ' . date('j.m.Y G:i:s');
    }

}
