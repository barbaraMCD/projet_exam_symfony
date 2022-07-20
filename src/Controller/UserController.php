<?php

namespace App\Controller;

use App\Entity\Oeuvre;
use App\Form\OeuvreType;
use App\Repository\OeuvreRepository;
use App\Repository\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    #[Route('/api/profil', name: 'profilApi')]
    public function indexApi(OeuvreRepository $oeuvreRepository, ProfilRepository $profilRepository): Response
    {
        $user = $this->getUser();
        $oeuvres = $oeuvreRepository->findAll();
        $profils = $profilRepository->findAll();
        return $this->render('user/index.html.twig', [
            "user" => $user,
            "oeuvres" => $oeuvres,
            "profils" => $profils
        ]);
    }

    #[Route('/profil', name: 'profil')]
    public function index(OeuvreRepository $oeuvreRepository, ProfilRepository $profilRepository): Response
    {
        $user = $this->getUser();
        $oeuvres = $oeuvreRepository->findAll();
        $profils = $profilRepository->findAll();
        return $this->render('user/index.html.twig', [
            "user" => $user,
            "oeuvres" => $oeuvres,
            "profils" => $profils
        ]);
    }

    #[Route('/create', name: 'oeuvre.create', methods: ['GET', 'POST'])]
    public function create(Request $request, OeuvreRepository $oeuvreRepository) : Response
    {
        $oeuvre = new Oeuvre();

        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $oeuvre->setUser($this->getUser());
            $oeuvreRepository->add($oeuvre);
            $this->addFlash('success', "Votre oeuvre a été ajouté avec succès.");
            return $this->redirectToRoute('profil');
        }

        return $this->render("user/createOeuvre.html.twig", [
          'form' => $form->createView()
        ]);
    }

    #[Route('/api/create', name: 'oeuvre.create', methods: ['GET', 'POST'])]
    public function createApi(Request $request, OeuvreRepository $oeuvreRepository) : Response
    {
        $oeuvre = new Oeuvre();

        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $oeuvre->setUser($this->getUser());
            $oeuvreRepository->add($oeuvre);
            $this->addFlash('success', "Votre oeuvre a été ajouté avec succès.");
            return $this->redirectToRoute('profil');
        }

        return $this->render("user/createOeuvre.html.twig", [
          'form' => $form->createView()
        ]);
    }

        #[Route('/modify/{id<[0-9]+>}', name: 'oeuvre.edit', methods: ['GET', 'POST'])]
        public function edit(Oeuvre $oeuvre, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/editOeuvre.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/api/modify/{id<[0-9]+>}', name: 'oeuvre.edit', methods: ['GET', 'POST'])]
        public function editApi(Oeuvre $oeuvre, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/editOeuvre.html.twig', [
            'form' => $form->createView(),
        ]);
    }

        #[Route('/supprimer/{id<[0-9]+>}', name: 'oeuvre.delete', methods: ['POST'])]
        public function delete(Oeuvre $oeuvre, Request $request, OeuvreRepository $oeuvreRepository)
        {

            if($this->isCsrfTokenValid('delete' . $oeuvre->getId(), $request->request->get('_token')) )
        {
            $oeuvreRepository->remove($oeuvre, true);
            return $this->redirectToRoute('profil');
        }
        
        }

        #[Route('/api/supprimer/{id<[0-9]+>}', name: 'oeuvre.delete', methods: ['POST'])]
        public function deleteApi(Oeuvre $oeuvre, Request $request, OeuvreRepository $oeuvreRepository)
        {

            if($this->isCsrfTokenValid('delete' . $oeuvre->getId(), $request->request->get('_token')) )
        {
            $oeuvreRepository->remove($oeuvre, true);
            return $this->redirectToRoute('profil');
        }
        
        }
}
