<?php
namespace Zf2Propel2;

use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;
use Zend\Console\Request as ConsoleRequest;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;

class Module
    implements
        AutoloaderProviderInterface,
        ConfigProviderInterface,
        ConsoleBannerProviderInterface,
        BootstrapListenerInterface
{
//    public function init(ModuleManager $moduleManager)
//    {
//        // Include the main Propel script
////        require_once 'vendor/propel/propel1/runtime/lib/Propel.php';
////        // Add the generated 'classes' directory to the include path
////        set_include_path("data/zpropel/proxy/build/classes" . PATH_SEPARATOR . get_include_path());
//    }
    public function getConfig()
    {
        return include(__DIR__ . '/config/module.config.php');
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    /**
     * Load Propel configuration when the system is being bootstrapped.
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        /*$serviceManager = $e->getApplication()->getServiceManager();
        $config = $serviceManager->get('Config');
        // Set up static service/event manager manager
        require_once('src/Zpropel/Model/StaticManager.php');
        Model\StaticManager::setServiceLocator($serviceManager);
        $e = $serviceManager->get('SharedEventManager');
        Model\StaticManager::getEventManager()->setSharedManager($e);
        // Initialize Propel with the runtime configuration
        $runtime_conf = $config['zpropel']['runtime-conf'];
        if (file_exists($runtime_conf)) {
            \Propel::init($runtime_conf);
        }*/

        if(!$e->getRequest() instanceof ConsoleRequest)
        {
            $db_config = $e->getApplication()->getConfig()['database'];

            // Set up Propel2 default connection
            $serviceContainer = Propel::getServiceContainer();
            $serviceContainer->setAdapterClass('default', 'mysql');
            $manager = new ConnectionManagerSingle();
            @ $manager->setConfiguration(array(
                'dsn'      => 'mysql:host=' . $db_config['host'] . ';dbname=' . $db_config['database'],
                'user'     => $db_config['username'],
                'password' => $db_config['password'],
                'settings' => [
                    'charset' => 'utf8',
                    'queries' => [
                        'utf8' => "SET NAMES utf8;"
                    ]
                ],
            ));
            $serviceContainer->setConnectionManager('default', $manager);
        }
    }
    public function getConsoleBanner(ConsoleAdapter $console)
    {
        return
            "==-------------------------------------==" . PHP_EOL .
            "  PropelOrm Module for Zend Framework 2" . PHP_EOL .
            "==-------------------------------------==";
    }
}