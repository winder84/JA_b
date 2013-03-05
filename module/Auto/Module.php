<?php
namespace Auto;
use Auto\Model\Auto;
use Auto\Model\AutoTable;
use Zend\Db\ResultSet\ResultSet;

class Module
{
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'AutoModelAutoTable' =>  function($sm) {
					$dbAdapter = $sm->get('ZendDbAdapterAdapter');
					$table = new AutoTable($dbAdapter);
					return $table;
				},
			),
		);
	}
}