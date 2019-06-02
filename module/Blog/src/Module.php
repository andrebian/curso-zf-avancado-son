<?php
/**
 * Created by PhpStorm.
 * User: andrebian - Andre Cardoso https://github.com/andrebian
 * Date: 05/08/18
 * Time: 14:08
 */

namespace Blog;


use Blog\Model\Post;
use Blog\Model\PostTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceManager;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                PostTable::class => function (ServiceManager $serviceManager) {
                    $tableGateway = $serviceManager->get('PostTableGateway');
                    return new PostTable($tableGateway);
                },
                'PostTableGateway' => function (ServiceManager $serviceManager) {
                    $dbAdapter = $serviceManager->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Post());
                    return new TableGateway('posts', $dbAdapter, null, $resultSetPrototype);
                }
            ]
        ];
    }
}
