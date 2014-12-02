<?php

namespace Bdloc\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email', 'email', array(                
                "label" => "Votre email"
            ))
            ->add('password', 'password', array(
                'type' => 'Votre mot de passe',
                'invalid_message' => 'Le login et le mot de passe ne correspondent pas',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'email'),
                'second_options' => array('label' => 'Mot de passe'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bdloc\AppBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bdloc_appbundle_user';
    }
}
