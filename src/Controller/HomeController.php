<?php

namespace App\Controller;

use App\Repository\OeuvreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'home')]
    // public function index(): Response
    // {
    //     $user = $this->getUser();
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //         "user" => $user,
    //     ]);
    // }

    #[Route('/api', name: 'homeApi')]
    public function indexApi(): Response
    {
        $user = $this->getUser();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "user" => $user,
        ]);
    }

    // #[Route('/oeuvres', name: 'oeuvre')]
    // public function indexOeuvre(OeuvreRepository $oeuvreRepository): Response
    // {
    //     $oeuvres = $oeuvreRepository->findAll();
    //     $user = $this->getUser();
    //     return $this->render('home/indexOeuvre.html.twig', [
    //         "oeuvres" => $oeuvres,
    //         "user" => $user,
    //     ]);
    // }

    #[Route('/api/oeuvres', name: 'oeuvreApi', methods:["GET"])]
    public function indexOeuvreApi(OeuvreRepository $oeuvreRepository): Response
    {
        $oeuvres = $oeuvreRepository->findAll();
        $serializedOeuvres = array_map(function ($se) {
            return array(
                "Id" => $se->getId(),
                 "TitreOeuvre" => $se->getTitreOeuvre(),
                 "Contenu" => $se->getContenu(),
                 "Genre" => $se->getGenre(),
                 "User" => $se->getUser()
              );
            }, $oeuvres);
            return new JsonResponse($serializedOeuvres);
    }
}
