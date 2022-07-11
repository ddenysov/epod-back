<?php

namespace App\Service\Builder\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints\NotBlank;

class SymfonyRuleResolver
{
    /**
     * @return array
     */
    protected function map(): array
    {
        return [
            NotBlank::class => ['required' => true],
        ];
    }

    /**
     * @param Form $item
     * @return array
     */
    public function resolve(Form $item): array
    {
        return array_reduce($item->getConfig()->getOption('constraints') , function ($prev, $curr) {
            if (isset($this->map()[get_class($curr)])) {
                $val = $this->map()[get_class($curr)];
                $prev = array_merge_recursive($prev, $val);
            }

            return $prev;
        }, []);
    }
}