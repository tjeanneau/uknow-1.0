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
            ->add('cours', 'ckeditor', array(
                    'config' => array(
                        'toolbar' => array(
                            array(
                                'name'  => 'document',
                                'items' => array('Maximize', '-', 'NewPage', 'DocProps', 'Preview', 'Print', 'Templates'),
                            ),
                            array(
                                'name'  => 'clipboard',
                                'items' => array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord','Undo', 'Redo'),
                            ),
                            array(
                                'name'  => 'indent',
                                'items' => array( 'NumberedList', 'BulletedList', 'Outdent', 'Indent','Blockquote', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'),
                            ),
                            array(
                                'name'  => 'insert',
                                'items' => array( 'SpecialChar','Image', 'Table', 'HorizontalRule'),
                            ),
                            '/',
                            array(
                                'name'  => 'style',
                                'items' => array('Styles', 'Format', 'Font', 'FontSize'),
                            ),
                            array(
                                'name'  => 'basic style',
                                'items' => array('Bold', 'Italic', 'Underline','Strike', 'Subscript', 'Superscript', 'RemoveFormat'),
                            ),
                            array(
                                'name'  => 'colors',
                                'items' => array('TextColor', 'BGColor'),
                            )
                        ),
                        'uiColor' => '#ffffff',
                        'config_name' => 'my_config',
                    )))
            ->add('exercice', 'ckeditor', array(
                'config' => array(
                    'toolbar' => array(
                        array(
                            'name'  => 'document',
                            'items' => array('Maximize', '-', 'NewPage', 'DocProps', 'Preview', 'Print', 'Templates'),
                        ),
                        array(
                            'name'  => 'clipboard',
                            'items' => array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord','Undo', 'Redo'),
                        ),
                        array(
                            'name'  => 'indent',
                            'items' => array( 'NumberedList', 'BulletedList', 'Outdent', 'Indent','Blockquote', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'),
                        ),
                        array(
                            'name'  => 'insert',
                            'items' => array( 'SpecialChar','Image', 'Table', 'HorizontalRule'),
                        ),
                        '/',
                        array(
                            'name'  => 'style',
                            'items' => array('Styles', 'Format', 'Font', 'FontSize'),
                        ),
                        array(
                            'name'  => 'basic style',
                            'items' => array('Bold', 'Italic', 'Underline','Strike', 'Subscript', 'Superscript', 'RemoveFormat'),
                        ),
                        array(
                            'name'  => 'colors',
                            'items' => array('TextColor', 'BGColor'),
                        ),
                        array(
                            'name'  => 'form',
                            'items' => array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton'),
                        )
                    ),
                    'uiColor' => '#ffffff',
                    'config_name' => 'my_config',
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
            ->add('temps', 'choice', array('choices' => array(
                    '1' => '5',
                    '2' => '10',
                    '3' => '15',
                    '4' => '20',
                    '5' => '25',
                    '6' => '30',
                    '7' => '35',
                    '8' => '40',
                    '9' => '45',
                    '10' => '50',
                    '11' => '55',
                    '12' => '60'
                    ), 'empty_value' => 'Choisir le temps'
                    ))
            ->add('niveau', 'choice', array('choices' => array(
                    '1' => 'Sixième',
                    '2' => 'Cinquième',
                    '3' => 'Quatrième',
                    '4' => 'Troisième',
                    '5' => 'Seconde',
                    '6' => 'Première',
                    '7' => 'Terminal',
                    '8' => 'Bac + 1',
                    '9' => 'Bac + 2',
                    '10' => 'Bac + 3',
                    '11' => 'Bac + 4',
                    '12' => 'Bac + 5',
                    '13' => 'Bac + 6',
                    '14' => 'Bac + 7',
                    '15' => 'Bac + 8'), 'empty_value' => 'Choisir le niveau'
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