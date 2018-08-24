<?php

namespace Wuestkamp\AlterableFormBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class FormAlterator
{
    private $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Perform operations on FormBuilderInterface
     *
     * @param FormBuilderInterface $builder
     * @param $type
     * @param array
     * @return FormBuilderInterface
     */
    public function alter(FormBuilderInterface $builder, $type)
    {
        foreach ($this->configuration['forms'] as $formClass => $formConfig) {
            if ($type === $formClass) {
                foreach ($formConfig as $field => $fieldConfig) {
                    $this->addField($builder, $field, $fieldConfig);
                }
            }
        }

        return $builder;
    }

    /**
     * re-adds a field with overridden options values. There is no way currently to alter the options of
     * an existing field so we do it this way.
     *
     * @param FormBuilderInterface $builder
     * @param $fieldName
     * @param $fieldOptions
     */
    private function addField(FormBuilderInterface $builder, $fieldName, $fieldOptions)
    {
        if ($builder->has($fieldName)) {
            $field = $builder->get($fieldName);
            $options = $field->getOptions();
            $type = get_class($field->getType()->getInnerType());
            $options = array_merge($options, $fieldOptions['options']);
            $builder->add($field->getName(), $type, $options);
        }
    }
}
