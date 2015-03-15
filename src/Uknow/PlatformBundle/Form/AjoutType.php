<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22/02/15
 * Time: 14:37
 */

namespace Uknow\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AjoutType extends AbstractType{

    private $listStructure;

    public function __construct($listStructure){
        $this->listStructure = $listStructure;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', 'text', array(
                    'attr' => array(
                        'placeholder' => 'Titre'
                    )))
            ->add('contenu', 'ckeditor', array(
                    'config' => array(
                        'toolbar' => array(
                            array(
                                'name'  => 'document',
                                'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                            ),
                            '/',
                            array(
                                'name'  => 'basicstyles',
                                'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                            ),
                        ),
                        'uiColor' => '#ffffff',
                    )))
            ->add('structure', 'choice', array(
                    'choices' => $this->listStructure,
                    'empty_value' => 'Choisir le chapitre'
                    ))
            ->add('type', 'choice', array(
                    'choices' => array(
                        'Exercice' => 'Exercice',
                        'Cours' => 'Cours'),
                    'empty_value' => 'Choisir le type'
                    ))
            ->add('temps', 'text', array(
                    'attr' => array(
                        'size' => 39,
                        'placeholder' => 'Choisir le temps d\'apprentissage ou de réalisation'
                    )))
            ->add('niveau', 'choice', array('choices' => array(
                    '1' => '6ème = niveau 1',
                    '2' => '5ème = niveau 2',
                    '3' => '4ème = niveau 3',
                    '4' => '3ème = niveau 4',
                    '5' => 'Seconde = niveau 5',
                    '6' => 'Première = niveau 6',
                    '7' => 'Terminal = niveau 7',
                    '8' => 'Bac+1 = niveau 8',
                    '9' => 'Bac+2 = niveau 9',
                    '10' => 'Bac+3 = niveau 10',
                    '11' => 'Bac+4 = niveau 11',
                    '12' => 'Bac+5 = niveau 12',
                    '13' => 'Bac+6 = niveau 13',
                    '14' => 'Bac+7 = niveau 14',
                    '15' => 'Bac+8 = niveau 15'), 'empty_value' => 'Choisir le niveau'
                    ))
            ->add('ajouter', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uknow\PlatformBundle\Classes\FormulaireAjouter'
        ));
    }

    public function getName()
    {
        return 'uknow_platformbundle_ajout';
    }
}