<?php
return array(
	'view_manager' => array(
		'template_path_stack' => array(
			'zfcuser' => __DIR__ . '/../view',
		),
	),
	'controllers' => array(
		'invokables' => array(
			'zfcuser' => 'ZfcUser\Controller\UserController',
		),
	),
	'service_manager' => array(
		'aliases' => array(
			'zfcuser_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
		),
	),
	'router' => array(
		'routes' => array(
			'zfcuser' => array(
				'type' => 'segment',
				'priority' => 1000,
				'options' => array(
					'route' => '/admin[/:action]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'Auto\Controller\Auto',
						'action'     => 'admin',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'del' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '[/:mod][/:id]',
							'defaults' => array(
								'controller' => 'Auto\Controller\Auto',
								'mod'     => 'cat',
								'id'     => 0,
							),
						),
					),
					'login' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/login',
							'defaults' => array(
								'controller' => 'zfcuser',
								'action'     => 'login',
							),
						),
					),
					'authenticate' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/authenticate',
							'defaults' => array(
								'controller' => 'zfcuser',
								'action'     => 'authenticate',
							),
						),
					),
					'logout' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/logout',
							'defaults' => array(
								'controller' => 'zfcuser',
								'action'     => 'logout',
							),
						),
					),
					'register' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/register',
							'defaults' => array(
								'controller' => 'zfcuser',
								'action'     => 'register',
							),
						),
					),
					'changepassword' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/change-password',
							'defaults' => array(
								'controller' => 'zfcuser',
								'action'     => 'changepassword',
							),
						),
						'may_terminate' => true,
						'child_routes' => array(
							'query' => array(
								'type' => 'Query',
							),
						),
					),
					'changeemail' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/change-email',
							'defaults' => array(
								'controller' => 'zfcuser',
								'action' => 'changeemail',
							),
						),
						'may_terminate' => true,
						'child_routes' => array(
							'query' => array(
								'type' => 'Query',
							),
						),
					),
				),
			),
		),
	),
);
