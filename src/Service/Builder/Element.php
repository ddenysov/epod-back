<?php

namespace App\Service\Builder;

use JetBrains\PhpStorm\ArrayShape;

class Element
{
    /**
     * @var array
     */
    private array $props = [];

    /**
     * @var array
     */
    private array $children = [];

    /**
     * @param string $tag
     */
    public function __construct(private string $tag) { }

    /**
     * @return array
     */
    #[ArrayShape(['tag' => "string", 'props' => "array", 'children' => "array"])]
    public function toArray(): array
    {
        return [
            'tag' => $this->tag,
            'props' => $this->props,
            'children' => array_map(function (Element $child) {
                return $child->toArray();
            }, $this->children),
        ];
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setProp(string $key, string $value): static
    {
        $this->props[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getProp(string $key): string
    {
        return $this->props[$key];
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