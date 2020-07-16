<?php

namespace FP\ElasticApmBundle\Apm;

use FP\ElasticApmBundle\Utils\ArrayHelper;
use Nipwaayoni\AgentBuilder;
use Nipwaayoni\Config;

class ElasticApmFactory
{
    public static function createAgent(array $config = [])
    {
        // Replace "enabled" config key with active from config array
        ArrayHelper::replaceKey($config, 'enabled', 'active');

        // Check php sapi is cli disable apm agent
        if (PHP_SAPI === 'cli') {
            $config['active'] = false;
        }

        return (new AgentBuilder())
            ->withConfig(new Config($config))
            ->build();
    }
}