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
//                     $this->sendMail($request->getPost()->toArray());
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
        
        $repository = $this->getEm()->getRepository('ACPLOUser\Service\User');
        $user = $repository->findBy(array(
            'id' => 32
        ));
        if ($result)
            return new ViewModel(array(
                'user' => $result
            ));
        else
            return new ViewModel();
    }

    public function sendMail($post)
    {
        $repository = $this->getEm()->getRepository('ACPLOUser\Entity\User');
        $user = $repository->findBy(array(
            'email' => $post['email']
        ));
        
        var_dump($user[0]->getActivationKey());
        die();
        $transport = $this->getServiceLocator()->get('ACPLOUser\Mail\Transport');
        $message = new Message();
        $this->getRequest()->getServer(); // Server vars
        
        $message->addTo($user[0]->getEmail())
            ->addFrom('adzf2.project@gmail.com')
            ->setSubject('Vai te fude consegui enviar a porra do email kkkk!')
            ->
        // ->setBody("Please, click the link to confirm your registration => " . $this->getRequest()
        // ->getServer('HTTP_ORIGIN') . $this->url()
        setBody("Please, click the link to confirm your registration => http://" . $this->getRequest()
            ->getServer('HTTP_HOST') . $this->url()
            ->fromRoute('acplouser-activate', array(
            'controller' => 'index',
            'action' => 'activate',
            'id' => $user[0]->getActivationKey()
        )));
        
        // $this->acploUrl()->from('usuario/confirm-email',['id'=>$user->getUsrRegistrationToken()], true)
        
        $transport->send($message);
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