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

class AjoutExerciceType extends AbstractType{

    private $domaine;
    private $matiere;
    private $theme;
    private $chapitre;

    public function __construct($domaine, $matiere, $theme, $chapitre){
        $this->domaine = $domaine;
        $this->matiere = $matiere;
        $this->theme = $theme;
        $this->chapitre = $chapitre;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', 'text', array(
                    'attr' => array(
                        'placeholder' => 'Titre'
                    )))
            ->add('ckeditor', 'ckeditor', array(
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
            ->add('domaine_lien', 'choice', array(
                'choices' => $this->domaine,
                'empty_value' => 'Choisir le domaine'
            ))
            ->add('matiere_lien', 'choice', array(
                'choices' => $this->matiere,
                'empty_value' => 'Choisir la matière'
            ))
            ->add('theme_lien', 'choice', array(
                'choices' => $this->theme,
                'empty_value' => 'Choisir le thème'
            ))
            ->add('chapitre_lien', 'choice', array(
                'choices' => $this->chapitre,
                'empty_value' => 'Choisir le chapitre'
            ))
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
            ->add('niveau', 'choice', array('choices' => array(
                'Sixième' => 'Sixième',
                'Cinquième' => 'Cinquième',
                'Quatrième' => 'Quatrième',
                'Troisième' => 'Troisième',
                'Seconde' => 'Seconde',
                'Première' => 'Première',
                'Terminal' => 'Terminal',
                'Bac + 1' => 'Bac + 1',
                'Bac + 2' => 'Bac + 2',
                'Bac + 3' => 'Bac + 3',
                'Bac + 4' => 'Bac + 4',
                'Bac + 5' => 'Bac + 5',
                'Bac + 6' => 'Bac + 6',
                'Bac + 7' => 'Bac + 7',
                'Bac + 8' => 'Bac + 8'), 'empty_value' => 'Choisir le niveau'
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
        return 'uknow_platformbundle_ajout_exercice';
    }
}