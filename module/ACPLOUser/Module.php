<?php
namespace ACPLOUser;

use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use ACPLOUser\Auth\Adapter as AuthAdapter;

use Zend\ModuleManager\ModuleManager;
class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        
        // $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController",
        // MvcEvent::EVENT_DISPATCH,
        // array($this,'validaAuth'),100);
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ACPLOUser\Mail\Transport' => function ($sm) {
                    $config = $sm->get('Config');
                    $transport = new SmtpTransport();
                    $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                    return $transport;
                },
                'ACPLOUser\Service\User' => function ($sm) {
                    $sm->get('ACPLOUser\Mail\Transport');
                    
                    return new Service\User($sm->get('Doctrine\ORM\EntityManager'), $sm->get('ACPLOUser\Mail\Transport'), $sm->get('View'));
                },
                'ACPLOUser\Auth\Adapter' => function ($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
                }
            )
        )
        ;
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                // 'fieldCollection' => 'ACPLOBase\Form\View\Helper\FieldCollection',
                // 'fieldRow' => 'ACPLOBase\Form\View\Helper\FormElement',
                'formLabel' => 'ACPLOBase\Form\View\Helper\FormLabel'
            )
        );
    }
}
