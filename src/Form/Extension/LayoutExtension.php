<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LayoutExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(['layout', 'block_size']);
    }

    public static function getExtendedTypes(): iterable
    {
        return [
            TextType::class,
            DateTimeType::class,
            ButtonType::class,
            ChoiceType::class
        ];
    }
}