<?php

namespace App\Service\Builder\Form;

use Symfony\Component\Form\Button;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SymfonyRuleResolver
{
    /**
     * @return array
     */
    protected function mapRules(): array
    {
        return [
            NotBlank::class => ['required' => true],
        ];
    }

    /**
     * @return \string[][]
     */
    protected function mapMessages(): array
    {
        return [
            NotBlank::class => ['message']
        ];
    }

    /**
     * @param Form $item
     * @return array
     */
    public function resolve(FormInterface $item): array
    {
        if (get_class($item) === Button::class) {
            return [
                'rules' => [],
                'messages' => [],
            ];
        }
        $rules = array_reduce($item->getConfig()->getOption('constraints') , function ($prev, $curr) {
            if (isset($this->mapRules()[get_class($curr)])) {
                $val = $this->mapRules()[get_class($curr)];
                $prev = array_merge_recursive($prev, $val);
            }

            return $prev;
        }, []);

        $messages = array_reduce($item->getConfig()->getOption('constraints') , function ($prev, $curr) {
            if (isset($this->mapMessages()[get_class($curr)])) {
                $msgMap = $this->mapMessages()[get_class($curr)];

                $res = [];
                $x = [];
                foreach ($msgMap as $msg) {
                    $res[] = $curr->$msg;
                }
                $val = array_keys($this->mapRules()[get_class($curr)])[0];
                //@TODO Check multiple messages for vee validate
                $x[$val] = $res[0];

                $prev = array_merge_recursive($prev, $x);
            }

            return $prev;
        }, []);

        return [
            'rules' => $rules,
            'messages' => $messages,
        ];
    }
}