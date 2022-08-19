<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\Event\SearchType;
use App\Form\UserType;
use App\Service\Builder\Element;

use App\Service\Builder\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class SignUpController extends AbstractController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route('/api/sign_up', name: 'coming_soon')]
    public function index(): JsonResponse
    {
        $root = new Element('div');

        $body = new Element('ui-body');
        $container = new Element('ui-container', [
            'props' => [
                'align' => 'center',
            ]
        ]);
        $row = new Element('ui-row');
        $col = new Element('ui-col', [
            'props' => [
                'span' => 8,
                'offset' => 8,
            ]
        ]);


        $form = $this->createForm(UserType::class, new User(), [
            'action' => '/events',
            'method' => 'GET',
        ]);

        $formBuilder = new FormBuilder();
        $formElement = $formBuilder->build($form);

        $col->appendChild($formElement);
        $row->appendChild($col);
        $container->appendChild($row);
        $body->appendChild($container);

        $root->appendChild($body);

        return new JsonResponse($root->toArray());
    }
}