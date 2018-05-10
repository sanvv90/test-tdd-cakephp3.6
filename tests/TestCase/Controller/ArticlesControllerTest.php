<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         1.2.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Test\TestCase\Controller;

use App\Controller\PagesController;
use App\Test\TestCase\ApplicationTestCase;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Database\Driver\Sqlite;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\IntegrationTestCase;
use Cake\View\Exception\MissingTemplateException;
use Symfony\Component\DomCrawler\Crawler;

/**
 * ArticlesControllerTest class
 */
class ArticlesControllerTest extends ApplicationTestCase
{
    /**
     * View create articles
     */
    public function testViewCreateArticles()
    {
        $this->get('/articles/create');
        $this->assertResponseOk();
    }

    public function testArticlesItemCorrect()
    {
        $this->get('/articles/create');
        $this->assertResponseContains(__('articles.title'));
        $this->assertResponseContains(__('articles.author'));
        $this->assertResponseContains(__('articles.content'));

        $crawler = new Crawler($this->_getBodyAsString());
        $this->assertEquals(1, $crawler->filter("input[name='title']")->count());
        $this->assertEquals(1, $crawler->filter("input[name='author']")->count());
        $this->assertEquals(1, $crawler->filter("textarea[name='content']")->count());
    }

    public function testAddArticles()
    {
        $this->addArticles();
    }

    public function testViewDetailArticles()
    {
        $this->addArticles(1);

        $this->get('/articles/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Title 1');
        $this->assertResponseContains('SanVV 1');
        $this->assertResponseContains('Trung Hoang Phan Bao 1');
    }

    public function addArticles($number = 1)
    {
        $this->post('/articles', [
            'title' => 'Title ' . $number,
            'author' => 'SanVV ' . $number,
            'content' => 'Trung Hoang Phan Bao ' . $number
        ]);

        $this->assertResponseCode(302);
        $this->assertRedirect('/articles/' . $number);
    }

    public function testViewDetailSecondArticles()
    {
        $this->addArticles(1);
        $this->addArticles(2);

        $this->get('/articles/2');
        $this->assertResponseOk();
        $this->assertResponseContains('SanVV 2');
    }


}
