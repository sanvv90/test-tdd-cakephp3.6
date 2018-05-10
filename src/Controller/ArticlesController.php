<?php
namespace App\Controller;

/**
 * Class ArticlesController
 * @package App\Controller
 *
 * @property \App\Model\Table\ArticlesTable Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function create()
    {

    }

    public function add()
    {
        $articles = $this->Articles->newEntity();
        $data = $this->getRequest()->getData();
        $articles = $this->Articles->patchEntity($articles, $data);
        $result = $this->Articles->save($articles);

        return $this->redirect('/articles/' . $result->id);
    }

    public function view()
    {
        $id = $this->getRequest()->getParam('id');
        $articles = $this->Articles->find()
            ->where([
                'Articles.id' => $id
            ])
            ->first();
        $this->set(compact('articles'));
    }
}