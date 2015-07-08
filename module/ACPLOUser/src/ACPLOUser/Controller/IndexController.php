<?php
namespace ACPLOUser\Controller;

use Zend\Mvc\Controller\AbstractActionController, Zend\View\Model\ViewModel;
use ACPLOUser\Form\User as FormUser;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use ACPLOUser\Mail\Transport as ACPLOUserSmtpTransport;
use ACPLOUser\Entity\UserRepository;
use ACPLOUser\Entity\User;

class IndexController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    protected $em;

    protected $service;

    protected $entity;

    protected $form;

    protected $route;

    protected $controller;

    public function registerAction()
    {
        $form = new FormUser();
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get("ACPLOUser\Service\User");
                if ($send = $service->insert($request->getPost()
                    ->toArray())) {
                    $fm = $this->flashMessenger()
                        ->setNamespace('ACPLOUser')
                        ->addMessage("Usuário cadastrado com sucesso");
                    // $this->sendMail($request->getPost()->toArray());
                }
                
                return $this->redirect()->toRoute('acplouser-register');
            }
        }
        
        $messages = $this->flashMessenger()
            ->setNamespace('ACPLOUser')
            ->getMessages();
        
        return new ViewModel(array(
            'form' => $form,
            'messages' => $messages
        ));
    }

    public function activateAction()
    {
        $activationKey = $this->params()->fromRoute('key');
        
        $userService = $this->getServiceLocator()->get('ACPLOUser\Service\User');
        $result = $userService->activate($activationKey);
        
        if ($result)
            return new ViewModel(array(
                'user' => $result
            ));
        else
            return new ViewModel();
    }

    /*
     * @return EntityManager
     */
    protected function getEm()
    {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        return $this->em;
    }
}