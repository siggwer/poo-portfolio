<?php

/**
 * La configuration de PHP-DI pour les rendus (html, json, ...)
 */

use function \DI\get as di_get;
use function \DI\object as di_object;
use function \DI\string as di_string;

use Framework\Render\RenderInterface;
use Framework\Render\TwigRender;

return [
    'twig.path' => di_string(__DIR__.'/../app/View'),
    RenderInterface::class => di_object(TwigRender::class)
        ->constructor(di_get('twig.path'))
];
