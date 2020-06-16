<?php

namespace FP\ElasticApmBundle\EventListener;

use FP\ElasticApmBundle\Apm\ElasticApmAwareInterface;
use FP\ElasticApmBundle\Apm\ElasticApmAwareTrait;
use FP\ElasticApmBundle\Utils\RequestProcessor;
use Nipwaayoni\Exception\Transaction\DuplicateTransactionNameException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ApmTransactionRegisterListener implements ElasticApmAwareInterface, LoggerAwareInterface
{
    use ElasticApmAwareTrait, LoggerAwareTrait;

    protected $exclude = [];

    public function onKernelRequest(GetResponseEvent $event)
    {
        $config = $this->apm->getConfig();
        $transactions = $config->get('transactions');

        if (!$event->isMasterRequest() || !$config->get('active') || !$transactions['enabled']) {
            return;
        }

        $name = RequestProcessor::getTransactionName($event->getRequest());
        if ($this->exclude) {
            foreach ($this->exclude as $pattern) {
                if (fnmatch($pattern, $name, FNM_NOESCAPE)) {
                    break;
                }
            }
        }

        try {
            $this->apm->startTransaction($name);
        } catch (DuplicateTransactionNameException $e) {
            return;
        }

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Transaction started for "%s"', $name));
        }
    }

    public function setExclude(array $exclude)
    {
        $this->exclude = $exclude;
    }
}
