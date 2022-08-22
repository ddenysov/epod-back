<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\Builder\Element;
use App\Service\Builder\Form\FormBuilder;
use App\Service\Builder\TextElement;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SignUpController extends AbstractController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route('/api/sign_up', name: 'sign_up')]
    public function index(): JsonResponse
    {
        $root = new Element('div');

        $body = new Element('ui-body', [
            'props' => [
                'name' => 'body',
            ]
        ]);
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
            'action' => '/sign_up/store',
            'method' => 'POST',
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

    /**
     * @param Request $request
     * @param ManagerRegistry $manager
     * @return JsonResponse
     */
    #[Route('/api/sign_up/store', name: 'store_user')]
    public function store(Request $request, ManagerRegistry $manager): JsonResponse
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

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

        $manager->getManager()->persist($user);
        $manager->getManager()->flush();

        $element = new Element('ui-body', [
            'props' => [
                'name' => 'body',
            ]
        ], [new Element('ui-dialog')]);

        return new JsonResponse($element->toArray(), Response::HTTP_CREATED);
    }
}