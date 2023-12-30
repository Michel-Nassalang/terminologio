<?php

namespace App\Controller;

use App\Entity\Illustration;
use App\Form\IllustrationType;
use App\Repository\IllustrationRepository;
use App\Entity\Composant;
use App\Form\ComposantType;
use App\Repository\ComposantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/illustration')]
class IllustrationController extends AbstractController
{
    #[Route('/', name: 'app_illustration_index', methods: ['GET'])]
    public function index(IllustrationRepository $illustrationRepository): Response
    {
        return $this->render('illustration/index.html.twig', [
            'illustrations' => $illustrationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_illustration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $illustration = new Illustration();
        $form = $this->createForm(IllustrationType::class, $illustration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgsrc')->getData();

            // Stockage dans le dossier public/uploads
            $uploadsDirectory = $this->getParameter('uploads_directory');
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $uploadsDirectory,
                $fileName
            );

            $illustration->setImgsrc($fileName);
            
            $entityManager->persist($illustration);
            $entityManager->flush();

            return $this->redirectToRoute('app_illustration_edit', ['id' => $illustration->getId()], Response::HTTP_SEE_OTHER);
        }else {
            $errors = $form->getErrors(true, false);
            return $this->render('illustration/new.html.twig', [
                'illustration' => $illustration,
                'form' => $form,
            ]);
        }

        
    }

    #[Route('/{id}', name: 'app_illustration_show', methods: ['GET'])]
    public function show(Illustration $illustration): Response
    {
        return $this->render('illustration/show.html.twig', [
            'illustration' => $illustration,
        ]);
    }

    

    #[Route('/data/{id}', name: 'app_illustration_data', methods: ['GET'])]
    public function showIllustrationData(Illustration $illustration, SerializerInterface $serializer): JsonResponse
    {
        $jsonIllustration = $serializer->serialize($illustration, 'json', ['groups' => ['data']]);
        return new JsonResponse($jsonIllustration, Response::HTTP_OK, [], true);
    }



    #[Route('/{id}/edit', name: 'app_illustration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Illustration $illustration, EntityManagerInterface $entityManager): Response
    {
        $composant = new Composant();
        $form = $this->createForm(ComposantType::class, $composant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $composant->setIllusId($illustration);
            $entityManager->persist($composant);
            $entityManager->flush();

        }

        return $this->render('illustration/edit.html.twig', [
            'illustration' => $illustration,
            'form' => $form,
        ]);
    }


    

    #[Route('/{id}', name: 'app_illustration_delete', methods: ['POST'])]
    public function delete(Request $request, Illustration $illustration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$illustration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($illustration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_illustration_index', [$illustration], Response::HTTP_SEE_OTHER);
    }

    // #[Route('/{id}/composant', name: 'app_illustration_composant', methods: ['GET', 'POST'])]
    // public function editComposant(Request $request,Illustration $illustration, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    // {
    //     $composant = new Composant();
    //     $label = $request->request->get('label');
    //     $adressex = $request->request->get('adressex');
    //     $adressey = $request->request->get('adressey');
    //     $description = $request->request->get('description');
    //     $composant->setLabel($label);
    //     $composant->setAdressex($adressex);
    //     $composant->setAdressey($adressey);
    //     $composant->setDescription($description);
    //     $composant->setIllusId($illustration);

    //     $entityManager->persist($composant);
    //     $entityManager->flush();

    //     $jsonComposant = $serializer->serialize($composant, 'json');
    //     // return new JsonResponse($jsonComposant, Response::HTTP_OK, [], true);
    //     return $this->render('illustration/edit.html.twig', [
    //         'illustration' => $illustration,
    //     ]);
    // }
}

