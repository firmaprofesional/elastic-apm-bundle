<?php

namespace FP\ElasticApmBundle\Apm;

use Nipwaayoni\Agent;

trait ElasticApmAwareTrait
{
    /**
     * @var Agent
     */
    protected $apm;

    public function __construct(Agent $apm)
    {
        $this->apm = $apm;
    }
}