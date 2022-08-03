<?php

namespace App\Form\Event;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', ChoiceType::class, [
                'block_name' => 'search',
                'attr' => [
                    'fullWidth' => true,
                ],
                'choices'  => [
                    'Всі' => null,
                    'Гірський велосипед' => 1,
                    'Шоссе' => 2,
                    'Гревел' => 3,
                    'Бревет' => 4,
                    'Багатоденні' => 5,
                    'Змагання' => 6,
                ],
            ])
            ->add('complexity', ChoiceType::class, [
                'attr' => [
                    'fullWidth' => true,
                ],
                'choices'  => [
                    'Всі' => null,
                    'Легка складність' => true,
                    'Середня складність' => false,
                    'Важка складність' => false,
                ],
                'block_name' => 'search',
            ])
            ->add('save', ButtonType::class, [
                'block_name' => 'search',
                'block_size' => 4,
                'attr' => [
                    'fullWidth' => true,
                ],
            ]);
    }
}