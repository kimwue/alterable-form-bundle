<?php

namespace Wuestkamp\AlterableFormBundle\Form;

use Symfony\Component\Form\FormRegistryInterface;
use Symfony\Component\Form\ResolvedFormTypeFactoryInterface;

class FormFactory extends \Symfony\Component\Form\FormFactory
{
    private $alterator;

    public function __construct(
        FormRegistryInterface $registry,
        ResolvedFormTypeFactoryInterface $resolvedTypeFactory,
        FormAlterator $alterator
    )
    {
        parent::__construct($registry, $resolvedTypeFactory);
        $this->alterator = $alterator;
    }

    /**
     * Creates FormBuilder as parent but will apply changes from yml if available
     *
     * @param string $type
     * @param null $data
     * @param array $options
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = [])
    {
        $builder = $this->createBuilder($type, $data, $options);
        $this->alterator->alter($builder, $type);
        return $builder->getForm();
    }
}
