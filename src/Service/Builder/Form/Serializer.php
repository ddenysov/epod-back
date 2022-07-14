<?php

namespace App\Service\Builder\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;

class Serializer
{
    /**
     * @param Form $form
     * @return array
     */
    public function serialize(FormInterface $form): array
    {
        $resolver = new SymfonyRuleResolver();
        $result = [
            'name' => $form->getName(),
            'model' => [],
            'children' => [],
        ];
        $items = $form->all();
        foreach ($items as $item) {
            $normalType = substr(strrchr(get_class($item->getConfig()->getType()->getInnerType()), '\\'), 1);
            $uiType = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $normalType));
            $result['model'][$item->getName()] = $item->getData();
            $result['children'][$item->getName()] = [
                'name' => $item->getName(),
                'type' => $uiType,
                'value' => $item->getData(),
                'label' => $this->resolveLabel($item),
                'description' => $item->getConfig()->getOption('help'),
                'rules' => $resolver->resolve($item)['rules'],
                'messages' => $resolver->resolve($item)['messages'],
            ];
        }
        return $result;
    }

    /**
     * @param FormInterface $item
     * @return string
     */
    private function resolveLabel(FormInterface $item): string
    {
        return $item->getConfig()->getOption('label') ?? str_ireplace('_', ' ', ucfirst($item->getName()));
    }
}