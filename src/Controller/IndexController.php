<?php

namespace App\Controller;

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

        $header = new Element('ui-header');

        $body = new Element('ui-body');
        $searchSection = new Element('ui-hero-banner');
        $events = new Element('app-events');
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        $events->appendChild(new Element('app-event-preview'));
        //$events->setProp('filters', json_encode(['MTB', 'Road']));
        $body->appendChild($searchSection);
        $body->appendChild($events);

        $footer = new Element('ui-footer');

        $root->appendChild($header);
        $root->appendChild($body);
        $root->appendChild($footer);

        return new JsonResponse($root->toArray());
    }
}