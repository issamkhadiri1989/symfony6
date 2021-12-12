<?php

declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_TEACHER")
 *
 * @return Response
 */
class HomeController extends AbstractController
{
    /**
     * @IsGranted("ROLE_TEACHER")
     *
     * @return Response Some dummy response
     */
    public function teacher(): Response
    {
        return new Response();
    }

    //<editor-fold desc="//...">

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
        ]);
    }

    //</editor-fold>
}
