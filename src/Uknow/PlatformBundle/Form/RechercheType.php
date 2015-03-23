<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 24/02/15
 * Time: 11:44
 */

namespace Uknow\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RechercheType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recherche', 'text', array('attr' => array( 'placeholder' => 'Un cours ou un exercice à rechercher ?')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uknow\PlatformBundle\Classes\FormulaireRechercher'
        ));
    }

    public function getName()
    {
        return 'uknow_platformbundle_recherche';
    }

}