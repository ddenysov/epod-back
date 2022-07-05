<?php

namespace App\Controller;

use App\Component\Events\EventsList;
use App\Service\Builder\Element;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route('/', name: 'index')]
    public function index(): JsonResponse
    {
        $root = new Element('div');

        $body = new Element('ui-body');
        $wrapper = new Element('ui-wrapper');
        $searchSection = new Element('ui-hero-banner');
        $select1 = new Element('ui-select');
        $searchSection->appendChild($select1);


        //$events->setProp('filters', json_encode(['MTB', 'Road']));
        $wrapper->appendChild($searchSection);
        $wrapper->appendChild((new EventsList())->create());
        $body->appendChild($wrapper);

        $root->appendChild($body);

        return new JsonResponse($root->toArray());
    }

    #[Route('/event/create', name: 'event.create')]
    public function eventCreate(): JsonResponse
    {
        $root = new Element('div');

        $body = new Element('ui-body');
        $wrapper = new Element('ui-wrapper');

        $steps = new Element('ui-steps');
        $steps->appendChild(new Element('ui-step', [
            'props' => [
                'title' => 'Деталі',
            ]
        ]));
        $steps->appendChild(new Element('ui-step', [
            'props' => [
                'title' => 'Реєстрація',
            ]
        ]));
        $steps->appendChild(new Element('ui-step', [
            'props' => [
                'title' => 'Налаштування',
            ]
        ]));


        $wrapper->appendChild(new Element('ui-breadcrumbs'));
        $wrapper->appendChild($steps);
        $body->appendChild($wrapper);

        $root->appendChild($body);

        return new JsonResponse($root->toArray());
    }

    #[Route('/events', name: 'events')]
    public function events(): JsonResponse
    {
        return new JsonResponse((new EventsList())->create()->toArray());
    }
}