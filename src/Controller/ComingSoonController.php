<?php

namespace App\Controller;


use App\Service\Builder\Element;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ComingSoonController extends AbstractController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route('/api/coming-soon', name: 'coming_soon')]
    public function index(): JsonResponse
    {
        sleep(5);
        $root = new Element('div');

        $body = new Element('ui-body');
        $wrapper = new Element('ui-wrapper');


        $wrapper->appendChild(new Element('app-coming-soon'));
        $body->appendChild($wrapper);

        $root->appendChild($body);

        return new JsonResponse($root->toArray());
    }
}