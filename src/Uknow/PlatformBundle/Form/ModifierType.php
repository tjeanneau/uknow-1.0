<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 09:44
 */

namespace Uknow\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModifierType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contenu', 'textarea', array('attr' => array('class' => 'ckeditor') ))
            ->add('temps', 'text', array('attr' => array('size' => 3)))
            ->add('modifier', 'submit');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uknow\PlatformBundle\Classes\FormulaireModifier'
        ));
    }

    public function getName()
    {
        return 'uknow_platformbundle_modifier';
    }

}