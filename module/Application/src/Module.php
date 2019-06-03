<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Cache\StorageFactory;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Module implements ServiceProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'cache' => function (ServiceManager $serviceManager) {
                    $config = $serviceManager->get('config')['cache'];

                    $cache = StorageFactory::factory([
                        'adapter' => $config['adapter'],
                        'options' => [
                            'ttl' => $config['ttl']
                        ],
                        'plugins' => [
                            'exception_handler' => [
                                'throw_exceptions' => $config['throw_exceptions']
                            ],
                            'serializer'
                        ]
                    ]);

                    return $cache;
                }
            ]
        ];
    }
}
