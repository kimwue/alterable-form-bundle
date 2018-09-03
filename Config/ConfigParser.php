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
        if (is_string($formClassName)) {
            if ($forms = $this->getForms()) {
                if (array_key_exists($formClassName, $forms)) {
                    if (array_key_exists('fields', $forms[$formClassName])) {
                        return $forms[$formClassName]['fields'];
                    }
                }
            }
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
     * returns the $key value for $formClassName->$fieldName
     *
     * @param $formClassName
     * @param $fieldName
     * @param $key
     * @return array|null
     */
    public function getFieldConfigKey($formClassName, $fieldName, $key)
    {
        if ($field = $this->getFieldConfig($formClassName, $fieldName)) {
            if (array_key_exists($key, $field)) {
                return $field[$key];
            }
        }

        return null;
    }

    /**
     * returns the options value for $formClassName->$fieldName
     *
     * @param $formClassName
     * @param $fieldName
     * @return array|null
     */
    public function getFieldConfigOptions($formClassName, $fieldName)
    {
        return $this->getFieldConfigKey($formClassName, $fieldName, 'options');
    }

    /**
     * returns the add value for $formClassName->$fieldName
     *
     * @param $formClassName
     * @param $fieldName
     * @return bool
     */
    public function getFieldConfigAdd($formClassName, $fieldName)
    {
        $add = $this->getFieldConfigKey($formClassName, $fieldName, 'add');

        if ($add !== null) {
            return $add === true;
        }

        return false;
    }
}
