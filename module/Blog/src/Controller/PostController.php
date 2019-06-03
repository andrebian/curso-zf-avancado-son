<?php
/**
 * Created by PhpStorm.
 * User: andrebian - Andre Cardoso https://github.com/andrebian
 * Date: 05/08/18
 * Time: 14:22
 */

namespace Blog\Controller;

use Blog\Form\PostForm;
use Blog\Model\Post;
use Blog\Model\PostTable;
use Zend\Cache\Storage\StorageInterface;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\SaveHandler\Cache;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }

    public function indexAction()
    {
        /** @var PostTable $postTable */
        $postTable = $this->getServiceManager()->get(PostTable::class);

        /** @var StorageInterface $cache */
        $cache = $this->getServiceManager()->get('cache');
        if (! $posts = $cache->getItem('posts')) {
            $posts = $postTable->fetchAll();
            $cache->setItem('posts', $posts);
        }

        return new ViewModel([
            'posts' => $posts
        ]);
    }

    public function addAction()
    {
        $form = new PostForm();
        $errorMessages = [];

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost()->toArray();

            $form->setData($data);
            if (! $form->isValid()) {
                $errorMessages = $form->getMessages();
            }

            $data = $form->getData();
            $post = new Post();
            $post->exchangeArray($data);

            /** @var PostTable $postTable */
            $postTable = $this->getServiceManager()->get(PostTable::class);
            if ($postTable->savePost($post)) {
                return $this->redirect()->toRoute('blog');
            }
        }

        return new ViewModel([
            'form' => $form,
            'errorMessages' => $errorMessages
        ]);
    }
}
