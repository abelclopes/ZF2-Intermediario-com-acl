<?php
namespace ACPLOBase\Form\View\Helper;

use Zend\Form\View\Helper\FormCollection;
use ACPLOBase\Form\View\Helper\FormLabel;

class FieldCollection extends FormCollection
{

    public function render(ElementInterface $element)
    {
        return sprintf('<table  class="table table-condensed">%s</table>', parent::render($element));
    }
}
