<?php

namespace App\Controller;


use App\Entity\Theme;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ThemeRepository $themeRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'themes' => $themeRepository->findAll(),
        ]);
    }

    #[Route('/default', name: 'app_default')]
    public function indexd(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
