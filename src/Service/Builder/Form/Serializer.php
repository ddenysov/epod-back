<?php

namespace App\Service\Builder\Form;

use Symfony\Component\Form\Form;

class Serializer
{
    /**
     * @param Form $form
     * @return array
     */
    public function serialize(Form $form): array
    {
        return [];
    }
}