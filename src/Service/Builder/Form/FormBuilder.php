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

        foreach ($serializedForm['children'] as $fieldData) {
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
            $root->appendChild($fieldElement);
        }

        return $root;
    }
}