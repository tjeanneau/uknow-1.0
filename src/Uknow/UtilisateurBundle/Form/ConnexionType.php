<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/03/15
 * Time: 16:23
 */

namespace Uknow\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConnexionType extends AbstractType{

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
            ->add('connexion', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Staroad\UknowBundle\Classes\FormulaireConnexion'
        ));
    }

    public function getName()
    {
        return 'staroad_uknowbundle';
    }
}