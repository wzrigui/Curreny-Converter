<?php


namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\CurrencyConverter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;



class CurrencyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $build, array $option) {

        $build
            ->add('amount',NumberType::class,)
            ->add('from', ChoiceType::class, [
                'choices'  => [
                    'Euro' => 'EUR',
                    'Us Dollar' => 'USD',
                    'Britisch Pfund' => 'GBP',
                    'Schweizer Franken' => 'CHF',
                ],
            ])
            ->add('to', ChoiceType::class, [
                'choices'  => [
                    'Japanese Yen' => 'JPY',
                    'Us Dollar' => 'USD',
                    'Britisch Pfund' => 'GBP',
                    'Schweizer Franken' => 'CHF',
                    'Canadien Dollar' => 'CAD',
                ],
            ])
            ->add('convert',SubmitType::class);


    }

       public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CurrencyConverter::class,
        ]);
    }
}