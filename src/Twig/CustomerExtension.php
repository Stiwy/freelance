<?php

namespace App\Twig;

use Symfony\Component\Validator\Constraints\Length;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CustomerExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('plurial', [$this, 'plurial']),
        ];
    }

    public function plurial($value, $str)
    {
        if(count($value) != 1) {
            return count($value) . " " . $str . "s";
        } else {
            return count($value) . " " . $str;
        }
    }
}
