<?php
/**
 * Created by JetBrains PhpStorm.
 * User: winder
 * Date: 10.02.13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */
return array(
	'controllers' => array(
		'invokables' => array(
			'Auto\Controller\Auto' => 'Auto\Controller\AutoController',
		),
	),
	'router' => array(
		'routes' => array(
			'auto' => array(
				'type'	=> 'segment',
				'options' => array(
					'route'	=> '/catalog[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'	 => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Auto\Controller\Auto',
						'action'	 => 'catalog',
					),
				),
			),
			'home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'	=> '/',
					'defaults' => array(
						'controller' => 'Auto\Controller\Auto',
						'action'	 => 'index',
					),
				),
			),
			'catalog' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'	=> '/catalog/',
					'constraints' => array(
						'id'	 => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Auto\Controller\Auto',
						'action'	 => 'catalog',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'auto' => __DIR__ . '/../view',
		),
	),
);