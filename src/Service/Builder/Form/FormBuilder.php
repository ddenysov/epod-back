<?php

namespace App\Service\Builder\Form;

use App\Service\Builder\Element;
use Symfony\Component\Form\Form;

class FormBuilder
{
    public function build(Form $form): Element
    {
        $serializer = new Serializer();
        $serializedForm = $serializer->serialize($form);
        $root = new Element('ui-form');

        foreach ($serializedForm as $fieldData) {
            $fieldElement = new Element('ui-form-item', [
                'props' => [
                    'label' => $fieldData['label'],
                    'description' => $fieldData['label'],
                    'rules' => $fieldData['rules'],
                ]
            ], [
                new Element($fieldData['type'], [
                    'props' => [
                        'value' => $fieldData['value'],
                    ],
                ]),
            ]);
            $root->appendChild($fieldElement);
        }

        return $root;
    }
}