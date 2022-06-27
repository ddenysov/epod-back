<?php

namespace App\Tests\Service\Builder;

use App\Service\Builder\Element;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testBuilderRootElements()
    {
        $root = new Element('template');
        $this->assertEquals([
            'tag' => 'template',
            'props' => [],
            'children' => [],
        ], $root->toArray());
    }

    public function testBuilderElementsAndProps()
    {
        $root = new Element('template');
        $root->setProp('name', 'New Component');
        $this->assertEquals([
            'tag' => 'template',
            'props' => [
                'name' => 'New Component'
            ],
            'children' => [],
        ], $root->toArray());
    }

    public function testBuilderWithChildren()
    {
        $root = new Element('template');
        $root->setProp('name', 'New Component');
        $root->appendChild(new Element('ui-panel'));
        $root->appendChild(new Element('ui-panel'));

        $this->assertEquals('template', $root->getTag());
        $this->assertEquals('New Component', $root->getProp('name'));
        $this->assertEquals('ui-panel', $root->getChild(0)->getTag());

        $this->assertEquals([
            'tag' => 'template',
            'props' => [
                'name' => 'New Component'
            ],
            'children' => [
                [
                    'tag' => 'ui-panel',
                    'props' => [],
                    'children' => [],
                ],
                [
                    'tag' => 'ui-panel',
                    'props' => [],
                    'children' => [],
                ]
            ],
        ], $root->toArray());
    }

    public function testDeeplyNested()
    {
        $root = new Element('template');
        $root->setProp('name', 'New Component');
        $root->appendChild(new Element('ui-panel'));

        $panel = new Element('ui-panel');
        $panel->appendChild(new Element('ui-form'));

        $root->appendChild($panel);

        $this->assertEquals([
            'tag' => 'template',
            'props' => [
                'name' => 'New Component'
            ],
            'children' => [
                [
                    'tag' => 'ui-panel',
                    'props' => [],
                    'children' => [],
                ],
                [
                    'tag' => 'ui-panel',
                    'props' => [],
                    'children' => [
                        [
                            'tag' => 'ui-form',
                            'props' => [],
                            'children' => [],
                        ]
                    ],
                ]
            ],
        ], $root->toArray());
    }
}
