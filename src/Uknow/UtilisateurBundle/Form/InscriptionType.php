<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/03/15
 * Time: 12:30
 */

namespace Uknow\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscriptionType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('adresse_mail', 'email', array(
            'constraints' => array(
                new NotBlank(),
                new Email()
            ),
            'attr' => array(
                'placeholder' => 'Adresse Mail',
            )))
            ->add('mot_de_passe', 'password', array(
                'attr' => array(
                    'placeholder' => 'Mot de passe',
                )))
            ->add('confirmation', 'password', array(
                'attr' => array(
                    'placeholder' => 'Confirmation du mot de passe',
                )))
            ->add('inscription', 'submit');
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Staroad\UknowBundle\Classes\FormulaireInscription'
        ));
    }
    public function getName()
    {
        return 'staroad_uknowbundle';
    }
}