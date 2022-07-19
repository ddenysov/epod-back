<?php

namespace App\Form;

use App\Entity\Event;
use App\Form\Fields\LocationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'ololo trololo',
                'help' => '<a>alalalalal</a>',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'ololo trololo',
                'help' => '<a>alalalalal</a>',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
            ])
            ->add('start_date', DateTimeType::class, [
                'help' => '<a>alalalalal</a>',
                'block_name' => 'date',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('end_date', DateTimeType::class, [
                'help' => '<a>alalalalal</a>',
                'block_name' => 'date',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('image', TextType::class)
            ->add('location', LocationType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
