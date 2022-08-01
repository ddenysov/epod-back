<?php

namespace App\Form\Fields;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('file_name', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('type', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('size', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('width', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('height', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('path', HiddenType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
        ;

    }
}
