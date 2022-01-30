<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\{
    Session,
    Storage\Handler\NativeFileSessionHandler,
    Storage\NativeSessionStorage
};

class SessionController
{
    /**
     * @Route(path="/session", name="session")
     *
     * @return Response
     */
    public function nativeSession(): Response
    {
        $sessionStorage = new NativeSessionStorage(
            options: [],
            handler: new NativeFileSessionHandler(),
        );
        $session = new Session(storage: $sessionStorage);

        return new Response();
    }
}