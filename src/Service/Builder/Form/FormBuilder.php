<?php

namespace App\Service\Builder\Form;

use App\Service\Builder\Element;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;

class FormBuilder
{
    public function build(FormInterface $form): Element
    {
        $serializer = new Serializer();
        $serializedForm = $serializer->serialize($form);

        $root = new Element('ui-form', [
            'props' => [
                'model' => $serializedForm['model'],
                'name' => $serializedForm['name'],
                'action' => $serializedForm['action'],
                'method' => $serializedForm['method'],
            ]
        ]);

        $formattedForm = [];
        foreach ($serializedForm['children'] as $index => $fieldData) {
            $key = $index;
            if ($fieldData['block']) {
                $key = $fieldData['block'];
            }
            $formattedForm[$key][] = $fieldData;
        }

        foreach ($formattedForm as $group) {
            $row = new Element('ui-row', [
                'props' => [
                    'gutter' => 10,
                ]
            ]);

            foreach ($group as $fieldData) {
                $span = 24 / count($group);

                if ($fieldData['size']) {
                    $span = $fieldData['size'];
                }

                $col = new Element('ui-col', [
                    'props' => [
                        'span' => $span,
                    ]
                ]);

                $attrs = $fieldData['attr'] ?? [];

                $fieldElement = new Element($fieldData['type'], [
                    'props' => array_merge([
                        'value' => $fieldData['value'],
                        'name' => $fieldData['name'],
                        'label' => $fieldData['label'],
                        'description' => $fieldData['description'],
                        'rules' => empty($fieldData['rules']) ? new \stdClass() : $fieldData['rules'],
                        'messages' => empty($fieldData['messages']) ? new \stdClass() : $fieldData['messages'],
                        'choices' => $fieldData['choices']
                    ], $attrs),
                ]);

                if ($fieldData['layout']) {
                    $fieldData['layout']->appendChild($fieldElement);
                    $fieldElement = $fieldData['layout'];
                    unset($fieldData['layout']);
                }

                $col->appendChild($fieldElement);
                $row->appendChild($col);
            }
            $root->appendChild($row);
        }

        return $root;
    }
}