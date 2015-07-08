<?php
namespace ACPLOUser\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'nome',
            'require' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'massages' => array(
                            'isEmpty' => 'Não pode estar branco'
                        )
                    )
                )
            )
        ));
        
        $validator = new \Zend\Validator\EmailAddress();
        $validator->setOptions(array(
            'domain' => false
        ));
        $this->add(array(
            'name' => 'email',
            'validators' => array($validator)            
        ));
        
        $this->add(array(
            'name' => 'password',
            'require' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'massages' => array(
                            'isEmpty' => 'Não pode estar b
                array(ranco'
                        )
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'confirmation',
            'require' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'massages' => array(
                            'isEmpty' => 'Não pode estar em branco'
                        ),
                        'name' => 'Identical', 'options'=>array('token'=>'passeword')
                    )
                )
            )
        ));
    }
}