<?php
namespace Zf2Propel2;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractFactoryInterface;

class AbstractFactory
    implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return class_exists($requestedName)
        && (is_a($requestedName, 'Propel\Runtime\ActiveRecord\ActiveRecordInterface', true)
            || is_a($requestedName, 'Propel\Runtime\ActiveQuery\ModelCriteria', true));
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        // Instead of directly creating and returning an instance of the found model,
        // we register it with the ServiceManager as a non-shared invokable class,
        // so that all the comforts of dependency injection can be used within the models
        /** @var \Zend\ServiceManager\ServiceManager $service_manager */
        $service_manager = $serviceLocator->get('ServiceManager');
        $service_manager->setInvokableClass($requestedName, $requestedName, false);

        return $service_manager->get($requestedName);
    }
}