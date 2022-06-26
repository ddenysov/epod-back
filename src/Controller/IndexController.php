<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route('/blog', name: 'blog_list')]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'ololo' => 'trololo',
        ]);
    }
}