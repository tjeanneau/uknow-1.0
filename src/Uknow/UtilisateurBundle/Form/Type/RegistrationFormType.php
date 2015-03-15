<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/03/15
 * Time: 17:59
 */

namespace Uknow\UtilisateurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class RegistrationFormType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('niveauChapitre')
        ->add('voixChapitre')
        ->add('donneesSauvegardees')
        ->add('donneesEvaluees');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'uknow_utilisateur_registration';
    }
}