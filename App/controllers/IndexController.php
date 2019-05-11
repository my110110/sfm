<?php
/**
 * Created by PhpStorm.
 * Users: zyh
 * Date: 2019/4/5
 * Time: 下午7:20
 */
namespace App\controllers;


use App\models\Users;

class IndexController
{

    public function index()
    {
        $model = new Users();
        $a=$model->select(1);
    }

}