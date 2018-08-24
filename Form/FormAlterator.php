<?php

namespace Wuestkamp\AlterableFormBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Wuestkamp\AlterableFormBundle\Config\ConfigParser;

class FormAlterator
{
    private $configParser;

    public function __construct(ConfigParser $configParser)
    {
        $this->configParser = $configParser;
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
        if ($fields = $this->configParser->getFields($type)) {
            foreach ($fields as $fieldName => $fieldOptions) {
                $this->performFieldOperations($builder, $type, $fieldName);
            }
        }

        return $builder;
    }

    /**
     * @param $builder
     * @param $type
     * @param $fieldName
     */
    private function performFieldOperations($builder, $type, $fieldName)
    {
        if ($remove = $this->configParser->getFieldConfigRemove($type, $fieldName)) {
            $this->removeField($builder, $fieldName);
        } elseif ($options = $this->configParser->getFieldConfigOptions($type, $fieldName)) {
            $this->addField($builder, $fieldName, $options);
        }
    }

    /**
     * @param FormBuilderInterface $builder
     * @param $fieldName
     */
    private function removeField(FormBuilderInterface $builder, $fieldName)
    {
        if ($builder->has($fieldName)) {
            $builder->remove($fieldName);
        }
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
            $options = array_merge($options, $fieldOptions);
            $builder->add($field->getName(), $type, $options);
        }
    }
}
