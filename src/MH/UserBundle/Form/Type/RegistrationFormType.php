<?php
namespace MH\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseFormType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
            ))
        ;
    }

    public function getName()
    {
        return 'mh_user_form_type_user_registration';
    }
}
