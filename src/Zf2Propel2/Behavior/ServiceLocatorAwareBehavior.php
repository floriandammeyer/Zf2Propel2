<?php
namespace Zf2Propel2\Behavior;

class ServiceLocatorAwareBehavior
	extends \Propel\Generator\Model\Behavior
{
	// TODO: diese methode wird so nicht funktionieren, wahrscheinlich muss objectFilter genutzt werden um ein Interface hinzuzufügen
	// TODO: die methoden in den xxxQuery-Objekten, die ein Model-Objekt erstellen, müssen auch dahingehend angepasst werden, dass sie den ServiceLocator injizieren
	public function objectInterfaces()
	{
		return 'ServiceLocatorAwareInterface';
	}

	public function objectAttributes($builder)
	{
		$script = <<<PHP_SCRIPT
protected \$_zf2_service_locator = null;
PHP_SCRIPT;

		return $script;
	}

	public function objectMethods($builder)
	{
		$builder->declareClasses(
			'\Zend\ServiceManager\ServiceLocatorAwareInterface',
			'\Zend\ServiceManager\ServiceLocatorInterface'
		);

		$script = <<<PHP_SCRIPT
public function getServiceLocator()
{
	return \$this->_zf2_service_locator;
}

public function setServiceLocator(ServiceLocatorInterface \$service_locator)
{
	\$this->_zf2_service_locator = \$service_locator;
	return \$this;
}
PHP_SCRIPT;

		return $script;
	}

	public function allowMultiple()
	{
		return false;
	}
}