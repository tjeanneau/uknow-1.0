<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22/02/15
 * Time: 14:44
 */

namespace Uknow\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question', 'text', array('attr' => array( 'placeholder' => 'Une question à poser ?')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uknow\PlatformBundle\Entity\Question'
        ));
    }

    public function getName()
    {
        return 'uknow_platformbundle_question';
    }
}