<?php

namespace App\Tests\Service\Builder\Form;

use App\Entity\Event;
use App\Form\EventType;
use App\Service\Builder\Form\Serializer;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class Test extends KernelTestCase
{
    public function testSerialization()
    {
        self::bootKernel();
        $event = new Event();
        $container = static::getContainer();
        $form = $container->get('form.factory')->create(EventType::class, $event);
        $serializer = new Serializer();
        $result = $serializer->serialize($form);

        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('start_date', $result);
        $this->assertArrayHasKey('end_date', $result);
        $this->assertArrayHasKey('image', $result);
        $this->assertArrayHasKey('lat', $result);
        $this->assertArrayHasKey('lon', $result);

        $this->assertArrayHasKey('name', $result['title']);
        $this->assertArrayHasKey('type', $result['title']);
        $this->assertArrayHasKey('label', $result['title']);
        $this->assertArrayHasKey('description', $result['title']);

        $this->assertEquals(['required' => true], $result['title']['rules']);
    }
}
