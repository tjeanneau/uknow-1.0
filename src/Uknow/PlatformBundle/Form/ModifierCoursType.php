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
use Symfony\Component\Validator\Constraints\NotBlank;

class ModifierCoursType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ckeditor', 'ckeditor', array(
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
            ),
            'constraints' => array(
                new NotBlank,
            )))
            ->add('temps', 'choice', array('choices' => array(
                '5' => '5',
                '10' => '10',
                '15' => '15',
                '20' => '20',
                '25' => '25',
                '30' => '30',
                '35' => '35',
                '40' => '40',
                '45' => '45',
                '50' => '50',
                '55' => '55',
                '60' => '60'
            ), 'empty_value' => 'Choisir le temps'
            ))
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
        return 'uknow_platformbundle_modifier_cours';
    }

}