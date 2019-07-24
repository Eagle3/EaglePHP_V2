<?php
namespace core\lib\database;

use PDO;

class Mysql {
    /*
     * 默认使用的连接
     */
    protected $connection = 'default';

    /*
     * PDO对象
     */
    private $pdo = NULL;

    /*
     * PDOStatement对象
     */
    private $pdoStmt = NULL;

    /*
     * 表名称
     */
    protected $table = '';

    /*
     * 最后执行的SQL
     */
    protected $lastSql = '';

    /*
     * 错误信息
     */
    protected $errMsg = '';

    /*
     * 数据获取模式
     */
    protected $fetchMode = PDO::FETCH_ASSOC;

    


}