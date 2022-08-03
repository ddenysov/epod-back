<?php

namespace App\Service\Builder;

interface ElementInterface
{
    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string
     */
    public function getTag(): string;
}