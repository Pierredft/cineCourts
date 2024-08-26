<?php
// src/Security/CustomAuthenticationEntryPoint.php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class CustomAuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    public function start(Request $request, AuthenticationException $authException = null)
    {
        // Rediriger vers la route app_home
        return new RedirectResponse($this->router->generate('app_home', ['showLoginModal' => 'true']));
    }
}