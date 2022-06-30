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

        $header = new Element('ui-header');

        $body = new Element('ui-body');
        $searchSection = new Element('ui-hero-banner');
        $select1 = new Element('ui-select');
        $searchSection->appendChild($select1);


        //$events->setProp('filters', json_encode(['MTB', 'Road']));
        $body->appendChild($searchSection);
        $body->appendChild((new EventsList())->create());

        $footer = new Element('ui-footer');

        $root->appendChild($header);
        $root->appendChild($body);
        $root->appendChild($footer);

        return new JsonResponse($root->toArray());
    }

    #[Route('/events', name: 'events')]
    public function events(): JsonResponse
    {
        return new JsonResponse((new EventsList())->create()->toArray());
    }
}