<?php

namespace App\Tests\Service\Builder\Form;

use App\Entity\Event;
use App\Form\EventType;
use App\Service\Builder\Form\FormBuilder;
use App\Service\Builder\Form\Serializer;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BuilderTest extends KernelTestCase
{
    public function testSerialization()
    {
        self::bootKernel();
        $event = new Event();
        $event->setTitle('ololo');
        $container = static::getContainer();
        $form = $container->get('form.factory')->create(EventType::class, $event);
        $builder = new FormBuilder();

        $root = $builder->build($form);
        $this->assertEquals('ui-form', $root->getTag());
        $title = $root->getChild(0);
        $this->assertEquals('ui-form-item', $title->getTag());
        $this->assertEquals('ololo trololo', $title->getProp('label'));
        $this->assertEquals('<a>alalalalal</a>', $title->getProp('description'));
        $this->assertEquals(['required' => true], $title->getProp('rules'));
        $this->assertEquals('ololo', $title->getChild(0)->getProp('value'));
        $this->assertEquals('text-type', $title->getChild(0)->getTag());
    }
}
