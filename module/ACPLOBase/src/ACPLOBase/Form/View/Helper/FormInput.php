<?php
namespace ACPLOBase\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormInput extends ZendFormInput
{


    /**
     * Render a form <input> element from the provided $element    
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes          = $element->getAttributes();
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $attributes['value'] = $element->getValue();

        return sprintf(
            '<input %s class="form-control '.(count($element->getMessages()) > 0 ? 'error-class' : '').'" %s',
            $this->createAttributesString($attributes),
            $this->getInlineClosingBracket()
        );
    }

}