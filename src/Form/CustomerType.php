<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Customer;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', options: ['label' => 'Email: ', 'required' => true])
            ->add('password', options: ['mapped' => false, 'label' => 'Password: ', 'required' => true])
            ->add('firstName', options: ['label' => 'First Name: ', 'required' => true])
            ->add('lastName', options: ['label' => 'Last Name: ', 'required' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class
        ]);
    }
}
