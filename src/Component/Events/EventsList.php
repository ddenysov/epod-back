<?php

namespace App\Component\Events;

use App\Form\Event\FilterType;
use App\Form\Event\SearchType;
use App\Service\Builder\Element;
use App\Service\Builder\Form\FormBuilder;
use App\Service\Builder\TextElement;
use Symfony\Component\Form\FormInterface;

class EventsList
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function create(): Element
    {
        $events = new Element('app-events', [
            'props' => [
                'filters' => [
                    [
                        'label' => 'Всі',
                        'key' => 'all',
                    ],
                    [
                        'label' => 'Сьогодні',
                        'key' => 'today',
                    ],
                    [
                        'label' => 'Завтра',
                        'key' => 'tomorrow',
                    ],
                    [
                        'label' => 'На цьому тижні',
                        'key' => 'week',
                    ],
                    [
                        'label' => 'Вихідні',
                        'key' => 'weekend',
                    ],
                ],
                'name' => 'events'
            ]
        ]);

        $form = $this->createForm(FilterType::class);
        $formBuilder = new FormBuilder();
        $formElement = $formBuilder->build($form);

        $filters = new Element('div', [], [$formElement]);

        $events->appendSlot('filters', $filters);

        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));
        $events->appendChild(new Element('app-event-preview', [
            'props' => [
                'title' => 'Some title ' . rand(1, 500),
            ],
        ]));

        return $events;
    }

    /**
     * Creates and returns a Form instance from the type of the form.
     */
    protected function createForm(string $type, mixed $data = null, array $options = []): FormInterface
    {
        return $this->container->get('form.factory')->create($type, $data, $options);
    }
}