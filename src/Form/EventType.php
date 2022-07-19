<?php

namespace App\Form;

use App\Entity\Event;
use App\Form\Fields\LocationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'label' => 'Дайте назву події.',
                'help' => 'Подивіться, як ваше ім’я відображається на сторінці події, а також список усіх місць, де використовуватиметься ваша назва події. <a class="el-link el-link--primary" href="#">Дізнатися більше</a>',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Будь ласка, опишіть свою подію.',
                'help' => 'Напишіть кілька слів нижче, щоб описати свою подію та надайте будь-яку додаткову інформацію, таку як розклад, маршрут або будь-які спеціальні інструкції, необхідні для відвідування вашої події.',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
            ])
            ->add('start_date', DateTimeType::class, [
                'label' => 'Коли почнеться ваша подія?',
                'help' => 'Повідомте своїм учасникам, коли ваша подія почнеться, щоб вони могли підготуватися до участі.',
                'block_name' => 'date',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('end_date', DateTimeType::class, [
                'label' => 'Коли закінчеться ваша подія?',
                'help' => 'Повідомте своїм учасникам, коли ваша подія завершиться, щоб вони могли спланувати свій час.',
                'block_name' => 'date',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('image', TextType::class, [
                'label' => 'Додайте кілька зображень на банер події.',
                'help' => 'Завантажте барвисті та яскраві зображення як банер для вашої події! Подивіться, як гарні зображення допомагають вашій сторінці подій. <a class="el-link el-link--primary" href="#">Дізнайтесь більше</a>'
            ])
            ->add('location', LocationType::class, [
                'label' => 'Де відбувається ваш захід?',
                'help' => 'Додайте місце проведення до своєї події, щоб повідомити учасникам, де приєднатися до події.',
                'constraints' => [
                    new NotBlank(),
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
