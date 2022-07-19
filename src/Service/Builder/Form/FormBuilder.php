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
                $col = new Element('ui-col', [
                    'props' => [
                        'span' => 24 / count($group),
                    ]
                ]);
                $fieldElement = new Element($fieldData['type'], [
                    'props' => [
                        'value' => $fieldData['value'],
                        'name' => $fieldData['name'],
                        'label' => $fieldData['label'],
                        'description' => $fieldData['description'],
                        'rules' => empty($fieldData['rules']) ? new \stdClass() : $fieldData['rules'],
                        'messages' => empty($fieldData['messages']) ? new \stdClass() : $fieldData['messages'],
                    ],
                ]);
                $col->appendChild($fieldElement);
                $row->appendChild($col);
            }
            $root->appendChild($row);
        }

        return $root;
    }
}