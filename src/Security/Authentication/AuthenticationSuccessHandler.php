<?php

declare(strict_types=1);

namespace App\Security\Authentication;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    /**
     * A custom authentication success handler.
     *
     * @param Request $request the current request instance
     *
     * @return Response a response to return to user. in API for example, it may be json response containing the token
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        // ... Do Some logic

        return new Response(/*Some response*/);
    }
}
