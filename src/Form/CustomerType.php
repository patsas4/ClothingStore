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
            ->add('email', options: ['label' => 'Email: '])
            ->add('password', options: ['mapped' => false, 'label' => 'Password: '])
            ->add('firstName', options: ['label' => 'First Name: '])
            ->add('lastName', options: ['label' => 'Last Name: '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class
        ]);
    }
}
