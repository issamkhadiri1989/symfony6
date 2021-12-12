<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @return Response
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
