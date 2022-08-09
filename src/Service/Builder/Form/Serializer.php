<?php

namespace App\Service\Builder\Form;

use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            'method' => $form->getConfig()->getMethod(),
            'action' => $form->getConfig()->getAction(),
            'group' => $form->getConfig()->getOption('block_name'),
            'model' => [],
            'children' => [],
        ];
        $items = $form->all();
        foreach ($items as $item) {
            $type = get_class($item->getConfig()->getType()->getInnerType());

            if ($type === CollectionType::class) {
                $type = $item->getConfig()->getOption('entry_type');
            }

            $normalType = substr(strrchr($type, '\\'), 1);
            $uiType = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $normalType));

            $choices = $item->getConfig()->getAttribute('choice_list');

            $choicesResult = [];
            if ($choices) {
                /**
                 * @var ArrayChoiceList $choices
                 */
                $keysList = $choices->getChoices();
                $valuesList = $choices->getOriginalKeys();

                foreach ($keysList as $key => $value) {
                    $choicesResult[$key] = [
                        'value' => $value,
                        'label' => $valuesList[$key]
                    ];
                }
            }

            $result['model'][$item->getName()] = $item->getData();
            $result['children'][$item->getName()] = [
                'name' => $item->getName(),
                'type' => $uiType,
                'value' => $item->getData(),
                'attr' => $item->getConfig()->getOption('attr'),
                'label' => $this->resolveLabel($item),
                'description' => $item->getConfig()->getOption('help'),
                'rules' => $resolver->resolve($item)['rules'],
                'messages' => $resolver->resolve($item)['messages'],
                'block' => $item->getConfig()->getOption('block_name'),
                'layout' => $item->getConfig()->getOption('layout'),
                'size' => $item->getConfig()->getOption('block_size'),
                'choices' => $choicesResult,
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