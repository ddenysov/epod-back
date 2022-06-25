<?php

namespace App\Service\Builder;

class Builder
{
    public function build(): array
    {
        return [
            [
                'tag' => 'ui-panel',
                'props' => [
                    'name' => 'trololo',
                    'title' => 'Panel title',
                ],
                'children' => [
                    [
                        'tag' => 'ui-form',
                        'props' => [
                            'name' => 'simple-form',
                        ],
                        'children' => [
                            [
                                'tag' => 'ui-text-input',
                                'props' => [
                                    'name' => 'login',
                                    'validation' => [
                                        'required' => true,
                                    ]
                                ]
                            ],
                            [
                                'tag' => 'ui-password-input',
                                'props' => [
                                    'name' => 'password',
                                    'validation' => [
                                        'required' => true,
                                        'password' => true,
                                    ]
                                ]
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }
}