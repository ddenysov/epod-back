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
        $resolver = new SymfonyRuleResolver();
        $result = [];
        $items = $form->all();
        foreach ($items as $item) {
            $result[$item->getName()] = [
                'name' => $item->getName(),
                'type' => substr(strrchr(get_class($item->getConfig()->getType()->getInnerType()), '\\'), 1),
                'label' => $item->getConfig()->getOption('label'),
                'description' => $item->getConfig()->getOption('help'),
                'rules' => $resolver->resolve($item),
            ];
        }
        return $result;
    }
}