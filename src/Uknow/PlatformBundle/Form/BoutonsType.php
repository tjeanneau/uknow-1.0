<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/02/15
 * Time: 13:34
 */

namespace Uknow\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BoutonsType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pertinent', 'submit')
            ->add('developper', 'submit')
            ->add('modifier', 'submit')
            ->add('modification', 'submit')
            ->add('suivre', 'submit')
            ->add('enregistrer', 'submit');
    }

    public function getName()
    {
        return 'uknow_platformbundle_donnees';
    }
}