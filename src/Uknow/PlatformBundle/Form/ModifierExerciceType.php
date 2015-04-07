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

class ModifierExerciceType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ckeditor', 'ckeditor', array(
                'config' => array(
                    'toolbar' => array(
                        array(
                            'name'  => 'document',
                            'items' => array('Maximize', '-', 'DocProps', 'Preview', 'Print'),
                        ),
                        array(
                            'name'  => 'editing',
                            'items' => array('Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'),
                        ),
                        array(
                            'name'  => 'clipboard',
                            'items' => array('Undo', 'Redo'),
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
                ),
            'constraints' => array(
                new NotBlank,
            )))
            ->add('correction', 'ckeditor', array(
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
                ),
                'constraints' => array(
                    new NotBlank,
                )))
            ->add('temps', 'text', array('attr' => array('size' => 3)))
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
        return 'uknow_platformbundle_modifier_exercice';
    }

}