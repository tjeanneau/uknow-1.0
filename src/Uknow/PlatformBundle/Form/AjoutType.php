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