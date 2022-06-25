<?php

namespace App\Controller;

use App\Service\Builder\Builder;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    /**
     * @return void
     */
    public function index(): JsonResponse
    {
        $builder = new Builder();

        return new JsonResponse($builder->build());
    }
}