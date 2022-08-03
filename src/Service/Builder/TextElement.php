<?php

namespace App\Service\Builder;

use JetBrains\PhpStorm\ArrayShape;

class TextElement implements ElementInterface
{
    /**
     * @param string $tag
     * @param string $content
     */
    public function __construct(
        private string $tag,
        private string $content
    )
    {
    }

    /**
     * @return array
     */
    #[ArrayShape(['tag' => "string", 'content' => "string"])]
    public function toArray(): array
    {
        return [
            'tag' => $this->tag,
            'content' => $this->content,
        ];
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }
}