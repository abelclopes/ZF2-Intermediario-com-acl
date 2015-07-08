<?php
namespace ACPLOUser;

return array(
    'router' => array(
        'routes' => array(
            'acplouser-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ACPLOUser\Controller',
                        'controller' => 'Index',
                        'action' => 'register'
                    )
                )                
            ),
            'acplouser-activate'=>array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ACPLOUser\Controller',
                        'controller' => 'Index',
                        'action' => 'activate'
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'ACPLOUser\Controller\Index' => 'ACPLOUser\Controller\IndexController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
        'fixture' => array(
            __NAMESPACE__ => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture'
        )
    )
);