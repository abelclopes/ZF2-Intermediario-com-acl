<?php
namespace ACPLOBase\Form\View\Helper;

use Zend\Form\View\Helper\FormRow;
use Zend\Form\ElementInterface;

class FieldRow extends FormRow
{

    public function render(ElementInterface $element)
    {
        var_dump($element);
        $markup = '<div class="form-group">'. $labelOpen . $label. $labelClose .
        '<div class="col-sm-5"><div class="input-group">'.$elementString .'</div>'.'</div>'.'</div>' ;
        
    }
}
