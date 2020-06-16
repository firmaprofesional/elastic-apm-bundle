<?php

namespace FP\ElasticApmBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

interface TokenStorageAwareInterface
{
    public function setTokenStorage(TokenStorage $tokenStorage);
}
