<?php

namespace App\Controller;

use App\Component\Events\EventsList;
use App\Entity\Event;
use App\Form\EventType;
use App\Service\Builder\Element;
use App\Service\Builder\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class IndexController extends AbstractController
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

    #[Route('/event/create', name: 'event.create')]
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
                'title' => 'Реєстрація',
                'index' => 1,
                'form' => [
                    'fields' => [
                        [
                            'name' => 'name',
                            'value' => '',
                            'validation' => [
                                'required' => true,
                                'message' => 'Будь ласка введіть назву події',
                            ]
                        ],
                        [
                            'name' => 'description',
                            'value' => '',
                            'validation' => [
                                'required' => true,
                                'message' => 'Будь ласка введіть опис події',
                            ]
                        ]
                    ]
                ]
            ]
        ]));
        $steps->appendChild(new Element('ui-step', [
            'props' => [
                'title' => 'Налаштування',
                'index' => 3,
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

    #[Route('/form', name: 'form')]
    public function form()
    {
        // creates a task object and initializes some data for this example
        $task = new Event();
        $form = $this->createForm(EventType::class, $task);

        $this->map = [
            NotBlank::class => ['required' => true],
        ];

        $result = [];
        $items = $form->all();
        foreach ($items as $item) {
            dd($item);
            /*dump($item->createView());
            dump($item->getConfig()->getType());
            dump($item->getConfig()->getOptions());*/
        }

        dd($result);

        dd($form->get('title')->getConfig()->getOptions());

        dd($form->get('title')->createView());

        dd('OLOLO');
    }
}