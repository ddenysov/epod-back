<?php

namespace App\Component\Events;

use App\Service\Builder\Element;

class EventsList
{
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
}