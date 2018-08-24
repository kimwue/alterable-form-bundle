<?php

namespace Wuestkamp\AlterableFormBundle\Config;

class ConfigParser
{
    private $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * returns form class names specified as keys in yml
     * 
     * @return array
     */
    public function getForms()
    {
        if (array_key_exists('forms', $this->configuration)) {
            return $this->configuration['forms'];
        }

        return [];
    }

    /**
     * returns fields of passed form
     *
     * @param $formClassName
     * @return array
     */
    public function getFields($formClassName)
    {
        $forms = $this->getForms();

        if (array_key_exists($formClassName, $forms)) {
            return $forms[$formClassName];
        }

        return null;
    }

    /**
     * @param $formClassName
     * @param $fieldName
     * @return array|null
     */
    public function getFieldConfig($formClassName, $fieldName)
    {
        if ($fields = $this->getFields($formClassName)) {
            if (array_key_exists($fieldName, $fields)) {
                return $fields[$fieldName];
            }
        }

        return null;
    }

    /**
     * @param $formClassName
     * @param $fieldName
     * @return array|null
     */
    public function getFieldConfigOptions($formClassName, $fieldName)
    {
        if ($field = $this->getFieldConfig($formClassName, $fieldName)) {
            if (array_key_exists('options', $field)) {
                return $field['options'];
            }
        }

        return null;
    }
}
