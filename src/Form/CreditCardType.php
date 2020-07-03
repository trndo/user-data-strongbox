<?php

namespace App\Form;

use App\Model\CreditCardModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paymentNumber', TextType::class)
            ->add('cardVerificationCode', TextType::class)
            ->add('password', TextType::class)
            ->add('expirationDate', TextType::class)
            ->add('passPhrase', TextType::class)
            ->add('userKey', PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreditCardModel::class,
        ]);
    }
}
