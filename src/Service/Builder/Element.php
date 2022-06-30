<?php

namespace App\Service\Builder;

use JetBrains\PhpStorm\ArrayShape;

class Element
{
    /**
     * @var array
     */
    private array $input = [];

    /**
     * @var array
     */
    private array $children = [];

    /**
     * @param string $tag
     * @param array $input
     */
    public function __construct(private string $tag, array $input = [])
    {
        $this->input = $input;
    }

    /**
     * @return array
     */
    #[ArrayShape(['tag' => "string", 'input' => "array", 'children' => "array"])]
    public function toArray(): array
    {
        return [
            'tag' => $this->tag,
            'input' => $this->input,
            'children' => array_map(function (Element $child) {
                return $child->toArray();
            }, $this->children),
        ];
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param int $index
     * @return Element
     */
    public function getChild(int $index): Element
    {
        return $this->children[$index];
    }

    /**
     * @param Element $element
     * @return $this
     */
    public function appendChild(Element $element): static
    {
        $this->children[] = $element;

        return $this;
    }
}