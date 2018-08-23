<?php

namespace Wuestkamp\AlterableFormBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class FormFactory extends \Symfony\Component\Form\FormFactory
{
    private $configuration;

    /**
     * TODO
     */
    public function create($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = array())
    {
        $builder = $this->createBuilder($type, $data, $options);

        foreach ($this->configuration as $formClass => $formConfig) {

            if ($type === $formClass) {
                $this->addEventListenerForForm($builder, $formConfig);
            }
        }

        return $builder->getForm();
    }

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    private function addEventListenerForForm(FormBuilderInterface $builder, $formConfig)
    {
        foreach ($formConfig as $field => $fieldConfig) {
            $this->addField($builder, $field, $fieldConfig);
        }
    }

    private function addField(FormBuilderInterface $builder, $fieldName, $fieldOptions)
    {
        $field = $builder->get($fieldName);
        $options = $field->getOptions();
        $type = get_class($field->getType()->getInnerType());
        $options = array_merge($options, $fieldOptions['options']);
        $builder->add($field->getName(), $type, $options);
    }
}
