<?php

namespace Bdloc\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', array(
                "label" => "Votre prénom"
            ))
            ->add('name', 'text', array(
                "label" => "Votre nom"
            ))
            ->add('email', 'email', array(                
                "label" => "Votre email"
            ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Mot de passe (validation)'),
            ))
            ->add('adress', 'text', array(                
                "label" => "Votre adresse"
            ))
            ->add('postalCode', 'number', array(                
                "label" => "Votre code postal"
            ))
            ->add('tel', 'number', array(                
                "label" => "Votre téléphone"
            ))

            ->add('submit','submit', array(                
                "label" => "Envoyer ma demande",
                "attr" => array(
                    "class" => "btn"
                )
            ));
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
