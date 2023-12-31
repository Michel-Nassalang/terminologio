<?php

namespace App\Controller;

use App\Entity\Traduction;
use App\Form\TraductionType;
use App\Repository\TraductionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/traduction')]
class TraductionController extends AbstractController
{
    #[Route('/', name: 'app_traduction_index', methods: ['GET'])]
    public function index(TraductionRepository $traductionRepository): Response
    {
        return $this->render('traduction/index.html.twig', [
            'traductions' => $traductionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_traduction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $traduction = new Traduction();
        $form = $this->createForm(TraductionType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traduction);
            $entityManager->flush();

            return $this->redirectToRoute('app_traduction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traduction/new.html.twig', [
            'traduction' => $traduction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traduction_show', methods: ['GET'])]
    public function show(Traduction $traduction): Response
    {
        return $this->render('traduction/show.html.twig', [
            'traduction' => $traduction,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_traduction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Traduction $traduction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TraductionType::class, $traduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_traduction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traduction/edit.html.twig', [
            'traduction' => $traduction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traduction_delete', methods: ['POST'])]
    public function delete(Request $request, Traduction $traduction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traduction->getId(), $request->request->get('_token'))) {
            $entityManager->remove($traduction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_traduction_index', [], Response::HTTP_SEE_OTHER);
    }
}
