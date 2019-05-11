<?php
/**
 * Created by PhpStorm.
 * Users: zyh
 * Date: 2019/4/5
 * Time: 下午8:18
 */

namespace core;

use core\lib\Orm;

class model extends Orm
{
    protected $_table;
    public function __construct()
    {
            // 连接数据库
            $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $this->_table= $this->table;

    }
    public function __destruct()
    {

    }




}