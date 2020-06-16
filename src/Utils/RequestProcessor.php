<?php

namespace FP\ElasticApmBundle\Utils;

use Symfony\Component\HttpFoundation\Request;

class RequestProcessor
{
    public static function getTransactionName(Request $request): string
    {
        $controllerName = $request->get('_controller');
        return sprintf('%s', $controllerName);
    }
}
