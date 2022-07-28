<?php

namespace App\Controller;

use App\Component\Events\EventsList;
use App\Entity\Event;
use App\Form\EventType;
use App\Service\Builder\Element;
use App\Service\Builder\Form\FormBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class IndexController extends AbstractController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route('/api', name: 'index')]
    public function index(): JsonResponse
    {
        $root = new Element('div');

        $body = new Element('ui-body');
        $wrapper = new Element('ui-wrapper');
        /*        $searchSection = new Element('ui-hero-banner');
                $select1 = new Element('ui-select');
                $searchSection->appendChild($select1);


                //$events->setProp('filters', json_encode(['MTB', 'Road']));
                $wrapper->appendChild($searchSection);*/
        $wrapper->appendChild((new EventsList())->create());
        $body->appendChild($wrapper);

        $root->appendChild($body);

        return new JsonResponse($root->toArray());
    }

    #[Route('/api/event/create', name: 'event.create')]
    public function eventCreate(): JsonResponse
    {
        $root = new Element('div');

        $body = new Element('ui-body');
        $wrapper = new Element('ui-wrapper');

        $steps = new Element('ui-step-wizard');
        $firstStep = new Element('ui-step', [
            'props' => [
                'title' => 'Деталі',
                'index' => 0,
            ]
        ]);

        $event = new Event();
        $event->setTitle('trololo');
        $event->setDescription('alalal');

        $form = $this->createForm(EventType::class, $event);

        $formBuilder = new FormBuilder();
        $formElement = $formBuilder->build($form);
        $firstStep->appendChild($formElement);

        $steps->appendChild($firstStep);
        $steps->appendChild(new Element('ui-step', [
            'props' => [
                'title' => 'Деталі',
                'index' => 1,
            ]
        ]));
        $steps->appendChild(new Element('ui-step', [
            'props' => [
                'title' => 'Налаштування',
                'index' => 2,
            ]
        ]));


        $wrapper->appendChild(new Element('ui-breadcrumbs'));
        $wrapper->appendChild($steps);
        $body->appendChild($wrapper);

        $root->appendChild($body);

        return new JsonResponse($root->toArray());
    }

    #[Route('/api/events', name: 'events')]
    public function events(): JsonResponse
    {
        return new JsonResponse((new EventsList())->create()->toArray());
    }

    #[Route('/api/form', name: 'form_test')]
    public function form()
    {
        // creates a task object and initializes some data for this example
        $task = new Event();
        $form = $this->createForm(EventType::class, $task);

        $this->map = [
            NotBlank::class => ['required' => true],
        ];


        dd($form);

        dd($form->createView());

        dd('OLOLO');
    }

    #[Route(
        '/api/form/store',
        name: 'form',
        methods: ['POST', 'GET'],
        format: 'json'
    ), ]
    public function storeFirst(Request $request, ManagerRegistry $manager): JsonResponse
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        $form->submit($request->toArray());
        $errors = [];
        $valid = true;

        foreach ($form->all() as $item) {
            $errors[$item->getName()] = [];


            if(!$item->isValid()) {
                $valid = false;
                $errors[$item->getName()][] = $item->getErrors()->current()->getMessage();
            }
        }

        if (!$valid) {
            return new JsonResponse(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $manager->getManager()->persist($event);
        $manager->getManager()->flush();

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}