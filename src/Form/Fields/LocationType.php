<?php

namespace App\Form\Fields;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lat', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('lng', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ]);

    }
}
