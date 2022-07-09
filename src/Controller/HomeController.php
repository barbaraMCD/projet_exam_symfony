<?php

namespace App\Controller;

use App\Repository\OeuvreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "user" => $user,
        ]);
    }

    #[Route('/api/oeuvres', name: 'oeuvre')]
    public function indexOeuvre(OeuvreRepository $oeuvreRepository): Response
    {
        $oeuvres = $oeuvreRepository->findAll();
        $user = $this->getUser();
        return $this->render('home/indexOeuvre.html.twig', [
            "oeuvres" => $oeuvres,
            "user" => $user,
        ]);
    }
}
