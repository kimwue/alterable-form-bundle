<?php

namespace Wuestkamp\AlterableFormBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class FormFactory extends \Symfony\Component\Form\FormFactory
{

    /**
     * TODO
     */
    public function create($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = array())
    {
        //return $this->createBuilder($type, $data, $options)->getForm();

        $builder = $this->createBuilder($type, $data, $options);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();

            /*$options = $form->get('special_needs')->getConfig()->getOptions();
            $options['required'] = true;*/

            $fieldName = 'fieldname';

            $field = $form->get($fieldName);
            $options = $field->getConfig()->getOptions();
            $type = get_class($field->getConfig()->getType()->getInnerType());

            $options['required'] = true;

            $form->add($field->getName(), $type, $options);
        });

        return $builder->getForm();
    }

}
