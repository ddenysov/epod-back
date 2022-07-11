<?php

namespace App\Tests\Service\Builder\Form;

use App\Entity\Event;
use App\Form\EventType;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testSerialization()
    {
        $event = new Event();
        $form = $this->container->get('form.factory')->create(EventType::class, $event);
        $this->assertTrue(false);
    }
}
