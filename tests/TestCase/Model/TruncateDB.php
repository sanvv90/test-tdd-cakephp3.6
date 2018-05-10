<?php
namespace App\Test\TestCase\Model;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Created by PhpStorm.
 * User: quangsancntt
 * Date: 09/05/2018
 * Time: 16:16
 */
trait TruncateDB
{
    private function truncateAllDb()
    {
        $articlesTable = TableRegistry::get('Articles');
        $articlesTable->deleteAll([true]);

        $conn = ConnectionManager::get('default');
        $conn->execute("UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='articles'");
    }
}