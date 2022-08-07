<?php

namespace App\Form\Event;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('period', ChoiceType::class, [
                'block_name' => 'search',
                'block_size' => 10,
                'attr' => [
                    'fullWidth' => true,
                ],
                'choices'  => [
                    'Всі' => null,
                    'Сьогодні' => 1,
                    'Завтра' => 2,
                    'На цьому тижні' => 3,
                    'Вихідні' => 4,
                    'Цього місяця' => 5,
                ],
            ])
            ->add('save', ButtonType::class, [
                'block_name' => 'search',
                'block_size' => 4,
            ]);
    }
}