<?php
namespace ACPLOUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class User extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('user', $options);
        $this->setInputFilter(new UserFilter());
        $this->setAttribute('methos', 'post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new Element\Text('nome');
        $nome->setLabel('Nome: ')
            ->setAttributes(array(
            'class' => 'form-controll'
        ))
            ->setAttribute('Placeholder', 'Entre com o nome');
        $this->add($nome);
        
        $email = new \Zend\Form\Element\Text('email');
        $email->setLabel('Email: ')
            ->setAttributes(array(
            'class' => 'form-controll'
        ))
            ->setAttribute('Placeholder', 'Entre com o Email');
        $this->add($email);
        
        $password = new \Zend\Form\Element\Password('password');
        $password->setLabel('Password: ')
            ->setAttributes(array(
            'class' => 'form-controll'
        ))
            ->setAttribute('Placeholder', 'Entre com o Senha');
        $this->add($password);
        
        $confirmation = new \Zend\Form\Element\Password('confirmation');
        $confirmation->setLabel('Redigite a Senha: ')
            ->setLabelAttributes(array(
            'class' => 'form-controll'
        ))
            ->setAttribute('Placeholder', 'Redigite a Senha');
        $this->add($confirmation);
        
        $csrf = new \Zend\Form\Element\Csrf('security');
        $this->add($csrf);
        
        $this->add(array(
            'name' => 'submit',
            'type' => '\Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));
    }
}