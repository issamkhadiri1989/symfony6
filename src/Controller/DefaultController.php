<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DefaultController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(EntityManagerInterface $manager, ContainerBagInterface $containerBag): Response
    {
        $database = $containerBag->get('app.secret');
        $databaseUrl = $containerBag->get('app.database_url');
//            $user = new User();
//            $user->setName('ipsum lorem');
//            $manager->persist($user);
//            $manager->flush();

        return $this->render('default/index.html.twig');
    }
}